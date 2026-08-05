<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Konfigurasi Environment Path</h4>
            <p class="text-muted">Masukkan domain atau host yang ingin dipakai aplikasi, misalnya <code>toc1-middleware-gae7b5g3ecbhe2b9.canadacentral-01.azurewebsites.net</code>.</p>

            <form method="post" action="<?= site_url('admin/environment-config/save') ?>">
                <div class="mb-3">
                    <label for="environment_path" class="form-label">Host / Path Environment</label>
                    <input type="text" class="form-control" id="environment_path" name="environment_path" value="<?= htmlspecialchars($currentValue ?? '') ?>" placeholder="contoh: 127.0.0.1:8084 atau domain.azurewebsites.net">
                </div>

                <div class="alert alert-info">
                    <strong>Preview base URL:</strong> <?= htmlspecialchars($previewValue ?? '') ?>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
