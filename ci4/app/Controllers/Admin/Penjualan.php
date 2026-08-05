<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\LogModel;
use App\Models\SalesOrderItemSerialModel;
use App\Models\SalesOrderPackageModel;
use App\Models\SalesOrderWmsHistoryModel;
use App\Models\SalesOrderEscrowModel;
use App\Libraries\D365Service;

class Penjualan extends BaseController
{
    protected $penjualanModel;
    protected $detailModel;
    protected $logModel;
    protected $itemSerialModel;
    protected $packageModel;
    protected $wmsHistoryModel;
    protected $escrowModel;
    protected $d365Service;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->penjualanModel = new PenjualanModel();
        $this->detailModel = new PenjualanDetailModel();
        $this->logModel = new LogModel();
        $this->itemSerialModel = new SalesOrderItemSerialModel();
        $this->packageModel = new SalesOrderPackageModel();
        $this->wmsHistoryModel = new SalesOrderWmsHistoryModel();
        $this->escrowModel = new SalesOrderEscrowModel();
        $this->d365Service = new D365Service();
        helper('url');
        // session available via service('session') if needed
    }

    public function index()
    {
        $perPage = 20;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $rows = $this->penjualanModel->getAll($perPage, $offset);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['title' => 'Transaksi Penjualan', 'rows' => $rows]);
        }

        $data = ['title' => 'Transaksi Penjualan', 'rows' => $rows, 'pagination' => ''];
        return view('admin/templates/header', $data) . view('admin/penjualan/index', $data) . view('admin/templates/footer', $data);
    }

    public function ajax_rows()
    {
        $perPage = 20;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $rows = $this->penjualanModel->getAll($perPage, $offset);
        return $this->response->setJSON(['rows' => $rows]);
    }

    public function show($id)
    {
        $row = $this->penjualanModel->findById($id);
        if (!$row) {
            return redirect()->to('/admin/penjualan');
        }

        $salesorderNo = $row['salesorder_no'] ?? $row['order_no'] ?? null;
        $detailRows = [];
        if (!empty($salesorderNo)) {
            $detailRows = $this->detailModel->getBySalesorderNo($salesorderNo);
        }

        $serialRows = $this->itemSerialModel->getBySalesorderInternalId((int) ($row['id'] ?? 0));
        $packageRows = $this->packageModel->getBySalesorderInternalId((int) ($row['id'] ?? 0));
        $wmsRows = $this->wmsHistoryModel->getBySalesorderInternalId((int) ($row['id'] ?? 0));
        $escrowRows = $this->escrowModel->getBySalesorderInternalId((int) ($row['id'] ?? 0));

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'row' => $row,
                'details' => $detailRows,
                'serials' => $serialRows,
                'packages' => $packageRows,
                'wms_histories' => $wmsRows,
                'escrows' => $escrowRows,
            ]);
        }

        $payloadRaw = $row['payload'] ?? '[]';
        $payload = json_decode($payloadRaw, true) ?: [];
        $d365Payload = $this->buildD365RequestFromStoredPayload($payload);
        $d365PayloadRaw = $this->buildD365RequestJson($payloadRaw);

        $data = [
            'row' => $row,
            'details' => $detailRows,
            'serials' => $serialRows,
            'packages' => $packageRows,
            'wms_histories' => $wmsRows,
            'escrows' => $escrowRows,
            'd365_payload' => $d365Payload,
            'd365_payload_raw' => $d365PayloadRaw,
            'title' => 'Detail Penjualan',
        ];
        return view('admin/templates/header', $data) . view('admin/penjualan/show', $data) . view('admin/templates/footer', $data);
    }

    private function normalizeD365Payload($payload): array
    {
        if (!is_array($payload)) {
            return ['_request' => ['orders' => []]];
        }

        if (isset($payload['_request']) && isset($payload['_request']['orders']) && is_array($payload['_request']['orders'])) {
            $orders = array_values($payload['_request']['orders']);
            $orders = array_map(function ($order) {
                if (!is_array($order)) {
                    return $order;
                }
                $order = $this->reorderD365OrderFields($order);
                return $this->normalizeD365PayloadNumbers($order);
            }, $orders);

            return ['_request' => ['orders' => $orders]];
        }

        $orders = array_values($payload) !== $payload ? [$payload] : array_values($payload);
        $orders = array_map(function ($order) {
            if (!is_array($order)) {
                return $order;
            }
            $order = $this->reorderD365OrderFields($order);
            return $this->normalizeD365PayloadNumbers($order);
        }, $orders);

        return ['_request' => ['orders' => $orders]];
    }

    private function normalizeD365PayloadNumbers(array $payload): array
    {
        $numericKeys = [
            'weight_kg', 'weight_in_gram', 'price', 'amount', 'tax_amount',
            'sell_price', 'original_price', 'sub_total', 'total_tax', 'grand_total',
            'shipping_cost', 'insurance_cost', 'total_disc', 'disc_amount', 'disc_marketplace',
            'service_fee', 'order_processing_fee', 'cod_fee', 'buyer_shipping_cost'
        ];

        foreach ($payload as $key => $value) {
            if (is_array($value)) {
                $payload[$key] = $this->normalizeD365PayloadNumbers($value);
                continue;
            }

            if (in_array($key, $numericKeys, true)) {
                $formatted = number_format((float) $value, 2, '.', '');
                $payload[$key] = (float) $formatted;
            }
        }

        return $payload;
    }

    private function buildD365RequestFromStoredPayload(array $row = [], array $detailRows = []): array
    {
        $order = $this->buildD365OrderFromDatabaseRow($row, $detailRows);
        return [
            '_request' => [
                'dataareaid' => 'MPR',
                'orders' => [$order],
            ],
        ];
    }

    private function buildD365OrderFromDatabaseRow(array $row, array $detailRows = []): array
    {
        $items = [];
        foreach ($detailRows as $detail) {
            if (!is_array($detail)) {
                continue;
            }

            $items[] = [
                'salesorder_detail_id' => $detail['salesorder_detail_id'] ?? null,
                'item_id' => $detail['item_id'] ?? null,
                'description' => $detail['description'] ?? '',
                'tax_id' => $detail['tax_id'] ?? 1,
                'disc_marketplace' => $this->formatD365Decimal($detail['disc_marketplace'] ?? 0),
                'price' => $this->formatD365Decimal($detail['price'] ?? 0),
                'qty' => $this->formatD365Decimal($detail['qty'] ?? 0),
                'unit' => $detail['unit'] ?? 'Buah',
                'qty_in_base' => $this->formatD365Decimal($detail['qty_in_base'] ?? 0),
                'disc' => $this->formatD365Decimal($detail['disc'] ?? 0),
                'disc_amount' => $this->formatD365Decimal($detail['disc_amount'] ?? 0),
                'tax_amount' => $this->formatD365Decimal($detail['tax_amount'] ?? 0),
                'amount' => $this->formatD365Decimal($detail['amount'] ?? 0),
                'item_code' => $detail['item_code'] ?? '',
                'item_name' => $detail['item_name'] ?? '',
                'sell_price' => $this->formatD365Decimal($detail['sell_price'] ?? 0),
                'original_price' => $this->formatD365Decimal($detail['original_price'] ?? 0),
                'barcode' => $detail['barcode'] ?? '',
                'rate' => $this->formatD365Decimal($detail['rate'] ?? 0),
                'tax_name' => $detail['tax_name'] ?? 'No Tax',
                'is_bundle' => false,
                'item_group_id' => $detail['item_group_id'] ?? null,
                'loc_id' => $detail['loc_id'] ?? -1,
                'weight_in_gram' => $this->formatD365Decimal($detail['weight_in_gram'] ?? 0),
                'loc_name' => $detail['loc_name'] ?? 'Pusat',
                'fbm' => '',
                'is_fbm' => false,
                'thumbnail' => $detail['thumbnail'] ?? '',
                'serials' => [],
            ];
        }

        return [
            'action' => 'update-salesorder',
            'items' => $items,
            'salesorder_id' => (int) ($row['salesorder_id'] ?? 0),
            'salesorder_no' => $row['salesorder_no'] ?? '',
            'contact_id' => $row['contact_id'] ?? null,
            'customer_name' => $row['customer_name'] ?? '',
            'transaction_date' => $row['transaction_date'] ?? '',
            'created_date' => $row['created_date'] ?? '',
            'is_tax_included' => false,
            'note' => '',
            'sub_total' => $this->formatD365Decimal($row['sub_total'] ?? 0),
            'total_disc' => $this->formatD365Decimal($row['total_disc'] ?? 0),
            'total_tax' => $this->formatD365Decimal($row['total_tax'] ?? 0),
            'grand_total' => $this->formatD365Decimal($row['grand_total'] ?? 0),
            'ref_no' => '',
            'payment_method' => '',
            'location_id' => $row['location_id'] ?? -1,
            'is_canceled' => false,
            'source' => $row['source'] ?? 'INTERNAL',
            'is_paid' => true,
            'channel_status' => $row['channel_status'] ?? 'Processing',
            'shipping_cost' => $this->formatD365Decimal($row['shipping_cost'] ?? 0),
            'insurance_cost' => $this->formatD365Decimal($row['insurance_cost'] ?? 0),
            'shipping_full_name' => $row['shipping_full_name'] ?? '',
            'shipping_address' => $row['shipping_address'] ?? '',
            'shipping_area' => '',
            'shipping_city' => '',
            'shipping_province' => '',
            'shipping_post_code' => '',
            'shipping_country' => '',
            'last_modified' => $row['last_modified'] ?? '',
            'store_id' => $row['store_id'] ?? -100,
            'is_deleted_from_picklist' => false,
            'shipping_phone' => $row['shipping_phone'] ?? '',
            'is_acknowledge' => true,
            'add_disc' => $this->formatD365Decimal($row['discount_marketplace'] ?? 0),
            'add_fee' => $this->formatD365Decimal(0),
            'courier' => $row['courier'] ?? '',
            'picked_in' => null,
            'service_fee' => $this->formatD365Decimal($row['service_fee'] ?? 0),
            'is_cod' => false,
            'buyer_shipping_cost' => $this->formatD365Decimal($row['buyer_shipping_cost'] ?? 0),
            'package_count' => 1,
            'is_instant_courier' => false,
            'pos_is_shipping' => false,
            'awb_printed_count' => 0,
            'wms_status' => '',
            'use_shipping_insurance' => false,
            'shipping_cost_discount' => $this->formatD365Decimal($row['shipping_cost_discount'] ?? 0),
            'discount_marketplace' => $this->formatD365Decimal($row['discount_marketplace'] ?? 0),
            'is_edit_value' => false,
            'is_sameday' => false,
            'shipping_fee_discount_platform' => $this->formatD365Decimal(0),
            'shipping_fee_discount_seller' => $this->formatD365Decimal(0),
            'cod_fee' => $this->formatD365Decimal($row['cod_fee'] ?? 0),
            'is_jubelio_shipment' => false,
            'shipping_tax' => $this->formatD365Decimal($row['shipping_tax'] ?? 0),
            'order_processing_fee' => $this->formatD365Decimal($row['order_processing_fee'] ?? 0),
            'cod_fee_discount' => $this->formatD365Decimal(0),
            'total_weight_in_kg' => $this->formatD365Decimal(0),
            'internal_status' => $row['internal_status'] ?? '',
            'invoice_id' => $row['invoice_id'] ?? null,
            'invoice_no' => $row['invoice_no'] ?? '',
            'invoice_date' => $row['invoice_date'] ?? '',
            'customer_phone' => $row['customer_phone'] ?? '',
            'customer_email' => $row['customer_email'] ?? '',
            'tracking_no' => '',
            'source_name' => $row['source_name'] ?? '',
            'store_name' => $row['store_name'] ?? '',
            'location_name' => $row['location_name'] ?? 'Pusat',
            'location_code' => $row['location_code'] ?? '',
            'shipper' => $row['shipper'] ?? '',
            'picklist_no' => '',
            'channel_id' => 1,
            'store' => $row['store'] ?? '',
            'extra_info' => [],
            'extra_info_header' => [],
            'status' => $row['order_status'] ?? $row['status'] ?? 'INVOICED',
        ];
    }

    private function formatD365Decimal($value, int $decimals = 4): string
    {
        if ($value === null || $value === '') {
            return number_format(0, $decimals, '.', '');
        }

        return number_format((float) $value, $decimals, '.', '');
    }

    private function buildD365RequestJson(string $payloadRaw): string
    {
        $payload = json_decode($payloadRaw, true);
        if (!$payload) {
            return json_encode(['_request' => ['orders' => []]], JSON_PRETTY_PRINT);
        }

        $d365Payload = $this->normalizeD365Payload($payload);
        return json_encode($d365Payload, JSON_PRETTY_PRINT);
    }

    private function reorderD365OrderFields(array $order): array
    {
        $ordered = [];
        if (array_key_exists('action', $order)) {
            $ordered['action'] = $order['action'];
        }
        if (array_key_exists('items', $order)) {
            $ordered['items'] = $order['items'];
        }
        foreach ($order as $key => $value) {
            if ($key === 'action' || $key === 'items') {
                continue;
            }
            $ordered[$key] = $value;
        }
        return $ordered;
    }

    public function delete($id)
    {
        // log deletion
        $this->logModel->insertFor('penjualan', $id, 'deleted', 'Record deleted via admin');
        $this->penjualanModel->deleteRow($id);
        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/admin/penjualan');
    }

    public function resend($id)
    {
        $row = $this->penjualanModel->findById($id);
        if (!$row) {
            return redirect()->to('/admin/penjualan');
        }

        $salesorderNo = $row['salesorder_no'] ?? $row['order_no'] ?? null;
        $detailRows = [];
        if (!empty($salesorderNo)) {
            $detailRows = $this->detailModel->getBySalesorderNo($salesorderNo);
        }

        $payload = $this->buildD365RequestFromStoredPayload($row, $detailRows);

        $this->logModel->insertFor('penjualan', $id, 'resend_initiated', 'Admin requested resend', ['payload' => $payload]);
        $result = $this->d365Service->send('penjualan', $payload);

        $this->penjualanModel->updateRow($id, [
            'status' => $result['success'] ? 'sent' : 'failed',
            'response' => $result['body'],
            'sent_at' => date('Y-m-d H:i:s'),
        ]);

        $this->logModel->insertFor('penjualan', $id, 'resend_result', 'Result of admin resend', [
            'success' => $result['success'], 'body' => $result['body'], 'status_code' => $result['status_code'] ?? null
        ]);

        session()->setFlashdata($result['success'] ? 'success' : 'error', $result['success'] ? 'Berhasil dikirim ke D365' : 'Gagal kirim ke D365: ' . $result['body']);

        return redirect()->to('/admin/penjualan/' . $id);
    }
}
