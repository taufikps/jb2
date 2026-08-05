<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class EnvironmentConfig extends BaseController
{
    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        helper('url');
    }

    public function index()
    {
        $currentValue = env('app.baseURL', '');
        $displayValue = $this->displayValue($currentValue);
        $previewValue = $this->normalizeBaseUrl($currentValue);

        $data = [
            'title' => 'Konfigurasi Environment Path',
            'currentValue' => $displayValue,
            'previewValue' => $previewValue,
        ];

        return view('admin/templates/header', $data)
            . view('admin/environment_config/index', $data)
            . view('admin/templates/footer', $data);
    }

    public function save()
    {
        $rawValue = trim($this->request->getPost('environment_path') ?? '');
        $baseUrl = $this->normalizeBaseUrl($rawValue);
        $this->writeEnvBaseUrl($baseUrl);

        session()->setFlashdata('success', 'Environment path berhasil disimpan.');

        return redirect()->to('/admin/environment-config');
    }

    private function normalizeBaseUrl(string $value): string
    {
        $trimmed = trim($value);

        if ($trimmed === '') {
            return '';
        }

        if (preg_match('#^https?://#i', $trimmed)) {
            return rtrim($trimmed, '/') . '/';
        }

        $hasPort = preg_match('#:\d+$#', $trimmed);
        $isLocal = preg_match('#^(localhost|127\.0\.0\.1|0\.0\.0\.0)$#i', $trimmed);
        $scheme = ($isLocal || $hasPort) ? 'http://' : 'https://';

        return rtrim($scheme . $trimmed, '/') . '/';
    }

    private function displayValue(string $value): string
    {
        if ($value === '') {
            return '';
        }

        return trim(preg_replace('#^https?://#i', '', rtrim($value, '/')), '/');
    }

    private function writeEnvBaseUrl(string $baseUrl): void
    {
        $envPath = rtrim(dirname(APPPATH), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.env';

        if (! file_exists($envPath)) {
            file_put_contents($envPath, "");
        }

        $content = file_get_contents($envPath) ?: '';
        $line = 'app.baseURL = "' . addslashes($baseUrl) . '"';
        $pattern = '/^app\.baseURL\s*=.*$/m';

        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, $line, $content);
        } else {
            $content = rtrim($content, "\n") . PHP_EOL . $line . PHP_EOL;
        }

        file_put_contents($envPath, $content);
    }
}
