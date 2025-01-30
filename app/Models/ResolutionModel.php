<?php namespace App\Models;

use CodeIgniter\Model;

class ResolutionModel extends Model{
    protected $table      = 'resolutions';
    protected $primaryKey = 'resolution_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'resolution', 'description', 'imagen_resolucion', 'created_by', 'created_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
