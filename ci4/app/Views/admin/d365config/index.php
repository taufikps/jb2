<h3>Konfigurasi D365 Finance & Operations</h3>
<p class="text-muted">Parameter OAuth2 (client credentials) yang dipakai untuk get bearer token, serta mapping endpoint per jenis transaksi.</p>

<div class="card mb-4">
    <div class="card-header">Parameter Koneksi / OAuth Token</div>
    <div class="card-body">
        <form action="<?= site_url('admin/d365-config/save') ?>" method="post">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tenant ID</label>
                    <input type="text" name="tenant_id" class="form-control" value="<?= htmlspecialchars($config['tenant_id'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Client ID</label>
                    <input type="text" name="client_id" class="form-control" value="<?= htmlspecialchars($config['client_id'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Client Secret</label>
                    <input type="password" name="client_secret" class="form-control" value="<?= htmlspecialchars($config['client_secret'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Grant Type</label>
                    <input type="text" name="grant_type" class="form-control" value="<?= htmlspecialchars($config['grant_type'] ?? 'client_credentials') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Resource / Audience</label>
                    <input type="text" name="resource" class="form-control" placeholder="https://namaenv.operations.dynamics.com" value="<?= htmlspecialchars($config['resource'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Login URL</label>
                    <input type="text" name="login_url" class="form-control"
                           placeholder="https://login.microsoftonline.com/{tenantId}/oauth2/token"
                           value="<?= htmlspecialchars($config['login_url'] ?? 'https://login.microsoftonline.com/{tenantId}/oauth2/token') ?>" required>
                    <div class="form-text">Placeholder <code>{tenantId}</code> otomatis diganti dengan Tenant ID di atas.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Base URL D365 F&O</label>
                    <input type="text" name="base_url" class="form-control" placeholder="https://namaenv.operations.dynamics.com" value="<?= htmlspecialchars($config['base_url'] ?? '') ?>" required>
                </div>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Simpan Konfigurasi</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Mapping Endpoint per Jenis Transaksi</div>
    <div class="card-body">
        <form action="<?= site_url('admin/d365-config/save-endpoints') ?>" method="post">
            <table class="table table-bordered">
                <thead class="table-light">
                <tr>
                    <th>Jenis Transaksi</th>
                    <th>Endpoint Path (relatif ke Base URL)</th>
                    <th>Method</th>
                    <th>Aktif</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($transactionTypes as $type => $label):
                    $existing = null;
                    foreach ($endpoints as $e) {
                        if ($e['transaction_type'] === $type) {
                            $existing = $e;
                            break;
                        }
                    }
                ?>
                    <tr>
                        <td><?= htmlspecialchars($label) ?></td>
                        <td>
                            <input type="text" name="endpoint_<?= $type ?>" class="form-control"
                                   placeholder="/data/SalesOrders"
                                   value="<?= htmlspecialchars($existing['endpoint_path'] ?? '') ?>">
                        </td>
                        <td>
                            <select name="method_<?= $type ?>" class="form-select">
                                <?php foreach (['POST', 'PUT', 'PATCH'] as $m): ?>
                                    <option value="<?= $m ?>" <?= (($existing['http_method'] ?? 'POST') === $m) ? 'selected' : '' ?>><?= $m ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="active_<?= $type ?>" value="1" <?= (!$existing || $existing['is_active']) ? 'checked' : '' ?>>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <button class="btn btn-primary" type="submit">Simpan Mapping Endpoint</button>
        </form>
    </div>
</div>
