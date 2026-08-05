<?php

namespace App\Libraries;

use App\Models\D365ConfigModel;

class D365Service
{
    protected $configModel;

    public function __construct()
    {
        $this->configModel = new D365ConfigModel();
    }

    public function getToken()
    {
        $config = $this->configModel->getConfig();
        if (!$config) {
            throw new \Exception('Konfigurasi D365 belum diisi.');
        }

        $tenantId = $config['tenant_id'] ?? null;
        $loginUrl = $config['login_url'] ?? null;

        if (strpos($loginUrl ?? '', '{tenantId}') !== false) {
            $loginUrl = str_replace('{tenantId}', $tenantId, $loginUrl);
        }
        if (empty($loginUrl)) {
            $loginUrl = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/token';
        }

        $postFields = http_build_query([
            'grant_type' => $config['grant_type'] ?? 'client_credentials',
            'client_id' => $config['client_id'] ?? '',
            'client_secret' => $config['client_secret'] ?? '',
            'resource' => $config['resource'] ?? '',
        ]);

        $ch = curl_init($loginUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
            CURLOPT_TIMEOUT => 30,
        ]);
        $body = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            throw new \Exception('cURL error saat get token: ' . $err);
        }

        $decoded = json_decode($body, true);
        if (empty($decoded['access_token'])) {
            throw new \Exception('Gagal mendapatkan token D365: ' . $body);
        }

        return $decoded['access_token'];
    }

    public function send(string $transactionType, array $payload): array
    {
        $config = $this->configModel->getConfig();
        $endpoint = $this->configModel->getEndpointByType($transactionType);

        if (!$config) {
            return ['success' => false, 'status_code' => 0, 'body' => 'Konfigurasi D365 belum diisi.'];
        }

        if (!$endpoint || empty($endpoint['is_active']) || empty($endpoint['endpoint_path'])) {
            return ['success' => false, 'status_code' => 0, 'body' => "Endpoint untuk transaksi '{$transactionType}' belum dikonfigurasi/nonaktif."];
        }

        try {
            $token = $this->getToken();
        } catch (\Exception $e) {
            return ['success' => false, 'status_code' => 0, 'body' => $e->getMessage()];
        }

        $url = rtrim($config['base_url'] ?? '', '/') . '/' . ltrim($endpoint['endpoint_path'] ?? '', '/');
        $method = strtoupper($endpoint['http_method'] ?? 'POST');
        $json = json_encode($payload, JSON_UNESCAPED_SLASHES);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            CURLOPT_TIMEOUT => 30,
        ]);
        $body = curl_exec($ch);
        $err = curl_error($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($err) {
            return ['success' => false, 'status_code' => 0, 'body' => 'cURL error: ' . $err];
        }

        return ['success' => $statusCode >= 200 && $statusCode < 300, 'status_code' => $statusCode, 'body' => $body];
    }
}
