<h3>Detail Return #<?= $row['id'] ?></h3>

<table class="table table-bordered bg-white">
    <tr><th style="width: 220px;">Order No</th><td><?= htmlspecialchars($row['order_no'] ?? '') ?></td></tr>
    <tr><th>Return No</th><td><?= htmlspecialchars($row['return_no'] ?? '') ?></td></tr>
    <tr><th>Tanggal Return</th><td><?= htmlspecialchars($row['return_date'] ?? '') ?></td></tr>
    <tr><th>Salesorder ID</th><td><?= htmlspecialchars($row['salesorder_id'] ?? '') ?></td></tr>
    <tr><th>Salesorder No</th><td><?= htmlspecialchars($row['salesorder_no'] ?? '') ?></td></tr>
    <tr><th>Contact ID</th><td><?= htmlspecialchars($row['contact_id'] ?? '') ?></td></tr>
    <tr><th>Customer Name</th><td><?= htmlspecialchars($row['customer_name'] ?? '') ?></td></tr>
    <tr><th>Customer Phone</th><td><?= htmlspecialchars($row['customer_phone'] ?? '') ?></td></tr>
    <tr><th>Customer Email</th><td><?= htmlspecialchars($row['customer_email'] ?? '') ?></td></tr>
    <tr><th>Transaction Date</th><td><?= htmlspecialchars($row['transaction_date'] ?? '') ?></td></tr>
    <tr><th>Created Date</th><td><?= htmlspecialchars($row['created_date'] ?? '') ?></td></tr>
    <tr><th>Last Modified</th><td><?= htmlspecialchars($row['last_modified'] ?? '') ?></td></tr>
    <tr><th>Internal Status</th><td><?= htmlspecialchars($row['internal_status'] ?? '') ?></td></tr>
    <tr><th>Channel Status</th><td><?= htmlspecialchars($row['channel_status'] ?? '') ?></td></tr>
    <tr><th>Source</th><td><?= htmlspecialchars($row['source'] ?? '') ?></td></tr>
    <tr><th>Source Name</th><td><?= htmlspecialchars($row['source_name'] ?? '') ?></td></tr>
    <tr><th>Store</th><td><?= htmlspecialchars($row['store'] ?? '') ?></td></tr>
    <tr><th>Store Name</th><td><?= htmlspecialchars($row['store_name'] ?? '') ?></td></tr>
    <tr><th>Store ID</th><td><?= htmlspecialchars($row['store_id'] ?? '') ?></td></tr>
    <tr><th>Location ID</th><td><?= htmlspecialchars($row['location_id'] ?? '') ?></td></tr>
    <tr><th>Location Name</th><td><?= htmlspecialchars($row['location_name'] ?? '') ?></td></tr>
    <tr><th>Location Code</th><td><?= htmlspecialchars($row['location_code'] ?? '') ?></td></tr>
    <tr><th>Sub Total</th><td><?= htmlspecialchars($row['sub_total'] ?? '') ?></td></tr>
    <tr><th>Total Disc</th><td><?= htmlspecialchars($row['total_disc'] ?? '') ?></td></tr>
    <tr><th>Total Tax</th><td><?= htmlspecialchars($row['total_tax'] ?? '') ?></td></tr>
    <tr><th>Grand Total</th><td><?= htmlspecialchars($row['grand_total'] ?? '') ?></td></tr>
    <tr><th>Shipping Cost</th><td><?= htmlspecialchars($row['shipping_cost'] ?? '') ?></td></tr>
    <tr><th>Insurance Cost</th><td><?= htmlspecialchars($row['insurance_cost'] ?? '') ?></td></tr>
    <tr><th>Shipping Tax</th><td><?= htmlspecialchars($row['shipping_tax'] ?? '') ?></td></tr>
    <tr><th>Shipping Full Name</th><td><?= htmlspecialchars($row['shipping_full_name'] ?? '') ?></td></tr>
    <tr><th>Shipping Phone</th><td><?= htmlspecialchars($row['shipping_phone'] ?? '') ?></td></tr>
    <tr><th>Shipping Address</th><td><?= htmlspecialchars($row['shipping_address'] ?? '') ?></td></tr>
    <tr><th>Shipping Area</th><td><?= htmlspecialchars($row['shipping_area'] ?? '') ?></td></tr>
    <tr><th>Shipping City</th><td><?= htmlspecialchars($row['shipping_city'] ?? '') ?></td></tr>
    <tr><th>Shipping Province</th><td><?= htmlspecialchars($row['shipping_province'] ?? '') ?></td></tr>
    <tr><th>Shipping Post Code</th><td><?= htmlspecialchars($row['shipping_post_code'] ?? '') ?></td></tr>
    <tr><th>Shipping Country</th><td><?= htmlspecialchars($row['shipping_country'] ?? '') ?></td></tr>
    <tr><th>Courier</th><td><?= htmlspecialchars($row['courier'] ?? '') ?></td></tr>
    <tr><th>Shipper</th><td><?= htmlspecialchars($row['shipper'] ?? '') ?></td></tr>
    <tr><th>Tracking No</th><td><?= htmlspecialchars($row['tracking_no'] ?? '') ?></td></tr>
    <tr><th>Tracking Number</th><td><?= htmlspecialchars($row['tracking_number'] ?? '') ?></td></tr>
    <tr><th>Tracking URL</th><td><?= htmlspecialchars($row['tracking_url'] ?? '') ?></td></tr>
    <tr><th>Status</th><td><span class="badge badge-<?= $row['status'] ?>"><?= $row['status'] ?></span></td></tr>
    <tr><th>Dikirim pada</th><td><?= htmlspecialchars($row['sent_at'] ?? '') ?></td></tr>
</table>

<h5>Payload dari Jubelio</h5>
<pre class="payload"><?= htmlspecialchars(json_encode(json_decode($row['payload'] ?? '[]'), JSON_PRETTY_PRINT)) ?></pre>

<h5>Payload yang dikirim ke D365 (built)</h5>
<?php if (!empty($d365_payload)): ?>
    <pre class="payload"><?= htmlspecialchars(json_encode($d365_payload, JSON_PRETTY_PRINT)) ?></pre>
<?php else: ?>
    <pre class="payload">(tidak ada payload D365)</pre>
<?php endif; ?>

<h5>Payload D365 (raw JSON)</h5>
<pre class="payload"><?= htmlspecialchars($d365_payload_raw ?? '') ?></pre>

<h5>Response D365</h5>
<pre class="payload"><?= htmlspecialchars($row['response']) ?></pre>

<form action="<?= site_url('admin/return-full/' . $row['id'] . '/resend') ?>" method="post" style="display:inline">
    <button class="btn btn-warning">Kirim Ulang ke D365</button>
</form>
<a href="<?= site_url('admin/return-full') ?>" class="btn btn-secondary">Kembali</a>
