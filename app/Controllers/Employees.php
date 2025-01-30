<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EmployeeModel;
use App\Models\UserModel;
use App\Models\EmployeesCompetenciesModel;
use App\Models\ResolutionModel;
use App\Models\InnovationModel;
use App\Models\ServiceModel;
use App\Models\SatisfactionResponseModel;
use App\Models\SatisfactionResponseRatingModel;

use CodeIgniter\Files\File;

// use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Employees extends BaseController {
     protected $helpers = ['form'];


    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

 

    //FUNCION QUE SOLO TE DEJA VER LOS MIEMBROS DE TU ORGANIZACION
    public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $employeemodel = new Employeemodel($db);

        $query = $db->table('employees e');
        $query->select('e.*, u.user, u.credential_id, cr.credential, ci.civil_status, co.country, n.nationality, t.type_user, s.schooling, o.organization, d.department, p.position');
        $query->join('users u', 'u.user_id = e.user_id ', "left");
        $query->join('credentials cr', 'cr.credential_id = u.credential_id ', "left");
        $query->join('genders g', 'g.gender_id = e.gender_id ', "left");
        $query->join('civil_status ci', 'ci.civil_status_id = e.civil_status_id ', "left");
        $query->join('countries co', 'co.country_id = e.country_id ', "left");
        $query->join('nationalities n', 'n.nationality_id = e.nationality_id ', "left");
        $query->join('type_users t', 't.type_user_id = e.type_user_id ', "left");
        $query->join('schooling s', 's.schooling_id = e.schooling_id ', "left");
        $query->join('organizations o', 'o.organization_id = e.organization_id ', "left");
        $query->join('departments d', 'd.department_id = e.department_id ', "left");
        $query->join('positions p', 'p.position_id = e.position_id ', "left");
        // $query->where('e.deleted_at', NULL);
        // if($this->session->get('user_id') != 1){
            $query->where('o.organization_id', $this->session->get('organization_id'));
        // }
        $data['employees'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Socios');
        $data['sub_title'] = 'Socios';
        $data['custom'] = 'employees';
        $data['content'] = 'employees/employees_view';

        return view('templates/common/Layout_view',$data);

    }

    public function form_view($user_id){
        $db = \Config\Database::connect();
        
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }
    
        // Obtiene datos necesarios para el formulario
        $data['credentials'] = $db->table('credentials')->select('*')->get()->getResultArray();
        $data['civil_status'] = $db->table('civil_status')->select('*')->get()->getResultArray();
        $data['genders'] = $db->table('genders')->select('*')->get()->getResultArray();
        $data['countries'] = $db->table('countries')->select('*')->orderBy('country', 'ASC')->get()->getResultArray();
        $data['nationalities'] = $db->table('nationalities')->select('*')->get()->getResultArray();
        $data['type_users'] = $db->table('type_users')->select('*')->get()->getResultArray();
        $data['schooling'] = $db->table('schooling')->select('*')->get()->getResultArray();
    
        // Obtiene todas las organizaciones
        $orgQuery = $db->table('organizations')->select('*')->where('deleted_at', NULL)->orderBy('organization', 'ASC');
        $data['organizations'] = $orgQuery->get()->getResultArray();
    
        // Obtiene departamentos y posiciones con posibles filtros
        $data['departments'] = $db->table('departments')
            ->select('*')
            ->where('deleted_at', NULL)
            ->where('organization_id', $this->session->get('organization_id'))
            ->orderBy('department', 'ASC')
            ->get()
            ->getResultArray();
    
        $data['positions'] = $db->table('positions')
            ->select('*')
            ->where('deleted_at', NULL)
            ->where('organization_id', $this->session->get('organization_id'))
            ->orderBy('position', 'ASC')
            ->get()
            ->getResultArray();
    
        // Obtiene la información del empleado
        $query = $db->table('employees e')
            ->select('e.*, u.*')
            ->join('users u', 'u.user_id = e.user_id', "left")
            ->join('credentials cr', 'cr.credential_id = u.credential_id', "left")
            ->join('genders g', 'g.gender_id = e.gender_id', "left")
            ->join('civil_status ci', 'ci.civil_status_id = e.civil_status_id', "left")
            ->join('countries co', 'co.country_id = e.country_id', "left")
            ->join('nationalities n', 'n.nationality_id = e.nationality_id', "left")
            ->join('type_users t', 't.type_user_id = e.type_user_id', "left")
            ->join('schooling s', 's.schooling_id = e.schooling_id', "left")
            ->join('organizations o', 'o.organization_id = e.organization_id', "left")
            ->join('departments d', 'd.department_id = e.department_id', "left")
            ->join('positions p', 'p.position_id = e.position_id', "left")
            ->where('e.user_id', $user_id);
        
        $data['employee'] = $query->get()->getRowArray();
    
        if (empty($data['employee'])) {
            $data['employee'] = array_fill_keys([
                'user_id', 'user', 'password', 'credential_id', 'employee_id', 'first_name', 'second_name',
                'last_name', 'second_last_name', 'business_name', 'gender_id', 'birthday', 'email',
                'phone', 'mobile', 'civil_status_id', 'economic_dependents', 'street', 'number', 'suburb',
                'postal_code', 'estate', 'delegation', 'country_id', 'nationality_id', 'type_user_id',
                'salary_amount', 'social_security', 'benefit_1', 'benefit_amount_1', 'benefit_2', 
                'benefit_amount_2', 'benefit_3', 'benefit_amount_3', 'benefit_4', 'benefit_amount_4',
                'total', 'disc', 'date_admission', 'schooling_id', 'organization_id', 'department_id', 
                'position_id'
            ], '');
        } else {
            $data['employee']['email'] = $data['employee']['email'] ?? '';
        }
    
        $data['title'] = 'Empleados';
        $data['sub_title'] = 'Agregar empleados';
        $data['custom'] = 'employees';
        $data['content'] = 'employees/form_view';
    
        return view('templates/common/Layout_view', $data);
    }
    
    

    public function validar_form(){
        $validation =  \Config\Services::validation();

        if($this->request->getPost('form') == 1){
            $required = '';
            $errors = '';
            if($this->request->getPost('user_id') == 0){                
                $required = 'required';
                $errors = lang('Home.El campo Contraseña no puede estar vacio.');
            }

            $rules = [
                'user' => [
                    'label'  => lang('Home.Usuario'),
                    'rules'  => 'trim|required|is_unique[users.user, user_id, {user_id}]',
                    'errors' => [
                        'required' => lang('Home.El campo Usuario no puede estar vacio.'),
                        'is_unique' => lang('Home.El campo Usuario ya se encuentra registrado en el sistema, favor de intentar con un usuario diferente.'),
                    ],
                ],
                'password' => [
                    'label'  => lang('Home.Contraseña'),
                    'rules'  => 'trim|'.$required.'',
                    'errors' => [
                        'required' => ''.$errors.'',
                    ],
                ],
                'credential_id' => [
                    'label'  => lang('Home.Credencial'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Credencial no puede estar vacio.'),
                    ],
                ]
            ];
        }

        if($this->request->getPost('form') == 2){
            $required = '';
            $errors = '';
            if($this->request->getPost('credential_id') == 5){                
                $required = 'required';
                $errors = lang('Home.El campo Razón social no puede estar vacio.');
            }

            $rules = [
                'first_name' => [
                    'label'  => lang('Home.Usuario'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Usuario no puede estar vacio.'),
                    ],
                ],
                'last_name' => [
                    'label'  => lang('Home.Apellido paterno'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Apellido paterno no puede estar vacio.'),
                    ],
                ],
                'business_name' => [
                    'label'  => lang('Home.Razón social'),
                    'rules'  => 'trim|'.$required.'',
                    'errors' => [
                        'required' => ''.$errors.'',
                    ],
                ],
                'gender_id' => [
                    'label'  => lang('Home.Género'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Género no puede estar vacio.'),
                    ],
                ],
                'birthday' => [
                    'label'  => lang('Home.Fecha de nacimiento'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Fecha de nacimiento no puede estar vacio.'),
                    ],
                ],
                'email' => [
                    'label'  => lang('Home.Correo electronico'),
                    'rules'  => 'trim|required|valid_email|is_unique[employees.email, user_id, {user_id}]',
                    'errors' => [
                        'required' => lang('Home.El campo Correo electronico no puede estar vacio.'),
                        'is_unique' => lang('Home.El campo Correo electronico ya se encuentra registrado en el sistema.'),
                        'valid_email' => lang('Home.El campo Correo electronico no cuenta con la estructura correcta.'),
                    ],
                ],
                'phone' => [
                    'label'  => lang('Home.Teléfono'),
                    'rules'  => 'trim|required|numeric|is_natural',
                    'errors' => [
                        'required' => lang('Home.El campo Teléfono no puede estar vacio.'),
                        'numeric' => lang('Home.El campo Teléfono solo debe ser numeros.'),
                        'is_natural' => lang('Home.El campo Teléfono solo debe ser numeros.'),
                    ],
                ],
                'mobile' => [
                    'label'  => lang('Home.Celular'),
                    'rules'  => 'trim|required|numeric|is_natural',
                    'errors' => [
                        'required' => lang('Home.El campo Celular no puede estar vacio.'),
                        'numeric' => lang('Home.El campo Celular solo debe ser numeros.'),
                        'is_natural' => lang('Home.El campo Celular solo debe ser numeros.'),
                    ],
                ],
                'civil_status_id' => [
                    'label'  => lang('Home.Estado civil'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Estado civil no puede estar vacio.'),
                    ],
                ],
                'economic_dependents' => [
                    'label'  => lang('Home.Dependientes económicos'),
                    'rules'  => 'trim|required|numeric',
                    'errors' => [
                        'required' => lang('Home.El campo Dependientes económicos no puede estar vacio.'),
                        'numeric' => lang('Home.El campo Dependientes económicos solo debe ser números.'),
                    ],
                ],
                'street' => [
                    'label'  => lang('Home.Calle'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Calle no puede estar vacio.'),
                    ],
                ],
                'number' => [
                    'label'  => lang('Home.Numero'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Numero no puede estar vacio.'),
                    ],
                ],
                'suburb' => [
                    'label'  => lang('Home.Colonia'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Colonia no puede estar vacio.'),
                    ],
                ],
                'postal_code' => [
                    'label'  => lang('Home.Codigo postal'),
                    'rules'  => 'trim|required|numeric',
                    'errors' => [
                        'required' => lang('Home.El campo Codigo postal no puede estar vacio.'),
                        'numeric' => lang('Home.El campo Codigo postal solo debe ser numeros.'),
                    ],
                ],
                'estate' => [
                    'label'  => lang('Home.Estado'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Estado no puede estar vacio.'),
                    ],
                ],
                'delegation' => [
                    'label'  => lang('Home.Delegación'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Delegación no puede estar vacio.'),
                    ],
                ],
                'country_id' => [
                    'label'  => lang('Home.País'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo País no puede estar vacio.'),
                    ],
                ],
                'nationality_id' => [
                    'label'  => lang('Home.Nacionalidad'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Nacionalidad no puede estar vacio.'),
                    ],
                ],
            ];
        }

        if($this->request->getPost('form') == 3){
            $required = '';
            $errors = '';
            $decimal = '';
            $errors_decimal = '';

            $required_total = '';
            $errors_total = '';
            $decimal_total = '';
            $errors_decimal_total = '';
            // if($this->request->getPost('type_user_id') == 1){                
            //     $required = 'required';
            //     $errors = 'El campo {field} no puede estar vacio.';
            //     $decimal = 'decimal';
            //     $errors_decimal = 'El campo {field} solo debe ser numeros y decimales.';
            // }
            if($this->request->getPost('credential_id') < 5){                
                $required = 'required';
                $errors = lang('Home.El campo Seguro social no puede estar vacio.');
                $decimal = 'decimal';
                $errors_decimal = lang('Home.El campo Seguro social solo debe ser numeros y decimales.');

                $required_total = 'required';
                $errors_total = lang('Home.El campo Total no puede estar vacio.');
                $decimal_total = 'decimal';
                $errors_decimal_total = lang('Home.El campo Total solo debe ser numeros y decimales.');
            }

            $rules = [
                // 'type_user_id' => [
                //     'label'  => 'Tipo de usuario',
                //     'rules'  => 'trim|required',
                //     'errors' => [
                //         'required' => 'El campo {field} no puede estar vacio.',
                //     ],
                // ],
                'schooling_id' => [
                    'label'  => lang('Home.Educación'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Educación no puede estar vacio.'),
                    ],
                ],
                'organization_id' => [
                    'label'  => lang('Home.Organización'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Organización no puede estar vacio.'),
                    ],
                ],
                'department_id' => [
                    'label'  => lang('Home.Departamento'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Departamento no puede estar vacio.'),
                    ],
                ],
                'position_id' => [
                    'label'  => lang('Home.Puesto'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Puesto no puede estar vacio.'),
                    ],
                ],
                'date_admission' => [
                    'label'  => lang('Home.Fecha de ingreso'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Fecha de ingreso no puede estar vacio.'),
                    ],
                ],
                'salary_amount' => [
                    'label'  => lang('Home.Salario o cantidad comprada'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Salario o cantidad comprada no puede estar vacio.'),
                    ],
                ],
                'social_security' => [
                    'label'  => lang('Home.Seguro social'),
                    'rules'  => 'trim|'.$required.'',
                    'errors' => [
                        'required' => ''.$errors.''
                    ],
                ],
                'total' => [
                    'label'  => lang('Home.Total'),
                    'rules'  => 'trim|decimal|'.$required_total.'',
                    'errors' => [
                        'required' => ''.$errors_total.'',
                        'decimal' => lang('Home.El campo Total solo debe ser numeros y decimales.')
                    ],
                ],
                'disc' => [
                    'label'  => lang('Home.Disc'),
                    'rules'  => 'trim|required|less_than_equal_to[8]',
                    'errors' => [
                        'required' => lang('Home.El campo Disc no puede estar vacio.'),
                        'less_than_equal_to' => lang('Home.El campo Disc no puede ser mayor a 8')
                    ],
                ],
            ];
        }

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $response['status'] = "OK";
            $response['message'] = lang('Home.Campos validados.');
        }

        exit(json_encode($response));
    }

    public function form_datos(){
        // Código para manejar el formulario 1
        if($this->request->getPost('form') == 1){

            $userModel = new UserModel($db);

            if(empty($this->request->getPost('user_id'))){
                $data = [
                    'user' => $this->request->getPost('user'),
                    'password'  => md5($this->request->getPost('password')),
                    'credential_id'  => $this->request->getPost('credential_id'),
                    'created_by'  => $this->session->get('user_id'),
                    'created_at'  => date('Y-m-d H:i:s')
                ];

                $query = $db->table('users')->insert($data);
                $user_id = $db->insertID();

                $data = [
                    'user_id' => $user_id,
                    'created_by'  => $this->session->get('user_id'),
                    'created_at'  => date('Y-m-d H:i:s'),
                    'deleted_at'  => NULL
                ];

                $query = $db->table('employees')->insert($data);
            }else{

                if(empty($this->request->getPost('password'))){
                    $data = [
                        'user' => $this->request->getPost('user'),
                        'credential_id'  => $this->request->getPost('credential_id'),
                        'modified_by'  => $this->session->get('user_id'),
                        'updated_at'  => date('Y-m-d H:i:s')
                    ];
                }else{                    
                    $data = [
                        'user' => $this->request->getPost('user'),
                        'password'  => md5($this->request->getPost('password')),
                        'credential_id'  => $this->request->getPost('credential_id'),
                        'modified_by'  => $this->session->get('user_id'),
                        'updated_at'  => date('Y-m-d H:i:s')
                    ];
                }

                $query = $userModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();
                $user_id = $this->request->getPost('user_id');
            }
        }

        if($this->request->getPost('form') == 2){
            $data = [
                'first_name'            => $this->request->getPost('first_name'),
                'second_name'            => $this->request->getPost('second_name'),
                'last_name'            => $this->request->getPost('last_name'),
                'second_last_name'            => $this->request->getPost('second_last_name'), 
                'business_name'            => $this->request->getPost('business_name'),
                'gender_id'            => $this->request->getPost('gender_id'),
                'birthday'            => $this->request->getPost('birthday'),
                'email'            => $this->request->getPost('email'), 
                'phone'            => $this->request->getPost('phone'), 
                'mobile'            => $this->request->getPost('mobile'), 
                'civil_status_id'            => $this->request->getPost('civil_status_id'),
                'economic_dependents'            => $this->request->getPost('economic_dependents'), 
                'street'            => $this->request->getPost('street'),
                'number'            => $this->request->getPost('number'), 
                'suburb'            => $this->request->getPost('suburb'), 
                'postal_code'            => $this->request->getPost('postal_code'), 
                'estate'            => $this->request->getPost('estate'), 
                'delegation'            => $this->request->getPost('delegation'), 
                'country_id'            => $this->request->getPost('country_id'), 
                'nationality_id'            => $this->request->getPost('nationality_id'), 
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => NULL
            ];

            $employeeModel = new EmployeeModel($db);

            $query = $employeeModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();

            $user_id = $this->request->getPost('user_id');
        }

        if($this->request->getPost('form') == 3){
            $data = [
                // 'type_user_id'            => $this->request->getPost('type_user_id'),
                'salary_amount'            => $this->request->getPost('salary_amount'),
                'social_security'            => $this->request->getPost('social_security'),
                'benefit_1'            => $this->request->getPost('benefit_1'), 
                'benefit_amount_1'            => $this->request->getPost('benefit_amount_1'),
                'benefit_2'            => $this->request->getPost('benefit_2'), 
                'benefit_amount_2'            => $this->request->getPost('benefit_amount_2'),
                'benefit_3'            => $this->request->getPost('benefit_3'), 
                'benefit_amount_3'            => $this->request->getPost('benefit_amount_3'),
                'benefit_4'            => $this->request->getPost('benefit_4'), 
                'benefit_amount_4'            => $this->request->getPost('benefit_amount_4'),
                'total'            => $this->request->getPost('total'),
                'disc'            => $this->request->getPost('disc'),
                'date_admission'            => $this->request->getPost('date_admission'), 
                'schooling_id'            => $this->request->getPost('schooling_id'), 
                'organization_id'            => $this->request->getPost('organization_id'), 
                'department_id'            => $this->request->getPost('department_id'), 
                'position_id'            => $this->request->getPost('position_id'),
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => NULL
            ];

            $employeeModel = new EmployeeModel($db);

            $query = $employeeModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();

            $user_id = $this->request->getPost('user_id');
        }

        if($query){
            $res = $user_id;
        }

        exit(json_encode($res));
    }

    public function eliminar_datos(){

        $employeeModel = new EmployeeModel($db);
        $userModel = new UserModel($db);

        if($this->request->getPost('estatus') == 0){
            $res = $employeeModel->where('user_id', $this->request->getPost('user_id'))->delete();

            $res = $userModel->where('user_id', $this->request->getPost('user_id'))->delete();
        }else{
            $data = [
                'deleted_at'  => NULL
            ];

            $res = $employeeModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();
            $res = $userModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();
        }

        exit(json_encode($res));
    }

    public function ver_detalles(){
        $employeeModel = new EmployeeModel($db);
        
        $query = $db->table('employees e');
        $query->select('e.*, u.*, cr.credential, g.gender, ci.civil_status, co.country, n.nationality, t.type_user, s.schooling, o.organization, d.department, p.position');
        $query->join('users u', 'u.user_id = e.user_id ', "left");
        $query->join('credentials cr', 'cr.credential_id = u.credential_id ', "left");
        $query->join('genders g', 'g.gender_id = e.gender_id ', "left");
        $query->join('civil_status ci', 'ci.civil_status_id = e.civil_status_id ', "left");
        $query->join('countries co', 'co.country_id = e.country_id ', "left");
        $query->join('nationalities n', 'n.nationality_id = e.nationality_id ', "left");
        $query->join('type_users t', 't.type_user_id = e.type_user_id ', "left");
        $query->join('schooling s', 's.schooling_id = e.schooling_id ', "left");
        $query->join('organizations o', 'o.organization_id = e.organization_id ', "left");
        $query->join('departments d', 'd.department_id = e.department_id ', "left");
        $query->join('positions p', 'p.position_id = e.position_id ', "left");
        $query->where('e.user_id', $this->request->getPost('user_id'));
        $employee = $query->get()->getRowArray();

        exit(json_encode($employee));
    }

    public function profile_view($user_id, $position_id){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $employeeModel = new EmployeeModel($db);
        
        $query = $db->table('employees e');
        $query->select('e.*, u.*, cr.credential, g.gender, ci.civil_status, co.country, n.nationality, t.type_user, s.schooling, o.organization, d.department, p.position');
        $query->join('users u', 'u.user_id = e.user_id ', "left");
        $query->join('credentials cr', 'cr.credential_id = u.credential_id ', "left");
        $query->join('genders g', 'g.gender_id = e.gender_id ', "left");
        $query->join('civil_status ci', 'ci.civil_status_id = e.civil_status_id ', "left");
        $query->join('countries co', 'co.country_id = e.country_id ', "left");
        $query->join('nationalities n', 'n.nationality_id = e.nationality_id ', "left");
        $query->join('type_users t', 't.type_user_id = e.type_user_id ', "left");
        $query->join('schooling s', 's.schooling_id = e.schooling_id ', "left");
        $query->join('organizations o', 'o.organization_id = e.organization_id ', "left");
        $query->join('departments d', 'd.department_id = e.department_id ', "left");
        $query->join('positions p', 'p.position_id = e.position_id ', "left");
        $query->where('e.user_id', $user_id);
        $data['employee'] = $query->get()->getRowArray();
//obtenemos las resoluciones del usuario
        $query = $db->table('resolutions');
        $query->select('*');
        $query->where('user_id', $user_id);
        $data['resolutions'] = $query->get()->getResultArray();

        $query = $db->table('innovations');
        $query->select('*');
        $query->where('user_id', $user_id);
        $data['innovations'] = $query->get()->getResultArray();

        // $where = 's.user_id = '.$user_id.' OR (s.position_id= '.$position_id.' AND s.created_admin != 0)';
        $where = 's.user_id = '.$user_id.'';
        $where .= ' AND s.deleted_at IS NULL';

        $query = $db->table('services s');
        $query->select('s.*, st.status service_status');
        $query->join('services_status st', 'st.service_status_id = s.status ', "left");
        $query->where($where);
        $data['services'] = $query->get()->getResultArray();

        $query = $db->table('complaints c');
        $query->select('c.*, CONCAT(ea.first_name, " ", ea.second_name,  " ", ea.last_name,  " ", ea.second_last_name) author, CONCAT(er.first_name, " ", er.second_name,  " ", er.last_name,  " ", er.second_last_name) responsible, ca.category, cs.status, ct.type');
        $query->join('employees ea', 'ea.user_id  = c.created_by', "left");
        $query->join('employees er', 'er.user_id  = c.user_id', "left");
        $query->join('categories ca', 'ca.category_id  = c.category_id', "left");
        $query->join('complaints_status cs', 'cs.complaint_status_id  = c.complaint_status_id', "left");
        $query->join('complaints_types ct', 'ct.complaint_type_id  = c.complaint_type_id ', "left");
        $query->where('c.deleted_at', NULL);
        $query->where('c.user_id', $user_id);
        $data['complaints'] = $query->get()->getResultArray();

        $query = $db->table('services_customers sc');
        $query->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) customer, e.user_id, u.profile_picture');
        $query->join('employees e', 'e.user_id = sc.customer_id', "left");
        $query->join('users u', 'u.user_id = e.user_id', "left");
        $query->where('sc.created_by', $user_id);
        $query->groupBy('e.user_id');
        $data['providers'] = $query->get()->getResultArray();

        $query = $db->table('tasks t');
        $query->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) name, t.commentary_productivity, t.commentary_quality, t.commentary_innovation, t.commentary_service, t.created_by, t.updated_at');
        $query->join('employees e', 'e.user_id = t.created_by', "left");
        $query->join('users u', 'u.user_id = e.user_id', "left");
        $query->where('t.user_id', $user_id);
        $data['comments'] = $query->get()->getResultArray();

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service');
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        $query->where('t.user_id', $this->request->getPost('user_id'));
        $tasks = $query->get()->getRowArray();

        $promedio = round(($tasks['average_productivity'] + $tasks['average_quality'] + $tasks['average_innovation'] + $tasks['average_service']) / 4, 2);

        $data['user_id'] = $user_id;
        $data['position_id'] = $position_id;
        $data['title'] = 'Empleados';
        $data['sub_title'] = 'Perfil';
        $data['custom'] = 'profile_view';
        $data['content'] = 'employees/profile_view';

        return view('templates/common/Layout_view',$data);
    }

    public function competencies_view($user_id){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $employeeModel = new EmployeeModel($db);

        $query = $db->table('employees_competencies ec');
        $query->select('c.competency_id, c.competency, ec.qualification');
        $query->join('competencies c ', 'c.competency_id = ec.competency_id', 'left');
        $query->where('ec.user_id', $user_id);
        $query->orderBy('c.competency_id', 'ASC');
        $data['competencies'] = $query->get()->getResultArray();

        if(empty($data['competencies'])){        
            $query = $db->table('competencies');
            $query->select('*');
            $data['competencies'] = $query->get()->getResultArray();

            for ($i=0; $i < 50; $i++) { 
                $data['competencies'][$i]['qualification'] = '';
            }
        }

        // d($data);
        // exit;

        $data['user_id'] = $user_id;
        $data['title'] = 'Empleados';
        $data['sub_title'] = 'Competencias';
        $data['custom'] = 'employees';
        $data['content'] = 'employees/competencies_view';

        return view('templates/common/Layout_view',$data);
    }

    public function validar_form_competiencies(){
        $validation =  \Config\Services::validation();
        $required = '';
        $errors = '';
        if($this->request->getPost('user_id') == 0){                
            $required = 'required';
            $errors = 'El campo {field} no puede estar vacio.';
        }

        $rules = [
            'qualification1' => [
                'label'  => lang('Home.Coeficiente Intelectual'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Coeficiente Intelectual no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Coeficiente Intelectual solo debe ser numeros.'),
                ],
            ],
            'qualification2' => [
                'label'  => lang('Home.Competencia en Análisis de Problemas'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Análisis de Problemas no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia en Análisis de Problemas solo debe ser numeros.'),
                ],
            ],
            'qualification3' => [
                'label'  => lang('Home.Competencia para la Toma de Decisiones'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para la Toma de Decisiones no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia para la Toma de Decisiones solo debe ser numeros.'),
                ],
            ],
            'qualification4' => [
                'label'  => lang('Home.Competencia de Juicio'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia de Juicio no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia de Juicio solo debe ser numeros.'),
                ],
            ],
            'qualification5' => [
                'label'  => lang('Home.Competencia en Comunicación'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Comunicación no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia en Comunicación solo debe ser numeros.'),
                ],
            ],
            'qualification6' => [
                'label'  => lang('Home.Competencia en Liderazgo'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Liderazgo no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia en Liderazgo solo debe ser numeros.'),
                ],
            ],
            'qualification7' => [
                'label'  => lang('Home.Competencia para la Delegación'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para la Delegación no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia para la Delegación solo debe ser numeros.'),
                ],
            ],
            'qualification8' => [
                'label'  => lang('Home.Competencia para el Desarrollo de Colaboradores'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para el Desarrollo de Colaboradores no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia para el Desarrollo de Colaboradores solo debe ser numeros.'),
                ],
            ],
            'qualification9' => [
                'label'  => lang('Home.Competencia para el Trabajo en Equipo'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para el Trabajo en Equipo no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia para el Trabajo en Equipo solo debe ser numeros.'),
                ],
            ],
            'qualification10' => [
                'label'  => lang('Home.Competencia en Inteligencia Emocional'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Inteligencia Emocional no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia en Inteligencia Emocional solo debe ser numeros.'),
                ],
            ],
            'qualification11' => [
                'label'  => lang('Home.Competencia para la Tolerancia a la Presión'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para la Tolerancia a la Presión no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia para la Tolerancia a la Presión solo debe ser numeros.'),
                ],
            ],
            'qualification12' => [
                'label'  => lang('Home.Competencia en Actitud de Servicio'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Actitud de Servicio no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia en Actitud de Servicio solo debe ser numeros.'),
                ],
            ],
            'qualification13' => [
                'label'  => lang('Home.Competencia para el Seguimiento y Control'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para el Seguimiento y Control no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia para el Seguimiento y Control solo debe ser numeros.'),
                ],
            ],
            'qualification14' => [
                'label'  => lang('Home.Competencia en Planeación y Organización'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Planeación y Organización no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia en Planeación y Organización solo debe ser numeros.'),
                ],
            ],
            'qualification15' => [
                'label'  => lang('Home.Competencia en Enfoque a Resultados'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Enfoque a Resultados no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Competencia en Enfoque a Resultados solo debe ser numeros.'),
                ],
            ],
            'qualification16' => [
                'label'  => lang('Home.Gusto por la Venta'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Gusto por la Venta no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Gusto por la Venta solo debe ser numeros.'),
                ],
            ],
            'qualification17' => [
                'label'  => lang('Home.Capacidad de Negociación'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Capacidad de Negociación no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Capacidad de Negociación solo debe ser numeros.'),
                ],
            ],
            'qualification18' => [
                'label'  => lang('Home.Habilidades de Comunicación'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Habilidades de Comunicación no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Habilidades de Comunicación solo debe ser numeros.'),
                ],
            ],
            'qualification19' => [
                'label'  => lang('Home.Empatía'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Empatía no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Empatía solo debe ser numeros.'),
                ],
            ],
            'qualification20' => [
                'label'  => lang('Home.Orientación a Resultados para las ventas'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Orientación a Resultados para las ventas no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Orientación a Resultados para las ventas solo debe ser numeros.'),
                ],
            ],
            'qualification21' => [
                'label'  => lang('Home.Tolerancia al Rechazo'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Tolerancia al Rechazo no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Tolerancia al Rechazo solo debe ser numeros.'),
                ],
            ],
            'qualification22' => [
                'label'  => lang('Home.Autodisciplina'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Autodisciplina no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Autodisciplina solo debe ser numeros.'),
                ],
            ],
            'qualification23' => [
                'label'  => lang('Home.Liderazgo Directivo'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Directivo no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Liderazgo Directivo solo debe ser numeros.'),
                ],
            ],
            'qualification24' => [
                'label'  => lang('Home.Liderazgo Participativo ó Democrático'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Participativo ó Democrático no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Liderazgo Participativo ó Democrático solo debe ser numeros.'),
                ],
            ],
            'qualification25' => [
                'label'  => lang('Home.Liderazgo Delegativo'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Delegativo no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Liderazgo Delegativo solo debe ser numeros.'),
                ],
            ],
            'qualification26' => [
                'label'  => lang('Home.Liderazgo Transformacional'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Transformacional no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Liderazgo Transformacional solo debe ser numeros.'),
                ],
            ],
            'qualification27' => [
                'label'  => lang('Home.Liderazgo Transaccional'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Transaccional no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Liderazgo Transaccional solo debe ser numeros.'),
                ],
            ],
            'qualification28' => [
                'label'  => lang('Home.Capacidad de Comunicación'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Capacidad de Comunicación no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Capacidad de Comunicación solo debe ser numeros.'),
                ],
            ],
            'qualification29' => [
                'label'  => lang('Home.Inteligencia Emocional'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Inteligencia Emocional no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Inteligencia Emocional solo debe ser numeros.'),
                ],
            ],
            'qualification30' => [
                'label'  => lang('Home.Toma de Decisiones'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Toma de Decisiones no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Toma de Decisiones solo debe ser numeros.'),
                ],
            ],
            'qualification31' => [
                'label'  => lang('Home.Orientación a Resultados'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Orientación a Resultados no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Orientación a Resultados solo debe ser numeros.'),
                ],
            ],
            'qualification32' => [
                'label'  => lang('Home.Habilidades de Negociación'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Habilidades de Negociación no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Habilidades de Negociación solo debe ser numeros.'),
                ],
            ],
            'qualification33' => [
                'label'  => lang('Home.Capacidad de Mando'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Capacidad de Mando no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Capacidad de Mando solo debe ser numeros.'),
                ],
            ],
            'qualification34' => [
                'label'  => lang('Home.Capacidad de Planeación'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Capacidad de Planeación no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Capacidad de Planeación solo debe ser numeros.'),
                ],
            ],
            'qualification35' => [
                'label'  => lang('Home.Conciencia de sus Fortalezas'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Conciencia de sus Fortalezas no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Conciencia de sus Fortalezas solo debe ser numeros.'),
                ],
            ],
            'qualification36' => [
                'label'  => lang('Home.Desarrollo Personal y de su Equipo'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Desarrollo Personal y de su Equipo no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Desarrollo Personal y de su Equipo solo debe ser numeros.'),
                ],
            ],
            'qualification37' => [
                'label'  => lang('Home.Carisma y Habilidades Sociales'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Carisma y Habilidades Sociales no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Carisma y Habilidades Sociales solo debe ser numeros.'),
                ],
            ],
            'qualification38' => [
                'label'  => lang('Home.Conciencia Social'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Conciencia Social no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Conciencia Social solo debe ser numeros.'),
                ],
            ],
            'qualification39' => [
                'label'  => lang('Home.Creatividad e Innovación'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Creatividad e Innovación no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Creatividad e Innovación solo debe ser numeros.'),
                ],
            ],
            'qualification40' => [
                'label'  => lang('Home.Responsabilidad'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Responsabilidad no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Responsabilidad solo debe ser numeros.'),
                ],
            ],
            'qualification41' => [
                'label'  => lang('Home.Habilidad de Información'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Habilidad de Información no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Habilidad de Información solo debe ser numeros.'),
                ],
            ],
            'qualification42' => [
                'label'  => lang('Home.Adaptación al Cambio'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Adaptación al Cambio no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Adaptación al Cambio solo debe ser numeros.'),
                ],
            ],
            'qualification43' => [
                'label'  => lang('Home.Índice de Confianza'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Índice de Confianza no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Índice de Confianza solo debe ser numeros.'),
                ],
            ],
            'qualification44' => [
                'label'  => lang('Home.Descripción del Nivel de Certidumbre y Confianza General'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Descripción del Nivel de Certidumbre y Confianza General no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Descripción del Nivel de Certidumbre y Confianza General solo debe ser numeros.'),
                ],
            ],
            'qualification45' => [
                'label'  => lang('Home.Nivel de Honestidad'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Nivel de Honestidad no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Nivel de Honestidad solo debe ser numeros.'),
                ],
            ],
            'qualification46' => [
                'label'  => lang('Home.Descripción del Nivel de Honestidad'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Descripción del Nivel de Honestidad no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Descripción del Nivel de Honestidad solo debe ser numeros.'),
                ],
            ],
            'qualification47' => [
                'label'  => lang('Home.Nivel de ética'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Nivel de ética no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Nivel de ética solo debe ser numeros.'),
                ],
            ],
            'qualification48' => [
                'label'  => lang('Home.Descripción del Nivel de ética'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Descripción del Nivel de ética no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Descripción del Nivel de ética solo debe ser numeros.'),
                ],
            ],
            'qualification49' => [
                'label'  => lang('Home.Nivel de Valores'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Nivel de Valores no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Nivel de Valores solo debe ser numeros.'),
                ],
            ],
            'qualification50' => [
                'label'  => lang('Home.Descripción del Nivel de Valores'),
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required' => lang('Home.El campo Descripción del Nivel de Valores no puede estar vacio.'),
                    'numeric' => lang('Home.El campo Descripción del Nivel de Valores solo debe ser numeros.'),
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $response['status'] = "OK";
            $response['message'] = lang('Home.Campos validados.');
        }

        exit(json_encode($response)); 
    }

    public function form_datos_competiencies(){

        $employeescompetenciesModel = new EmployeesCompetenciesModel($db);

        $employeescompetenciesModel->where('user_id', $this->request->getPost('user_id'))->delete();

        $sumatoria = 0;

        foreach ($this->request->getPost('competency_id') as $ci) {
            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'competency_id'  => $ci,
                'qualification'  => $this->request->getPost('qualification'.$ci),
                'created_by'  => $this->session->get('user_id'),
                'created_at'  => date('Y-m-d H:i:s')
            ];
            $query = $db->table('employees_competencies')->insert($data);

            $sumatoria = $sumatoria + $this->request->getPost('qualification'.$ci);
        }

        $promedio = round($sumatoria / 50, 2);
        $data = [
            'average'  => $promedio,
            'modified_by'  => $this->session->get('user_id'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $employeeModel = new EmployeeModel($db);

        $query = $employeeModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();

        exit(json_encode($query));
    }

    public function get_competencias(){
        $employeeModel = new EmployeeModel($db);

        $query = $db->table('employees_competencies ec');
        $query->select('c.competency, ec.qualification');
        $query->join('competencies c', 'c.competency_id = ec.competency_id ', "left");
        $query->where('ec.user_id', $this->request->getPost('user_id'));
        $res = $query->get()->getResultArray();

        $datos = array();
        $i = 0;
        foreach ($res as $r) {
            $datos['competency'][$i] = lang('Home.'.$r['competency'].'');
            $datos['value'][$i] = (int) $r['qualification'];
            $i++;
        }
        
        exit(json_encode($datos));
    }

    public function actualizar_datos(){
        $employeeModel = new EmployeeModel($db);
        $validation =  \Config\Services::validation();

        if($this->request->getPost('date') < 5){        
            if($this->request->getPost('date') == 1){
                $rules = [
                    'mission' => [
                        'label'  => lang('Home.Misión'),
                        'rules'  => 'trim|required',
                        'errors' => [
                            'required' => lang('Home.El campo Misión no puede estar vacio.'),
                        ],
                    ]
                ];

                $data = [
                    'user_id' => $this->request->getPost('user_id'),
                    'mission'  => trim($this->request->getPost('mission')),
                    'modified_by'  => $this->session->get('user_id'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];
            }
            if($this->request->getPost('date') == 2){
                $rules = [
                    'vision' => [
                        'label'  => lang('Home.Visión'),
                        'rules'  => 'trim|required',
                        'errors' => [
                            'required' => lang('Home.El campo Visión no puede estar vacio.'),
                        ],
                    ]
                ];

                $data = [
                    'user_id' => $this->request->getPost('user_id'),
                    'vision'  => trim($this->request->getPost('vision')),
                    'modified_by'  => $this->session->get('user_id'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];
            }
            if($this->request->getPost('date') == 3){
                $rules = [
                    'competitive_advantages' => [
                        'label'  => lang('Home.Ventaja competitiva'),
                        'rules'  => 'trim|required',
                        'errors' => [
                            'required' => lang('Home.El campo Ventaja competitiva no puede estar vacio.'),
                        ],
                    ]
                ];

                $data = [
                    'user_id' => $this->request->getPost('user_id'),
                    'competitive_advantages'  => trim($this->request->getPost('competitive_advantages')),
                    'modified_by'  => $this->session->get('user_id'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];
            }
            if($this->request->getPost('date') == 4){
                $rules = [
                    'comparative_advantages' => [
                        'label'  => lang('Home.Ventaja comparativa'),
                        'rules'  => 'trim|required',
                        'errors' => [
                            'required' => lang('Home.El campo Ventaja comparativa no puede estar vacio.'),
                        ],
                    ]
                ];

                $data = [
                    'user_id' => $this->request->getPost('user_id'),
                    'comparative_advantages'  => trim($this->request->getPost('comparative_advantages')),
                    'modified_by'  => $this->session->get('user_id'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];
            }

            if(!$this->validate($rules)){
                $response['status'] = "ERROR";
                $response['message'] = $validation->listErrors();
            }else{
                $response['status'] = "OK";
                $response['message'] = lang('Home.Los datos se guardaron correctamente.');
            }

            if($response['status'] == 'OK'){
                $query = $employeeModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();
            }
        }
//esto es para editar las resoluciones

        // Validar si la solicitud es para actualizar una resolución
        if ($this->request->getPost('date') == 5) {
            // Reglas de validación para resolución
            $rules = [
                'resolution' => [
                    'label'  => lang('Home.Resolución'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Resolución no puede estar vacio.'),
                    ],
                ],
                'description' => [
                    'label'  => lang('Home.Descripción'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Descripción no puede estar vacio.'),
                    ],
                ],
                'imagen_resolucion' => [
                    'label' => 'Imagen',
                    'rules' => 'trim|mime_in[imagen_resolucion,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[imagen_resolucion,6048]',
                    'errors' => [
                        'mime_in'  => lang('Home.El archivo tiene una extensión inválida.'),
                        'max_size' => lang('Home.El archivo excede el tamaño permitido.'),
                    ],
                ],
            ];

            // Recopilar datos del formulario
            $data = [
                'resolution'  => trim($this->request->getPost('resolution')),
                'description'  => trim($this->request->getPost('description')),
                'modified_by'  => session()->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            // Validar los datos del formulario
            if (!$this->validate($rules)) {
                $response = [
                    'status' => 'ERROR',
                    'message' => $validation->listErrors(),
                ];
            } else {
                $resolutionModel = new ResolutionModel($db);
                $resolution_id = $this->request->getPost('resolution_id');

                // Verificar si hay una imagen y manejar la carga de la imagen
                $imageFile = $this->request->getFile('imagen_resolucion');
                if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                    $newName = $imageFile->getRandomName();
                    $carpeta = './public/resolucion/' . $resolution_id;

                    if (!file_exists($carpeta)) {
                        mkdir($carpeta, 0777, true);
                    }

                    $imageFile->move($carpeta, $newName);
                    $data['imagen_resolucion'] = $newName;
                }

                // Actualizar la resolución en la base de datos
                $resolutionModel->set($data)->where('resolution_id', $resolution_id)->update();

                $response = [
                    'status' => 'OK',
                    'message' => lang('Home.Los datos se guardaron correctamente.'),
                ];
            }

            return $this->response->setJSON($response);
        }

//esto es para editar las innovaciones
        if($this->request->getPost('date') == 6){
            $rule_uploaded = '';
            $rule_max_size = '';
            $rule_mime_in = '';

            $errors_uploaded= '';
            $errors_mime_in = '';
            $errors_max_size= '';

            if($this->request->getPost('imagen_innovacion') != 'undefined'){
                helper(['form', 'url']);

                $rule_uploaded  = '|uploaded[imagen_innovacion]';
                $rule_max_size  = '|max_size[imagen_innovacion,6048]';
                $rule_mime_in   = '|mime_in[imagen_innovacion,image/jpg,image/jpeg,image/gif,image/png,image/webp]';

                $errors_uploaded = lang('Home.El campo Imagen no puede estar vacio o el archivo excede el tamaño permitido.');
                $errors_mime_in  = lang('Home.El archivo tiene un extención invalida.');
                $errors_max_size = lang('Home.El archivo excede el tamaño permitido.');
            }

            $rules = [
                'innovation' => [
                    'label'  => lang('Home.Innovación'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Innovación no puede estar vacio.'),
                    ],
                ],
                'description' => [
                    'label'  => lang('Home.Descripción'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Descripción no puede estar vacio.'),
                    ],
                ],
                'annual_value' => [
                    'label'  => lang('Home.Valor anual'),
                    'rules'  => 'trim|required|decimal',
                    'errors' => [
                        'required' => lang('Home.El campo Valor anual no puede estar vacio.'),
                        'decimal' => lang('Home.El campo Valor anual solo debe ser numeros y decimales.')
                    ],
                ],
                'imagen_innovacion' => [
                    'label' => 'Imagen',
                    'rules' => 'trim'.$rule_uploaded.$rule_max_size.$rule_mime_in.'',
                    'errors' => [
                        'uploaded' => ''.$errors_uploaded.'',
                        'mime_in'  => ''.$errors_mime_in.'',
                        'max_size' => ''.$errors_max_size.''
                    ],
                ],
            ];

            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'innovation'  => trim($this->request->getPost('innovation')),
                'annual_value'  => trim($this->request->getPost('annual_value')),
                'description'  => trim($this->request->getPost('description')),
                'created_by'  => $this->session->get('user_id'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            if(!$this->validate($rules)){
                $response['status'] = "ERROR";
                $response['message'] = $validation->listErrors();
            }else{
                $response['status'] = "OK";
                $response['message'] = lang('Home.Los datos se guardaron correctamente.');
            }

            if($response['status'] == 'OK'){
                if($this->request->getPost('innovation_id') == ''){
                    $query = $db->table('innovations')->insert($data);
                    $innovation_id = $db->insertID();
                }else{
                    $innovationModel = new innovationModel($db);
                    $query = $innovationModel->set($data)->where('innovation_id', $this->request->getPost('innovation_id'))->update();
                    $innovation_id = $this->request->getPost('innovation_id');
                }


                if($this->request->getPost('imagen_innovacion') != 'undefined'){
                    helper(['form', 'url']);
                    $carpeta = './public/innovacion/'.$innovation_id;

                    if (!file_exists($carpeta)) {
                        mkdir($carpeta, 0777, true);
                    }

                    $imageFile = $this->request->getFile('imagen_innovacion');
                    $newName = $imageFile->getRandomName();
                    $imageFile->move($carpeta, $newName);

                    $data = [
                        'imagen_innovacion'  => $newName,
                        'created_by'  => $this->session->get('user_id'),
                        'created_at'  => date('Y-m-d H:i:s')
                    ];

                    $innovationModel = new innovationModel($db);
                    $query = $innovationModel->set($data)->where('innovation_id', $innovation_id)->update();
                }
            }
        }

        exit(json_encode($response));
    }

    public function delete_dato(){
        $resolutionModel = new ResolutionModel($db);
        $innovationModel = new InnovationModel($db);

        if($this->request->getPost('type') == 1){        
            $query = $resolutionModel->where('resolution_id', $this->request->getPost('id'))->delete();
        }

        if($this->request->getPost('type') == 2){        
            $query = $innovationModel->where('innovation_id', $this->request->getPost('id'))->delete();
        }

        exit(json_encode($query));
    }

    public function add_foto(){
        helper(['form', 'url']);
        $carpeta = './public/fotos/'.$this->request->getPost('user_id');

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $validation =  \Config\Services::validation();

        $rules = [
            'profile_picture' => [
                'label' => lang('Home.Foto de perfil'),
                'rules' => 'uploaded[profile_picture]|max_size[profile_picture,10000]|mime_in[profile_picture,image/jpg,image/jpeg,image/gif,image/png,image/webp,video/mp4,video/avi]',
                'errors' => [
                    'uploaded' => lang('Home.El campo Foto de perfil no puede estar vacio o el archivo excede el tamaño permitido.'),
                    'mime_in'  => lang('Home.El archivo tiene un extención invalida.'),
                    'max_size' => lang('Home.El archivo excede el tamaño permitido.'),
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $response['status'] = "OK";
            $response['message'] = lang('Home.Campos validados.');
        }

        if ($response['status'] == "OK") {
            $imageFile = $this->request->getFile('profile_picture');
            $newName = $imageFile->getRandomName();
            $imageFile->move($carpeta, $newName);

            $data = [
                'profile_picture' => $newName,
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $userModel = new UserModel($db);
            $query = $userModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();

            $response['status'] = "OK";
            $response['message'] = lang('Home.Se actualizó la foto correctamente. Favor de recargar la página.');
        }
        
        exit(json_encode($response));
    }

    public function add_video(){
        helper(['form', 'url']);
        $carpeta = './public/videos/'.$this->request->getPost('user_id');

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $validation =  \Config\Services::validation();

        $rules = [
            'profile_video' => [
                'label' => lang('Home.Video de perfil'),
                'rules' => 'uploaded[profile_video]|max_size[profile_video,10240]|mime_in[profile_video,video/mp4,video/mkv]',
                'errors' => [
                    'uploaded' => lang('Home.El campo Video de perfil no puede estar vacio.'),
                    'mime_in'  => lang('Home.El archivo tiene un extención invalida.'),
                    'max_size' => lang('Home.El archivo excede el tamaño permitido.'),
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $response['status'] = "OK";
            $response['message'] = lang('Home.Campos validados.');
        }

        if ($response['status'] == "OK") {
            $imageFile = $this->request->getFile('profile_video');
            $newName = $imageFile->getRandomName();
            $imageFile->move($carpeta, $newName);

            $data = [
                'profile_video' => $newName,
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $userModel = new UserModel($db);
            $query = $userModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();

            $response['status'] = "OK";
            $response['message'] = lang('Home.Se actualizó el video correctamente. Favor de recargar la página.');
        }
        
        exit(json_encode($response));
    }

    public function email_recuperar_password() {
        $employeemodel = new Employeemodel($db);
        $userModel = new UserModel($db);

        $validation =  \Config\Services::validation();

        $rules = [
            'email' => [
                'label'  => lang('Home.Correo electronico'),
                'rules'  => 'trim|required|valid_email',
                'errors' => [
                    'required' => lang('Home.El campo Correo electronico no puede estar vacio.'),
                    'valid_email' => lang('Home.El campo Correo electronico no cuenta con la estructura correcta.'),
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $response['status'] = "OK";
            $response['message'] = lang('Home.Campos validados.');
        }

        if($response['status'] == "OK") {        
            $query = $db->table('employees e');
            $query->select('*');
            $query->join('users u', 'u.user_id = e.user_id ', "left");
            $query->where('e.email', $this->request->getPost('email'));
            $employee = $query->get()->getResultArray();

            if(!empty($employee)){            
                $data = [
                    'recover' => 1,
                    'modified_by'  => $this->session->get('user_id'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];

                $query = $userModel->set($data)->where('user_id', $employee[0]['user_id'])->update();

                $subject = lang('Home.Actualización de contraseña');
                $message = lang('Home.Favor de dar clic en el siguiente enlance:');
                $link = base_url().'/auth/recuperar_view/'.base64_encode($employee[0]['email']);

                // Datos el email destino. Donde irá a parar el formulario
                $this->email->setTo(''.$employee[0]['email'].'');

                // Email desde el que se envía (el que hemos configurarado en el apartado anterior)
                $this->email->setFrom("no-reply@midominio.com", "ACCELE-RATE");

                $this->email->setSubject($subject);
                $this->email->setMessage($message .' '. $link);

                $response = array();

                if($this->email->send()){
                    $response['status'] = "OK";
                    $response['message'] = lang('Home.Se envió un correo, con las instrucciones para la actualización de la contraseña');
                }else{
                    $response['status'] = "ERROR";
                    $response['message'] = lang('Home.Email No enviado').'<br />'. $this->email->printDebugger(['headers']);
                }
            }else{
                $response['status'] = "ERROR";
                $response['message'] = lang('Home.Email No enviado, no se encuentra registrado el Email.');
            }

        }
        
        exit(json_encode($response));
    }

    public function presentation_view($user_id, $position_id){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }
        
        $employeeModel = new EmployeeModel($db);
        
        $query = $db->table('employees e');
        $query->select('e.*, u.*, cr.credential, g.gender, ci.civil_status, co.country, n.nationality, t.type_user, s.schooling, o.organization, o.quiz, d.department, p.position');
        $query->join('users u', 'u.user_id = e.user_id ', "left");
        $query->join('credentials cr', 'cr.credential_id = u.credential_id ', "left");
        $query->join('genders g', 'g.gender_id = e.gender_id ', "left");
        $query->join('civil_status ci', 'ci.civil_status_id = e.civil_status_id ', "left");
        $query->join('countries co', 'co.country_id = e.country_id ', "left");
        $query->join('nationalities n', 'n.nationality_id = e.nationality_id ', "left");
        $query->join('type_users t', 't.type_user_id = e.type_user_id ', "left");
        $query->join('schooling s', 's.schooling_id = e.schooling_id ', "left");
        $query->join('organizations o', 'o.organization_id = e.organization_id ', "left");
        $query->join('departments d', 'd.department_id = e.department_id ', "left");
        $query->join('positions p', 'p.position_id = e.position_id ', "left");
        $query->where('e.user_id', $user_id);
        $data['employee'] = $query->get()->getRowArray();

        $query = $db->table('resolutions');
        $query->select('*');
        $query->where('user_id', $user_id);
        $data['resolutions'] = $query->get()->getResultArray();

        $query = $db->table('innovations');
        $query->select('*');
        $query->where('user_id', $user_id);
        $data['innovations'] = $query->get()->getResultArray();

        // $where = 's.user_id = '.$user_id.' OR (s.position_id= '.$position_id.' AND s.created_admin != 0)';
        $where = 's.user_id = '.$user_id.'';
        $where .= ' AND s.deleted_at IS NULL';

        $query = $db->table('services s');
        $query->select('s.*, st.status service_status');
        $query->join('services_status st', 'st.service_status_id = s.status ', "left");
        $query->where($where);
        $data['services'] = $query->get()->getResultArray();

        $query = $db->table('complaints c');
        $query->select('c.*, CONCAT(ea.first_name, " ", ea.second_name,  " ", ea.last_name,  " ", ea.second_last_name) author, ea.user_id, u.profile_picture, CONCAT(er.first_name, " ", er.second_name,  " ", er.last_name,  " ", er.second_last_name) responsible, ca.category, cs.status, ct.type');
        $query->join('employees ea', 'ea.user_id  = c.created_by', "left");
        $query->join('users u', 'u.user_id = ea.user_id ', "left");
        $query->join('employees er', 'er.user_id  = c.user_id', "left");
        $query->join('categories ca', 'ca.category_id  = c.category_id', "left");
        $query->join('complaints_status cs', 'cs.complaint_status_id  = c.complaint_status_id', "left");
        $query->join('complaints_types ct', 'ct.complaint_type_id  = c.complaint_type_id ', "left");
        $query->where('c.deleted_at', NULL);
        $query->where('c.user_id', $user_id);
        $data['complaints'] = $query->get()->getResultArray();

        $query = $db->table('employees_competencies ec');
        $query->select('c.competency, ec.qualification');
        $query->join('competencies c', 'c.competency_id = ec.competency_id ', "left");
        $query->where('ec.user_id', $user_id);
        $query->orderBy('ec.qualification', 'DESC');
        $query->limit(10);
        $data['competencies'] = $query->get()->getResultArray();

        $query = $db->table('services_customers sc');
        $query->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) customer, e.user_id, u.profile_picture');
        $query->join('employees e', 'e.user_id = sc.customer_id', "left");
        $query->join('users u', 'u.user_id = e.user_id', "left");
        $query->where('sc.created_by', $user_id);
        $query->groupBy('e.user_id');
        $data['providers'] = $query->get()->getResultArray();

        $query = $db->table('tasks t');
        $query->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) name, task_id, e.user_id, u.profile_picture, t.commentary_productivity, t.commentary_quality, t.commentary_innovation, t.commentary_service, t.created_by, t.updated_at');
        $query->join('employees e', 'e.user_id = t.created_by', "left");
        $query->join('users u', 'u.user_id = e.user_id', "left");
        $query->where('t.user_id', $user_id);
        $data['comments'] = $query->get()->getResultArray();

        $satisfaction_categories = $db->table('satisfaction_categories sc');
        $satisfaction_categories->select('*');
        $data['satisfaction_categories'] = $satisfaction_categories->get()->getResultArray();

        for ($i=0; $i < count($data['satisfaction_categories']); $i++) { 
            $satisfaction_mechanisms = $db->table('satisfaction_mechanisms sm');
            $satisfaction_mechanisms->select('*');
            $satisfaction_mechanisms->where('sm.satisfaction_category_id', $data['satisfaction_categories'][$i]['satisfaction_category_id']);
            $data['satisfaction_categories'][$i]['satisfaction_mechanisms'] = $satisfaction_mechanisms->get()->getResultArray();

            for ($j=0; $j < count($data['satisfaction_categories'][$i]['satisfaction_mechanisms']); $j++) { 
                $satisfaction_responses = $db->table('satisfaction_responses sr');
                $satisfaction_responses->select('sr.*, srr.satisfaction_response_rating_id, srr.satisfaction_id, srr.user_id, srr.rating, srr.description');
                $satisfaction_responses->join('satisfaction_response_ratings srr', 'srr.satisfaction_response_id = sr.satisfaction_response_id AND srr.user_id = '.$user_id.'', "left");
                $satisfaction_responses->where('sr.satisfaction_id', $data['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['satisfaction_id']);
                $satisfaction_responses->where('sr.user_id', $user_id);
                $data['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['satisfaction_responses'] = $satisfaction_responses->get()->getResultArray();

                for ($k=0; $k < count($data['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['satisfaction_responses']); $k++) {
                    $satisfaction_responses = $db->table('satisfaction_response_ratings srr');
                    $satisfaction_responses->select('AVG(srr.rating) average_rating');
                    $satisfaction_responses->where('srr.satisfaction_id', $data['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['satisfaction_responses'][$k]['satisfaction_id']);
                    $satisfaction_responses->where('srr.user_id', $user_id);
                    $data['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['average'] = $satisfaction_responses->get()->getResultArray();
                }
            }
        }

        $query = $db->table('chiefs c');
        $query->select('c.*, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) name');
        $query->where('c.employee_user_id', $user_id);
        $query->join('employees e', 'e.user_id = c.chief_user_id', "left");
        $data['chiefs'] = $query->get()->getResultArray();
        
        for ($c=0; $c < count($data['chiefs']); $c++) {
            // $data['chiefs'][$c]['employee_user_id'];

            $satisfaction_categories = $db->table('satisfaction_categories sc');
            $satisfaction_categories->select('*');
            $data['chiefs'][$c]['satisfaction_categories'] = $satisfaction_categories->get()->getResultArray();

            for ($i=0; $i < count($data['chiefs'][$c]['satisfaction_categories']); $i++) { 
                $satisfaction_mechanisms = $db->table('satisfaction_mechanisms sm');
                $satisfaction_mechanisms->select('*');
                $satisfaction_mechanisms->where('sm.satisfaction_category_id', $data['chiefs'][$c]['satisfaction_categories'][$i]['satisfaction_category_id']);
                $data['chiefs'][$c]['satisfaction_categories'][$i]['satisfaction_mechanisms'] = $satisfaction_mechanisms->get()->getResultArray();

                for ($j=0; $j < count($data['chiefs'][$c]['satisfaction_categories'][$i]['satisfaction_mechanisms']); $j++) { 
                    $satisfaction_responses = $db->table('satisfaction_responses sr');
                    $satisfaction_responses->select('sr.*, srr.satisfaction_response_rating_id, srr.satisfaction_id, srr.user_id, srr.rating, srr.description');
                    $satisfaction_responses->join('satisfaction_response_ratings srr', 'srr.satisfaction_response_id = sr.satisfaction_response_id AND srr.user_id = sr.user_id', "left");
                    $satisfaction_responses->where('sr.satisfaction_id', $data['chiefs'][$c]['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['satisfaction_id']);
                    $satisfaction_responses->where('sr.user_id', $data['chiefs'][$c]['chief_user_id']);
                    $data['chiefs'][$c]['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['satisfaction_responses'] = $satisfaction_responses->get()->getResultArray();

                    for ($k=0; $k < count($data['chiefs'][$c]['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['satisfaction_responses']); $k++) {
                        $satisfaction_responses = $db->table('satisfaction_response_ratings srr');
                        $satisfaction_responses->select('AVG(srr.rating) average_rating');
                        $satisfaction_responses->where('srr.satisfaction_id', $data['chiefs'][$c]['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['satisfaction_responses'][$k]['satisfaction_id']);
                        $satisfaction_responses->where('srr.user_id', $data['chiefs'][$c]['chief_user_id']);
                        $data['chiefs'][$c]['satisfaction_categories'][$i]['satisfaction_mechanisms'][$j]['average'] = $satisfaction_responses->get()->getResultArray();
                    }
                }
            }
        }

        // print_r($data['satisfaction_categories']);
        // exit;

        $data['user_id'] = $user_id;
        $data['title'] = 'Empleados';
        $data['sub_title'] = 'Perfil';
        $data['custom'] = 'presentation_view';

        return view('templates/employees/presentation_view',$data);
    }

    public function add_formulario(){
        helper(['form', 'url']);
        $carpeta = './public/formularios/'.$this->request->getPost('service_id');

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $validation =  \Config\Services::validation();

        $rules = [
            'file_pdf' => [
                'label' => lang('Home.Formulario'),
                'rules' => 'uploaded[file_pdf]|max_size[file_pdf,2048]',
                'errors' => [
                    'uploaded' => lang('Home.El campo Formulario no puede estar vacio.'),
                    'max_size' => lang('Home.El archivo excede el tamaño permitido.'),
                ],
            ]
        ];

        if($this->request->getPost('file_pdf') != 'undefined'){        
            $path = $_FILES['file_pdf']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            if(!$this->validate($rules)){
                $response['status'] = "ERROR";
                $response['message'] = $validation->listErrors();
            }else{
                $response['status'] = "OK";
                $response['message'] = lang('Home.Campos validados.');
            }

            if($extension != 'pdf'){
                $response['status'] = "ERROR";
                $response['message'] = lang('Home.El archivo tiene un extención invalida.');
            }

            if ($response['status'] == "OK") {
                $imageFile = $this->request->getFile('file_pdf');
                $newName = $imageFile->getRandomName();
                $imageFile->move($carpeta, $newName);

                $data = [
                    'file_pdf' => $newName,
                    'modified_by'  => $this->session->get('user_id'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];

                $serviceModel = new ServiceModel($db);
                $query = $serviceModel->set($data)->where('service_id', $this->request->getPost('service_id'))->update();

                $response['status'] = "OK";
                $response['message'] = lang('Home.Se actualizó el documento del formulario correctamente. Favor de recargar la página.');
            }
        }else{
            $response['status'] = "ERROR";
            $response['message'] = lang('Home.El campo Formulario no puede estar vacio.');
        }

        
        exit(json_encode($response));
    }

    public function get_estadisticas(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('users');
        $query->select('user_id, profile_picture');
        $query->where('user_id', $this->request->getPost('user_id'));
        $res['employee'] = $query->get()->getRowArray();

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service');
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        $query->where('t.user_id', $this->request->getPost('user_id'));
        $tasks = $query->get()->getRowArray();

        $res['estadisticas']['average_productivity'] = round($tasks['average_productivity'], 2);
        $res['estadisticas']['average_quality'] = round($tasks['average_quality'], 2);
        $res['estadisticas']['average_innovation'] = round($tasks['average_innovation'], 2);
        $res['estadisticas']['average_service'] = round($tasks['average_service'], 2);

        $query = $db->table('tasks t');
        $query->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) name, e.user_id, e.position_id, AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service');
        $query->join('services s', 's.service_id = t.service_id ', "left");
        $query->join('employees e', 'e.user_id = s.user_id ', "left");
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        $query->where('s.position_id', $this->request->getPost('position_id'));
        $query->where('e.position_id', $this->request->getPost('position_id'));
        $query->groupBy('e.user_id');
        $res['tasks_general'] = $query->get()->getResultArray();

        $diaSemana = date("w");
        $tiempoDeInicioDeSemana = strtotime("-" . $diaSemana . " days");
        $fechaInicioSemana = date("Y-m-d", $tiempoDeInicioDeSemana);
        $fechaInicioSemana = date("Y-m-d",strtotime($fechaInicioSemana."+ 1 days"));
        $fechaFinSemana = date("Y-m-d",strtotime($fechaInicioSemana."+ 6 days"));

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service');
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        $query->where('t.user_id', $this->request->getPost('user_id'));
        $query->where('t.created_at >=', $fechaInicioSemana.' 00:00:00');
        $query->where('t.created_at <=', $fechaFinSemana.' 23:59:59');
        $res['semanal'] = $query->get()->getRowArray();

        $res['promedio'] = round(($tasks['average_productivity'] + $tasks['average_quality'] + $tasks['average_innovation'] + $tasks['average_service']) / 4, 2);
        exit(json_encode($res));
    }

    public function cargar_excel_mecanismos(){
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $rules = [
            'archivo_excel' => [
                'label' => lang('Home.Archivo de mecanismos de satisfacción'),
                'rules' => 'uploaded[archivo_excel]|ext_in[archivo_excel,xlsx]',
                'errors' => [
                    'uploaded' => lang('Home.El campo Archivo de mecanismos de satisfacción no puede estar vacio.'),
                    'ext_in'  => lang('Home.El archivo tiene un extención invalida.'),
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
            $response['data'] = '';
        }else{
            $file_data = $this->request->getFile('archivo_excel');

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            $spreadsheet = $reader->load($file_data);
            $data_values = $spreadsheet->getActiveSheet()->toArray();

            if(!empty($data_values)){
                $j = 0;

                for ($i = 1; $i < count($data_values); $i++) { 
                    $response['data'][$j]['satisfaction_id'] = $i;
                    $response['data'][$j]['user_id'] = $this->session->get('user_id');
                    $response['data'][$j]['response'][0] = $data_values[$i][1];
                    $response['data'][$j]['response'][1] = $data_values[$i][2];
                    $response['data'][$j]['response'][2] = $data_values[$i][3];
                    $response['data'][$j]['response'][3] = $data_values[$i][4];
                    $response['data'][$j]['response'][4] = $data_values[$i][5];
                    $response['data'][$j]['created_by']  = $this->session->get('user_id');

                    $num = $i;

                    if($response['data'][$j]['response'][0] == '' || $response['data'][$j]['response'][0] == NULL){
                        $response['status'] = "ERROR";
                        $response['message'] = lang('Home.Favor de llenar la respuesta # 1, de la pregunta #').''.$num;
                        exit(json_encode($response));
                    }
                    if($response['data'][$j]['response'][1] == '' || $response['data'][$j]['response'][1] == NULL){
                        $response['status'] = "ERROR";
                        $response['message'] = lang('Home.Favor de llenar la respuesta # 2, de la pregunta #').''.$num;
                        exit(json_encode($response));
                    }
                    if($response['data'][$j]['response'][2] == '' || $response['data'][$j]['response'][2] == NULL){
                        $response['status'] = "ERROR";
                        $response['message'] = lang('Home.Favor de llenar la respuesta # 3, de la pregunta #').''.$num;
                        exit(json_encode($response));
                    }
                    if($response['data'][$j]['response'][3] == '' || $response['data'][$j]['response'][3] == NULL){
                        $response['status'] = "ERROR";
                        $response['message'] = lang('Home.Favor de llenar la respuesta # 4, de la pregunta #').''.$num;
                        exit(json_encode($response));
                    }
                    if($response['data'][$j]['response'][4] == '' || $response['data'][$j]['response'][4] == NULL){
                        $response['status'] = "ERROR";
                        $response['message'] = lang('Home.Favor de llenar la respuesta # 5, de la pregunta #').''.$num;
                        exit(json_encode($response));
                    }

                    $j++;
                }

                $response['status'] = "OK";
                $response['message'] = lang('Home.Los datos se leyeron correctamente.');
            }else{
                $response['status'] = "ERROR";
                $response['message'] = lang('Home.El archivo no contiene datos.');
                $response['data'] = '';
            }
        }

        exit(json_encode($response));
    }

    public function eliminar_mecanismos(){
        $satisfactionResponseModel = new SatisfactionResponseModel($db);
        $res = $satisfactionResponseModel->where('user_id', $this->session->get('user_id'))->delete();
        exit(json_encode($res));
    }

    public function guardar_respuestas_mecanismos(){
        for($i = 0; $i < count($this->request->getPost('response')) ; $i++){ 
            $data = [
                'satisfaction_id'  => $this->request->getPost('satisfaction_id'),
                'user_id'  => $this->session->get('user_id'),
                'response'      => $_POST['response'][$i],
                'created_by'  => $this->session->get('user_id'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            $satisfactionResponseModel = new SatisfactionResponseModel($db);
            $query = $db->table('satisfaction_responses')->insert($data);
        }

        exit(json_encode($query));
    }

    public function guardar_calificacion(){
        $validation =  \Config\Services::validation();
        $rules = [
            'description' => [
                'label'  => lang('Home.Descripción'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Descripción no puede estar vacio.'),
                ],
            ],
            'rating' => [
                'label'  => lang('Home.Calificación'),
                'rules'  => 'trim|required|less_than_equal_to[101]',
                'errors' => [
                    'required' => lang('Home.El campo Calificación no puede estar vacio.'),
                    'less_than_equal_to' => lang('Home.La calificación no puede ser mayor a 100.')
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $satisfactionResponseRatingModel = new SatisfactionResponseRatingModel($db);

            if(empty($this->request->getPost('satisfaction_response_rating_id'))){
                $data = [
                    'satisfaction_response_id'  => $this->request->getPost('satisfaction_response_id'),
                    'satisfaction_id'  => $this->request->getPost('satisfaction_id'),
                    'description'  => $this->request->getPost('description'),
                    'rating'  => $this->request->getPost('rating'),
                    'user_id'  => $this->request->getPost('user_id'),
                    'created_by'  => $this->session->get('user_id'),
                    'created_at'  => date('Y-m-d H:i:s')
                ];

                $query = $db->table('satisfaction_response_ratings')->insert($data);

                $satisfaction_response_rating_id = $db->insertID();

            }else{
                $data = [
                    'satisfaction_response_id'  => $this->request->getPost('satisfaction_response_id'),
                    'satisfaction_id'  => $this->request->getPost('satisfaction_id'),
                    'description'  => $this->request->getPost('description'),
                    'rating'  => $this->request->getPost('rating'),
                    'user_id'  => $this->request->getPost('user_id'),
                    'modified_by'  => $this->session->get('user_id'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];

                $query = $satisfactionResponseRatingModel->set($data)->where('satisfaction_response_rating_id', $this->request->getPost('satisfaction_response_rating_id'))->update();

                $satisfaction_response_rating_id = $this->request->getPost('satisfaction_response_id');
            }

            $query = $db->table('satisfaction_response_ratings');
            $query->select('*');
            $query->where('satisfaction_response_rating_id', $satisfaction_response_rating_id);
            $query = $query->get()->getRowArray();

            $response['status'] = "OK";
            $response['message'] = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($response));
    }

    public function get_departamentos_puestos(){
        $employeeModel = new EmployeeModel($db);

        $query = $db->table('positions p');
        $query->select('*');
        $query->where('p.organization_id', $this->request->getPost('organization_id'));
        $query->where('p.deleted_at', NULL);
        $query->orderBy('p.position', 'ASC');
        $res['positions'] = $query->get()->getResultArray();

        $query = $db->table('departments d');
        $query->select('*');
        $query->where('d.organization_id', $this->request->getPost('organization_id'));
        $query->where('d.deleted_at', NULL);
        $query->orderBy('d.department', 'ASC');
        $res['departments'] = $query->get()->getResultArray();

        exit(json_encode($res));
    }

    public function get_servicios(){
        $serviceModel = new ServiceModel($db);

        $query = $db->table('tasks t');
        $query->select('COUNT(*) total');
        $query->join('services s', 's.service_id = t.service_id', "left");
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        $query->where('t.user_id', $this->request->getPost('user_id'));
        $res['total'] = $query->get()->getRowArray();

        $query = $db->table('services s');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, s.weighing, s.description service, t.updated_at');
        $query->join('tasks t', 's.service_id = t.service_id', "left");
        $query->where('s.user_id', $this->request->getPost('user_id'));
        $query->where('s.deleted_at', NULL);
        $query->groupBy('s.service_id');
        $res['tasks_weighings'] = $query->get()->getResultArray();

        exit(json_encode($res));
    }

    public function ver_respuestas_empleados(){
        $serviceModel = new ServiceModel($db);

        $query = $db->table('satisfaction_response_ratings srr');
        $query->select('*');
        $query->where('srr.satisfaction_response_id', $this->request->getPost('satisfaction_response_id'));
        $res = $query->get()->getResultArray();

        exit(json_encode($res));  
    }
}