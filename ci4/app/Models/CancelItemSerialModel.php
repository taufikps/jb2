<?php

namespace App\Models;

use CodeIgniter\Model;

class CancelItemSerialModel extends Model
{
    protected $table = 'middleware_penjualan_cancel_item_serials';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    public function getByCancelId($cancelId)
    {
        return $this->where('cancel_id', $cancelId)
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    public function getByCancelDetailId($cancelDetailId)
    {
        return $this->where('cancel_detail_id', $cancelDetailId)
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
