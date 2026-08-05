<?php foreach ($rows as $r): ?>
    <tr data-status="<?= strtolower($r['status']) ?>">
        <td><?= $r['id'] ?></td>
        <td><?= htmlspecialchars($r['order_no']) ?></td>
        <td><?= htmlspecialchars($r['salesorder_no']) ?></td>
        <td><?= htmlspecialchars($r['invoice_no']) ?></td>
        <td><?= htmlspecialchars($r['customer_code']) ?></td>
        <td><?= htmlspecialchars($r['customer_name']) ?></td>
        <td><?= htmlspecialchars($r['customer_phone']) ?></td>
        <td><?= htmlspecialchars($r['customer_email']) ?></td>
        <td><?= htmlspecialchars($r['contact_id']) ?></td>
        <td><?= htmlspecialchars($r['action']) ?></td>
        <td><?= htmlspecialchars($r['status']) ?></td>
        <td><?= htmlspecialchars($r['order_status']) ?></td>
        <td><?= htmlspecialchars($r['internal_status']) ?></td>
        <td><?= htmlspecialchars($r['channel_status']) ?></td>
        <td><?= htmlspecialchars($r['source']) ?></td>
        <td><?= htmlspecialchars($r['source_name']) ?></td>
        <td><?= htmlspecialchars($r['store']) ?></td>
        <td><?= htmlspecialchars($r['store_name']) ?></td>
        <td><?= htmlspecialchars($r['store_id']) ?></td>
        <td><?= htmlspecialchars($r['location_name']) ?></td>
        <td><?= htmlspecialchars($r['location_code']) ?></td>
        <td><?= htmlspecialchars($r['location_id']) ?></td>
        <td><?= number_format($r['sub_total'] ?? 0, 2) ?></td>
        <td><?= number_format($r['total_disc'] ?? 0, 2) ?></td>
        <td><?= number_format($r['total_tax'] ?? 0, 2) ?></td>
        <td><?= number_format($r['grand_total'] ?? 0, 2) ?></td>
        <td><?= number_format($r['shipping_cost'] ?? 0, 2) ?></td>
        <td><?= number_format($r['insurance_cost'] ?? 0, 2) ?></td>
        <td><?= number_format($r['shipping_tax'] ?? 0, 2) ?></td>
        <td><?= number_format($r['shipping_cost_discount'] ?? 0, 2) ?></td>
        <td><?= number_format($r['discount_marketplace'] ?? 0, 2) ?></td>
        <td><?= number_format($r['service_fee'] ?? 0, 2) ?></td>
        <td><?= number_format($r['order_processing_fee'] ?? 0, 2) ?></td>
        <td><?= number_format($r['cod_fee'] ?? 0, 2) ?></td>
        <td><?= number_format($r['buyer_shipping_cost'] ?? 0, 2) ?></td>
        <td><?= htmlspecialchars($r['courier']) ?></td>
        <td><?= htmlspecialchars($r['shipper']) ?></td>
        <td><?= htmlspecialchars($r['shipping_full_name']) ?></td>
        <td><?= htmlspecialchars($r['shipping_address']) ?></td>
        <td><?= htmlspecialchars($r['shipping_area']) ?></td>
        <td><?= htmlspecialchars($r['shipping_city']) ?></td>
        <td><?= htmlspecialchars($r['shipping_province']) ?></td>
        <td><?= htmlspecialchars($r['shipping_post_code']) ?></td>
        <td><?= htmlspecialchars($r['shipping_country']) ?></td>
        <td><?= htmlspecialchars($r['tracking_no']) ?></td>
        <td><?= htmlspecialchars($r['tracking_number']) ?></td>
        <td><?= htmlspecialchars($r['tracking_url']) ?></td>
        <td><?= htmlspecialchars($r['invoice_date']) ?></td>
        <td><?= htmlspecialchars($r['transaction_date']) ?></td>
        <td><?= htmlspecialchars($r['created_date']) ?></td>
        <td><?= htmlspecialchars($r['last_modified']) ?></td>
        <td><span class="badge badge-<?= $r['status'] ?>"><?= $r['status'] ?></span></td>
        <td><?= htmlspecialchars($r['sent_at']) ?></td>
        <td>
            <a href="<?= site_url('admin/penjualan/' . $r['id']) ?>" class="btn btn-sm btn-primary">Detail</a>
            <form action="<?= site_url('admin/penjualan/' . $r['id'] . '/resend') ?>" method="post" style="display:inline">
                <button class="btn btn-sm btn-warning" type="submit">Kirim ke D365</button>
            </form>
            <form action="<?= site_url('admin/penjualan/' . $r['id'] . '/delete') ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
