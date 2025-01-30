<?php namespace App\Models;

use CodeIgniter\Model;

class Taskmodel extends Model{

    protected $table      = 'tasks';
    protected $primaryKey = 'task_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['service_id', 'user_id', 'delivery_date', 'start_date', 'finish_date', 'productivity', 'quality', 'innovation', 'service', 'commentary', 'document', 'average_productivity', 'average_quality', 'average_innovation', 'average_service', 'commentary_productivity', 'commentary_quality', 'commentary_innovation', 'commentary_service', 'status_id', 'my_productivity', 'amount', 'created_by', 'created_at', 'modified_by', 'updated_at', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
