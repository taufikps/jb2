<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    private $tables = [
        'penjualan' => 'log_penjualan',
        'penjualan_cancel' => 'log_penjualan_cancel',
        'return_full' => 'log_return_full',
        'return_partial' => 'log_return_partial',
        'stock_opname' => 'log_stock_opname',
        'bill_with_putaway_true' => 'log_bill_with_putaway_true',
    ];

    public function countLogs($type, $search = null, $action = null)
    {
        $table = $this->tableFor($type);
        if (!$table) return 0;

        $builder = $this->db->table($table);
        if ($action) $builder->where('action', $action);
        if ($search) {
            $builder->groupStart();
            $builder->like('message', $search);
            $builder->orLike('meta', $search);
            $builder->groupEnd();
        }

        return (int) $builder->countAllResults();
    }

    public function getLogs($type, $limit = 50, $offset = 0, $search = null, $action = null)
    {
        $table = $this->tableFor($type);
        if (!$table) return [];

        $builder = $this->db->table($table);
        if ($action) $builder->where('action', $action);
        if ($search) {
            $builder->groupStart();
            $builder->like('message', $search);
            $builder->orLike('meta', $search);
            $builder->groupEnd();
        }
        $builder->orderBy('created_at', 'DESC')->limit((int)$limit, (int)$offset);
        return $builder->get()->getResultArray();
    }

    private function tableFor($type)
    {
        return isset($this->tables[$type]) ? $this->tables[$type] : null;
    }

    public function insertFor($type, $source_id = null, $action = 'info', $message = '', $meta = [])
    {
        $table = $this->tableFor($type);
        if (!$table) return 0;

        $data = [
            'source_id' => $source_id ?: null,
            'action' => $action,
            'message' => $message,
            'meta' => $meta ? json_encode($meta, JSON_UNESCAPED_UNICODE) : null,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        try {
            $this->db->table($table)->insert($data);
            return (int) $this->db->insertID();
        } catch (\Exception $e) {
            $fallbackPath = WRITEPATH . 'logs/log_fallback.txt';
            $entry = [
                'failed_insert_table' => $table,
                'data' => $data,
                'error' => $e->getMessage(),
                'time' => date('c'),
            ];
            @file_put_contents($fallbackPath, json_encode($entry, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND | LOCK_EX);
            return 0;
        }
    }
}
