<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PositionModel;

class Positions extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

	public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $positionModel = new PositionModel($db);

        $query = $db->table('organizations o');
        $query->select('*');
        $query->where('o.deleted_at', NULL);
        if($this->session->get('user_id') != 1){
            $query->where('o.organization_id', $this->session->get('organization_id'));
        }
        $data['organizations'] = $query->get()->getResultArray();

        $query = $db->table('positions p');
        $query->select('p.*, o.organization');
        $query->join('organizations o', 'o.organization_id = p.organization_id', "left");
        $query->where('p.deleted_at', NULL);
        if($this->session->get('user_id') != 1){
            $query->where('o.organization_id', $this->session->get('organization_id'));
        }
        $data['positions'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Puestos');
        $data['sub_title'] = lang('Home.Puestos');
		$data['custom'] = 'positions';
        $data['content'] = 'positions/positions_view';

        return view('templates/common/Layout_view',$data);

	}

    public function validar_form(){
        $validation =  \Config\Services::validation();
        $rules = [
                'position' => [
                    'label'  => lang('Home.Puesto'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Puesto no puede estar vacio.'),
                    ],
                ],
                'organization_id' => [
                    'label'  => lang('Home.Organización'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Organización no puede estar vacio.'),
                    ],
                ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $response['status'] = "OK";
            $response['message'] = lang('Home.Campos validados.');

            $positionModel = new PositionModel($db);

            $query = $positionModel->table('positions');
            $query->select('*');
            $query->where('organization_id', $this->request->getPost('organization_id'));
            $query->where('position', $this->request->getPost('position'));
            $validar_nombre = $query->get()->getRowArray();

            if(!empty($validar_nombre)){
                if($validar_nombre['position_id'] != $this->request->getPost('position_id')){
                    $response['status'] = "ERROR";
                    $response['message'] = lang('Home.No puede existir más de un puesto con el mismo nombre, dentro de la organización.');
                }
            }
        }

        exit(json_encode($response));
    }

    public function form_datos(){
        $data = [
            'position' => $this->request->getPost('position'),
            'organization_id'  => $this->request->getPost('organization_id'),
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $positionModel = new PositionModel($db);

        if(empty($this->request->getPost('position_id'))){
            $query = $db->table('positions')->insert($data);
        }else{
            $query = $positionModel->set($data)->where('position_id', $this->request->getPost('position_id'))->update();
        }

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($res));
    }

    public function eliminar_datos(){
        $positionModel = new PositionModel($db);
        $res = $positionModel->where('position_id', $this->request->getPost('position_id'))->delete();
        exit(json_encode($res));
    }

}
