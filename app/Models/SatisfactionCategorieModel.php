<?php namespace App\Models;

use CodeIgniter\Model;

class SatisfactionCategorieModel extends Model{

    protected $table      = 'satisfaction_categories';
    protected $primaryKey = 'satisfaction_category_id ';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['satisfaction_category_id ', 'image'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
