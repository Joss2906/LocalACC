<?php namespace App\Models;

use CodeIgniter\Model;

class ServiceCustomerModel extends Model{
    protected $table      = 'services_customers';
    protected $primaryKey = 'service_customer_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['service_id', 'customer_id', 'position_customer_id', 'created_by', 'created_at', 'modified_by', 'updated_at', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
