<?php namespace App\Models;

use CodeIgniter\Model;

class Usermodel extends Model{

    protected $table      = 'users';
    protected $primaryKey = 'user_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['user', 'password', 'credential_id', 'profile_picture', 'profile_video', 'recover', 'language', 'login', 'created_by', 'modified_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
