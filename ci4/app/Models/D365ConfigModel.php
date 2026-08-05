<?php

namespace App\Models;

use CodeIgniter\Model;

class D365ConfigModel extends Model
{
    protected $table = 'middleware_d365_config';
    protected $endpointTable = 'middleware_d365_endpoint';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'tenant_id',
        'client_id',
        'client_secret',
        'grant_type',
        'resource',
        'login_url',
        'base_url',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;

    public function getConfig()
    {
        return $this->orderBy('id', 'ASC')->limit(1)->first();
    }

    public function saveConfig(array $data)
    {
        $existing = $this->getConfig();
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($existing) {
            return $this->update($existing['id'], $data);
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }

    public function getAllEndpoints()
    {
        return $this->db->table($this->endpointTable)->get()->getResultArray();
    }

    public function getEndpointByType($type)
    {
        return $this->db->table($this->endpointTable)->getWhere(['transaction_type' => $type])->getRowArray();
    }

    public function saveEndpoint($type, array $data)
    {
        $existing = $this->getEndpointByType($type);
        $data['transaction_type'] = $type;
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($existing) {
            return $this->db->table($this->endpointTable)->update($data, ['id' => $existing['id']]);
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->table($this->endpointTable)->insert($data);
    }
}
