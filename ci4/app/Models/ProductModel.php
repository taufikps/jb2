<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'idproduct';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['idproduct', 'namaproduct', 'harga'];
    protected $useTimestamps = false;

    public function insertRow($data)
    {
        return $this->insert($data);
    }
}
