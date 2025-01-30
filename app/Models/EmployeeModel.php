<?php namespace App\Models;

use CodeIgniter\Model;

class Employeemodel extends Model{

    protected $table      = 'employees';
    protected $primaryKey = 'employee_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['first_name', 'second_name', 'last_name', 'second_last_name', 'business_name', 'gender_id', 'birthday', 'email', 'phone', 'mobile', 'civil_status_id', 'economic_dependents', 'street', 'number', 'suburb', 'postal_code', 'estate', 'delegation', 'country_id', 'nationality_id', 'type_user_id', 'salary_amount', 'social_security', 'benefit_1', 'benefit_amount_1', 'benefit_2', 'benefit_amount_2', 'benefit_3', 'benefit_amount_3', 'benefit_4', 'benefit_amount_4', 'total', 'disc', 'date_admission' , 'schooling_id', 'organization_id' , 'department_id' , 'position_id', 'mission', 'vision', 'competitive_advantages', 'comparative_advantages', 'average', 'roi', 'created_by', 'created_at', 'deleted', 'created_by', 'modified_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
