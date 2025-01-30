<?php namespace App\Models;

use CodeIgniter\Model;

class InnovationModel extends Model{
    protected $table      = 'innovations';
    protected $primaryKey = 'innovation_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'innovation', 'annual_value', 'description', 'imagen_innovacion', 'created_by', 'created_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
