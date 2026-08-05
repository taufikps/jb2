<?php helper(['url','session']);
$session = session();
$success = $session->getFlashdata('success');
$error = $session->getFlashdata('error');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Middleware Jubelio - D365' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body { min-height:100%; overflow-x:hidden; }
        body { background:#f4f6f9; color:#1f2937; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .page-shell { min-height:100vh; width:100%; animation: fadeInPage .45s ease forwards; }
        .page-shell > .d-flex { min-height:100vh; }
        .sidebar { flex:0 0 240px; min-height:100vh; background:#1b2a4a; box-shadow: 0 10px 30px rgba(0,0,0,.12); overflow-y:auto; }
        .sidebar a { color:#c7d0e0; display:block; padding:10px 18px; text-decoration:none; border-radius:8px; margin:4px 12px; transition: all .2s ease; }
        .sidebar a:hover, .sidebar a.active { background:#26375f; color:#fff; transform: translateX(2px); }
        .sidebar h5 { color:#fff; padding:18px; margin:0; }
        .content-area { flex:1 1 auto; animation: fadeInPage .38s ease; min-width:0; overflow-y:auto; overflow-x:hidden; }
        .admin-page .page-shell { animation: none !important; }
        .admin-page .content-area { animation: none !important; }
        .admin-page .content-area.swap-animate { animation: fadeInPage .24s ease both !important; }
        .content-area .table-responsive { overflow-x:auto; overflow-y:hidden; }
        .table-filter-card { overflow:hidden; }
        .table-filter-card .table { margin-bottom:0; }
        .table-filter-table th,
        .table-filter-table td { white-space: nowrap; }
        .table-filter-table th { font-weight:600; }
        .badge-pending{background:#ffc107;color:#000;}
        .badge-sent{background:#198754;}
        .badge-failed{background:#dc3545;}
        pre.payload { max-height:300px; overflow:auto; background:#0d1117; color:#d1e0ff; padding:12px; border-radius:6px; }
        #page-loading-overlay {
            position:fixed; inset:0; z-index:3000; display:flex; align-items:center; justify-content:center;
            background:rgba(8, 15, 30, 0.72); backdrop-filter: blur(4px); opacity:0; visibility:hidden;
            transition: opacity .25s ease, visibility .25s ease;
        }
        #page-loading-overlay.show { opacity:1; visibility:visible; }
        .loading-spinner {
            width:54px; height:54px; border:4px solid rgba(255,255,255,.24); border-top-color:#14FFEC;
            border-radius:50%; animation: spin 1s linear infinite; box-shadow: 0 10px 30px rgba(0,0,0,.25);
        }
        .loading-label {
            margin-top:12px; color:#fff; font-size:13px; letter-spacing:.12em; text-transform:uppercase;
        }
        @keyframes fadeInPage {
            from { opacity:0; transform: translateY(10px); }
            to { opacity:1; transform: translateY(0); }
        }
        @keyframes slideDown {
            from { opacity:0; transform: translateY(-8px); }
            to { opacity:1; transform: translateY(0); }
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="<?= strpos($_SERVER['REQUEST_URI'], '/admin') !== false ? 'admin-page' : '' ?>">
<div id="page-loading-overlay" aria-hidden="true">
    <div class="d-flex flex-column align-items-center">
        <div class="loading-spinner"></div>
        <div class="loading-label">Memuat halaman...</div>
    </div>
</div>
<?php
    $sidebarPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $sidebarPath = preg_replace('#/index\.php#', '', $sidebarPath);
    $sidebarPath = rtrim($sidebarPath, '/');
    if ($sidebarPath === '') {
        $sidebarPath = '/';
    }
    $isActive = function ($path) use ($sidebarPath) {
        return $sidebarPath === $path || strpos($sidebarPath, $path . '/') === 0;
    };
?>
<div class="page-shell">
<div class="d-flex">
    <div class="sidebar" style="width:240px;">
        <h5>Middleware Jubelio</h5>
        <a href="<?= site_url() ?>" style="background:#0d7377; border-left:3px solid #14FFEC;">
            <span style="font-size:14px;">← Kembali ke Home</span>
        </a>
        <hr style="border-color:#3a4a6b; margin:8px 0;">
        <div style="padding:0 12px; color:#9fb0d1; font-size:12px;">Transaksi</div>
        <a href="<?= site_url('admin/penjualan') ?>" class="<?= $isActive('/admin/penjualan') ? 'active' : '' ?>">• Transaksi Penjualan</a>
        <a href="<?= site_url('admin/cancel') ?>" class="<?= $isActive('/admin/cancel') ? 'active' : '' ?>">• Penjualan Cancel</a>
        <a href="<?= site_url('admin/return-full') ?>" class="<?= $isActive('/admin/return-full') ? 'active' : '' ?>">• Return</a>
        <a href="<?= site_url('admin/bill-with-putaway-true') ?>" class="<?= $isActive('/admin/bill-with-putaway-true') ? 'active' : '' ?>">• BILL WITH PUTAWAY TRUE</a>
        <a href="<?= site_url('admin/stock-opname') ?>" class="<?= $isActive('/admin/stock-opname') ? 'active' : '' ?>">• Stock Opname</a>

        <hr style="border-color:#3a4a6b;">
        <div style="padding:0 12px; color:#9fb0d1; font-size:12px;">Log</div>
        <a href="<?= site_url('admin/logs/view/penjualan') ?>">• Log Penjualan</a>
        <a href="<?= site_url('admin/logs/view/penjualan_cancel') ?>">• Log Penjualan Cancel</a>
        <a href="<?= site_url('admin/logs/view/return_full') ?>">• Log Return</a>
        <a href="<?= site_url('admin/logs/view/bill_with_putaway_true') ?>">• Log Bill With Putaway True</a>
        <a href="<?= site_url('admin/logs/view/stock_opname') ?>">• Log Stock Opname</a>

        <hr style="border-color:#3a4a6b;">
        <div style="padding:0 12px; color:#9fb0d1; font-size:12px;">Konfigurasi</div>
        <a href="<?= site_url('admin/d365-config') ?>">⚙ Konfigurasi D365</a>
    </div>
    <div class="flex-grow-1 p-4 content-area">
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
