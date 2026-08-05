<h3>Detail Penjualan Cancel #<?= $row['id'] ?></h3>

<div class="row g-3">
    <div class="col-lg-7">
        <table class="table table-bordered bg-white">
            <tr><th style="width: 220px">Order No</th><td><?= htmlspecialchars($row['order_no'] ?: '-') ?></td></tr>
            <tr><th>Salesorder No</th><td><?= htmlspecialchars($row['salesorder_no'] ?: '-') ?></td></tr>
            <tr><th>Customer</th><td><?= htmlspecialchars($row['customer_name'] ?: '-') ?></td></tr>
            <tr><th>Kontak</th><td><?= htmlspecialchars(($row['customer_phone'] ?: '') . (!empty($row['customer_email']) ? ' / ' . $row['customer_email'] : '')) ?></td></tr>
            <tr><th>Alasan Cancel</th><td><?= htmlspecialchars($row['cancel_reason'] ?: '-') ?></td></tr>
            <tr><th>Subtotal</th><td><?= htmlspecialchars($row['sub_total'] ?: '-') ?></td></tr>
            <tr><th>Grand Total</th><td><?= htmlspecialchars($row['grand_total'] ?: '-') ?></td></tr>
            <tr><th>WMS Status</th><td><?= htmlspecialchars($row['wms_status'] ?: '-') ?></td></tr>
            <tr><th>Channel Status</th><td><?= htmlspecialchars($row['channel_status'] ?: '-') ?></td></tr>
            <tr><th>Shipping</th><td><?= htmlspecialchars(($row['shipping_full_name'] ?: '-') . (!empty($row['shipping_address']) ? ' - ' . $row['shipping_address'] : '')) ?></td></tr>
            <tr><th>Tracking</th><td><?= htmlspecialchars($row['tracking_number'] ?: $row['tracking_no'] ?: '-') ?></td></tr>
            <tr><th>Tanggal Cancel</th><td><?= htmlspecialchars($row['cancel_date'] ?: $row['internal_cancel_date'] ?: '-') ?></td></tr>
            <tr><th>Status</th><td><span class="badge bg-secondary"><?= htmlspecialchars($row['status'] ?: 'pending') ?></span></td></tr>
            <tr><th>Dikirim pada</th><td><?= htmlspecialchars($row['sent_at'] ?: '-') ?></td></tr>
        </table>
    </div>
</div>

<?php if (!empty($details)): ?>
    <h5 class="mt-4">Item yang dibatalkan</h5>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
            <tr>
                <th>Item</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Canceled</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($details as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['item_name'] ?: $d['description'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($d['item_code'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($d['qty'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($d['amount'] ?: '-') ?></td>
                    <td><?= !empty($d['is_canceled_item']) ? 'Ya' : 'Tidak' ?></td>
                    <td><?= htmlspecialchars($d['status'] ?: '-') ?></td>
                </tr>

                <?php $serialRows = $serialsByDetail[$d['id']] ?? []; ?>
                <?php if (!empty($serialRows)): ?>
                    <tr>
                        <td colspan="6" class="bg-light">
                            <strong>Serial Item</strong>
                            <div class="table-responsive mt-2">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>picked_serial_number_id</th>
                                        <th>picklist_detail_id</th>
                                        <th>pick_scanned_date</th>
                                        <th>batch_no</th>
                                        <th>serial_no</th>
                                        <th>bin_id</th>
                                        <th>qty</th>
                                        <th>expired_date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($serialRows as $serial): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($serial['picked_serial_number_id'] ?: '-') ?></td>
                                            <td><?= htmlspecialchars($serial['picklist_detail_id'] ?: '-') ?></td>
                                            <td><?= htmlspecialchars($serial['pick_scanned_date'] ?: '-') ?></td>
                                            <td><?= htmlspecialchars($serial['batch_no'] ?: '-') ?></td>
                                            <td><?= htmlspecialchars($serial['serial_no'] ?: '-') ?></td>
                                            <td><?= htmlspecialchars($serial['bin_id'] ?: '-') ?></td>
                                            <td><?= htmlspecialchars($serial['qty'] ?: '-') ?></td>
                                            <td><?= htmlspecialchars($serial['expired_date'] ?: '-') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<h5 class="mt-4">Payload dari Jubelio</h5>
<pre class="payload"><?= htmlspecialchars(json_encode(json_decode($row['payload']), JSON_PRETTY_PRINT)) ?></pre>

<h5 class="mt-4">Payload yang dikirim ke D365</h5>
<pre class="payload"><?= htmlspecialchars($d365_payload_raw ?? '') ?></pre>

<h5>Response D365</h5>
<pre class="payload"><?= htmlspecialchars($row['response'] ?? '') ?></pre>

<form action="<?= site_url('admin/cancel/' . $row['id'] . '/resend') ?>" method="post" style="display:inline">
    <button class="btn btn-warning">Kirim Ulang ke D365</button>
</form>
<a href="<?= site_url('admin/cancel') ?>" class="btn btn-secondary">Kembali</a>
