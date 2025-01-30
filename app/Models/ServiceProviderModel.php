<?php namespace App\Models;

use CodeIgniter\Model;

class ServiceProviderModel extends Model{
    protected $table      = 'service_providers';
    protected $primaryKey = 'service_provider_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['organization_id', 'user_id', 'service_id', 'description', 'date_service', 'created_by', 'created_at', 'created_by', 'modified_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
