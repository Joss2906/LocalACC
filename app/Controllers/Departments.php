<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DepartmentModel;

class Departments extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

	public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $departmentModel = new DepartmentModel($db);

        $query = $db->table('organizations o');
        $query->select('*');
        $query->where('o.deleted_at', NULL);
        if($this->session->get('user_id') != 1){
            $query->where('o.organization_id', $this->session->get('organization_id'));
        }
        $data['organizations'] = $query->get()->getResultArray();

        $query = $db->table('departments d');
        $query->select('d.*, o.organization');
        $query->join('organizations o', 'o.organization_id = d.organization_id', "left");
        $query->where('d.deleted_at', NULL);
        if($this->session->get('user_id') != 1){
            $query->where('o.organization_id', $this->session->get('organization_id'));
        }
        $data['departments'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Departamentos');
        $data['sub_title'] = lang('Home.Departamentos');
		$data['custom'] = 'departments';
        $data['content'] = 'departments/departments_view';

        return view('templates/common/Layout_view',$data);

	}

    public function validar_form(){
        $validation =  \Config\Services::validation();
        $rules = [
                'department' => [
                    'label'  => lang('Home.Departamento'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Departamento no puede estar vacío.'),
                    ],
                ],
                'organization_id' => [
                    'label'  => lang('Home.Organización'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Organización no puede estar vacío.'),
                    ],
                ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $response['status'] = "OK";
            $response['message'] = lang('Home.Campos validados.');

            $departmentModel = new DepartmentModel($db);

            $query = $departmentModel->table('departments');
            $query->select('*');
            $query->where('organization_id', $this->request->getPost('organization_id'));
            $query->where('department', $this->request->getPost('department'));
            $validar_nombre = $query->get()->getRowArray();

            if(!empty($validar_nombre)){
                if($validar_nombre['department_id'] != $this->request->getPost('department_id')){
                    $response['status'] = "ERROR";
                    $response['message'] = lang('Home.No puede existir más de un departamento con el mismo nombre, dentro de la organización.');
                }
            }
        }

        exit(json_encode($response));
    }

    public function form_datos(){
        $data = [
            'department' => $this->request->getPost('department'),
            'organization_id'  => $this->request->getPost('organization_id'),
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $departmentModel = new DepartmentModel($db);

        if(empty($this->request->getPost('department_id'))){
            $query = $db->table('departments')->insert($data);
        }else{
            $query = $departmentModel->set($data)->where('department_id', $this->request->getPost('department_id'))->update();
        }

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($res));
    }

    public function eliminar_datos(){
        $departmentModel = new DepartmentModel($db);
        $res = $departmentModel->where('department_id', $this->request->getPost('department_id'))->delete();
        exit(json_encode($res));
    }

}
