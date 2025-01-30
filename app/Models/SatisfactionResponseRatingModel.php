<?php namespace App\Models;

use CodeIgniter\Model;

class SatisfactionResponseRatingModel extends Model{
    protected $table      = 'satisfaction_response_ratings';
    protected $primaryKey = 'satisfaction_response_rating_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['satisfaction_response_id', 'satisfaction_id', 'user_id', 'rating', 'description', 'created_by', 'created_at', 'modified_by', 'updated_at', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
