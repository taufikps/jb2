<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BillWithPutawayTrueModel;
use App\Models\LogModel;
use App\Libraries\D365Service;

class Bill_with_putaway_true extends BaseController
{
    protected $model;
    protected $logModel;
    protected $d365Service;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->model = new BillWithPutawayTrueModel();
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
            return $this->response->setJSON(['title' => 'Transaksi Bill With Putaway True', 'rows' => $rows]);
        }

        $data = ['title' => 'Transaksi Bill With Putaway True', 'rows' => $rows, 'pagination' => ''];
        return view('admin/templates/header', $data)
            . view('admin/bill_with_putaway_true/index', $data)
            . view('admin/templates/footer', $data);
    }

    public function show($id)
    {
        $row = $this->model->find($id);
        if (!$row) {
            return redirect()->to('/admin/bill-with-putaway-true');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['row' => $row]);
        }

        $payloadRaw = $row['payload'] ?? '[]';
        $payload = json_decode($payloadRaw, true) ?: [];
        $d365Payload = $this->buildD365BillFromStoredPayload($payload);
        $d365PayloadRaw = $this->buildD365BillJson($payloadRaw);

        $data = ['row' => $row, 'title' => 'Detail Bill With Putaway True', 'd365_payload' => $d365Payload, 'd365_payload_raw' => $d365PayloadRaw];
        return view('admin/templates/header', $data)
            . view('admin/bill_with_putaway_true/show', $data)
            . view('admin/templates/footer', $data);
    }

    public function delete($id)
    {
        $this->logModel->insertFor('bill_with_putaway_true', $id, 'deleted', 'Record deleted via admin');
        $this->model->delete($id);
        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/admin/bill-with-putaway-true');
    }

    public function resend($id)
    {
        $row = $this->model->find($id);
        if (!$row) {
            return redirect()->to('/admin/bill-with-putaway-true');
        }

        $payload = json_decode($row['payload'] ?? '[]', true) ?: [];
        $d365Payload = $this->buildD365BillFromStoredPayload($payload);
        $this->logModel->insertFor('bill_with_putaway_true', $id, 'resend_initiated', 'Admin requested resend', ['payload' => $d365Payload]);
        $result = $this->d365Service->send('bill_with_putaway_true', $d365Payload);

        $this->model->update($id, [
            'status' => $result['success'] ? 'sent' : 'failed',
            'response' => $result['body'],
            'sent_at' => date('Y-m-d H:i:s'),
        ]);

        $this->logModel->insertFor('bill_with_putaway_true', $id, 'resend_result', 'Result of admin resend', ['success' => $result['success'], 'body' => $result['body']]);
        session()->setFlashdata($result['success'] ? 'success' : 'error', $result['success'] ? 'Berhasil dikirim ke D365' : 'Gagal kirim ke D365: ' . $result['body']);
        return redirect()->to('/admin/bill-with-putaway-true/' . $id);
    }

    private function buildD365BillFromStoredPayload(array $row = []): array
    {
        $bills = [];
        $bill = $this->buildD365BillOrderFromPayload($row);
        return [
            '_request' => [
                'dataareaid' => 'MPR',
                'bills' => [$bill],
            ],
        ];
    }

    private function buildD365BillOrderFromPayload(array $row = []): array
    {
        $items = [];
        if (!empty($row['items']) && is_array($row['items'])) {
            foreach ($row['items'] as $detail) {
                if (!is_array($detail)) continue;
                $items[] = $this->removeNulls([
                    'bill_detail_id' => $detail['bill_detail_id'] ?? null,
                    'item_id' => $detail['item_id'] ?? null,
                    'description' => $detail['description'] ?? '',
                    'invt_acct_id' => $detail['invt_acct_id'] ?? null,
                    'tax_id' => $detail['tax_id'] ?? 1,
                    'price' => $this->formatD365Decimal($detail['price'] ?? 0),
                    'qty' => $this->formatD365Decimal($detail['qty'] ?? 0),
                    'unit' => $detail['unit'] ?? 'Buah',
                    'qty_in_base' => $this->formatD365Decimal($detail['qty_in_base'] ?? 0),
                    'disc' => $this->formatD365Decimal($detail['disc'] ?? 0, 2),
                    'disc_amount' => $this->formatD365Decimal($detail['disc_amount'] ?? 0),
                    'tax_amount' => $this->formatD365Decimal($detail['tax_amount'] ?? 0),
                    'amount' => $this->formatD365Decimal($detail['amount'] ?? 0),
                    'purchaseorder_detail_id' => $detail['purchaseorder_detail_id'] ?? null,
                    'item_code' => $detail['item_code'] ?? '',
                    'item_name' => $detail['item_name'] ?? '',
                    'buy_price' => $this->formatD365Decimal($detail['buy_price'] ?? 0),
                    'variant' => $detail['variant'] ?? '',
                    'item_group_id' => $detail['item_group_id'] ?? null,
                    'original_price' => $this->formatD365Decimal($detail['original_price'] ?? 0),
                    'rate' => $this->formatD365Decimal($detail['rate'] ?? 0, 2),
                    'tax_name' => $detail['tax_name'] ?? 'No Tax',
                    'account_name' => $detail['account_name'] ?? '',
                    'use_serial_number' => !empty($detail['use_serial_number']) ? true : false,
                    'use_batch_number' => !empty($detail['use_batch_number']) ? true : false,
                    'bin_final_code' => $detail['bin_final_code'] ?? '',
                    'thumbnail' => $detail['thumbnail'] ?? '',
                    'batchno' => $detail['batchno'] ?? [],
                    'serialno' => $detail['serialno'] ?? [],
                ]);
            }
        }

        return [
            'items' => $items,
            'bill_id' => (int) ($row['bill_id'] ?? 0),
            'bill_no' => $row['bill_no'] ?? '',
            'contact_id' => $row['contact_id'] ?? null,
            'supplier_name' => $row['supplier_name'] ?? '',
            'transaction_date' => $row['transaction_date'] ?? '',
            'created_date' => $row['created_date'] ?? '',
            'due_date' => $row['due_date'] ?? '',
            'is_tax_included' => !empty($row['is_tax_included']) ? true : false,
            'note' => $row['note'] ?? '',
            'sub_total' => $this->formatD365Decimal($row['sub_total'] ?? 0),
            'total_disc' => $this->formatD365Decimal($row['total_disc'] ?? 0),
            'total_tax' => $this->formatD365Decimal($row['total_tax'] ?? 0),
            'grand_total' => $this->formatD365Decimal($row['grand_total'] ?? 0),
            'ref_no' => $row['ref_no'] ?? '',
            'is_opening_balance' => !empty($row['is_opening_balance']) ? true : false,
            'payment' => $this->formatD365Decimal($row['payment'] ?? 0),
            'location_id' => $row['location_id'] ?? null,
            'purchaseorder_id' => $row['purchaseorder_id'] ?? null,
            'last_modified' => $row['last_modified'] ?? '',
            'is_consignment' => !empty($row['is_consignment']) ? true : false,
            'created_by' => $row['created_by'] ?? '',
            'payment_term' => $row['payment_term'] ?? null,
            'auto_placement' => !empty($row['auto_placement']) ? true : false,
            'attachment' => $row['attachment'] ?? [],
            'header_note' => $row['header_note'] ?? '',
            'is_closed' => !empty($row['is_closed']) ? true : false,
            'purchaseorder_no' => $row['purchaseorder_no'] ?? '',
            'location_name' => $row['location_name'] ?? '',
            'payment_amount' => $this->formatD365Decimal($row['payment_amount'] ?? 0, 0),
            'add_cost_detail' => $row['add_cost_detail'] ?? [],
            'is_putaway' => !empty($row['is_putaway']) ? true : false,
        ]);
    }

    private function buildD365BillJson(string $payloadRaw): string
    {
        $payload = json_decode($payloadRaw, true);
        if (!$payload) {
            return json_encode(['_request' => ['bills' => []]], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        }

        $d365Payload = $this->buildD365BillFromStoredPayload($payload);
        return json_encode($d365Payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    private function removeNulls(array $data): array
    {
        foreach ($data as $key => $value) {
            if ($value === null) {
                unset($data[$key]);
                continue;
            }

            if (is_array($value)) {
                $data[$key] = $this->removeNulls($value);
            }
        }

        return $data;
    }

    private function formatD365Decimal($value, int $decimals = 4): string
    {
        if ($value === null || $value === '') {
            return number_format(0, $decimals, '.', '');
        }

        return number_format((float) $value, $decimals, '.', '');
    }
}
