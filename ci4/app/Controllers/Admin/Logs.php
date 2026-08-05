<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Logs extends BaseController
{
    protected $logModel;
    protected $types = [
        'penjualan' => 'Penjualan',
        'penjualan_cancel' => 'Penjualan Cancel',
        'return_full' => 'Return',
        'bill_with_putaway_true' => 'Bill With Putaway True',
        'stock_opname' => 'Stock Opname',
    ];

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->logModel = new LogModel();
        helper('url');
    }

    public function index()
    {
        $data = [
            'title' => 'Log - Tipe Log',
            'types' => $this->types,
        ];

        return view('admin/templates/header', $data)
            . view('admin/logs/index', $data)
            . view('admin/templates/footer', $data);
    }

    public function view($type)
    {
        if (!isset($this->types[$type])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tipe log tidak ditemukan');
        }

        $perPage = 50;
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $offset = ($page - 1) * $perPage;
        $search = $this->request->getGet('q');
        $action = $this->request->getGet('action');

        $total = $this->logModel->countLogs($type, $search, $action);
        $rows = $this->logModel->getLogs($type, $perPage, $offset, $search, $action);

        $queryParams = [];
        if ($search) {
            $queryParams['q'] = $search;
        }
        if ($action) {
            $queryParams['action'] = $action;
        }

        $pagination = $this->buildPagination($type, $page, $perPage, $total, $queryParams);

        $data = [
            'title' => 'Log: ' . $this->types[$type],
            'rows' => $rows,
            'pagination' => $pagination,
            'type' => $type,
            'actions' => array_values(array_unique(array_column($rows, 'action'))),
        ];

        return view('admin/templates/header', $data)
            . view('admin/logs/list', $data)
            . view('admin/templates/footer', $data);
    }

    private function buildPagination(string $type, int $currentPage, int $perPage, int $total, array $queryParams): string
    {
        $totalPages = $perPage > 0 ? (int) ceil($total / $perPage) : 0;
        if ($totalPages <= 1) {
            return '';
        }

        $baseUrl = site_url('admin/logs/view/' . $type);
        $query = '';
        if (!empty($queryParams)) {
            $query = '&' . http_build_query($queryParams);
        }

        $html = '<nav><ul class="pagination pagination-sm mb-0">';

        $prevPage = max(1, $currentPage - 1);
        $disabled = $currentPage === 1 ? ' disabled' : '';
        $html .= '<li class="page-item' . $disabled . '"><a class="page-link" href="' . $baseUrl . '?page=' . $prevPage . $query . '">Previous</a></li>';

        $start = max(1, $currentPage - 2);
        $end = min($totalPages, $currentPage + 2);
        if ($start > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=1' . $query . '">1</a></li>';
            if ($start > 2) {
                $html .= '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
            }
        }

        for ($i = $start; $i <= $end; $i++) {
            $active = $i === $currentPage ? ' active' : '';
            $html .= '<li class="page-item' . $active . '"><a class="page-link" href="' . $baseUrl . '?page=' . $i . $query . '">' . $i . '</a></li>';
        }

        if ($end < $totalPages) {
            if ($end < $totalPages - 1) {
                $html .= '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
            }
            $html .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $totalPages . $query . '">' . $totalPages . '</a></li>';
        }

        $nextPage = min($totalPages, $currentPage + 1);
        $disabled = $currentPage === $totalPages ? ' disabled' : '';
        $html .= '<li class="page-item' . $disabled . '"><a class="page-link" href="' . $baseUrl . '?page=' . $nextPage . $query . '">Next</a></li>';
        $html .= '</ul></nav>';

        return $html;
    }
}
