<h3>Transaksi Penjualan Cancel</h3>

<div class="card shadow-sm border-0 mb-4 table-filter-card">
    <div class="card-body">
        <div class="row g-2 align-items-end mb-3">
            <div class="col-md-6">
                <label class="form-label small text-muted">Cari data</label>
                <input type="text" class="form-control form-control-sm table-filter-search" placeholder="Cari order, alasan, atau status...">
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
            <tr>
                <th>ID</th>
                <th>Order / SO</th>
                <th>Customer</th>
                <th>Alasan</th>
                <th>Total</th>
                <th>WMS</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $r): ?>
                <tr data-status="<?= strtolower($r['status']) ?>">
                    <td><?= $r['id'] ?></td>
                    <td>
                        <div><?= htmlspecialchars($r['order_no'] ?: '-') ?></div>
                        <small class="text-muted"><?= htmlspecialchars($r['salesorder_no'] ?: '-') ?></small>
                    </td>
                    <td>
                        <div><?= htmlspecialchars($r['customer_name'] ?: '-') ?></div>
                        <small class="text-muted"><?= htmlspecialchars($r['customer_phone'] ?: '-') ?></small>
                    </td>
                    <td><?= htmlspecialchars($r['cancel_reason'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($r['grand_total'] ?: $r['sub_total'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($r['wms_status'] ?: '-') ?></td>
                    <td><?= htmlspecialchars($r['cancel_date'] ?: $r['created_at'] ?: '-') ?></td>
                    <td><span class="badge bg-secondary"><?= htmlspecialchars($r['status'] ?: 'pending') ?></span></td>
                    <td>
                        <a href="<?= site_url('admin/cancel/' . $r['id']) ?>" class="btn btn-sm btn-primary">Detail</a>
                        <form action="<?= site_url('admin/cancel/' . $r['id'] . '/resend') ?>" method="post" style="display:inline">
                            <button class="btn btn-sm btn-warning">Kirim ke D365</button>
                        </form>
                        <form action="<?= site_url('admin/cancel/' . $r['id'] . '/delete') ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
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
