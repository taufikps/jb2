<h3>Transaksi Return Partial</h3>

<div class="card shadow-sm border-0 mb-4 table-filter-card">
    <div class="card-body">
        <div class="row g-2 align-items-end mb-3">
            <div class="col-md-6">
                <label class="form-label small text-muted">Cari data</label>
                <input type="text" class="form-control form-control-sm table-filter-search" placeholder="Cari order, return no, atau status...">
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
            <tr><th>ID</th><th>Order No</th><th>Return No</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $r): ?>
                <tr data-status="<?= strtolower($r['status']) ?>">
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['order_no']) ?></td>
                    <td><?= htmlspecialchars($r['return_no']) ?></td>
                    <td><?= htmlspecialchars($r['return_date']) ?></td>
                    <td><span class="badge badge-<?= $r['status'] ?>"><?= $r['status'] ?></span></td>
                    <td>
                        <a href="<?= site_url('admin/return-partial/' . $r['id']) ?>" class="btn btn-sm btn-primary">Detail</a>
                        <form action="<?= site_url('admin/return-partial/' . $r['id'] . '/resend') ?>" method="post" style="display:inline">
                            <button class="btn btn-sm btn-warning">Kirim ke D365</button>
                        </form>
                        <form action="<?= site_url('admin/return-partial/' . $r['id'] . '/delete') ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
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
