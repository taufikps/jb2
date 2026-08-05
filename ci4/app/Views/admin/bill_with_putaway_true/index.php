<h3>Transaksi Bill With Putaway True</h3>

<div class="card shadow-sm border-0 mb-4 table-filter-card">
    <div class="card-body">
        <div class="row g-2 align-items-end mb-3">
            <div class="col-md-6">
                <label class="form-label small text-muted">Cari data</label>
                <input type="text" class="form-control form-control-sm table-filter-search" placeholder="Cari bill_no, supplier, atau status...">
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

        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white align-middle mb-0 table-filter-table">
                <thead class="table-light">
                <tr>
                    <?php if (!empty($rows)): ?>
                        <?php foreach (array_keys(current($rows)) as $field): ?>
                            <th><?= htmlspecialchars(ucwords(str_replace('_', ' ', $field))) ?></th>
                        <?php endforeach; ?>
                        <th>Aksi</th>
                    <?php else: ?>
                        <th>ID</th>
                        <th>Bill No</th>
                        <th>Supplier Name</th>
                        <th>Transaction Date</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $r): ?>
                    <tr data-status="<?= isset($r['status']) ? strtolower($r['status']) : '' ?>">
                        <?php foreach ($r as $value): ?>
                            <td>
                                <?php if (is_array($value) || is_object($value)): ?>
                                    <pre class="mb-0" style="white-space:pre-wrap; word-break:break-word;"><?= htmlspecialchars(json_encode($value, JSON_UNESCAPED_SLASHES)) ?></pre>
                                <?php else: ?>
                                    <?= htmlspecialchars((string) $value) ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <a href="<?= site_url('admin/bill-with-putaway-true/' . $r['id']) ?>" class="btn btn-sm btn-primary">Detail</a>
                            <form action="<?= site_url('admin/bill-with-putaway-true/' . $r['id'] . '/resend') ?>" method="post" style="display:inline">
                                <button class="btn btn-sm btn-warning">Kirim ke D365</button>
                            </form>
                            <form action="<?= site_url('admin/bill-with-putaway-true/' . $r['id'] . '/delete') ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $pagination ?>
