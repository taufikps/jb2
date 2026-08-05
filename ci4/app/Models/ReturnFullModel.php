<?php

namespace App\Models;

use CodeIgniter\Model;

class ReturnFullModel extends Model
{
    protected $table = 'middleware_return_full';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'order_no', 'return_no', 'return_date', 'salesorder_id', 'salesorder_no', 'contact_id', 'customer_name', 'customer_phone', 'customer_email',
        'transaction_date', 'created_date', 'last_modified', 'internal_status', 'channel_status', 'source', 'source_name', 'store', 'store_name', 'store_id',
        'location_id', 'location_name', 'location_code', 'sub_total', 'total_disc', 'total_tax', 'grand_total', 'shipping_cost', 'insurance_cost', 'shipping_tax',
        'shipping_full_name', 'shipping_phone', 'shipping_address', 'shipping_area', 'shipping_city', 'shipping_province', 'shipping_post_code', 'shipping_country',
        'courier', 'shipper', 'tracking_no', 'tracking_number', 'tracking_url', 'payload', 'status', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = false;

    public function getAll($limit = 20, $offset = 0)
    {
        return $this->orderBy('id', 'DESC')->limit($limit, $offset)->findAll();
    }

    public function insertRow($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }
}
