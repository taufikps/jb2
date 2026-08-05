<?php
// Backfill script for middleware_penjualan_cancel.payload
// Usage: php tools/backfill_cancel_payload.php [--limit=N] [--confirm]

$config = [
    'host' => '127.0.0.1',
    'user' => 'root',
    'pass' => '',
    'db'   => 'middleware',
    'port' => 3306,
    'socket' => '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock',
];

$opts = array_reduce($argv, function($acc, $arg) {
    if (strpos($arg, '--limit=') === 0) $acc['limit'] = (int)substr($arg,8);
    if ($arg === '--confirm') $acc['confirm'] = true;
    return $acc;
}, ['limit' => 100, 'confirm' => false]);

$mysqli = mysqli_init();
if (!$mysqli->real_connect($config['host'], $config['user'], $config['pass'], $config['db'], $config['port'], $config['socket'])) {
    echo "DB connect failed: " . mysqli_connect_error() . "\n";
    exit(1);
}

$limitSql = $opts['limit'] > 0 ? "LIMIT " . intval($opts['limit']) : '';
$selectSql = "SELECT id, order_no, salesorder_no, contact_id, customer_name, customer_phone, customer_email, transaction_date, created_date, last_modified, is_tax_included, note, sub_total, total_disc, total_tax, grand_total, ref_no, payment_method, location_id, is_canceled, cancel_reason, cancel_reason_detail, source, is_paid, channel_status, shipping_cost, insurance_cost, shipping_full_name, shipping_address, payload, items_payload FROM middleware_penjualan_cancel WHERE (payload IS NULL OR payload = '') " . $limitSql;

$res = $mysqli->query($selectSql);
if (!$res) {
    echo "Select failed: " . $mysqli->error . "\n";
    exit(1);
}

$rows = $res->fetch_all(MYSQLI_ASSOC);
echo "Found " . count($rows) . " rows to inspect (limit={$opts['limit']}).\n";
$updates = 0;

foreach ($rows as $row) {
    $id = $row['id'];
    // try to reconstruct payload: prefer existing items_payload if present
    $payload = null;
    if (!empty($row['payload'])) {
        $payload = $row['payload'];
    } elseif (!empty($row['items_payload'])) {
        // build object with basic fields + items
        $obj = $row;
        $obj['items'] = json_decode($row['items_payload'], true) ?: [];
        // remove DB-specific columns we don't want in payload
        unset($obj['items_payload']);
        $payload = json_encode($obj, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    } else {
        // try to fetch detail rows
        $dres = $mysqli->query("SELECT item_id,item_code,item_name,qty,price,amount FROM middleware_penjualan_cancel_detail WHERE cancel_id = " . intval($id));
        $items = [];
        if ($dres) {
            $items = $dres->fetch_all(MYSQLI_ASSOC);
        }
        $obj = [
            'order_no' => $row['order_no'],
            'salesorder_no' => $row['salesorder_no'],
            'customer_name' => $row['customer_name'],
            'items' => $items,
        ];
        $payload = json_encode($obj, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    if ($payload === null) {
        echo "Row {$id}: could not construct payload\n";
        continue;
    }

    echo "Row {$id}: payload length=" . strlen($payload) . "\n";

    if (!empty($opts['confirm'])) {
        $stmt = $mysqli->prepare("UPDATE middleware_penjualan_cancel SET payload = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param('si', $payload, $id);
        if ($stmt->execute()) {
            $updates++;
        } else {
            echo "Update failed for {$id}: " . $stmt->error . "\n";
        }
        $stmt->close();
    }
}

echo "Done. Updates applied: {$updates}. (confirm=" . ($opts['confirm'] ? 'yes' : 'no') . ")\n";
$mysqli->close();

exit(0);
