<?php namespace App\Models;

use CodeIgniter\Model;

class Complaintmodel extends Model{

    protected $table      = 'complaints';
    protected $primaryKey = 'complaint_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id', 'category_id', 'complaint_type_id', 'complaint', 'complaint_status_id', 'created_by', 'created_at', 'modified_by', 'updated_at', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
