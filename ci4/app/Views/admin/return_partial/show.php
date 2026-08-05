<h3>Detail Return Partial #<?= $row['id'] ?></h3>

<table class="table table-bordered bg-white w-50">
    <tr><th>Order No</th><td><?= htmlspecialchars($row['order_no']) ?></td></tr>
    <tr><th>Return No</th><td><?= htmlspecialchars($row['return_no']) ?></td></tr>
    <tr><th>Tanggal Return</th><td><?= htmlspecialchars($row['return_date']) ?></td></tr>
    <tr><th>Status</th><td><span class="badge badge-<?= $row['status'] ?>"><?= $row['status'] ?></span></td></tr>
    <tr><th>Dikirim pada</th><td><?= htmlspecialchars($row['sent_at']) ?></td></tr>
</table>

<h5>Payload dari Jubelio</h5>
<pre class="payload"><?= htmlspecialchars(json_encode(json_decode($row['payload']), JSON_PRETTY_PRINT)) ?></pre>

<h5>Response D365</h5>
<pre class="payload"><?= htmlspecialchars($row['response']) ?></pre>

<form action="<?= site_url('admin/return-partial/' . $row['id'] . '/resend') ?>" method="post" style="display:inline">
    <button class="btn btn-warning">Kirim Ulang ke D365</button>
</form>
<a href="<?= site_url('admin/return-partial') ?>" class="btn btn-secondary">Kembali</a>
