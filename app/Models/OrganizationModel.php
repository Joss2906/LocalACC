<?php namespace App\Models;

use CodeIgniter\Model;

class Organizationmodel extends Model{

    protected $table      = 'organizations';
    protected $primaryKey = 'organization_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['organization', 'maturity_id', 'quiz', 'created_by', 'created_at', 'deleted', 'created_by', 'modified_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
