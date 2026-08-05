<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesOrderItemSerialModel extends Model
{
    protected $table = 'sales_order_item_serials';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    public function getBySalesorderInternalId($salesorderInternalId)
    {
        return $this->where('salesorder_internal_id', $salesorderInternalId)
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
