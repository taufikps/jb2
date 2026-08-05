<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesOrderEscrowModel extends Model
{
    protected $table = 'sales_order_escrows';
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
