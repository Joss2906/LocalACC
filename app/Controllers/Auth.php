<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends BaseController {

    public $session = NULL;

    public function __construct(){
        helper('form');
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index(){        
        if ($this->session != NULL){
            if ($this->session->get('is_logued_in')) {
                return redirect()->to(base_url().'/employees');
            }
        }

        $data['title']            = 'Iniciar Sesión'; 
        $data['breadcrumb_title'] = 'Iniciar Sesión';
        $data['breadcrumb_sub']   = 'Iniciar Sesión'; 
        $data['custom']           = 'auth'; 
        return view('templates/auth/login_view',$data);
    } 

    public function login_auth(){
        // dd($this->request->getPost());
        
        $response = array();
        $userModel = new UserModel($db);
        helper(['form']);
        $validation =  \Config\Services::validation();
        $rules = [
                'user' => [
                    'label'  => lang("Home.Usuario"),
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field}-'.lang('Home.El campo no puede estar vacio.'),
                    ],
                ],
                'password' => [
                    'label'  => lang("Home.Contraseña"),
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field}-'.lang('Home.El campo no puede estar vacio.'),
                    ],
                ]
        ];

        var_dump('xxx');

        if(!$this->validate($rules)){
            var_dump('1');
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            var_dump('2');
            try {
            $query = $db->table('employees e');
            $query->select('e.*, u.user, u.language, cr.credential_id, cr.credential, t.type_user, o.organization, d.department, p.position, b.maturity_id, b.maturity');
            $query->join('users u', 'u.user_id = e.user_id', "left");
            $query->join('credentials cr', 'cr.credential_id = u.credential_id', "left");
            $query->join('civil_status ci', 'ci.civil_status_id = e.civil_status_id', "left");
            $query->join('countries co', 'co.country_id = e.country_id', "left");
            $query->join('nationalities n', 'n.nationality_id = e.nationality_id', "left");
            $query->join('type_users t', 't.type_user_id = e.type_user_id', "left");
            $query->join('schooling s', 's.schooling_id = e.schooling_id', "left");
            $query->join('organizations o', 'o.organization_id = e.organization_id', "left");
            $query->join('business_maturity b', 'b.maturity_id = o.maturity_id', "left");
            $query->join('departments d', 'd.department_id = e.department_id', "left");
            $query->join('positions p', 'p.position_id = e.position_id', "left");
            // $query->where('u.deleted_at', NULL);
            $query->where('user', $this->request->getPost('user'));
            $query->where('password', md5($this->request->getPost('password')));

            // $response = $query->get()->getRowArray();
            
            
                $response = $query->get()->getRowArray();
            } catch (Exception $e) {
                var_dump($e->getMessage());
                exit;
                $response = [];
            }

            if(!empty($response)){
                if($response['deleted_at'] == NULL){
                    $data = array(
                        'is_logued_in'    => 1,
                        'user_id'         => $response['user_id'],
                        'nombre'          => $response['first_name'].' '.$response['second_name'].' '.$response['last_name'].' '.$response['second_last_name'],
                        'maturity_id'     => $response['maturity_id'],
                        'maturity'        => $response['maturity'],
                        'salary_total'    => $response['total'],
                        'credential_id'   => $response['credential_id'],
                        'credential'      => $response['credential'],
                        'type_user_id'    => $response['type_user_id'],
                        'type_user'       => $response['type_user'],
                        'organization_id' => $response['organization_id'],
                        'organization'    => $response['organization'],
                        'department_id'   => $response['department_id'],
                        'department'      => $response['department'],
                        'position_id'     => $response['position_id'],
                        'language'        => $response['language'],
                        'position'        => $response['position']
                    );

                    $this->session->set($data);
                    $response['status'] = "OK";
                    $response['message'] = lang("Home.Bienvenido.");  
                    $response['user_id'] = $response['user_id'];  
                }else{
                    $response['status'] = "ERROR";
                    $response['message'] = lang("Home.Su usuario se encuentra desactivado.");  
                }
            }else{
                var_dump('smth');
                $response['status'] = "ERROR";
                $response['message'] = lang("Home.El usuario o contraseña es incorrecto.");
            }
        }
        // debug($response);
        // exit;
        var_dump($response);

        exit(json_encode($response));
    } 

    public function logout(){
        $this->session->destroy();
        return redirect()->to(base_url());
    }

    public function recuperar_view($email){
        $userModel = new UserModel($db);

        $email = base64_decode($email);

        $query = $db->table('employees e');
        $query->select('e.email, u.user_id, u.recover');
        $query->join('users u', 'u.user_id = e.user_id', "left");
        $query->where('email', $email);
        $data['employee'] = $query->get()->getResultArray();

        if($data['employee'][0]['recover'] == 1){
            return view('templates/auth/recuperar_view',$data);
        }else{
           return redirect()->to(base_url());
        }
    }

    public function actualizar_password(){
        $userModel = new UserModel($db);

        if(empty($this->request->getPost('password'))){
            $response['status'] = "ERROR";
            $response['message'] = lang("Home.La contraseña no puede estar vacia."); 
        }else{
            if(strlen($this->request->getPost('password')) < 6){
                $response['status'] = "ERROR";
                $response['message'] = lang("Home.La contraseña no puede ser menor a 6 caracteres.");
            }else{            
                $data = [
                    'recover' => NULL,
                    'password'  => md5($this->request->getPost('password')),
                    'modified_by'  => $this->session->get('user_id'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];

                $query = $userModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();
                $response['status'] = "OK";
                $response['message'] = lang("Home.La contraseña se actualizo correctamente.");
            }
        }

        exit(json_encode($response));
    }

    public function change_language(){
        $data['language'] = $this->request->getPost('language');
        $this->session->set($data);        
        $userModel = new UserModel($db);
        $query = $userModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();

        exit(json_encode($data['language']));
    }

}


