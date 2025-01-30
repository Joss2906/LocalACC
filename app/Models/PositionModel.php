<?php namespace App\Models;

use CodeIgniter\Model;

class PositionModel extends Model{

    protected $table      = 'positions';
    protected $primaryKey = 'position_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['position', 'organization_id', 'created_by', 'modified_by', 'deleted_by'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
