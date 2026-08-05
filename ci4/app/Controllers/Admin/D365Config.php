<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\D365Service;
use App\Models\D365ConfigModel;

class D365Config extends BaseController
{
    protected $configModel;
    protected $transactionTypes = [
        'penjualan'                 => 'Transaksi Penjualan',
        'penjualan_cancel'          => 'Transaksi Penjualan Cancel',
        'return_full'               => 'Transaksi Return',
        'bill_with_putaway_true'    => 'Transaksi Bill With Putaway True',
        'stock_opname'              => 'Stock Opname',
    ];

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->configModel = new D365ConfigModel();
        helper('url');
    }

    public function index()
    {
        $config = $this->configModel->getConfig() ?: [];
        $endpoints = $this->configModel->getAllEndpoints();

        $data = [
            'title' => 'Konfigurasi D365 F&O',
            'config' => $config,
            'endpoints' => $endpoints,
            'transactionTypes' => $this->transactionTypes,
        ];

        return view('admin/templates/header', $data)
            . view('admin/d365config/index', $data)
            . view('admin/templates/footer', $data);
    }

    public function save()
    {
        $data = [
            'tenant_id' => $this->request->getPost('tenant_id'),
            'client_id' => $this->request->getPost('client_id'),
            'client_secret' => $this->request->getPost('client_secret'),
            'grant_type' => $this->request->getPost('grant_type') ?: 'client_credentials',
            'resource' => $this->request->getPost('resource'),
            'login_url' => $this->request->getPost('login_url'),
            'base_url' => $this->request->getPost('base_url'),
        ];

        $this->configModel->saveConfig($data);
        session()->setFlashdata('success', 'Konfigurasi D365 berhasil disimpan');
        return redirect()->to('/admin/d365-config');
    }

    public function saveEndpoints()
    {
        foreach (array_keys($this->transactionTypes) as $type) {
            $data = [
                'endpoint_path' => $this->request->getPost("endpoint_{$type}"),
                'http_method' => $this->request->getPost("method_{$type}") ?: 'POST',
                'is_active' => $this->request->getPost("active_{$type}") ? 1 : 0,
            ];

            $this->configModel->saveEndpoint($type, $data);
        }

        session()->setFlashdata('success', 'Mapping endpoint berhasil disimpan');
        return redirect()->to('/admin/d365-config');
    }
}
