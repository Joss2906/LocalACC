<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ComplaintModel;

class Complaints extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

	public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $complaintModel = new ComplaintModel($db);

        $query = $db->table('categories');
        $query->select('*');
        $data['categories'] = $query->get()->getResultArray();

        $query = $db->table('complaints_types');
        $query->select('*');
        $data['types'] = $query->get()->getResultArray();

        $query = $db->table('users u');
        $query->select('*, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) responsible');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('e.user_id !=', $this->session->get('user_id'));
        $data['employees'] = $query->get()->getResultArray();

        $query = $db->table('complaints c');
        $query->select('c.*, CONCAT(ea.first_name, " ", ea.second_name,  " ", ea.last_name,  " ", ea.second_last_name) author, CONCAT(er.first_name, " ", er.second_name,  " ", er.last_name,  " ", er.second_last_name) responsible, ca.category, cs.status, ct.type');
        $query->join('employees ea', 'ea.user_id  = c.created_by', "left");
        $query->join('employees er', 'er.user_id  = c.user_id', "left");
        $query->join('categories ca', 'ca.category_id  = c.category_id', "left");
        $query->join('complaints_status cs', 'cs.complaint_status_id  = c.complaint_status_id', "left");
        $query->join('complaints_types ct', 'ct.complaint_type_id  = c.complaint_type_id ', "left");
        $query->where('c.deleted_at', NULL);
        $query->where('c.created_by', $this->session->get('user_id'));
        $data['complaints'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Mis quejas');
        $data['sub_title'] = 'Quejas';
		$data['custom'] = 'complaints';
        $data['content'] = 'complaints/complaints_view';

        return view('templates/common/Layout_view',$data);

	}

    public function validar_form(){
        $validation =  \Config\Services::validation();
        $rules = [
            'complaint_type_id' => [
                'label'  => lang('Home.Tipo de queja'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Tipo de queja no puede estar vacío.'),
                ],
            ],
            'category_id' => [
                'label'  => lang('Home.Categoria'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Categoria no puede estar vacío.'),
                ],
            ],
            'user_id' => [
                'label'  => lang('Home.Empleado'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Empleado no puede estar vacío.'),
                ],
            ],
            'complaint' => [
                'label'  => lang('Home.Queja'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Queja no puede estar vacío.'),
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
            'complaint_type_id' => $this->request->getPost('complaint_type_id'),
            'category_id' => $this->request->getPost('category_id'),
            'user_id'     => $this->request->getPost('user_id'),
            'complaint'   => $this->request->getPost('complaint'),
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $complaintModel = new ComplaintModel($db);

        if(empty($this->request->getPost('complaint_id'))){
            $query = $db->table('complaints')->insert($data);
        }else{
            $query = $complaintModel->set($data)->where('complaint_id', $this->request->getPost('complaint_id'))->update();
        }

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($res));
    }

    public function eliminar_datos(){
        $complaintModel = new ComplaintModel($db);
        $res = $complaintModel->where('complaint_id', $this->request->getPost('complaint_id'))->delete();
        exit(json_encode($res));
    }

    public function complaints_towards_me_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $complaintModel = new ComplaintModel($db);

        $query = $db->table('complaints c');
        $query->select('c.*, CONCAT(ea.first_name, " ", ea.second_name,  " ", ea.last_name,  " ", ea.second_last_name) author, CONCAT(er.first_name, " ", er.second_name,  " ", er.last_name,  " ", er.second_last_name) responsible, ca.category, cs.status, ct.type');
        $query->join('employees ea', 'ea.user_id  = c.created_by', "left");
        $query->join('employees er', 'er.user_id  = c.user_id', "left");
        $query->join('categories ca', 'ca.category_id  = c.category_id', "left");
        $query->join('complaints_status cs', 'cs.complaint_status_id  = c.complaint_status_id', "left");
        $query->join('complaints_types ct', 'ct.complaint_type_id  = c.complaint_type_id ', "left");
        $query->where('c.deleted_at', NULL);
        $query->where('c.user_id', $this->session->get('user_id'));
        $data['complaints'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Quejas hacia mí');
        $data['sub_title'] = 'Quejas';
        $data['custom'] = 'complaints';
        $data['content'] = 'complaints/complaints_towards_me_view';

        return view('templates/common/Layout_view',$data);
    }

    public function cambiar_status(){
        $data = [
            'complaint_status_id' => $this->request->getPost('complaint_status_id'),
            'modified_by'  => $this->session->get('user_id'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        $complaintModel = new ComplaintModel($db);

        $query = $complaintModel->set($data)->where('complaint_id', $this->request->getPost('complaint_id'))->update();

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($res));   
    }

    public function complaints_my_employees_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $complaintModel = new ComplaintModel($db);

        $data['complaints'] = '';

        $query = $db->table('users u');
        $query->select('e.user_id');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->join('chiefs c', 'c.employee_user_id = u.user_id', "left");
        $query->where('c.chief_user_id', $this->session->get('user_id'));
        $data['employees'] = $query->get()->getResultArray();

        if(!empty($data['employees'])){
            $query = $db->table('complaints c');
            $query->select('c.*, CONCAT(ea.first_name, " ", ea.second_name,  " ", ea.last_name,  " ", ea.second_last_name) author, CONCAT(er.first_name, " ", er.second_name,  " ", er.last_name,  " ", er.second_last_name) responsible, ca.category, cs.status, ct.type');
            $query->join('employees ea', 'ea.user_id  = c.created_by', "left");
            $query->join('employees er', 'er.user_id  = c.user_id', "left");
            $query->join('categories ca', 'ca.category_id  = c.category_id', "left");
            $query->join('complaints_status cs', 'cs.complaint_status_id  = c.complaint_status_id', "left");
            $query->join('complaints_types ct', 'ct.complaint_type_id  = c.complaint_type_id ', "left");

            $condition = '';
            
            for($i=0; $i < count($data['employees']); $i++) {
                $condition .= ' c.created_by ='.$data['employees'][$i]['user_id'].' OR';
            }

            $condition = substr($condition, 0, -2);
            $query->where('('.$condition.')');
            
            $query->where('c.deleted_at', NULL);

            $data['complaints'] = $query->get()->getResultArray();
        }


        $data['title'] = lang('Home.Quejas de mis empleados');
        $data['sub_title'] = lang('Home.Quejas');
        $data['custom'] = 'complaints';
        $data['content'] = 'complaints/complaints_my_employees_view';

        return view('templates/common/Layout_view',$data);
    }

}
