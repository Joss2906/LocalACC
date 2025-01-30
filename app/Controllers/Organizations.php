<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrganizationModel;

class Organizations extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

	public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $organizationModel = new OrganizationModel($db);

        $query = $db->table('business_maturity');
        $query->select('*');
        $data['business_maturity'] = $query->get()->getResultArray();

        $query = $db->table('organizations o');
        $query->select('o.*, b.maturity');
        $query->join('business_maturity b', 'b.maturity_id  = o.maturity_id ', "left");
        $query->where('o.deleted_at', NULL);
        if($this->session->get('user_id') != 1){
            $query->where('o.organization_id', $this->session->get('organization_id'));
        }

        $data['organizations'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Organizaciones');
        $data['sub_title'] = lang('Home.Organizaciones');
		$data['custom'] = 'organizations';
        $data['content'] = 'organizations/organizations_view';

        return view('templates/common/Layout_view',$data);

	}

    public function validar_form(){
        $validation =  \Config\Services::validation();
        $rules = [
                'organization' => [
                    'label'  => lang('Home.Organización'),
                    'rules'  => 'trim|required|is_unique[organizations.organization, organization_id, {organization_id}]',
                    'errors' => [
                        'required' => lang('Home.El campo Organización no puede estar vacio.'),
                        'is_unique' => lang('Home.El campo Organización ya se encuentra registrado en el sistema, favor de intentar con una organización diferente.'),
                    ],
                ],
                'maturity_id' => [
                    'label'  => 'Madurez empresarial',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Madurez empresarial no puede estar vacio.'),
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

        if(isset($_POST['quiz'])){
            $quiz = 1;
        }else{
            $quiz = 0;
        }
        
        $data = [
            'organization' => $this->request->getPost('organization'),
            'maturity_id'  => $this->request->getPost('maturity_id'),
            'quiz'  => $quiz,
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $organizationModel = new OrganizationModel($db);

        if(empty($this->request->getPost('organization_id'))){
            $query = $db->table('organizations')->insert($data);
        }else{
            $query = $organizationModel->set($data)->where('organization_id', $this->request->getPost('organization_id'))->update();
        }

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($res));
    }

    public function eliminar_datos(){
        $organizationModel = new OrganizationModel($db);
        $res = $organizationModel->where('organization_id', $this->request->getPost('organization_id'))->delete();
        exit(json_encode($res));
    }

}
