<?php namespace App\Models;

use CodeIgniter\Model;

class Servicemodel extends Model{

    protected $table      = 'services';
    protected $primaryKey = 'service_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['description', 'frequency', 'employee_id', 'position_id', 'created_admin', 'monthly_amount', 'productivity', 'quality', 'innovation', 'service', 'weighing', 'employee_cost', 'status', 'status_validated', 'classification', 'file_pdf', 'profile_picture', 'created_by', 'modified_by', 'updated_at', 'deleted_by'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
