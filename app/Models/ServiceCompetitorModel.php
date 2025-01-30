<?php namespace App\Models;

use CodeIgniter\Model;

class ServiceCompetitorModel extends Model{
    protected $table      = 'services_competitors';
    protected $primaryKey = 'service_competitor_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['service_id', 'company', 'guarantee', 'offered_price', 'created_by', 'created_at', 'created_by', 'modified_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
