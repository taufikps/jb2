<?php

namespace App\Models;

use CodeIgniter\Model;

class CancelModel extends Model
{
    protected $table = 'middleware_penjualan_cancel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'order_no', 'salesorder_id', 'salesorder_no', 'contact_id', 'customer_name', 'customer_phone', 'customer_email',
        'transaction_date', 'created_date', 'last_modified', 'is_tax_included', 'note', 'sub_total', 'total_disc',
        'total_tax', 'grand_total', 'ref_no', 'payment_method', 'location_id', 'is_canceled', 'cancel_reason',
        'cancel_reason_detail', 'source', 'is_paid', 'channel_status', 'shipping_cost', 'payload', 'status', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = false;

    public function getAll($limit = 20, $offset = 0)
    {
        return $this->orderBy('id', 'DESC')->limit($limit, $offset)->findAll();
    }

    public function countAllRows()
    {
        return $this->countAll();
    }

    public function findById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function insertRow($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }

    public function updateRow($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->update($id, $data);
    }

    public function deleteRow($id)
    {
        return $this->delete($id);
    }
}
