<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReturnPartialModel;
use App\Models\LogModel;
use App\Libraries\D365Service;

class Return_partial extends BaseController
{
    protected $model;
    protected $logModel;
    protected $d365Service;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->model = new ReturnPartialModel();
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
            return $this->response->setJSON(['title' => 'Transaksi Return Partial', 'rows' => $rows]);
        }

        $data = ['title' => 'Transaksi Return Partial', 'rows' => $rows, 'pagination' => ''];
        return view('admin/templates/header', $data) . view('admin/return_partial/index', $data) . view('admin/templates/footer', $data);
    }

    public function show($id)
    {
        $row = $this->model->find($id);
        if (!$row) return redirect()->to('/admin/return-partial');
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['row' => $row]);
        }
        $data = ['row' => $row, 'title' => 'Detail Return Partial'];
        return view('admin/templates/header', $data) . view('admin/return_partial/show', $data) . view('admin/templates/footer', $data);
    }

    public function delete($id)
    {
        $this->logModel->insertFor('return_partial', $id, 'deleted', 'Record deleted via admin');
        $this->model->delete($id);
        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/admin/return-partial');
    }

    public function resend($id)
    {
        $row = $this->model->find($id);
        if (!$row) return redirect()->to('/admin/return-partial');

        $payload = json_decode($row['payload'] ?? '[]', true) ?: [];
        $this->logModel->insertFor('return_partial', $id, 'resend_initiated', 'Admin requested resend', ['payload' => $payload]);
        $result = $this->d365Service->send('return_partial', $payload);

        $this->model->update($id, [
            'status' => $result['success'] ? 'sent' : 'failed',
            'response' => $result['body'],
            'sent_at' => date('Y-m-d H:i:s'),
        ]);

        $this->logModel->insertFor('return_partial', $id, 'resend_result', 'Result of admin resend', ['success' => $result['success'], 'body' => $result['body']]);
        session()->setFlashdata($result['success'] ? 'success' : 'error', $result['success'] ? 'Berhasil dikirim ke D365' : 'Gagal kirim ke D365: ' . $result['body']);
        return redirect()->to('/admin/return-partial/' . $id);
    }
}
