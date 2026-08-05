<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Middleware Jubelio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .card { border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,.08); }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card p-4 p-md-5">
            <h1 class="mb-3">Selamat datang di Middleware Jubelio</h1>
            <p class="text-muted">Pilih modul yang ingin Anda kelola.</p>
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text">Lihat transaksi penjualan, cancel, return, dan stock opname.</p>
                            <a href="<?= site_url('admin/penjualan') ?>" class="btn btn-primary">Buka Admin</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Konfigurasi D365</h5>
                            <p class="card-text">Atur endpoint dan setting integrasi Dynamics 365.</p>
                            <a href="<?= site_url('admin/d365-config') ?>" class="btn btn-outline-primary">Buka Konfigurasi</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title">📚 API Documentation</h5>
                            <p class="card-text">Lihat dokumentasi dan contoh integrasi API untuk insert data.</p>
                            <a href="<?= site_url('api-docs') ?>" class="btn btn-outline-info">Buka Dokumentasi API</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title">🔗 API Endpoints</h5>
                            <p class="card-text">Lihat daftar semua endpoint API dalam format JSON.</p>
                            <a href="<?= site_url('api/endpoints') ?>" class="btn btn-outline-secondary">Lihat JSON</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
