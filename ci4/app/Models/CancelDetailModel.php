<?php

namespace App\Models;

use CodeIgniter\Model;

class CancelDetailModel extends Model
{
    protected $table = 'middleware_penjualan_cancel_detail';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'cancel_id', 'salesorder_detail_id', 'item_id', 'item_code', 'item_name', 'description', 'barcode', 'qty', 'qty_in_base', 'unit', 'uom_id', 'price', 'sell_price', 'original_price', 'amount', 'disc', 'disc_amount', 'disc_marketplace', 'tax_id', 'tax_name', 'tax_amount', 'rate', 'weight_in_gram', 'item_group_id', 'loc_id', 'loc_name', 'thumbnail', 'serials', 'is_bundle', 'is_fbm', 'fbm', 'is_canceled_item', 'status', 'pick_scanned_date', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = false;

    public function insertRows(array $rows)
    {
        if (empty($rows)) {
            return 0;
        }

        return $this->insertBatch($rows);
    }

    public function getByCancelId($cancelId)
    {
        return $this->where('cancel_id', $cancelId)->orderBy('id', 'ASC')->findAll();
    }
}
