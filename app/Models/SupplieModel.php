<?php namespace App\Models;

use CodeIgniter\Model;

class SupplieModel extends Model{
    protected $table      = 'supplies';
    protected $primaryKey = 'supply_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['service_provider_id', 'type_supply_id', 'supply', 'created_by', 'created_at', 'created_by', 'modified_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
