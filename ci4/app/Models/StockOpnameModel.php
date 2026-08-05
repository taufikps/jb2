<?php

namespace App\Models;

use CodeIgniter\Model;

class StockOpnameModel extends Model
{
    protected $table = 'middleware_stock_opname';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['warehouse_code', 'opname_date', 'total_items', 'payload', 'status', 'created_at', 'updated_at'];
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
