<div class="card">
    <div class="card-header">Daftar Log</div>
    <div class="card-body">
        <p>Pilih tipe log untuk melihat detail.</p>
        <div class="list-group">
            <?php foreach ($types as $k => $label): ?>
                <a href="<?= site_url('admin/logs/view/' . $k) ?>" class="list-group-item list-group-item-action"><?= htmlspecialchars($label) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
