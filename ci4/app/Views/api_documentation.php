<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/atom-one-dark.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: #1b2a4a; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        .navbar a { color: #c7d0e0; }
        .navbar a:hover { color: #fff; }
        .endpoint-card { margin-bottom: 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,.08); }
        .endpoint-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0; }
        .method-badge { display: inline-block; padding: 4px 12px; border-radius: 4px; font-weight: bold; }
        .method-post { background: #28a745; color: white; }
        .code-block { background: #1e1e1e; color: #d4d4d4; padding: 16px; border-radius: 6px; overflow-x: auto; margin: 12px 0; }
        .code-block pre { margin: 0; font-family: 'Courier New', monospace; font-size: 13px; }
        .field-group { margin-top: 16px; }
        .field-table { font-size: 14px; }
        .field-table th { background: #f8f9fa; font-weight: 600; }
        .endpoint-description { color: #666; margin-bottom: 16px; }
        .curl-section { background: #f8f9fa; padding: 16px; border-left: 4px solid #667eea; border-radius: 4px; margin-top: 16px; }
        h1 { margin-bottom: 32px; font-weight: 700; }
        h2 { margin-top: 32px; margin-bottom: 24px; font-weight: 600; }
        .toc { background: white; padding: 20px; border-radius: 8px; margin-bottom: 24px; box-shadow: 0 2px 8px rgba(0,0,0,.04); }
        .toc a { text-decoration: none; color: #667eea; }
        .toc a:hover { color: #764ba2; text-decoration: underline; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url() ?>">Middleware Jubelio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= site_url('api-docs') ?>">API Docs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/penjualan') ?>">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <h1>📚 Dokumentasi API</h1>
                <p class="lead text-muted">Panduan lengkap untuk mengintegrasikan data ke sistem Middleware Jubelio</p>

                <div class="alert alert-info" role="alert">
                    <strong>Base URL:</strong> <code><?= site_url() ?></code>
                </div>

                <?php foreach ($endpoints as $index => $ep): ?>
                    <div class="endpoint-card">
                        <div class="endpoint-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="method-badge method-post"><?= $ep['method'] ?></span>
                                    <code style="color: white; margin-left: 12px;"><?= $ep['endpoint'] ?></code>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $ep['description'] ?></h5>
                            <p class="endpoint-description"><?= $ep['description'] ?> ke tabel <strong><?= $ep['table'] ?></strong></p>

                            <div class="field-group">
                                <h6>Field Wajib Diisi:</h6>
                                <div class="field-table">
                                    <ul class="list-unstyled">
                                        <?php foreach ($ep['required_fields'] as $field): ?>
                                            <li><code class="text-danger"><?= $field ?></code></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <?php if (!empty($ep['optional_fields'])): ?>
                                <div class="field-group">
                                    <h6>Field Opsional:</h6>
                                    <div class="field-table">
                                        <ul class="list-unstyled">
                                            <?php foreach ($ep['optional_fields'] as $field): ?>
                                                <li><code class="text-muted"><?= $field ?></code></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="field-group">
                                <h6>Contoh Request JSON:</h6>
                                <div class="code-block">
                                    <pre><?= htmlspecialchars($ep['example_json']) ?></pre>
                                </div>
                            </div>

                            <div class="curl-section">
                                <h6 class="mb-2">Contoh cURL:</h6>
                                <div class="code-block">
                                    <pre>curl -X POST <?= site_url($ep['endpoint']) ?> \
  -H "Content-Type: application/json" \
  -d '<?= str_replace("\n", '\n  ', $ep['example_json']) ?>'</pre>
                                </div>
                            </div>

                            <div class="alert alert-success mt-3">
                                <strong>Response Success (201):</strong>
                                <div class="code-block mt-2">
                                    <pre>{
  "success": true,
  "message": "X data berhasil diinsert",
  "data": {
    "inserted": X,
    "errors": []
  }
}</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-4">
                <div class="toc sticky-top" style="top: 20px;">
                    <h5>Daftar Endpoint</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($endpoints as $index => $ep): ?>
                            <li><a href="#endpoint-<?= $index ?>"><?= $ep['description'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>

                    <hr>

                    <h6 class="mt-4">Informasi Tambahan</h6>
                    <ul class="list-unstyled small">
                        <li><strong>Method:</strong> POST</li>
                        <li><strong>Content-Type:</strong> application/json</li>
                        <li><strong>Format Data:</strong> Array of Objects</li>
                        <li><strong>Response Format:</strong> JSON</li>
                    </ul>

                    <hr>

                    <h6 class="mt-4">HTTP Status Codes</h6>
                    <ul class="list-unstyled small">
                        <li><span class="badge bg-success">201</span> Created - Data berhasil diinsert</li>
                        <li><span class="badge bg-warning">400</span> Bad Request - Format JSON tidak valid</li>
                        <li><span class="badge bg-danger">405</span> Method Not Allowed - Gunakan POST</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll();
    </script>
</body>
</html>
