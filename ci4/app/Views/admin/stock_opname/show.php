<h3>Detail Stock Opname #<?= $row['id'] ?></h3>

<table class="table table-bordered bg-white w-50">
    <tr><th>Warehouse Code</th><td><?= htmlspecialchars($row['warehouse_code']) ?></td></tr>
    <tr><th>Tanggal Opname</th><td><?= htmlspecialchars($row['opname_date']) ?></td></tr>
    <tr><th>Total Items</th><td><?= htmlspecialchars($row['total_items']) ?></td></tr>
    <tr><th>Status</th><td><span class="badge badge-<?= $row['status'] ?>"><?= $row['status'] ?></span></td></tr>
    <tr><th>Dikirim pada</th><td><?= htmlspecialchars($row['sent_at']) ?></td></tr>
</table>

<h5>Payload dari Jubelio</h5>
<pre class="payload"><?= htmlspecialchars(json_encode(json_decode($row['payload']), JSON_PRETTY_PRINT)) ?></pre>

<h5>Response D365</h5>
<pre class="payload"><?= htmlspecialchars($row['response']) ?></pre>

<form action="<?= site_url('admin/stock-opname/' . $row['id'] . '/resend') ?>" method="post" style="display:inline">
    <button class="btn btn-warning">Kirim Ulang ke D365</button>
</form>
<a href="<?= site_url('admin/stock-opname') ?>" class="btn btn-secondary">Kembali</a>
