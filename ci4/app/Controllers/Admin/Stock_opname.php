<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StockOpnameModel;
use App\Models\LogModel;
use App\Libraries\D365Service;

class Stock_opname extends BaseController
{
    protected $model;
    protected $logModel;
    protected $d365Service;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->model = new StockOpnameModel();
        $this->logModel = new LogModel();
        $this->d365Service = new D365Service();
        helper('url');
    }

    public function index()
    {
        $perPage = 20;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $rows = $this->model->getAll($perPage, $offset);
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['title' => 'Stock Opname', 'rows' => $rows]);
        }

        $data = ['title' => 'Stock Opname', 'rows' => $rows, 'pagination' => ''];
        return view('admin/templates/header', $data) . view('admin/stock_opname/index', $data) . view('admin/templates/footer', $data);
    }

    public function show($id)
    {
        $row = $this->model->find($id);
        if (!$row) return redirect()->to('/admin/stock-opname');
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['row' => $row]);
        }
        $data = ['row' => $row, 'title' => 'Detail Stock Opname'];
        return view('admin/templates/header', $data) . view('admin/stock_opname/show', $data) . view('admin/templates/footer', $data);
    }

    public function delete($id)
    {
        $this->logModel->insertFor('stock_opname', $id, 'deleted', 'Record deleted via admin');
        $this->model->delete($id);
        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/admin/stock-opname');
    }

    public function resend($id)
    {
        $row = $this->model->find($id);
        if (!$row) return redirect()->to('/admin/stock-opname');

        $payload = json_decode($row['payload'] ?? '[]', true) ?: [];
        $this->logModel->insertFor('stock_opname', $id, 'resend_initiated', 'Admin requested resend', ['payload' => $payload]);
        $result = $this->d365Service->send('stock_opname', $payload);

        $this->model->update($id, [
            'status' => $result['success'] ? 'sent' : 'failed',
            'response' => $result['body'],
            'sent_at' => date('Y-m-d H:i:s'),
        ]);

        $this->logModel->insertFor('stock_opname', $id, 'resend_result', 'Result of admin resend', ['success' => $result['success'], 'body' => $result['body']]);
        session()->setFlashdata($result['success'] ? 'success' : 'error', $result['success'] ? 'Berhasil dikirim ke D365' : 'Gagal kirim ke D365: ' . $result['body']);
        return redirect()->to('/admin/stock-opname/' . $id);
    }
}
