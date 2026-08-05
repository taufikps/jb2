<h3>Detail Penjualan #<?= $row['id'] ?></h3>

<div class="row g-3">
    <div class="col-lg-7">
        <table class="table table-bordered bg-white">
            <tr><th style="width: 220px">Order No</th><td><?= htmlspecialchars($row['order_no'] ?: '-') ?></td></tr>
            <tr><th>Salesorder No</th><td><?= htmlspecialchars($row['salesorder_no'] ?: '-') ?></td></tr>
            <tr><th>Customer</th><td><?= htmlspecialchars($row['customer_name'] ?: '-') ?></td></tr>
            <tr><th>Kontak</th><td><?= htmlspecialchars(($row['customer_phone'] ?: '') . (!empty($row['customer_email']) ? ' / ' . $row['customer_email'] : '')) ?></td></tr>
            <tr><th>Subtotal</th><td><?= htmlspecialchars($row['sub_total'] ?: '-') ?></td></tr>
            <tr><th>Grand Total</th><td><?= htmlspecialchars($row['grand_total'] ?: '-') ?></td></tr>
            <tr><th>Channel Status</th><td><?= htmlspecialchars($row['channel_status'] ?: '-') ?></td></tr>
            <tr><th>Shipping</th><td><?= htmlspecialchars(($row['shipping_full_name'] ?: '-') . (!empty($row['shipping_address']) ? ' - ' . $row['shipping_address'] : '')) ?></td></tr>
            <tr><th>Tracking</th><td><?= htmlspecialchars($row['tracking_number'] ?: $row['tracking_no'] ?: '-') ?></td></tr>
            <tr><th>Tanggal</th><td><?= htmlspecialchars($row['transaction_date'] ?: $row['created_date'] ?: '-') ?></td></tr>
            <tr><th>Status</th><td><span class="badge bg-secondary"><?= htmlspecialchars($row['status'] ?: 'pending') ?></span></td></tr>
            <tr><th>Dikirim pada</th><td><?= htmlspecialchars($row['sent_at'] ?: '-') ?></td></tr>
        </table>
    </div>
</div>

<?php if (!empty($details)): ?>
    <h5 class="mt-4">Item</h5>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
            <tr>
                <th>Item</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($details as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['item_name'] ?: $d['description'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($d['item_code'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($d['qty'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($d['amount'] ?: '-') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if (!empty($serials)): ?>
    <h5 class="mt-4">Serial Item</h5>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
            <tr>
                <th>Detail ID</th>
                <th>Serial ID</th>
                <th>Serial Number</th>
                <th>Extra Info</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($serials as $serial): ?>
                <tr>
                    <td><?= htmlspecialchars($serial['salesorder_detail_internal_id'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($serial['serial_id'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($serial['serial_number'] ?: '-') ?></td>
                    <td><pre class="payload mb-0"><?= htmlspecialchars(is_array($serial['extra_info']) ? json_encode($serial['extra_info'], JSON_PRETTY_PRINT) : ($serial['extra_info'] ?: '-')) ?></pre></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if (!empty($packages)): ?>
    <h5 class="mt-4">Packages</h5>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
            <tr>
                <th>Package ID</th>
                <th>Package Number</th>
                <th>Weight (Kg)</th>
                <th>Courier Code</th>
                <th>Tracking No</th>
                <th>Meta</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($packages as $package): ?>
                <tr>
                    <td><?= htmlspecialchars($package['package_id'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($package['package_number'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($package['weight_kg'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($package['courier_code'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($package['tracking_no'] ?: '-') ?></td>
                    <td><pre class="payload mb-0"><?= htmlspecialchars(is_array($package['meta']) ? json_encode($package['meta'], JSON_PRETTY_PRINT) : ($package['meta'] ?: '-')) ?></pre></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if (!empty($wms_histories)): ?>
    <h5 class="mt-4">WMS History</h5>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
            <tr>
                <th>Status Code</th>
                <th>Updated At</th>
                <th>Updated By</th>
                <th>Meta</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($wms_histories as $wms): ?>
                <tr>
                    <td><?= htmlspecialchars($wms['status_code'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($wms['updated_at'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($wms['updated_by'] ?: '-') ?></td>
                    <td><pre class="payload mb-0"><?= htmlspecialchars(is_array($wms['meta']) ? json_encode($wms['meta'], JSON_PRETTY_PRINT) : ($wms['meta'] ?: '-')) ?></pre></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if (!empty($escrows)): ?>
    <h5 class="mt-4">Escrow</h5>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
            <tr>
                <th>Escrow ID</th>
                <th>Amount</th>
                <th>Settlement Status</th>
                <th>Released Date</th>
                <th>Meta</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($escrows as $escrow): ?>
                <tr>
                    <td><?= htmlspecialchars($escrow['escrow_id'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($escrow['amount'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($escrow['settlement_status'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($escrow['released_date'] ?: '-') ?></td>
                    <td><pre class="payload mb-0"><?= htmlspecialchars(is_array($escrow['meta']) ? json_encode($escrow['meta'], JSON_PRETTY_PRINT) : ($escrow['meta'] ?: '-')) ?></pre></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<h5 class="mt-4">Payload dari Jubelio</h5>
<pre class="payload"><?= htmlspecialchars(json_encode(json_decode($row['payload']), JSON_PRETTY_PRINT)) ?></pre>

<h5 class="mt-4">Payload yang dikirim ke D365</h5>
<pre class="payload"><?= htmlspecialchars($d365_payload_raw) ?></pre>

<h5>Response D365</h5>
<pre class="payload"><?= htmlspecialchars($row['response']) ?></pre>

<form action="<?= site_url('admin/penjualan/' . $row['id'] . '/resend') ?>" method="post" style="display:inline">
    <button class="btn btn-warning">Kirim Ulang ke D365</button>
</form>
<a href="<?= site_url('admin/penjualan') ?>" class="btn btn-secondary">Kembali</a>
