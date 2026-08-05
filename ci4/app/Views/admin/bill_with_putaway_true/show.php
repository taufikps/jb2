<h3>Detail Bill With Putaway True #<?= $row['id'] ?></h3>

<table class="table table-bordered bg-white">
    <?php foreach ($row as $field => $value): ?>
        <tr>
            <th style="width: 220px;"><?= htmlspecialchars(ucwords(str_replace('_', ' ', $field))) ?></th>
            <td>
                <?php if (is_array($value) || is_object($value)): ?>
                    <pre class="mb-0" style="white-space:pre-wrap; word-break:break-word;"><?= htmlspecialchars(json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) ?></pre>
                <?php else: ?>
                    <?= htmlspecialchars((string) $value) ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
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

<form action="<?= site_url('admin/bill-with-putaway-true/' . $row['id'] . '/resend') ?>" method="post" style="display:inline">
    <button class="btn btn-warning">Kirim Ulang ke D365</button>
</form>
<a href="<?= site_url('admin/bill-with-putaway-true') ?>" class="btn btn-secondary">Kembali</a>
