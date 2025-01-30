<?php namespace App\Models;

use CodeIgniter\Model;

class Chiefmodel extends Model{

    protected $table      = 'chiefs';
    protected $primaryKey = 'chief_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['chief_id', 'organization_id', 'chief_user_id', 'employee_user_id', 'created_by', 'modified_by', 'deleted_by'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
