<h3>Stock Opname</h3>

<div class="card shadow-sm border-0 mb-4 table-filter-card">
    <div class="card-body">
        <div class="row g-2 align-items-end mb-3">
            <div class="col-md-6">
                <label class="form-label small text-muted">Cari data</label>
                <input type="text" class="form-control form-control-sm table-filter-search" placeholder="Cari warehouse, tanggal, atau status...">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted">Status</label>
                <select class="form-select form-select-sm table-filter-status">
                    <option value="">Semua status</option>
                    <option value="pending">Pending</option>
                    <option value="sent">Sent</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 table-filter-reset">Reset</button>
            </div>
        </div>

        <table class="table table-bordered table-hover bg-white align-middle mb-0 table-filter-table">
            <thead class="table-light">
            <tr><th>ID</th><th>Warehouse</th><th>Tanggal Opname</th><th>Total Item</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $r): ?>
                <tr data-status="<?= strtolower($r['status']) ?>">
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['warehouse_code']) ?></td>
                    <td><?= htmlspecialchars($r['opname_date']) ?></td>
                    <td><?= htmlspecialchars($r['total_items']) ?></td>
                    <td><span class="badge badge-<?= $r['status'] ?>"><?= $r['status'] ?></span></td>
                    <td>
                        <a href="<?= site_url('admin/stock-opname/' . $r['id']) ?>" class="btn btn-sm btn-primary">Detail</a>
                        <form action="<?= site_url('admin/stock-opname/' . $r['id'] . '/resend') ?>" method="post" style="display:inline">
                            <button class="btn btn-sm btn-warning">Kirim ke D365</button>
                        </form>
                        <form action="<?= site_url('admin/stock-opname/' . $r['id'] . '/delete') ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $pagination ?>
