<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3><?= htmlspecialchars($title) ?></h3>
        <p class="text-muted">Menampilkan log terbaru. Gunakan pencarian atau filter action untuk menyaring.</p>
    </div>
    <div>
        <?php $q = htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES); $action = $_GET['action'] ?? ''; ?>
        <form class="row g-2" method="get" action="">
            <div class="col-auto">
                <input type="text" name="q" value="<?= $q ?>" class="form-control form-control-sm" placeholder="Cari pesan atau meta...">
            </div>
            <div class="col-auto">
                <select name="action" class="form-select form-select-sm">
                    <option value="">Semua action</option>
                    <?php foreach (['received','forward','resend_initiated','resend_result','deleted'] as $a): ?>
                        <option value="<?= $a ?>" <?= ($action === $a) ? 'selected' : '' ?>><?= $a ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-primary" type="submit">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr>
                    <th width="80">ID</th>
                    <th width="120">Waktu</th>
                    <th width="120">Action</th>
                    <th>Message</th>
                    <th width="160">Meta</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)): ?>
                    <tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada log.</td></tr>
                <?php else: ?>
                    <?php foreach ($rows as $r): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($r['action']) ?></span></td>
                            <td><?= nl2br(htmlspecialchars($r['message'])) ?></td>
                            <td><pre style="max-height:120px; overflow:auto; background:transparent; border:0; padding:0; margin:0;"><?= htmlspecialchars($r['meta']) ?></pre></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <?= $pagination ?>
    </div>
</div>
