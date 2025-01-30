<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ChiefModel;

class Chiefs extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $chiefModel = new ChiefModel($db);

        $query = $db->table('chiefs ch');
        $query->select('ch.*, o.organization, CONCAT(c.first_name, " ", c.second_name, " ", c.last_name, " ", c.second_last_name) chief, CONCAT(e.first_name, " ", e.second_name, " ", e.last_name, " ", e.second_last_name) employee');
        $query->join('organizations o', 'o.organization_id = ch.organization_id', "left");
        $query->join('employees c', 'c.user_id = ch.chief_user_id', "left");
        $query->join('employees e', 'e.user_id = ch.employee_user_id', "left");
        if($this->session->get('user_id') != 1){
            $query->where('c.organization_id', $this->session->get('organization_id'));
        }
        $data['chiefs'] = $query->get()->getResultArray();

        $query = $db->table('organizations');
        $query->select('*');
        if($this->session->get('user_id') != 1){
            $query->where('organization_id', $this->session->get('organization_id'));
        }
        $query->where('deleted_at', NULL);
        $data['organizations'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Jefe/Empleado');
        $data['sub_title'] = 'Jefe/Empleado';
        $data['custom'] = 'chiefs';
        $data['content'] = 'chiefs/chiefs_view';

        return view('templates/common/Layout_view',$data);
    }

    public function validar_form(){
        $validation =  \Config\Services::validation();
        $rules = [
                'organization_id' => [
                    'label'  => lang('Home.Organización'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Organización no puede estar vacío.'),
                    ],
                ],
                'chief_user_id' => [
                    'label'  => lang('Home.Jefe'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Jefe no puede estar vacío.'),
                    ],
                ],
                'employee_user_id' => [
                    'label'  => lang('Home.Empleado'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Empleado no puede estar vacío.'),
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

    public function form_datos(){
        $data = [
            'organization_id'  => $this->request->getPost('organization_id'),
            'chief_user_id'  => $this->request->getPost('chief_user_id'),
            'employee_user_id'  => $this->request->getPost('employee_user_id'),
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $chiefModel = new ChiefModel($db);

        if(empty($this->request->getPost('chief_id'))){
            $query = $db->table('chiefs')->insert($data);
        }else{
            $query = $chiefModel->set($data)->where('chief_id', $this->request->getPost('chief_id'))->update();
        }

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($res));
    }

    public function eliminar_datos(){
        $chiefModel = new ChiefModel($db);
        $res = $chiefModel->where('chief_id', $this->request->getPost('chief_id'))->delete();
        exit(json_encode($res));
    }

    public function get_empleados(){
        $chiefModel = new ChiefModel($db);
        $query = $db->table('users u');
        $query->select('*');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        if($this->session->get('user_id') != 1){
            $query->where('organization_id', $this->session->get('organization_id'));
        }else{
            $query->where('organization_id', $this->request->getPost('organization_id'));
        }
        $query->where('u.credential_id <', 4);
        $res['jefes'] = $query->get()->getResultArray();

        $query = $db->table('users u');
        $query->select('*');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->where('organization_id', $this->request->getPost('organization_id'));
        if($this->session->get('user_id') != 1){
            $query->where('organization_id', $this->session->get('organization_id'));
        }else{
            $query->where('organization_id', $this->request->getPost('organization_id'));
        }
        // $query->where('u.credential_id >', 1);
        // $query->where('u.credential_id <', 5);
        $res['empleados'] = $query->get()->getResultArray();

        exit(json_encode($res));
    }

    public function bloquear_opcion(){
        $chiefModel = new ChiefModel($db);

        $query = $db->table('chiefs ch');
        $query->select('COUNT(*) total');
        $query->where('ch.chief_user_id', $this->request->getPost('chief_user_id'));
        $query->where('ch.employee_user_id', $this->request->getPost('employee_user_id'));
        $data = $query->get()->getRowArray();

        exit(json_encode($data));
    }

}
