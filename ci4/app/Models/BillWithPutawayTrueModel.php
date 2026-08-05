<?php

namespace App\Models;

use CodeIgniter\Model;

class BillWithPutawayTrueModel extends Model
{
    protected $table = 'middleware_bill_with_putaway_true';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'bill_id', 'bill_no', 'contact_id', 'supplier_name', 'transaction_date', 'created_date', 'due_date',
        'is_tax_included', 'note', 'sub_total', 'total_disc', 'total_tax', 'grand_total', 'ref_no',
        'is_opening_balance', 'payment', 'payment_acct_id', 'location_id', 'purchaseorder_id', 'last_modified',
        'is_consignment', 'created_by', 'payment_term', 'auto_placement', 'attachment', 'add_cost', 'updated_by',
        'tag_ids', 'header_note', 'is_closed', 'purchaseorder_no', 'location_name', 'payment_amount',
        'add_cost_detail', 'is_putaway', 'items_payload', 'payload', 'status', 'response', 'sent_at',
        'created_at', 'updated_at',
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
