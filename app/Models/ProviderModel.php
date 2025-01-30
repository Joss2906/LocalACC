<?php namespace App\Models;

use CodeIgniter\Model;

class Providermodel extends Model{

    protected $table      = 'providers';
    protected $primaryKey = 'provider_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['service_provider_id', 'supply_id', 'user_id', 'position_id', 'productivity', 'quality', 'innovation', 'service', 'created_by', 'created_at', 'created_by', 'modified_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
