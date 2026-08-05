<?php

namespace App\Controllers;

use App\Libraries\D365Service;
use App\Models\CancelDetailModel;
use App\Models\CancelModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Api extends Controller
{
    protected $db;
    protected $d365Service;

    public function __construct()
    {
        helper(['url']);
        $this->db = db_connect();
        $this->d365Service = new D365Service();
    }

    private function response(bool $status, string $message, $data = null, int $httpCode = 200): ResponseInterface
    {
        $response = service('response');
        $response->setStatusCode($httpCode);
        $response->setContentType('application/json');
        $response->setBody(json_encode([
            'success' => $status,
            'message' => $message,
            'data' => $data,
        ], JSON_UNESCAPED_SLASHES));

        return $response;
    }

    private function normalizeBatchPayload($data)
    {
        if (!is_array($data)) {
            return null;
        }

        if (isset($data['_request'])) {
            if (isset($data['_request']['orders']) && is_array($data['_request']['orders'])) {
                return array_values($data['_request']['orders']);
            }
            if (isset($data['_request']['bills']) && is_array($data['_request']['bills'])) {
                return array_values($data['_request']['bills']);
            }
        }

        if ($data === []) {
            return [];
        }

        return array_values($data) !== $data ? [$data] : $data;
    }

    private function buildD365Request(array $orders, ?array $requestData = null): array
    {
        $payloadOrders = [];
        foreach (array_values($orders) as $entry) {
            if (!is_array($entry)) {
                continue;
            }

            if (isset($entry['row']) && is_array($entry['row'])) {
                $payloadOrders[] = $this->buildD365OrderFromDatabaseRow($entry['row'], $entry['detail_rows'] ?? []);
                continue;
            }

            if (isset($entry['salesorder_no']) || isset($entry['order_no'])) {
                $payloadOrders[] = $this->buildD365OrderFromDatabaseRow($entry, []);
            }
        }

        $dataareaId = 'MPR';
        if (is_array($requestData) && isset($requestData['_request']['dataareaid']) && !empty($requestData['_request']['dataareaid'])) {
            $dataareaId = $requestData['_request']['dataareaid'];
        }

        return [
            '_request' => [
                'dataareaid' => $dataareaId,
                'orders' => $payloadOrders,
            ],
        ];
    }

    private function buildD365OrderFromDatabaseRow(array $row, array $detailRows = []): array
    {
        return $this->buildD365CancelOrder($row, $detailRows);
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

    private function buildD365ReturnRequestFromPayload(array $payload): array
    {
        $order = $this->buildD365ReturnOrderFromPayload($payload);
        return [
            '_request' => [
                'dataareaid' => 'MPR',
                'orders' => [$order],
            ],
        ];
    }

    private function buildD365BillRequestFromPayload(array $payload): array
    {
        $bill = $this->buildD365BillOrderFromPayload($payload);
        return [
            '_request' => [
                'dataareaid' => 'MPR',
                'bills' => [$bill],
            ],
        ];
    }

    private function buildD365BillOrderFromPayload(array $row): array
    {
        $items = [];
        if (!empty($row['items']) && is_array($row['items'])) {
            foreach ($row['items'] as $detail) {
                if (!is_array($detail)) {
                    continue;
                }

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
                    'use_serial_number' => !empty($detail['use_serial_number']),
                    'use_batch_number' => !empty($detail['use_batch_number']),
                    'bin_final_code' => $detail['bin_final_code'] ?? '',
                    'thumbnail' => $detail['thumbnail'] ?? '',
                    'batchno' => $detail['batchno'] ?? [],
                    'serialno' => $detail['serialno'] ?? [],
                ]);
            }
        }

        $extraInfo = $row['extra_info'] ?? [];
        if (!is_array($extraInfo)) {
            $extraInfo = [];
        }
        $extraInfo = (object) $extraInfo;

        $extraInfoHeader = $row['extra_info_header'] ?? [];
        if (!is_array($extraInfoHeader)) {
            $extraInfoHeader = [];
        }
        $extraInfoHeader = (object) $extraInfoHeader;

        return $this->removeNulls([
            'items' => $items,
            'bill_id' => (int) ($row['bill_id'] ?? 0),
            'bill_no' => $row['bill_no'] ?? '',
            'contact_id' => $row['contact_id'] ?? null,
            'supplier_name' => $row['supplier_name'] ?? '',
            'transaction_date' => $row['transaction_date'] ?? '',
            'created_date' => $row['created_date'] ?? '',
            'due_date' => $row['due_date'] ?? '',
            'is_tax_included' => !empty($row['is_tax_included']),
            'note' => $row['note'] ?? '',
            'sub_total' => $this->formatD365Decimal($row['sub_total'] ?? 0),
            'total_disc' => $this->formatD365Decimal($row['total_disc'] ?? 0),
            'total_tax' => $this->formatD365Decimal($row['total_tax'] ?? 0),
            'grand_total' => $this->formatD365Decimal($row['grand_total'] ?? 0),
            'ref_no' => $row['ref_no'] ?? '',
            'is_opening_balance' => !empty($row['is_opening_balance']),
            'payment' => $this->formatD365Decimal($row['payment'] ?? 0),
            'payment_acct_id' => $row['payment_acct_id'] ?? null,
            'location_id' => $row['location_id'] ?? null,
            'purchaseorder_id' => $row['purchaseorder_id'] ?? null,
            'last_modified' => $row['last_modified'] ?? '',
            'is_consignment' => !empty($row['is_consignment']),
            'created_by' => $row['created_by'] ?? '',
            'payment_term' => $row['payment_term'] ?? null,
            'auto_placement' => !empty($row['auto_placement']),
            'attachment' => $row['attachment'] ?? [],
            'add_cost_detail' => $row['add_cost_detail'] ?? [],
            'is_putaway' => !empty($row['is_putaway']),
            'header_note' => $row['header_note'] ?? '',
            'is_closed' => !empty($row['is_closed']),
            'purchaseorder_no' => $row['purchaseorder_no'] ?? '',
            'location_name' => $row['location_name'] ?? '',
            'payment_amount' => $this->formatD365Decimal($row['payment_amount'] ?? 0, 0),
            'is_paid' => !empty($row['is_paid']),
            'extra_info' => $extraInfo,
            'extra_info_header' => $extraInfoHeader,
        ]);
    }

    private function buildD365ReturnOrderFromPayload(array $row): array
    {
        $items = [];
        if (!empty($row['items']) && is_array($row['items'])) {
            foreach ($row['items'] as $detail) {
                if (!is_array($detail)) continue;
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
                    'serials' => $detail['serials'] ?? [],
                    'is_canceled_item' => isset($detail['is_canceled_item']) ? (bool)$detail['is_canceled_item'] : false,
                ];
            }
        }

        $extraInfo = $row['extra_info'] ?? [];
        if (!is_array($extraInfo)) $extraInfo = [];
        $extraInfo = (object)$extraInfo;

        $extraInfoHeader = $row['extra_info_header'] ?? [];
        if (!is_array($extraInfoHeader)) $extraInfoHeader = [];
        $extraInfoHeader = (object)$extraInfoHeader;

        return [
            'action' => $row['action'] ?? 'update-salesorder',
            'items' => $items,
            'salesorder_id' => (int) ($row['salesorder_id'] ?? 0),
            'salesorder_no' => $row['salesorder_no'] ?? '',
            'contact_id' => $row['contact_id'] ?? null,
            'customer_name' => $row['customer_name'] ?? '',
            'transaction_date' => $row['transaction_date'] ?? '',
            'created_date' => $row['created_date'] ?? '',
            'is_tax_included' => false,
            'note' => $row['note'] ?? '',
            'sub_total' => $this->formatD365Decimal($row['sub_total'] ?? 0),
            'total_disc' => $this->formatD365Decimal($row['total_disc'] ?? 0),
            'total_tax' => $this->formatD365Decimal($row['total_tax'] ?? 0),
            'grand_total' => $this->formatD365Decimal($row['grand_total'] ?? 0),
            'ref_no' => $row['ref_no'] ?? '',
            'payment_method' => $row['payment_method'] ?? '',
            'location_id' => $row['location_id'] ?? -1,
            'is_canceled' => !empty($row['is_canceled']) ? true : false,
            'source' => $row['source'] ?? 'INTERNAL',
            'is_paid' => !empty($row['is_paid']) ? true : false,
            'channel_status' => $row['channel_status'] ?? '',
            'shipping_cost' => $this->formatD365Decimal($row['shipping_cost'] ?? 0),
            'insurance_cost' => $this->formatD365Decimal($row['insurance_cost'] ?? 0),
            'shipping_full_name' => $row['shipping_full_name'] ?? '',
            'shipping_address' => $row['shipping_address'] ?? '',
            'shipping_area' => $row['shipping_area'] ?? '',
            'shipping_city' => $row['shipping_city'] ?? '',
            'shipping_province' => $row['shipping_province'] ?? '',
            'shipping_post_code' => $row['shipping_post_code'] ?? '',
            'shipping_country' => $row['shipping_country'] ?? '',
            'last_modified' => $row['last_modified'] ?? '',
            'store_id' => $row['store_id'] ?? -100,
            'is_deleted_from_picklist' => false,
            'shipping_phone' => $row['shipping_phone'] ?? '',
            'is_acknowledge' => true,
            'add_disc' => $this->formatD365Decimal($row['discount_marketplace'] ?? 0),
            'add_fee' => $this->formatD365Decimal(0),
            'courier' => $row['courier'] ?? '',
            'picked_in' => $row['picked_in'] ?? null,
            'service_fee' => $this->formatD365Decimal($row['service_fee'] ?? 0),
            'is_cod' => !empty($row['is_cod']) ? true : false,
            'buyer_shipping_cost' => $this->formatD365Decimal($row['buyer_shipping_cost'] ?? 0),
            'package_count' => $row['package_count'] ?? 1,
            'is_instant_courier' => false,
            'pos_is_shipping' => false,
            'awb_printed_count' => $row['awb_printed_count'] ?? 0,
            'wms_status' => $row['wms_status'] ?? '',
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
            'total_weight_in_kg' => $this->formatD365Decimal($row['total_weight_in_kg'] ?? 0),
            'internal_status' => $row['internal_status'] ?? '',
            'invoice_id' => $row['invoice_id'] ?? null,
            'invoice_no' => $row['invoice_no'] ?? '',
            'invoice_date' => $row['invoice_date'] ?? '',
            'customer_phone' => $row['customer_phone'] ?? '',
            'customer_email' => $row['customer_email'] ?? '',
            'tracking_no' => $row['tracking_no'] ?? '',
            'source_name' => $row['source_name'] ?? '',
            'store_name' => $row['store_name'] ?? '',
            'location_name' => $row['location_name'] ?? 'Pusat',
            'location_code' => $row['location_code'] ?? '',
            'shipper' => $row['shipper'] ?? '',
            'picklist_no' => $row['picklist_no'] ?? '',
            'channel_id' => $row['channel_id'] ?? 1,
            'store' => $row['store'] ?? '',
            'extra_info' => $extraInfo,
            'extra_info_header' => $extraInfoHeader,
            'status' => $row['status'] ?? $row['internal_status'] ?? '',
        ];
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
            'extra_info' => $this->normalizeD365JsonObject($row['extra_info'] ?? null),
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
                $expiredDate = $this->normalizeD365DateTime($serial['expired_date']);
                if ($expiredDate !== null) {
                    $serialItem['expired_date'] = $expiredDate;
                }
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

    private function normalizeDecimal($value)
    {
        if ($value === null || $value === '') {
            return 0;
        }

        $normalized = str_replace(',', '.', trim((string) $value));
        return is_numeric($normalized) ? $normalized : 0;
    }

    private function normalizeDateValue($value, ?string $default = null)
    {
        if (empty($value)) {
            return $default ?? null;
        }

        $timestamp = strtotime((string) $value);
        return $timestamp !== false ? date('Y-m-d H:i:s', $timestamp) : $default;
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

    protected function normalizeReturnPayload($item)
    {
        if (!is_array($item)) {
            return null;
        }

        $orderNo = $item['order_no'] ?? $item['salesorder_no'] ?? null;
        $returnNo = $item['return_no'] ?? $item['process_number'] ?? null;
        $returnDate = $item['return_date'] ?? $item['shipment_date'] ?? $item['created_date'] ?? $item['transaction_date'] ?? null;

        return [
            'order_no' => $orderNo,
            'return_no' => $returnNo,
            'return_date' => $this->normalizeDateValue($returnDate, date('Y-m-d H:i:s')),
            'payload' => $item,
            'status' => 'pending',
        ];
    }

    private function requirePostRequest(): bool
    {
        return strtolower($this->request->getMethod()) === 'post';
    }

    public function penjualan()
    {
        if (!$this->requirePostRequest()) {
            return $this->response(false, 'Method tidak diizinkan. Gunakan POST.', null, 405);
        }

        $raw = $this->request->getBody();
        $data = json_decode($raw, true);
        $items = $this->normalizeBatchPayload($data);

        if ($items === null) {
            return $this->response(false, 'Format JSON tidak valid', null, 400);
        }

        if (empty($items)) {
            return $this->response(false, 'Payload kosong', null, 400);
        }

        $inserted = 0;
        $errors = [];
        $insertedRows = [];
        $successfulItems = [];
        $insertedRows = [];

        foreach ($items as $index => $item) {
            if (!is_array($item)) {
                $errors[] = 'Item ke-' . ($index + 1) . ': payload tidak valid';
                continue;
            }

            $orderNo = $item['order_no'] ?? $item['salesorder_no'] ?? null;
            if (empty($orderNo)) {
                $errors[] = 'Item ke-' . ($index + 1) . ': order_no atau salesorder_no wajib diisi';
                continue;
            }

            $insertData = [
                'order_no' => $orderNo,
                'customer_code' => $item['customer_code'] ?? (!empty($item['contact_id']) ? (string) $item['contact_id'] : null),
                'total_amount' => $this->normalizeDecimal($item['total_amount'] ?? $item['grand_total'] ?? 0),
                'action' => $item['action'] ?? null,
                'order_status' => $item['status'] ?? null,
                'salesorder_id' => $item['salesorder_id'] ?? null,
                'salesorder_no' => $item['salesorder_no'] ?? null,
                'invoice_id' => $item['invoice_id'] ?? null,
                'invoice_no' => $item['invoice_no'] ?? null,
                'invoice_date' => !empty($item['invoice_date']) ? date('Y-m-d H:i:s', strtotime($item['invoice_date'])) : null,
                'contact_id' => $item['contact_id'] ?? null,
                'customer_name' => $item['customer_name'] ?? null,
                'customer_phone' => $item['customer_phone'] ?? null,
                'customer_email' => $item['customer_email'] ?? null,
                'transaction_date' => !empty($item['transaction_date']) ? date('Y-m-d H:i:s', strtotime($item['transaction_date'])) : null,
                'created_date' => !empty($item['created_date']) ? date('Y-m-d H:i:s', strtotime($item['created_date'])) : null,
                'last_modified' => !empty($item['last_modified']) ? date('Y-m-d H:i:s', strtotime($item['last_modified'])) : null,
                'internal_status' => $item['internal_status'] ?? null,
                'channel_status' => $item['channel_status'] ?? null,
                'source' => $item['source'] ?? null,
                'source_name' => $item['source_name'] ?? null,
                'store' => $item['store'] ?? null,
                'store_name' => $item['store_name'] ?? null,
                'store_id' => $item['store_id'] ?? null,
                'location_id' => $item['location_id'] ?? null,
                'location_name' => $item['location_name'] ?? null,
                'location_code' => $item['location_code'] ?? null,
                'sub_total' => $this->normalizeDecimal($item['sub_total'] ?? null),
                'total_disc' => $this->normalizeDecimal($item['total_disc'] ?? null),
                'total_tax' => $this->normalizeDecimal($item['total_tax'] ?? null),
                'grand_total' => $this->normalizeDecimal($item['grand_total'] ?? null),
                'shipping_cost' => $this->normalizeDecimal($item['shipping_cost'] ?? null),
                'insurance_cost' => $this->normalizeDecimal($item['insurance_cost'] ?? null),
                'shipping_tax' => $this->normalizeDecimal($item['shipping_tax'] ?? null),
                'shipping_cost_discount' => $this->normalizeDecimal($item['shipping_cost_discount'] ?? null),
                'discount_marketplace' => $this->normalizeDecimal($item['discount_marketplace'] ?? null),
                'service_fee' => $this->normalizeDecimal($item['service_fee'] ?? null),
                'order_processing_fee' => $this->normalizeDecimal($item['order_processing_fee'] ?? null),
                'cod_fee' => $this->normalizeDecimal($item['cod_fee'] ?? null),
                'buyer_shipping_cost' => $this->normalizeDecimal($item['buyer_shipping_cost'] ?? null),
                'shipping_full_name' => $item['shipping_full_name'] ?? null,
                'shipping_phone' => $item['shipping_phone'] ?? null,
                'shipping_address' => $item['shipping_address'] ?? null,
                'shipping_area' => $item['shipping_area'] ?? null,
                'shipping_city' => $item['shipping_city'] ?? null,
                'shipping_province' => $item['shipping_province'] ?? null,
                'shipping_post_code' => $item['shipping_post_code'] ?? null,
                'shipping_country' => $item['shipping_country'] ?? null,
                'courier' => $item['courier'] ?? null,
                'shipper' => $item['shipper'] ?? null,
                'tracking_no' => $item['tracking_no'] ?? null,
                'tracking_number' => $item['tracking_number'] ?? null,
                'tracking_url' => $item['tracking_url'] ?? null,
                'payload' => json_encode($item),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->db->table('middleware_penjualan')->insert($insertData)) {
                $newId = $this->db->insertID();
                $inserted++;
                $insertedRows[] = ['id' => $newId, 'salesorder_no' => $insertData['salesorder_no'] ?? $orderNo];
                $detailRows = [];
                $successfulItems[] = ['row' => $insertData, 'detail_rows' => $detailRows];

                if (!empty($item['items']) && is_array($item['items'])) {
                    foreach ($item['items'] as $line) {
                        $detailRows[] = [
                            'salesorder_no' => $insertData['salesorder_no'] ?? $orderNo,
                            'salesorder_detail_id' => $line['salesorder_detail_id'] ?? null,
                            'item_id' => $line['item_id'] ?? null,
                            'item_code' => $line['item_code'] ?? null,
                            'item_name' => $line['item_name'] ?? null,
                            'description' => $line['description'] ?? null,
                            'barcode' => $line['barcode'] ?? null,
                            'qty' => $this->normalizeDecimal($line['qty'] ?? null),
                            'qty_in_base' => $this->normalizeDecimal($line['qty_in_base'] ?? null),
                            'unit' => $line['unit'] ?? null,
                            'uom_id' => $line['uom_id'] ?? null,
                            'price' => $this->normalizeDecimal($line['price'] ?? null),
                            'sell_price' => $this->normalizeDecimal($line['sell_price'] ?? null),
                            'original_price' => $this->normalizeDecimal($line['original_price'] ?? null),
                            'amount' => $this->normalizeDecimal($line['amount'] ?? null),
                            'disc' => $this->normalizeDecimal($line['disc'] ?? null),
                            'disc_amount' => $this->normalizeDecimal($line['disc_amount'] ?? null),
                            'disc_marketplace' => $this->normalizeDecimal($line['disc_marketplace'] ?? null),
                            'tax_id' => $line['tax_id'] ?? null,
                            'tax_name' => $line['tax_name'] ?? null,
                            'tax_amount' => $this->normalizeDecimal($line['tax_amount'] ?? null),
                            'rate' => $this->normalizeDecimal($line['rate'] ?? null),
                            'weight_in_gram' => $this->normalizeDecimal($line['weight_in_gram'] ?? null),
                            'item_group_id' => $line['item_group_id'] ?? null,
                            'loc_id' => $line['loc_id'] ?? null,
                            'loc_name' => $line['loc_name'] ?? null,
                            'thumbnail' => $line['thumbnail'] ?? null,
                            'is_bundle' => !empty($line['is_bundle']) ? 1 : 0,
                            'is_fbm' => !empty($line['is_fbm']) ? 1 : 0,
                            'fbm' => $line['fbm'] ?? null,
                            'serials' => json_encode($line['serials'] ?? []),
                        ];
                    }
                    if (!empty($detailRows)) {
                        $this->db->table('middleware_penjualan_detail')->insertBatch($detailRows);
                        $successfulItems[count($successfulItems) - 1]['detail_rows'] = $this->db->table('middleware_penjualan_detail')
                            ->where('salesorder_no', $insertData['salesorder_no'] ?? $orderNo)
                            ->orderBy('id', 'ASC')
                            ->get()
                            ->getResultArray();
                    }

                    foreach ($item['items'] as $line) {
                        if (!empty($line['serials']) && is_array($line['serials'])) {
                            $detailWhere = ['salesorder_no' => $insertData['salesorder_no'] ?? $orderNo];
                            if (!empty($line['salesorder_detail_id'])) {
                                $detailWhere['salesorder_detail_id'] = $line['salesorder_detail_id'];
                            }
                            $detailRow = $this->db->table('middleware_penjualan_detail')->where($detailWhere)->get()->getRowArray();
                            $detailInternalId = $detailRow['id'] ?? null;
                            $serialRows = [];
                            foreach ($line['serials'] as $s) {
                                $serialRows[] = [
                                    'salesorder_internal_id' => $newId,
                                    'salesorder_id' => $item['salesorder_id'] ?? null,
                                    'salesorder_no' => $item['salesorder_no'] ?? $orderNo,
                                    'salesorder_detail_internal_id' => $detailInternalId,
                                    'salesorder_detail_id' => $line['salesorder_detail_id'] ?? null,
                                    'serial_id' => $s['serial_id'] ?? null,
                                    'serial_number' => $s['serial_number'] ?? ($s['serial_no'] ?? null),
                                    'extra_info' => !empty($s) ? json_encode($s) : null,
                                    'created_at' => date('Y-m-d H:i:s'),
                                ];
                            }
                            if (!empty($serialRows)) {
                                $this->db->table('sales_order_item_serials')->insertBatch($serialRows);
                            }
                        }
                    }
                }

                if (!empty($item['packages']) && is_array($item['packages'])) {
                    $pkgRows = [];
                    foreach ($item['packages'] as $p) {
                        $pkgRows[] = [
                            'salesorder_internal_id' => $newId,
                            'salesorder_id' => $item['salesorder_id'] ?? null,
                            'salesorder_no' => $item['salesorder_no'] ?? $orderNo,
                            'package_id' => $p['package_id'] ?? null,
                            'package_number' => $p['package_number'] ?? null,
                            'weight_kg' => isset($p['weight_kg']) ? $this->normalizeDecimal($p['weight_kg']) : null,
                            'courier_code' => $p['courier_code'] ?? null,
                            'tracking_no' => $p['tracking_no'] ?? null,
                            'meta' => !empty($p) ? json_encode($p) : null,
                            'created_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                    if (!empty($pkgRows)) {
                        $this->db->table('sales_order_packages')->insertBatch($pkgRows);
                    }
                }

                if (!empty($item['wms_statuses']) && is_array($item['wms_statuses'])) {
                    $wmsRows = [];
                    foreach ($item['wms_statuses'] as $w) {
                        $wmsRows[] = [
                            'salesorder_internal_id' => $newId,
                            'salesorder_id' => $item['salesorder_id'] ?? null,
                            'salesorder_no' => $item['salesorder_no'] ?? $orderNo,
                            'status_code' => $w['status_code'] ?? null,
                            'updated_at' => !empty($w['updated_at']) ? date('Y-m-d H:i:s', strtotime($w['updated_at'])) : null,
                            'updated_by' => $w['updated_by'] ?? null,
                            'meta' => !empty($w) ? json_encode($w) : null,
                            'created_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                    if (!empty($wmsRows)) {
                        $this->db->table('sales_order_wms_histories')->insertBatch($wmsRows);
                    }
                }

                if (!empty($item['escrow_list']) && is_array($item['escrow_list'])) {
                    $escRows = [];
                    foreach ($item['escrow_list'] as $e) {
                        $escRows[] = [
                            'salesorder_internal_id' => $newId,
                            'salesorder_id' => $item['salesorder_id'] ?? null,
                            'salesorder_no' => $item['salesorder_no'] ?? $orderNo,
                            'escrow_id' => $e['escrow_id'] ?? null,
                            'amount' => $this->normalizeDecimal($e['amount'] ?? null),
                            'settlement_status' => $e['settlement_status'] ?? null,
                            'released_date' => !empty($e['released_date']) ? date('Y-m-d H:i:s', strtotime($e['released_date'])) : null,
                            'meta' => !empty($e) ? json_encode($e) : null,
                            'created_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                    if (!empty($escRows)) {
                        $this->db->table('sales_order_escrows')->insertBatch($escRows);
                    }
                }
            } else {
                $errors[] = 'Item ke-' . ($index + 1) . ': ' . $this->db->error()['message'];
            }
        }

        $d365Result = null;
        if ($inserted > 0) {
            $d365Payload = $this->buildD365Request($successfulItems, $data);
            try {
                $d365Result = $this->d365Service->send('penjualan', $d365Payload);
            } catch (\Throwable $e) {
                $d365Result = ['success' => false, 'status_code' => 0, 'body' => $e->getMessage()];
            }

            $updateData = [
                'status' => $d365Result['success'] ? 'sent' : 'failed',
                'response' => is_array($d365Result['body']) ? json_encode($d365Result['body']) : $d365Result['body'],
                'sent_at' => date('Y-m-d H:i:s'),
            ];

            foreach ($insertedRows as $row) {
                $this->db->table('middleware_penjualan')->update($updateData, ['id' => $row['id']]);
            }
        }

        if ($inserted > 0) {
            $message = $inserted . ' data berhasil diinsert';
            if ($d365Result && !$d365Result['success']) {
                $message .= '; pengiriman ke D365 gagal';
            }

            return $this->response(true, $message, [
                'inserted' => $inserted,
                'errors' => $errors,
                'd365_result' => $d365Result,
            ], 201);
        }

        return $this->response(false, 'Gagal memasukkan data', ['errors' => $errors], 400);
    }

    public function penjualanCancel()
    {
        if (!$this->requirePostRequest()) {
            return $this->response(false, 'Method tidak diizinkan. Gunakan POST.', null, 405);
        }

        $raw = $this->request->getBody();
        $data = json_decode($raw, true);
        $items = $this->normalizeBatchPayload($data);

        if ($items === null) {
            return $this->response(false, 'Format JSON tidak valid', null, 400);
        }

        if (empty($items)) {
            return $this->response(false, 'Payload kosong', null, 400);
        }

        $inserted = 0;
        $errors = [];
        $d365Results = [];
        $cancelModel = new CancelModel();
        $cancelDetailModel = new CancelDetailModel();
        $cancelSerialTable = $this->db->table('middleware_penjualan_cancel_item_serials');

        foreach ($items as $index => $item) {
            if (!is_array($item)) {
                $errors[] = 'Item ke-' . ($index + 1) . ': payload tidak valid';
                continue;
            }

            $orderNo = $item['order_no'] ?? $item['salesorder_no'] ?? null;
            if (empty($orderNo)) {
                $errors[] = 'Item ke-' . ($index + 1) . ': order_no atau salesorder_no wajib diisi';
                continue;
            }

            $insertData = [
                'order_no' => $orderNo,
                'salesorder_id' => $item['salesorder_id'] ?? null,
                'salesorder_no' => $item['salesorder_no'] ?? null,
                'contact_id' => $item['contact_id'] ?? null,
                'customer_name' => $item['customer_name'] ?? null,
                'customer_phone' => $item['customer_phone'] ?? null,
                'customer_email' => $item['customer_email'] ?? null,
                'transaction_date' => !empty($item['transaction_date']) ? date('Y-m-d H:i:s', strtotime($item['transaction_date'])) : null,
                'created_date' => !empty($item['created_date']) ? date('Y-m-d H:i:s', strtotime($item['created_date'])) : null,
                'last_modified' => !empty($item['last_modified']) ? date('Y-m-d H:i:s', strtotime($item['last_modified'])) : null,
                'is_tax_included' => !empty($item['is_tax_included']) ? 1 : 0,
                'note' => $item['note'] ?? null,
                'sub_total' => $this->normalizeDecimal($item['sub_total'] ?? null),
                'total_disc' => $this->normalizeDecimal($item['total_disc'] ?? null),
                'total_tax' => $this->normalizeDecimal($item['total_tax'] ?? null),
                'grand_total' => $this->normalizeDecimal($item['grand_total'] ?? null),
                'ref_no' => $item['ref_no'] ?? null,
                'payment_method' => $item['payment_method'] ?? null,
                'location_id' => $item['location_id'] ?? null,
                'is_canceled' => !empty($item['is_canceled']) ? 1 : 0,
                'cancel_reason' => $item['cancel_reason'] ?? null,
                'cancel_reason_detail' => $item['cancel_reason_detail'] ?? null,
                'source' => $item['source'] ?? null,
                'is_paid' => !empty($item['is_paid']) ? 1 : 0,
                'channel_status' => $item['channel_status'] ?? null,
                'shipping_cost' => $this->normalizeDecimal($item['shipping_cost'] ?? null),
                'payload' => json_encode($item),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($cancelModel->insert($insertData)) {
                $cancelId = $cancelModel->insertID();
                $detailRowsForPayload = [];
                $serialsByDetail = [];

                if (!empty($item['items']) && is_array($item['items'])) {
                    foreach ($item['items'] as $line) {
                        $detailRow = [
                            'cancel_id' => $cancelId,
                            'salesorder_detail_id' => $line['salesorder_detail_id'] ?? null,
                            'item_id' => $line['item_id'] ?? null,
                            'item_code' => $line['item_code'] ?? null,
                            'item_name' => $line['item_name'] ?? null,
                            'description' => $line['description'] ?? null,
                            'barcode' => $line['barcode'] ?? null,
                            'qty' => $this->normalizeDecimal($line['qty'] ?? null),
                            'qty_in_base' => $this->normalizeDecimal($line['qty_in_base'] ?? null),
                            'unit' => $line['unit'] ?? null,
                            'uom_id' => $line['uom_id'] ?? null,
                            'price' => $this->normalizeDecimal($line['price'] ?? null),
                            'sell_price' => $this->normalizeDecimal($line['sell_price'] ?? null),
                            'original_price' => $this->normalizeDecimal($line['original_price'] ?? null),
                            'amount' => $this->normalizeDecimal($line['amount'] ?? null),
                            'disc' => $this->normalizeDecimal($line['disc'] ?? null),
                            'disc_amount' => $this->normalizeDecimal($line['disc_amount'] ?? null),
                            'disc_marketplace' => $this->normalizeDecimal($line['disc_marketplace'] ?? null),
                            'tax_id' => $line['tax_id'] ?? null,
                            'tax_name' => $line['tax_name'] ?? null,
                            'tax_amount' => $this->normalizeDecimal($line['tax_amount'] ?? null),
                            'rate' => $this->normalizeDecimal($line['rate'] ?? null),
                            'weight_in_gram' => $this->normalizeDecimal($line['weight_in_gram'] ?? null),
                            'item_group_id' => $line['item_group_id'] ?? null,
                            'loc_id' => $line['loc_id'] ?? null,
                            'loc_name' => $line['loc_name'] ?? null,
                            'thumbnail' => $line['thumbnail'] ?? null,
                            'is_bundle' => !empty($line['is_bundle']) ? 1 : 0,
                            'is_fbm' => !empty($line['is_fbm']) ? 1 : 0,
                            'fbm' => $line['fbm'] ?? null,
                            'serials' => json_encode($line['serials'] ?? []),
                            'is_canceled_item' => !empty($line['is_canceled_item']) ? 1 : 0,
                            'status' => $line['status'] ?? null,
                            'pick_scanned_date' => $this->normalizeDateValue($line['pick_scanned_date'] ?? null),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];

                        if ($cancelDetailModel->insert($detailRow)) {
                            $cancelDetailId = $cancelDetailModel->insertID();
                            $detailRow['id'] = $cancelDetailId;
                            $detailRow['serials'] = $line['serials'] ?? [];
                            $detailRowsForPayload[] = $detailRow;

                            if (!empty($line['serials']) && is_array($line['serials'])) {
                                $serialsByDetail[$cancelDetailId] = $line['serials'];
                                $serialRows = [];
                                foreach ($line['serials'] as $serial) {
                                    $serialRows[] = [
                                        'cancel_id' => $cancelId,
                                        'cancel_detail_id' => $cancelDetailId,
                                        'salesorder_detail_id' => $line['salesorder_detail_id'] ?? null,
                                        'picked_serial_number_id' => $serial['picked_serial_number_id'] ?? null,
                                        'picklist_detail_id' => $serial['picklist_detail_id'] ?? null,
                                        'pick_scanned_date' => $this->normalizeDateValue($serial['pick_scanned_date'] ?? null),
                                        'batch_no' => $serial['batch_no'] ?? null,
                                        'serial_no' => $serial['serial_no'] ?? null,
                                        'bin_id' => $serial['bin_id'] ?? null,
                                        'qty' => isset($serial['qty']) ? (int) $serial['qty'] : null,
                                        'expired_date' => $this->normalizeDateValue($serial['expired_date'] ?? null),
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ];
                                }

                                if (!empty($serialRows)) {
                                    $cancelSerialTable->insertBatch($serialRows);
                                }
                            }
                        } else {
                            $errors[] = 'Item ke-' . ($index + 1) . ': detail insert gagal';
                        }
                    }
                }

                $d365Payload = $this->buildD365CancelPayload($insertData, $detailRowsForPayload, $serialsByDetail);
                try {
                    $d365Result = $this->d365Service->send('penjualan_cancel', $d365Payload);
                } catch (\Throwable $e) {
                    $d365Result = ['success' => false, 'status_code' => 0, 'body' => $e->getMessage()];
                }

                $this->db->table('middleware_penjualan_cancel')->update([
                    'status' => $d365Result['success'] ? 'sent' : 'failed',
                    'response' => is_array($d365Result['body']) ? json_encode($d365Result['body']) : $d365Result['body'],
                    'sent_at' => date('Y-m-d H:i:s'),
                ], ['id' => $cancelId]);

                $d365Results[] = [
                    'cancel_id' => $cancelId,
                    'success' => $d365Result['success'],
                    'status_code' => $d365Result['status_code'] ?? 0,
                    'body' => $d365Result['body'],
                ];

                $inserted++;
            } else {
                $errors[] = 'Item ke-' . ($index + 1) . ': insert gagal';
            }
        }

        if ($inserted > 0) {
            return $this->response(true, $inserted . ' cancel berhasil diinsert', ['inserted' => $inserted, 'errors' => $errors, 'd365_results' => $d365Results], 201);
        }

        return $this->response(false, 'Gagal memasukkan data cancel', ['errors' => $errors], 400);
    }

    public function returnFull()
    {
        if (!$this->requirePostRequest()) {
            return $this->response(false, 'Method tidak diizinkan. Gunakan POST.', null, 405);
        }

        $raw = $this->request->getBody();
        $data = json_decode($raw, true);

        $items = $this->normalizeBatchPayload($data);
        if ($items === null) {
            return $this->response(false, 'Format JSON tidak valid', null, 400);
        }

        if (empty($items)) {
            return $this->response(false, 'Payload kosong', null, 400);
        }

        $inserted = 0;
        $errors = [];

        foreach ($items as $index => $item) {
            $normalizedItem = $this->normalizeReturnPayload($item);
            if ($normalizedItem === null || empty($normalizedItem['order_no'])) {
                $errors[] = 'Item ke-' . ($index + 1) . ': order_no atau salesorder_no wajib diisi';
                continue;
            }

            $insertData = [
                'order_no' => $normalizedItem['order_no'],
                'return_no' => $normalizedItem['return_no'],
                'return_date' => $normalizedItem['return_date'],
                'salesorder_id' => $item['salesorder_id'] ?? null,
                'salesorder_no' => $item['salesorder_no'] ?? null,
                'contact_id' => $item['contact_id'] ?? null,
                'customer_name' => $item['customer_name'] ?? null,
                'customer_phone' => $item['customer_phone'] ?? null,
                'customer_email' => $item['customer_email'] ?? null,
                'transaction_date' => $this->normalizeDateValue($item['transaction_date'] ?? null),
                'created_date' => $this->normalizeDateValue($item['created_date'] ?? null),
                'last_modified' => $this->normalizeDateValue($item['last_modified'] ?? null),
                'internal_status' => $item['internal_status'] ?? null,
                'channel_status' => $item['channel_status'] ?? null,
                'source' => $item['source'] ?? null,
                'source_name' => $item['source_name'] ?? null,
                'store' => $item['store'] ?? null,
                'store_name' => $item['store_name'] ?? null,
                'store_id' => $item['store_id'] ?? null,
                'location_id' => $item['location_id'] ?? null,
                'location_name' => $item['location_name'] ?? null,
                'location_code' => $item['location_code'] ?? null,
                'sub_total' => $this->normalizeDecimal($item['sub_total'] ?? null),
                'total_disc' => $this->normalizeDecimal($item['total_disc'] ?? null),
                'total_tax' => $this->normalizeDecimal($item['total_tax'] ?? null),
                'grand_total' => $this->normalizeDecimal($item['grand_total'] ?? null),
                'shipping_cost' => $this->normalizeDecimal($item['shipping_cost'] ?? null),
                'insurance_cost' => $this->normalizeDecimal($item['insurance_cost'] ?? null),
                'shipping_tax' => $this->normalizeDecimal($item['shipping_tax'] ?? null),
                'shipping_full_name' => $item['shipping_full_name'] ?? null,
                'shipping_phone' => $item['shipping_phone'] ?? null,
                'shipping_address' => $item['shipping_address'] ?? null,
                'shipping_area' => $item['shipping_area'] ?? null,
                'shipping_city' => $item['shipping_city'] ?? null,
                'shipping_province' => $item['shipping_province'] ?? null,
                'shipping_post_code' => $item['shipping_post_code'] ?? null,
                'shipping_country' => $item['shipping_country'] ?? null,
                'courier' => $item['courier'] ?? null,
                'shipper' => $item['shipper'] ?? null,
                'tracking_no' => $item['tracking_no'] ?? null,
                'tracking_number' => $item['tracking_number'] ?? null,
                'tracking_url' => $item['tracking_url'] ?? null,
                'payload' => json_encode($normalizedItem['payload']),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->db->table('middleware_return_full')->insert($insertData)) {
                $newId = $this->db->insertID();
                $insertedRows[] = ['id' => $newId, 'row' => $insertData];
                $inserted++;
            } else {
                $errors[] = 'Item ke-' . ($index + 1) . ': ' . $this->db->error()['message'];
            }
        }
        $d365Results = [];
        if ($inserted > 0) {
            // For each inserted row, retrieve stored payload and send to D365
            foreach ($insertedRows as $ins) {
                $id = $ins['id'];
                $stored = $this->db->table('middleware_return_full')->getWhere(['id' => $id])->getRowArray();
                $payloadRaw = $stored['payload'] ?? '[]';
                $storedPayload = json_decode($payloadRaw, true) ?: [];

                // Build D365-compatible payload (dataareaid, numeric strings, objects for extra_info)
                $d365Payload = $this->buildD365ReturnRequestFromPayload($storedPayload);

                try {
                    $d365Result = $this->d365Service->send('return_full', $d365Payload);
                } catch (\Throwable $e) {
                    $d365Result = ['success' => false, 'status_code' => 0, 'body' => $e->getMessage()];
                }

                // update stored row with result
                $this->db->table('middleware_return_full')->update([
                    'status' => $d365Result['success'] ? 'sent' : 'failed',
                    'response' => is_array($d365Result['body']) ? json_encode($d365Result['body']) : $d365Result['body'],
                    'sent_at' => date('Y-m-d H:i:s'),
                ], ['id' => $id]);

                $d365Results[] = [
                    'id' => $id,
                    'success' => $d365Result['success'],
                    'status_code' => $d365Result['status_code'] ?? 0,
                    'body' => $d365Result['body'],
                ];
            }

            $message = $inserted . ' return full berhasil diinsert';
            if (!empty($d365Results)) {
                foreach ($d365Results as $r) {
                    if (empty($r['success'])) {
                        $message .= '; pengiriman ke D365 gagal untuk id ' . ($r['id'] ?? '-');
                        break;
                    }
                }
            }

            return $this->response(true, $message, ['inserted' => $inserted, 'errors' => $errors, 'd365_results' => $d365Results], 201);
        }

        return $this->response(false, 'Gagal memasukkan data return full', ['errors' => $errors], 400);
    }

    public function returnPartial()
    {
        if (!$this->requirePostRequest()) {
            return $this->response(false, 'Method tidak diizinkan. Gunakan POST.', null, 405);
        }

        $raw = $this->request->getBody();
        $data = json_decode($raw, true);

        $items = $this->normalizeBatchPayload($data);
        if ($items === null) {
            return $this->response(false, 'Format JSON tidak valid', null, 400);
        }

        if (empty($items)) {
            return $this->response(false, 'Payload kosong', null, 400);
        }

        $inserted = 0;
        $errors = [];

        foreach ($items as $index => $item) {
            $normalizedItem = $this->normalizeReturnPayload($item);
            if ($normalizedItem === null || empty($normalizedItem['order_no'])) {
                $errors[] = 'Item ke-' . ($index + 1) . ': order_no atau salesorder_no wajib diisi';
                continue;
            }

            $insertData = [
                'order_no' => $normalizedItem['order_no'],
                'return_no' => $normalizedItem['return_no'],
                'return_date' => $normalizedItem['return_date'],
                'salesorder_id' => $item['salesorder_id'] ?? null,
                'salesorder_no' => $item['salesorder_no'] ?? null,
                'contact_id' => $item['contact_id'] ?? null,
                'customer_name' => $item['customer_name'] ?? null,
                'customer_phone' => $item['customer_phone'] ?? null,
                'customer_email' => $item['customer_email'] ?? null,
                'transaction_date' => $this->normalizeDateValue($item['transaction_date'] ?? null),
                'created_date' => $this->normalizeDateValue($item['created_date'] ?? null),
                'last_modified' => $this->normalizeDateValue($item['last_modified'] ?? null),
                'internal_status' => $item['internal_status'] ?? null,
                'channel_status' => $item['channel_status'] ?? null,
                'source' => $item['source'] ?? null,
                'source_name' => $item['source_name'] ?? null,
                'store' => $item['store'] ?? null,
                'store_name' => $item['store_name'] ?? null,
                'store_id' => $item['store_id'] ?? null,
                'location_id' => $item['location_id'] ?? null,
                'location_name' => $item['location_name'] ?? null,
                'location_code' => $item['location_code'] ?? null,
                'sub_total' => $this->normalizeDecimal($item['sub_total'] ?? null),
                'total_disc' => $this->normalizeDecimal($item['total_disc'] ?? null),
                'total_tax' => $this->normalizeDecimal($item['total_tax'] ?? null),
                'grand_total' => $this->normalizeDecimal($item['grand_total'] ?? null),
                'shipping_cost' => $this->normalizeDecimal($item['shipping_cost'] ?? null),
                'insurance_cost' => $this->normalizeDecimal($item['insurance_cost'] ?? null),
                'shipping_tax' => $this->normalizeDecimal($item['shipping_tax'] ?? null),
                'shipping_full_name' => $item['shipping_full_name'] ?? null,
                'shipping_phone' => $item['shipping_phone'] ?? null,
                'shipping_address' => $item['shipping_address'] ?? null,
                'shipping_area' => $item['shipping_area'] ?? null,
                'shipping_city' => $item['shipping_city'] ?? null,
                'shipping_province' => $item['shipping_province'] ?? null,
                'shipping_post_code' => $item['shipping_post_code'] ?? null,
                'shipping_country' => $item['shipping_country'] ?? null,
                'courier' => $item['courier'] ?? null,
                'shipper' => $item['shipper'] ?? null,
                'tracking_no' => $item['tracking_no'] ?? null,
                'tracking_number' => $item['tracking_number'] ?? null,
                'tracking_url' => $item['tracking_url'] ?? null,
                'payload' => json_encode($normalizedItem['payload']),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->db->table('middleware_return_partial')->insert($insertData)) {
                $inserted++;
            } else {
                $errors[] = 'Item ke-' . ($index + 1) . ': ' . $this->db->error()['message'];
            }
        }

        if ($inserted > 0) {
            return $this->response(true, $inserted . ' return partial berhasil diinsert', ['inserted' => $inserted, 'errors' => $errors], 201);
        }

        return $this->response(false, 'Gagal memasukkan data return partial', ['errors' => $errors], 400);
    }

    public function billWithPutawayTrue()
    {
        if (!$this->requirePostRequest()) {
            return $this->response(false, 'Method tidak diizinkan. Gunakan POST.', null, 405);
        }

        $raw = $this->request->getBody();
        $data = json_decode($raw, true);
        $items = $this->normalizeBatchPayload($data);

        if ($items === null) {
            return $this->response(false, 'Format JSON tidak valid', null, 400);
        }

        if (empty($items)) {
            return $this->response(false, 'Payload kosong', null, 400);
        }

        $inserted = 0;
        $errors = [];
        $insertedRows = [];

        foreach ($items as $index => $item) {
            if (!is_array($item)) {
                $errors[] = 'Item ke-' . ($index + 1) . ': payload tidak valid';
                continue;
            }

            $insertData = [
                'bill_id' => $item['bill_id'] ?? null,
                'bill_no' => $item['bill_no'] ?? null,
                'contact_id' => $item['contact_id'] ?? null,
                'supplier_name' => $item['supplier_name'] ?? null,
                'transaction_date' => $this->normalizeDateValue($item['transaction_date'] ?? null),
                'created_date' => $this->normalizeDateValue($item['created_date'] ?? null),
                'due_date' => $this->normalizeDateValue($item['due_date'] ?? null),
                'is_tax_included' => !empty($item['is_tax_included']) ? 1 : 0,
                'note' => $item['note'] ?? null,
                'sub_total' => $this->normalizeDecimal($item['sub_total'] ?? null),
                'total_disc' => $this->normalizeDecimal($item['total_disc'] ?? null),
                'total_tax' => $this->normalizeDecimal($item['total_tax'] ?? null),
                'grand_total' => $this->normalizeDecimal($item['grand_total'] ?? null),
                'ref_no' => $item['ref_no'] ?? null,
                'is_opening_balance' => !empty($item['is_opening_balance']) ? 1 : 0,
                'payment' => $this->normalizeDecimal($item['payment'] ?? null),
                'payment_acct_id' => $item['payment_acct_id'] ?? null,
                'location_id' => $item['location_id'] ?? null,
                'purchaseorder_id' => $item['purchaseorder_id'] ?? null,
                'last_modified' => $this->normalizeDateValue($item['last_modified'] ?? null),
                'is_consignment' => !empty($item['is_consignment']) ? 1 : 0,
                'created_by' => $item['created_by'] ?? null,
                'payment_term' => $item['payment_term'] ?? null,
                'auto_placement' => !empty($item['auto_placement']) ? 1 : 0,
                'attachment' => is_string($item['attachment']) ? $item['attachment'] : json_encode($item['attachment'] ?? []),
                'add_cost' => $this->normalizeDecimal($item['add_cost'] ?? null),
                'updated_by' => $item['updated_by'] ?? null,
                'tag_ids' => is_string($item['tag_ids']) ? $item['tag_ids'] : json_encode($item['tag_ids'] ?? []),
                'header_note' => $item['header_note'] ?? null,
                'is_closed' => !empty($item['is_closed']) ? 1 : 0,
                'purchaseorder_no' => $item['purchaseorder_no'] ?? null,
                'location_name' => $item['location_name'] ?? null,
                'payment_amount' => $this->normalizeDecimal($item['payment_amount'] ?? null),
                'add_cost_detail' => is_string($item['add_cost_detail']) ? $item['add_cost_detail'] : json_encode($item['add_cost_detail'] ?? []),
                'is_putaway' => !empty($item['is_putaway']) ? 1 : 0,
                'items_payload' => json_encode($item['items'] ?? []),
                'payload' => json_encode($item),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->db->table('middleware_bill_with_putaway_true')->insert($insertData)) {
                $newId = $this->db->insertID();
                $insertedRows[] = ['id' => $newId, 'row' => $insertData];
                $inserted++;
            } else {
                $errors[] = 'Item ke-' . ($index + 1) . ': ' . $this->db->error()['message'];
            }
        }

        $d365Results = [];
        if ($inserted > 0) {
            foreach ($insertedRows as $ins) {
                $id = $ins['id'];
                $stored = $this->db->table('middleware_bill_with_putaway_true')->getWhere(['id' => $id])->getRowArray();
                $payloadRaw = $stored['payload'] ?? '[]';
                $storedPayload = json_decode($payloadRaw, true) ?: [];

                $d365Payload = $this->buildD365BillRequestFromPayload($storedPayload);
                try {
                    $d365Result = $this->d365Service->send('bill_with_putaway_true', $d365Payload);
                } catch (\Throwable $e) {
                    $d365Result = ['success' => false, 'status_code' => 0, 'body' => $e->getMessage()];
                }

                $this->db->table('middleware_bill_with_putaway_true')->update([
                    'status' => $d365Result['success'] ? 'sent' : 'failed',
                    'response' => is_array($d365Result['body']) ? json_encode($d365Result['body']) : $d365Result['body'],
                    'sent_at' => date('Y-m-d H:i:s'),
                ], ['id' => $id]);

                $d365Results[] = [
                    'id' => $id,
                    'success' => $d365Result['success'],
                    'status_code' => $d365Result['status_code'] ?? 0,
                    'body' => $d365Result['body'],
                ];
            }

            $message = $inserted . ' bill_with_putaway_true berhasil diinsert';
            if (!empty($d365Results)) {
                foreach ($d365Results as $r) {
                    if (empty($r['success'])) {
                        $message .= '; pengiriman ke D365 gagal untuk id ' . ($r['id'] ?? '-');
                        break;
                    }
                }
            }

            return $this->response(true, $message, ['inserted' => $inserted, 'errors' => $errors, 'd365_results' => $d365Results], 201);
        }

        return $this->response(false, 'Gagal memasukkan data bill_with_putaway_true', ['errors' => $errors], 400);
    }

    public function stockOpname()
    {
        if (!$this->requirePostRequest()) {
            return $this->response(false, 'Method tidak diizinkan. Gunakan POST.', null, 405);
        }

        $raw = $this->request->getBody();
        $data = json_decode($raw, true);

        $items = $this->normalizeBatchPayload($data);
        if ($items === null) {
            return $this->response(false, 'Format JSON tidak valid', null, 400);
        }

        if (empty($items)) {
            return $this->response(false, 'Payload kosong', null, 400);
        }

        $inserted = 0;
        $errors = [];

        foreach ($items as $index => $item) {
            if (!is_array($item) || empty($item['warehouse_code'])) {
                $errors[] = 'Item ke-' . ($index + 1) . ': warehouse_code wajib diisi';
                continue;
            }

            $insertData = [
                'warehouse_code' => $item['warehouse_code'],
                'opname_date' => $item['opname_date'] ?? date('Y-m-d H:i:s'),
                'total_items' => is_numeric($item['total_items'] ?? null) ? (int) $item['total_items'] : 0,
                'payload' => json_encode($item),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->db->table('middleware_stock_opname')->insert($insertData)) {
                $inserted++;
            } else {
                $errors[] = 'Item ke-' . ($index + 1) . ': ' . $this->db->error()['message'];
            }
        }

        if ($inserted > 0) {
            return $this->response(true, $inserted . ' stock opname berhasil diinsert', ['inserted' => $inserted, 'errors' => $errors], 201);
        }

        return $this->response(false, 'Gagal memasukkan data stock opname', ['errors' => $errors], 400);
    }

    public function product()
    {
        if (!$this->requirePostRequest()) {
            return $this->response(false, 'Method tidak diizinkan. Gunakan POST.', null, 405);
        }

        $raw = $this->request->getBody();
        $data = json_decode($raw, true);

        $items = $this->normalizeBatchPayload($data);
        if ($items === null) {
            return $this->response(false, 'Format JSON tidak valid', null, 400);
        }

        if (empty($items)) {
            return $this->response(false, 'Payload kosong', null, 400);
        }

        $inserted = 0;
        $errors = [];

        foreach ($items as $index => $item) {
            if (!is_array($item) || empty($item['idproduct']) || empty($item['namaproduct']) || empty($item['harga'])) {
                $errors[] = 'Item ke-' . ($index + 1) . ': idproduct, namaproduct, dan harga wajib diisi';
                continue;
            }

            $insertData = [
                'idproduct' => $item['idproduct'],
                'namaproduct' => $item['namaproduct'],
                'harga' => is_numeric($item['harga'] ?? null) ? (float) $item['harga'] : 0,
            ];

            if ($this->db->table('product')->insert($insertData)) {
                $inserted++;
            } else {
                $errors[] = 'Item ke-' . ($index + 1) . ': ' . $this->db->error()['message'];
            }
        }

        if ($inserted > 0) {
            return $this->response(true, $inserted . ' product berhasil diinsert', ['inserted' => $inserted, 'errors' => $errors], 201);
        }

        return $this->response(false, 'Gagal memasukkan data product', ['errors' => $errors], 400);
    }

    public function endpoints()
    {
        return $this->response(true, 'Daftar semua API endpoints yang tersedia', [
            'base_url' => base_url(),
            'endpoints' => [
                [
                    'method' => 'POST',
                    'endpoint' => '/api/penjualan',
                    'table' => 'middleware_penjualan',
                    'description' => 'Insert transaksi penjualan',
                ],
                [
                    'method' => 'POST',
                    'endpoint' => '/api/penjualan-cancel',
                    'table' => 'middleware_penjualan_cancel',
                    'description' => 'Insert penjualan cancel',
                ],
                [
                    'method' => 'POST',
                    'endpoint' => '/api/return-full',
                    'table' => 'middleware_return_full',
                    'description' => 'Insert return full',
                ],
                [
                    'method' => 'POST',
                    'endpoint' => '/api/return-partial',
                    'table' => 'middleware_return_partial',
                    'description' => 'Insert return partial',
                ],
                [
                    'method' => 'POST',
                    'endpoint' => '/api/stock-opname',
                    'table' => 'middleware_stock_opname',
                    'description' => 'Insert stock opname',
                ],
                [
                    'method' => 'POST',
                    'endpoint' => '/api/product',
                    'table' => 'product',
                    'description' => 'Insert product',
                ],
            ],
        ], 200);
    }
}
