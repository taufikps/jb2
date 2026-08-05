<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CancelModel;
use App\Models\CancelDetailModel;
use App\Models\CancelItemSerialModel;
use App\Models\LogModel;
use App\Libraries\D365Service;

class Cancel extends BaseController
{
    protected $cancelModel;
    protected $detailModel;
    protected $serialModel;
    protected $logModel;
    protected $d365Service;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->cancelModel = new CancelModel();
        $this->detailModel = new CancelDetailModel();
        $this->serialModel = new CancelItemSerialModel();
        $this->logModel = new LogModel();
        $this->d365Service = new D365Service();
        helper('url');
    }

    public function index()
    {
        $perPage = 20;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $rows = $this->cancelModel->getAll($perPage, $offset);
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['title' => 'Transaksi Penjualan Cancel', 'rows' => $rows]);
        }

        $data = ['title' => 'Transaksi Penjualan Cancel', 'rows' => $rows, 'pagination' => ''];
        return view('admin/templates/header', $data) . view('admin/cancel/index', $data) . view('admin/templates/footer', $data);
    }

    public function show($id)
    {
        $row = $this->cancelModel->findById($id);
        if (!$row) return redirect()->to('/admin/cancel');

        $details = $this->detailModel->getByCancelId($id);
        $serialsByDetail = [];
        foreach ($details as $detail) {
            $detailId = (int) ($detail['id'] ?? 0);
            if ($detailId > 0) {
                $serialsByDetail[$detailId] = $this->serialModel->getByCancelDetailId($detailId);
            }
        }

        $d365Payload = $this->buildD365CancelPayload($row, $details, $serialsByDetail);
        $d365PayloadRaw = $this->buildD365CancelPayloadJson($row, $details, $serialsByDetail);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'row' => $row,
                'details' => $details,
                'serialsByDetail' => $serialsByDetail,
                'd365_payload' => $d365Payload,
                'd365_payload_raw' => $d365PayloadRaw,
            ]);
        }

        $data = [
            'row' => $row,
            'details' => $details,
            'serialsByDetail' => $serialsByDetail,
            'd365_payload' => $d365Payload,
            'd365_payload_raw' => $d365PayloadRaw,
            'title' => 'Detail Penjualan Cancel',
        ];
        return view('admin/templates/header', $data) . view('admin/cancel/show', $data) . view('admin/templates/footer', $data);
    }

    public function delete($id)
    {
        $this->logModel->insertFor('penjualan_cancel', $id, 'deleted', 'Record deleted via admin');
        $this->cancelModel->deleteRow($id);
        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/admin/cancel');
    }

    private function buildD365CancelPayload(array $row, array $detailRows = [], array $serialsByDetail = []): array
    {
        if (!empty($serialsByDetail) && !empty($detailRows)) {
            foreach ($detailRows as $index => $detail) {
                $detailId = (int) ($detail['id'] ?? 0);
                if ($detailId > 0 && isset($serialsByDetail[$detailId])) {
                    $detailRows[$index]['serials'] = $serialsByDetail[$detailId];
                }
            }
        }

        return [
            '_request' => [
                'dataareaid' => 'MPR',
                'orders' => [
                    $this->buildD365CancelOrder($row, $detailRows),
                ],
            ],
        ];
    }

    private function getDefaultCancelItems(): array
    {
        return [
            [
                'salesorder_detail_id' => 62443,
                'item_id' => 1708,
                'description' => 'Test Barang Batch',
                'tax_id' => 1,
                'disc_marketplace' => '0.0000',
                'price' => '10000.0000',
                'qty' => '0.0000',
                'unit' => 'Buah',
                'qty_in_base' => '1.0000',
                'disc' => '0.00',
                'disc_amount' => '0.0000',
                'tax_amount' => '0.0000',
                'amount' => '10000.0000',
                'is_canceled_item' => true,
                'pick_scanned_date' => '2026-07-08T07:45:43.402Z',
                'item_code' => 'TBB1',
                'item_name' => 'Test Barang Batch',
                'sell_price' => '10000.0000',
                'original_price' => '10000.0000',
                'rate' => '0.00',
                'tax_name' => 'No Tax',
                'is_bundle' => false,
                'item_group_id' => 777,
                'loc_id' => -1,
                'weight_in_gram' => '10.0000',
                'loc_name' => 'Pusat',
                'fbm' => '',
                'is_fbm' => false,
                'thumbnail' => 'https://assets-alpha.ass8c.upcloudobjects.com/ndnmuriwr1sspttrd3ddig/images/thumb_rug-1688630523187-0.jpg',
                'serials' => [
                    [
                        'picked_serial_number_id' => 6154,
                        'picklist_detail_id' => 30190,
                        'pick_scanned_date' => '2026-07-08T07:45:43.402198+00:00',
                        'batch_no' => 'qwer',
                        'bin_id' => 1,
                        'qty' => 1,
                        'expired_date' => '2024-10-24T17:00:00+00:00',
                    ],
                    [
                        'picked_serial_number_id' => 6155,
                        'picklist_detail_id' => 30190,
                        'pick_scanned_date' => '2026-07-08T07:45:43.402198+00:00',
                        'batch_no' => 'qwer',
                        'bin_id' => 1,
                        'qty' => -1,
                        'expired_date' => '2024-10-24T17:00:00+00:00',
                    ],
                    [
                        'picked_serial_number_id' => 6156,
                        'picklist_detail_id' => 30190,
                        'pick_scanned_date' => '2026-07-08T07:45:43.402198+00:00',
                        'batch_no' => 'qwer',
                        'bin_id' => 1,
                        'qty' => -1,
                        'expired_date' => '2024-10-24T17:00:00+00:00',
                    ],
                    [
                        'picked_serial_number_id' => 6157,
                        'picklist_detail_id' => 30190,
                        'pick_scanned_date' => '2026-07-08T07:45:43.402198+00:00',
                        'batch_no' => 'qwer',
                        'bin_id' => 1,
                        'qty' => 1,
                        'expired_date' => '2024-10-24T17:00:00+00:00',
                    ],
                ],
            ],
            [
                'salesorder_detail_id' => 62444,
                'item_id' => 12714,
                'description' => 'TEST-SERIAL-WMS-2',
                'tax_id' => 1,
                'disc_marketplace' => '0.0000',
                'price' => '12000.0000',
                'qty' => '0.0000',
                'unit' => 'Buah',
                'qty_in_base' => '1.0000',
                'disc' => '0.00',
                'disc_amount' => '0.0000',
                'tax_amount' => '0.0000',
                'amount' => '12000.0000',
                'is_canceled_item' => true,
                'item_code' => 'TSN-WMS',
                'item_name' => 'TEST-SERIAL-WMS-2',
                'sell_price' => '12000.0000',
                'original_price' => '12000.0000',
                'rate' => '0.00',
                'tax_name' => 'No Tax',
                'is_bundle' => false,
                'item_group_id' => 7628,
                'loc_id' => -1,
                'weight_in_gram' => '210.0000',
                'loc_name' => 'Pusat',
                'fbm' => '',
                'is_fbm' => false,
                'thumbnail' => 'https://assets-alpha.ass8c.upcloudobjects.com/ndnmuriwr1sspttrd3ddig/images/ndnmuriwr1sspttrd3ddig/thumb_gocar.jpeg',
                'serials' => [],
            ],
        ];
    }

    private function buildD365CancelOrder(array $row, array $detailRows = []): array
    {
        $items = [];
        foreach (array_values($detailRows) as $detail) {
            if (!is_array($detail)) {
                continue;
            }

            $items[] = $this->buildD365CancelItem($detail);
        }

        if (empty($items)) {
            $items = $this->getDefaultCancelItems();
        }

        return [
            'action' => 'update-salesorder',
            'items' => $items,
            'salesorder_id' => isset($row['salesorder_id']) ? (int) $row['salesorder_id'] : 500114,
            'salesorder_no' => $row['salesorder_no'] ?? 'SO-000500114',
            'contact_id' => $row['contact_id'] ?? 39784,
            'customer_name' => $row['customer_name'] ?? 'punyarahel',
            'transaction_date' => $row['transaction_date'] ?? '2026-07-08T07:44:46.875Z',
            'created_date' => $row['created_date'] ?? '2026-07-08T07:44:46.558Z',
            'is_tax_included' => array_key_exists('is_tax_included', $row) ? (bool) $row['is_tax_included'] : false,
            'note' => $row['note'] ?? '',
            'sub_total' => isset($row['sub_total']) ? $this->formatD365Decimal($row['sub_total']) : '22000.0000',
            'total_disc' => isset($row['total_disc']) ? $this->formatD365Decimal($row['total_disc']) : '0.0000',
            'total_tax' => isset($row['total_tax']) ? $this->formatD365Decimal($row['total_tax']) : '0.0000',
            'grand_total' => isset($row['grand_total']) ? $this->formatD365Decimal($row['grand_total']) : '22000.0000',
            'ref_no' => $row['ref_no'] ?? '',
            'payment_method' => $row['payment_method'] ?? '',
            'location_id' => $row['location_id'] ?? -1,
            'is_canceled' => array_key_exists('is_canceled', $row) ? (bool) $row['is_canceled'] : true,
            'cancel_reason' => $row['cancel_reason'] ?? 'Stok Habis',
            'source' => $row['source'] ?? 'INTERNAL',
            'is_paid' => array_key_exists('is_paid', $row) ? (bool) $row['is_paid'] : true,
            'channel_status' => $row['channel_status'] ?? 'canceled',
            'shipping_cost' => isset($row['shipping_cost']) ? $this->formatD365Decimal($row['shipping_cost']) : '0.0000',
            'insurance_cost' => isset($row['insurance_cost']) ? $this->formatD365Decimal($row['insurance_cost']) : '0.0000',
            'shipping_full_name' => $row['shipping_full_name'] ?? 'punyarahel',
            'shipping_address' => $row['shipping_address'] ?? 'Jalan MCC',
            'shipping_area' => $row['shipping_area'] ?? '',
            'shipping_city' => $row['shipping_city'] ?? '',
            'shipping_province' => $row['shipping_province'] ?? '',
            'shipping_post_code' => $row['shipping_post_code'] ?? '',
            'shipping_country' => $row['shipping_country'] ?? '',
            'last_modified' => $row['last_modified'] ?? '2026-07-08T07:45:58.888Z',
            'store_id' => $row['store_id'] ?? -100,
            'marked_as_complete' => array_key_exists('marked_as_complete', $row) ? (bool) $row['marked_as_complete'] : false,
            'is_deleted_from_picklist' => array_key_exists('is_deleted_from_picklist', $row) ? (bool) $row['is_deleted_from_picklist'] : false,
            'shipping_phone' => $row['shipping_phone'] ?? '099xxx88',
            'is_acknowledge' => array_key_exists('is_acknowledge', $row) ? (bool) $row['is_acknowledge'] : true,
            'add_disc' => isset($row['add_disc']) ? $this->formatD365Decimal($row['add_disc']) : '0.0000',
            'add_fee' => isset($row['add_fee']) ? $this->formatD365Decimal($row['add_fee']) : '0.0000',
            'courier' => $row['courier'] ?? '',
            'picked_in' => $row['picked_in'] ?? 11202,
            'service_fee' => isset($row['service_fee']) ? $this->formatD365Decimal($row['service_fee']) : '0.0000',
            'is_cod' => array_key_exists('is_cod', $row) ? (bool) $row['is_cod'] : false,
            'buyer_shipping_cost' => isset($row['buyer_shipping_cost']) ? $this->formatD365Decimal($row['buyer_shipping_cost']) : '0.0000',
            'package_count' => $row['package_count'] ?? 1,
            'is_instant_courier' => array_key_exists('is_instant_courier', $row) ? (bool) $row['is_instant_courier'] : false,
            'pos_is_shipping' => array_key_exists('pos_is_shipping', $row) ? (bool) $row['pos_is_shipping'] : false,
            'awb_printed_count' => $row['awb_printed_count'] ?? 0,
            'wms_status' => $row['wms_status'] ?? 'CANCELED',
            'use_shipping_insurance' => array_key_exists('use_shipping_insurance', $row) ? (bool) $row['use_shipping_insurance'] : false,
            'shipping_cost_discount' => isset($row['shipping_cost_discount']) ? $this->formatD365Decimal($row['shipping_cost_discount']) : '0.0000',
            'discount_marketplace' => isset($row['discount_marketplace']) ? $this->formatD365Decimal($row['discount_marketplace']) : '0.0000',
            'internal_cancel_date' => $row['internal_cancel_date'] ?? '2026-07-08T07:45:58.927Z',
            'is_edit_value' => array_key_exists('is_edit_value', $row) ? (bool) $row['is_edit_value'] : false,
            'is_sameday' => array_key_exists('is_sameday', $row) ? (bool) $row['is_sameday'] : false,
            'shipping_fee_discount_platform' => isset($row['shipping_fee_discount_platform']) ? $this->formatD365Decimal($row['shipping_fee_discount_platform']) : '0.0000',
            'shipping_fee_discount_seller' => isset($row['shipping_fee_discount_seller']) ? $this->formatD365Decimal($row['shipping_fee_discount_seller']) : '0.0000',
            'extra_info' => $this->normalizeD365JsonObject($row['extra_info'] ?? null),
            'cod_fee' => isset($row['cod_fee']) ? $this->formatD365Decimal($row['cod_fee']) : '0.0000',
            'is_jubelio_shipment' => array_key_exists('is_jubelio_shipment', $row) ? (bool) $row['is_jubelio_shipment'] : false,
            'shipping_tax' => isset($row['shipping_tax']) ? $this->formatD365Decimal($row['shipping_tax']) : '0.0000',
            'order_processing_fee' => isset($row['order_processing_fee']) ? $this->formatD365Decimal($row['order_processing_fee']) : '0.0000',
            'cod_fee_discount' => isset($row['cod_fee_discount']) ? $this->formatD365Decimal($row['cod_fee_discount']) : '0.0000',
            'total_weight_in_kg' => isset($row['total_weight_in_kg']) ? $this->formatD365Decimal($row['total_weight_in_kg'], 3) : '0.220',
            'internal_status' => $row['internal_status'] ?? 'CANCELED',
            'customer_phone' => $row['customer_phone'] ?? '099xxx88',
            'customer_email' => $row['customer_email'] ?? 'raheljube@jubelio.com',
            'tracking_no' => $row['tracking_no'] ?? '',
            'source_name' => $row['source_name'] ?? 'INTERNAL',
            'store_name' => $row['store_name'] ?? 'Toko Default',
            'location_name' => $row['location_name'] ?? 'Pusat',
            'location_code' => isset($row['location_code']) ? (string) $row['location_code'] : '123',
            'shipper' => $row['shipper'] ?? '',
            'picklist_no' => $row['picklist_no'] ?? 'PICK-000011202',
            'channel_id' => $row['channel_id'] ?? 1,
            'store' => $row['store'] ?? 'Toko Default',
            'extra_info_header' => $this->normalizeD365JsonObject($row['extra_info_header'] ?? null),
            'status' => $row['status'] ?? 'CANCELED',
        ];
    }

    private function buildD365CancelItem(array $detail): array
    {
        return [
            'salesorder_detail_id' => $detail['salesorder_detail_id'] ?? 62443,
            'item_id' => $detail['item_id'] ?? 1708,
            'description' => $detail['description'] ?? 'Test Barang Batch',
            'tax_id' => $detail['tax_id'] ?? 1,
            'disc_marketplace' => isset($detail['disc_marketplace']) ? $this->formatD365Decimal($detail['disc_marketplace']) : '0.0000',
            'price' => isset($detail['price']) ? $this->formatD365Decimal($detail['price']) : '10000.0000',
            'qty' => isset($detail['qty']) ? $this->formatD365Decimal($detail['qty']) : '0.0000',
            'unit' => $detail['unit'] ?? 'Buah',
            'qty_in_base' => isset($detail['qty_in_base']) ? $this->formatD365Decimal($detail['qty_in_base']) : '1.0000',
            'disc' => isset($detail['disc']) ? $this->formatD365Decimal($detail['disc']) : '0.00',
            'disc_amount' => isset($detail['disc_amount']) ? $this->formatD365Decimal($detail['disc_amount']) : '0.0000',
            'tax_amount' => isset($detail['tax_amount']) ? $this->formatD365Decimal($detail['tax_amount']) : '0.0000',
            'amount' => isset($detail['amount']) ? $this->formatD365Decimal($detail['amount']) : '10000.0000',
            'is_canceled_item' => array_key_exists('is_canceled_item', $detail) ? (bool) $detail['is_canceled_item'] : true,
            'pick_scanned_date' => $this->normalizeD365DateTime($detail['pick_scanned_date'] ?? null) ?? '2026-07-08T07:45:43.402Z',
            'item_code' => $detail['item_code'] ?? 'TBB1',
            'item_name' => $detail['item_name'] ?? 'Test Barang Batch',
            'sell_price' => isset($detail['sell_price']) ? $this->formatD365Decimal($detail['sell_price']) : '10000.0000',
            'original_price' => isset($detail['original_price']) ? $this->formatD365Decimal($detail['original_price']) : '10000.0000',
            'rate' => isset($detail['rate']) ? $this->formatD365Decimal($detail['rate']) : '0.00',
            'tax_name' => $detail['tax_name'] ?? 'No Tax',
            'is_bundle' => array_key_exists('is_bundle', $detail) ? (bool) $detail['is_bundle'] : false,
            'item_group_id' => $detail['item_group_id'] ?? 777,
            'loc_id' => $detail['loc_id'] ?? -1,
            'weight_in_gram' => isset($detail['weight_in_gram']) ? $this->formatD365Decimal($detail['weight_in_gram']) : '10.0000',
            'loc_name' => $detail['loc_name'] ?? 'Pusat',
            'fbm' => $detail['fbm'] ?? '',
            'is_fbm' => array_key_exists('is_fbm', $detail) ? (bool) $detail['is_fbm'] : false,
            'thumbnail' => $detail['thumbnail'] ?? 'https://assets-alpha.ass8c.upcloudobjects.com/ndnmuriwr1sspttrd3ddig/images/thumb_rug-1688630523187-0.jpg',
            'serials' => $this->buildD365Serials($detail),
        ];
    }

    private function buildD365Serials(array $detail): ?array
    {
        $serials = $detail['serials'] ?? $detail['serials_payload'] ?? null;
        if (is_string($serials)) {
            $decoded = json_decode($serials, true);
            $serials = is_array($decoded) ? $decoded : null;
        }

        if (!is_array($serials)) {
            return [];
        }

        $result = [];
        foreach (array_values($serials) as $serial) {
            if (!is_array($serial)) {
                continue;
            }

            $serialItem = [
                'picked_serial_number_id' => array_key_exists('picked_serial_number_id', $serial) ? $serial['picked_serial_number_id'] : null,
                'picklist_detail_id' => array_key_exists('picklist_detail_id', $serial) ? $serial['picklist_detail_id'] : null,
                'batch_no' => array_key_exists('batch_no', $serial) ? $serial['batch_no'] : null,
                'bin_id' => array_key_exists('bin_id', $serial) ? $serial['bin_id'] : null,
                'qty' => array_key_exists('qty', $serial) ? $serial['qty'] : null,
            ];

            $pickScannedDate = array_key_exists('pick_scanned_date', $serial) ? $this->normalizeD365DateTime($serial['pick_scanned_date']) : null;
            if ($pickScannedDate !== null) {
                $serialItem['pick_scanned_date'] = $pickScannedDate;
            }

            if (array_key_exists('expired_date', $serial)) {
                $serialItem['expired_date'] = $this->normalizeD365DateTime($serial['expired_date']);
            }

            $result[] = $serialItem;
        }

        return $result;
    }

    private function normalizeCancelSerials($serials): array
    {
        if (is_string($serials)) {
            $decoded = json_decode($serials, true);
            if (is_array($decoded)) {
                $serials = $decoded;
            } else {
                return [];
            }
        }

        if (!is_array($serials)) {
            return [];
        }

        return array_map(function ($serial) {
            if (!is_array($serial)) {
                return [];
            }

            return [
                'picked_serial_number_id' => $serial['picked_serial_number_id'] ?? null,
                'picklist_detail_id' => $serial['picklist_detail_id'] ?? null,
                'pick_scanned_date' => $serial['pick_scanned_date'] ?? null,
                'batch_no' => $serial['batch_no'] ?? null,
                'bin_id' => $serial['bin_id'] ?? null,
                'qty' => $serial['qty'] ?? null,
                'expired_date' => $serial['expired_date'] ?? null,
            ];
        }, array_values($serials));
    }

    private function formatD365Decimal($value, int $decimals = 4): string
    {
        if ($value === null || $value === '') {
            return number_format(0, $decimals, '.', '');
        }

        return number_format((float) $value, $decimals, '.', '');
    }

    private function normalizeD365JsonObject($value)
    {
        if (is_array($value)) {
            return $value !== [] ? $value : (object) [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return $decoded !== [] ? $decoded : (object) [];
            }
        }

        return (object) [];
    }

    private function normalizeD365DateTime($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        try {
            $dt = new \DateTime((string) $value);
            $dt->setTimezone(new \DateTimeZone('UTC'));
            $milliseconds = (int) floor((int) $dt->format('u') / 1000);
            return $dt->format('Y-m-d\TH:i:s') . '.' . str_pad((string) $milliseconds, 3, '0', STR_PAD_LEFT) . 'Z';
        } catch (\Exception $e) {
            return null;
        }
    }

    private function normalizeD365Payload($payload): array
    {
        if (!is_array($payload)) {
            return ['_request' => ['dataareaid' => 'MPR', 'orders' => []]];
        }

        if (isset($payload['_request']) && isset($payload['_request']['orders']) && is_array($payload['_request']['orders'])) {
            $orders = array_values($payload['_request']['orders']);
            $orders = array_map(function ($order) {
                if (!is_array($order)) {
                    return $order;
                }

                return $this->normalizeD365PayloadNumbers($order);
            }, $orders);

            $request = ['orders' => $orders];
            if (isset($payload['_request']['dataareaid'])) {
                $request['dataareaid'] = $payload['_request']['dataareaid'];
            }

            return ['_request' => $request];
        }

        return ['_request' => ['dataareaid' => 'MPR', 'orders' => []]];
    }

    private function normalizeD365PayloadNumbers(array $payload): array
    {
        foreach ($payload as $key => $value) {
            if (is_array($value)) {
                $payload[$key] = $this->normalizeD365PayloadNumbers($value);
            }
        }

        return $payload;
    }

    private function buildD365CancelPayloadJson(array $row = [], array $detailRows = [], array $serialsByDetail = []): string
    {
        $payload = $this->buildD365CancelPayload($row, $detailRows, $serialsByDetail);
        $normalizedPayload = $this->normalizeD365Payload($payload);
        return json_encode($normalizedPayload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function resend($id)
    {
        $row = $this->cancelModel->findById($id);
        if (!$row) return redirect()->to('/admin/cancel');

        $detailRows = $this->detailModel->getByCancelId($id);
        $serialsByDetail = [];
        foreach ($detailRows as $detail) {
            $detailId = (int) ($detail['id'] ?? 0);
            if ($detailId > 0) {
                $serialsByDetail[$detailId] = $this->serialModel->getByCancelDetailId($detailId);
            }
        }

        $payload = $this->buildD365CancelPayload($row, $detailRows, $serialsByDetail);
        $this->logModel->insertFor('penjualan_cancel', $id, 'resend_initiated', 'Admin requested resend', ['payload' => $payload]);
        $result = $this->d365Service->send('penjualan_cancel', $payload);

        $this->cancelModel->updateRow($id, [
            'status' => $result['success'] ? 'sent' : 'failed',
            'response' => $result['body'],
            'sent_at' => date('Y-m-d H:i:s'),
        ]);

        $this->logModel->insertFor('penjualan_cancel', $id, 'resend_result', 'Result of admin resend', ['success' => $result['success'], 'body' => $result['body']]);
        session()->setFlashdata($result['success'] ? 'success' : 'error', $result['success'] ? 'Berhasil dikirim ke D365' : 'Gagal kirim ke D365: ' . $result['body']);
        return redirect()->to('/admin/cancel/' . $id);
    }
}
