<?php

function reorderD365OrderFields(array $order): array
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

function normalizeD365PayloadNumbers(array $payload): array
{
    $numericKeys = [
        'weight_kg', 'weight_in_gram', 'price', 'amount', 'tax_amount',
        'sell_price', 'original_price', 'sub_total', 'total_tax', 'grand_total',
        'shipping_cost', 'insurance_cost', 'total_disc', 'disc_amount', 'disc_marketplace',
        'service_fee', 'order_processing_fee', 'cod_fee', 'buyer_shipping_cost'
    ];

    foreach ($payload as $key => $value) {
        if (is_array($value)) {
            $payload[$key] = array_map(function ($v) {
                return is_array($v) ? normalizeD365PayloadNumbers($v) : $v;
            }, $value);
            continue;
        }

        if (in_array($key, $numericKeys, true)) {
            $formatted = number_format((float) $value, 2, '.', '');
            $payload[$key] = (float) $formatted;
        }
    }

    return $payload;
}

function normalizeD365Payload($payload)
{
    if (!is_array($payload)) {
        return ['_request' => ['orders' => []]];
    }

    if (isset($payload['_request']) && isset($payload['_request']['orders']) && is_array($payload['_request']['orders'])) {
        $orders = array_values($payload['_request']['orders']);
        $orders = array_map(function ($order) {
            if (!is_array($order)) return $order;
            $order = reorderD365OrderFields($order);
            return normalizeD365PayloadNumbers($order);
        }, $orders);
        return ['_request' => ['orders' => $orders]];
    }

    $orders = array_values($payload) !== $payload ? [$payload] : array_values($payload);
    $orders = array_map(function ($order) {
        if (!is_array($order)) return $order;
        $order = reorderD365OrderFields($order);
        return normalizeD365PayloadNumbers($order);
    }, $orders);

    return ['_request' => ['orders' => $orders]];
}

$sample = <<<'JSON'
{"_request":{"orders":[{"action":"update-salesorder","items":[{"salesorder_detail_id":62507,"item_id":18885,"description":"POHON racul kiyowo","tax_id":1,"disc_marketplace":"0.0000","price":"11000.0000","qty":"0.0000","unit":"Buah","qty_in_base":"1.0000","disc":"0.00","disc_amount":"0.0000","tax_amount":"0.0000","amount":"11000.0000","item_code":"!POHON2","item_name":"POHON racul kiyowo","sell_price":"11000.0000","original_price":"11000.0000","barcode":"4905083062197","rate":"0.00","tax_name":"No Tax","is_bundle":false,"item_group_id":10267,"loc_id":-1,"weight_in_gram":"450.0000","loc_name":"Pusat","fbm":"","is_fbm":false,"thumbnail":"https://file-service.3smqg.upcloudobjects.com/images/ndnmuriwr1sspttrd3ddig/ec625bef-afeb-473c-a00a-66093ee4280a_thumb.jpeg","serials":[]}],"salesorder_id":501038,"salesorder_no":"SO-000501038","contact_id":39784,"customer_name":"punyarahel","transaction_date":"2026-07-14T09:06:10.531Z","created_date":"2026-07-14T09:06:11.073Z","is_tax_included":false,"note":"","sub_total":"11000.0000","total_disc":"0.0000","total_tax":"0.0000","grand_total":"11000.0000","ref_no":"","payment_method":"","location_id":-1,"is_canceled":false,"source":"INTERNAL","is_paid":true,"channel_status":"Processing","shipping_cost":"0.0000","insurance_cost":"0.0000","shipping_full_name":"Oumps","shipping_address":"Jalan MCC","shipping_area":"","shipping_city":"","shipping_province":"","shipping_post_code":"","shipping_country":"","last_modified":"2026-07-15T08:04:04.105Z","store_id":-100,"is_deleted_from_picklist":false,"shipping_phone":"099xxx88","is_acknowledge":true,"add_disc":"0.0000","add_fee":"0.0000","is_label_printed":true,"courier":"Teman Express","picked_in":11225,"service_fee":"0.0000","is_cod":false,"buyer_shipping_cost":"0.0000","label_printed_count":1,"package_count":1,"is_instant_courier":false,"pos_is_shipping":false,"awb_printed_count":0,"wms_status":"FINISH_PACK","use_shipping_insurance":false,"shipping_cost_discount":"0.0000","discount_marketplace":"0.0000","is_edit_value":false,"is_sameday":false,"shipping_fee_discount_platform":"0.0000","shipping_fee_discount_seller":"0.0000","cod_fee":"0.0000","is_jubelio_shipment":false,"shipping_tax":"0.0000","order_processing_fee":"0.0000","cod_fee_discount":"0.0000","total_weight_in_kg":"0.450","internal_status":"PROCESSING","invoice_id":58851,"invoice_no":"INV-000058851","invoice_date":"2026-07-14T09:06:10.531Z","customer_phone":"099xxx88","customer_email":"raheljube@jubelio.com","tracking_no":"","source_name":"INTERNAL","store_name":"Toko Default","location_name":"Pusat","location_code":"123","shipper":"Teman Express","picklist_no":"PICK-000011225","channel_id":1,"store":"Toko Default","status":"INVOICED"}]}}
JSON;

$payload = json_decode($sample, true);
$out = normalizeD365Payload($payload);
echo json_encode($out, JSON_PRETTY_PRINT) . PHP_EOL;
