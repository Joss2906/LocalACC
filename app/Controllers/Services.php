<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ServiceModel;
use App\Models\ServiceCustomerModel;
use App\Models\ServiceCompetitorModel;
use App\Models\EmployeeModel;

class Services extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

	public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $serviceModel = new ServiceModel($db);

        $query = $db->table('services s');
        $query->select('s.*, o.organization, p.position, ss.status status_service, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) author');
        $query->join('organizations o', 'o.organization_id = s.organization_id', "left");
        $query->join('positions p', 'p.position_id = s.position_id', "left");
        $query->join('services_status ss', 'ss.service_status_id = s.status', "left");
        $query->where('s.deleted_at', NULL);

        if($_SESSION['credential_id'] != 1){
            $query->join('employees e', 'e.user_id = s.user_id', "left");
            $query->where('s.user_id', $this->session->get('user_id'));
        }else{
            $query->join('employees e', 'e.user_id = s.user_id', "left");
            $query->where('s.created_by', $this->session->get('user_id'));
            $query->orwhere("(s.deleted_at IS NULL AND s.position_id = ".$this->session->get('position_id')." AND created_admin = 1 AND s.user_id =".$this->session->get('user_id').")");
        }
        
        $data['services'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Funciones o servicios');
        $data['sub_title'] = lang('Home.Servicios');
		$data['custom'] = 'services';
        $data['content'] = 'services/services_view';

        return view('templates/common/Layout_view',$data);
	}

    public function form_view($service_id){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $serviceModel = new ServiceModel($db);

        $query = $db->table('organizations');
        $query->select('*');
        if($this->session->get('user_id') != 1){
            $query->where('organization_id', $this->session->get('organization_id'));
        }
        $query->where('deleted_at', NULL);
        $query->orderBy('organization', 'ASC');
        $data['organizations'] = $query->get()->getResultArray();

        $query = $db->table('users u');
        $query->select('*');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('e.user_id !=', $this->session->get('user_id'));
        $data['employees'] = $query->get()->getResultArray();

        $query = $db->table('services s');
        $query->select('*');
        $query->where('s.service_id', $service_id);
        $data['service'] = $query->get()->getRowArray();

        if(empty($data['service'])){
            $data['service']['service_id'] = '';
            $data['service']['organization_id'] = '';
            $data['service']['description'] = '';
            $data['service']['frequency'] = '';
            $data['service']['user_id'] = '';
            $data['service']['position_id'] = '';
            $data['service']['monthly_amount'] = '';
            $data['service']['productivity'] = '';
            $data['service']['quality'] = '';
            $data['service']['innovation'] = '';
            $data['service']['service'] = '';
            $data['service']['employee_cost'] = '';
        }

        $data['title'] = lang('Home.Servicios');
        $data['sub_title'] = lang('Home.Agregar servicios');
        $data['custom'] = 'services';
        $data['content'] = 'services/form_view';

        return view('templates/common/Layout_view',$data);
    }

    public function get_clientes_competidores(){
        $serviceModel = new ServiceModel($db);

        $query = $db->table('services_customers s');
        $query->select('s.*, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) user, p.position');
        $query->join('employees e', 'e.user_id = s.customer_id', "left");
        $query->join('positions p', 'p.position_id = s.position_customer_id', "left");
        $query->where('s.service_id', $this->request->getPost('service_id'));
        $res['services_customers'] = $query->get()->getResultArray();

        $query = $db->table('services_competitors s');
        $query->select('*');
        $query->where('s.service_id', $this->request->getPost('service_id'));
        $res['services_competitors'] = $query->get()->getResultArray();

        exit(json_encode($res));
    }

    public function validar_form(){
        $required_user_id = '';
        $errors_user_id = '';
        if(isset($_POST['user_id'])){                
            $required_user_id = 'required';
            $errors_user_id = lang('Home.El campo Empleado no puede estar vacio.');
        }

        $required_position_id = '';
        $errors_position_id = '';
        if(isset($_POST['position_id'])){                
            $required_position_id = 'required';
            $errors_position_id = lang('Home.El campo Posición no puede estar vacio.');
        }

        $required_employee_cost = '';
        $errors_employee_cost = '';
        if(isset($_POST['position_id']) && isset($_POST['employee_cost'])){                
            $required_employee_cost = 'required';
            $errors_employee_cost = lang('Home.El campo Costo del empleado no puede estar vacio.');
        }

        $validation =  \Config\Services::validation();
        $rules = [
            'organization_id' => [
                'label'  => lang('Home.Organización'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Organización no puede estar vacio.'),
                ],
            ],
            'user_id' => [
                'label'  => lang('Home.Empleado'),
                'rules'  => 'trim|'.$required_user_id.'',
                'errors' => [
                    'required' => ''.$errors_user_id.'',
                ],
            ],
            'position_id' => [
                'label'  => lang('Home.Posición'),
                'rules'  => 'trim|'.$required_position_id.'',
                'errors' => [
                    'required' => ''.$errors_position_id.'',
                ],
            ],
            'employee_cost' => [
                'label'  => lang('Home.Costo del empleado'),
                'rules'  => 'trim|'.$required_employee_cost.'',
                'errors' => [
                    'required' => ''.$errors_employee_cost.'',
                ],
            ],
            'description' => [
                'label'  => lang('Home.Descripción'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Descripción no puede estar vacio.'),
                ],
            ],
            'frequency' => [
                'label'  => lang('Home.Frecuencia'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Frecuencia no puede estar vacio.'),
                ],
            ],
            'monthly_amount' => [
                'label'  => lang('Home.Cantidad al mes'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Cantidad al mes no puede estar vacio.'),
                ],
            ],
            'productivity' => [
                'label'  => lang('Home.Productividad'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Productividad no puede estar vacio.'),
                ],
            ],
            'quality' => [
                'label'  => lang('Home.Calidad'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Calidad no puede estar vacio.'),
                ],
            ],
            'innovation' => [
                'label'  => lang('Home.Innovación'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Innovación no puede estar vacio.'),
                ],
            ],
            'service' => [
                'label'  => lang('Home.Servicio'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Servicio no puede estar vacio.'),
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
        $serviceModel = new ServiceModel($db);

        $_POST['employees']  = '';
        if(!isset($_POST['user_id'])){                
            $_POST['user_id'] = NULL;
            $_POST['created_admin'] = $this->session->get('user_id');

            $query = $db->table('employees');
            $query->select('user_id');
            $query->where('position_id', $_POST['position_id']);
            $_POST['employees'] = $query->get()->getResultArray();
        }else{
            $query = $db->table('employees');
            $query->select('user_id');
            $query->where('user_id', $_POST['user_id']);
            $_POST['employees'] = $query->get()->getResultArray();
            
            $_POST['created_admin'] = 0;
        }

        if(!isset($_POST['position_id'])){                
            $_POST['position_id'] = NULL;              
            $_POST['employee_cost'] = 0;
        }

        $this->add_datos($_POST);
    }

    public function add_datos(){
        if(COUNT($_POST['employees']) > 0){
            // $_POST['user_id'] = $_POST['employees'][0];
            $_POST['user_id'] = $_POST['employees'][0]['user_id'];
            $data = [
                'organization_id'  => $this->request->getPost('organization_id'),
                'description'  => $this->request->getPost('description'),
                'frequency'  => $this->request->getPost('frequency'),
                'user_id'  => $_POST['user_id'],
                'position_id'  => $_POST['position_id'],
                'employee_cost'  => $_POST['employee_cost'],
                'created_admin'  => $_POST['created_admin'],
                'monthly_amount'  => $this->request->getPost('monthly_amount'),
                'productivity'  => $this->request->getPost('productivity'),
                'quality'  => $this->request->getPost('quality'),
                'innovation'  => $this->request->getPost('innovation'),
                'service'  => $this->request->getPost('service'),
                'weighing'  => 0,
                'status'  => 1,
                'created_by'  => $this->session->get('user_id'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            $serviceModel = new ServiceModel($db);

            if(empty($this->request->getPost('service_id'))){
                $query = $db->table('services')->insert($data);
                $service_id = $db->insertID();
            }else{
                $query = $serviceModel->set($data)->where('service_id', $this->request->getPost('service_id'))->update();
                $service_id = $this->request->getPost('service_id');
            }

            if(isset($_POST['service_customer_id'])){
                foreach ($_POST['service_customer_id'] as $key => $c) {
                    if($_POST['service_customer_id'][$key] == 0){                
                        $data = [
                            'service_id' => $service_id,
                            'customer_id' => $_POST['customer_id'][$key],
                            'position_customer_id' => $_POST['position_customer_id'][$key],
                            'created_by'  => $this->session->get('user_id'),
                            'created_at'  => date('Y-m-d H:i:s')
                        ];

                        $query = $db->table('services_customers')->insert($data);
                    }else{
                        $serviceCustomerModel = new ServiceCustomerModel($db);
                        $data = [
                            'service_id' => $service_id,
                            'customer_id' => $_POST['customer_id'][$key],
                            'position_customer_id' => $_POST['position_customer_id'][$key],
                            'created_by'  => $this->session->get('user_id'),
                            'created_at'  => date('Y-m-d H:i:s')
                        ];

                        $query = $serviceCustomerModel->set($data)->where('service_customer_id', $_POST['service_customer_id'][$key])->update();
                    }
                }
            }

            if(isset($_POST['service_competitor_id'])){
                foreach ($_POST['service_competitor_id'] as $key => $c) {
                    if($_POST['service_competitor_id'][$key] == 0){                
                        $data = [
                            'service_id' => $service_id,
                            'company' => $_POST['company'][$key],
                            'guarantee' => $_POST['guarantee'][$key],
                            'offered_price' => $_POST['offered_price'][$key],
                            'created_by'  => $this->session->get('user_id'),
                            'created_at'  => date('Y-m-d H:i:s')
                        ];

                        if(!empty($_POST['company'][$key]) && !empty($_POST['guarantee'][$key]) && !empty($_POST['offered_price'][$key])){
                            $query = $db->table('services_competitors')->insert($data);
                        }

                    }else{
                        $serviceCompetitorModel = new ServiceCompetitorModel($db);
                        $data = [
                            'service_id' => $service_id,
                            'company' => $_POST['company'][$key],
                            'guarantee' => $_POST['guarantee'][$key],
                            'offered_price' => $_POST['offered_price'][$key],
                            'created_by'  => $this->session->get('user_id'),
                            'created_at'  => date('Y-m-d H:i:s')
                        ];

                        if(!empty($_POST['company'][$key]) && !empty($_POST['guarantee'][$key]) && !empty($_POST['offered_price'][$key])){
                            $query = $serviceCompetitorModel->set($data)->where('service_competitor_id', $_POST['service_competitor_id'][$key])->update();
                        }
                    }
                }
            }

            $res = $this->calcular_roi($_POST['user_id'], $_POST['position_id']);

            if($res == true){
                $_POST['employees'] = array_slice($_POST['employees'], 1);
                $this->add_datos($_POST);
            }
        }else{
            exit(json_encode(lang('Home.Se guardaron los datos correctamente.')));
        }
    }

    public function eliminar_datos(){
        $serviceModel = new ServiceModel($db);
        $res = $serviceModel->where('service_id', $this->request->getPost('service_id'))->delete();

        // dd($this->request->getPost('service_id'));

        if(isset($_POST['user_id'])){
            $user_id = NULL;
        }else{
            $user_id = $this->request->getPost('user_id');
        }

        $position_id = $this->request->getPost('position_id');

        $res = $this->calcular_roi($user_id, $position_id);
        exit(json_encode(lang('Home.Se guardaron los datos correctamente.')));
    }

    public function get_empleados_organizacion(){
        $serviceModel = new ServiceModel($db);

        $res = array();

        $res['employees'] = 0;
        $res['positions'] = 0;
        $res['employee_cost'] = 0;

        if($this->session->get('credential_id') != 1){
            $query = $db->table('users u');
            $query->select('*');
            $query->join('employees e', 'e.user_id = u.user_id', "left");
            $query->where('u.user_id', $this->session->get('user_id'));
            $res['employees'] = $query->get()->getResultArray();

            $query = $db->table('users u');
            $query->select('e.*, p.position');
            $query->join('employees e', 'e.user_id = u.user_id', "left");
            $query->join('positions p', 'p.position_id = e.position_id', "left");
            $query->where('e.organization_id', $this->session->get('organization_id'));
            $query->where('e.user_id !=', $this->session->get('user_id'));
            $res['employees_organization'] = $query->get()->getResultArray();

            $query = $db->table('positions p');
            $query->select('*');
            $query->where('p.position_id', $this->session->get('position_id'));
            $query->orderBy('p.position', 'ASC');
            $res['positions'] = $query->get()->getResultArray();
        }else{
            $query = $db->table('positions p');
            $query->select('*');
            $query->where('p.organization_id', $this->request->getPost('organization_id'));
            $query->where('p.deleted_at', NULL);
            $query->orderBy('p.position', 'ASC');
            $res['positions'] = $query->get()->getResultArray();

            $query = $db->table('users u');
            $query->select('e.*, p.position');
            $query->join('employees e', 'e.user_id = u.user_id', "left");
            $query->join('positions p', 'p.position_id = e.position_id', "left");
            $query->where('e.organization_id', $this->request->getPost('organization_id'));
            $query->where('e.deleted_at', NULL);
            $res['employees_organization'] = $query->get()->getResultArray();

            $res['employee_cost'] = $this->session->get('salary_total');
        }

        exit(json_encode($res));
    }

    public function delete_service_customer(){
        $serviceModel = new ServiceModel($db);

        $serviceCustomerModel = new ServiceCustomerModel($db);
        $query = $serviceCustomerModel->where('service_customer_id', $this->request->getPost('service_customer_id'))->delete();

        exit(json_encode($query));
    }

    public function delete_service_competitor(){
        $serviceModel = new ServiceModel($db);

        $serviceCompetitorModel = new ServiceCompetitorModel($db);
        $query = $serviceCompetitorModel->where('service_competitor_id', $this->request->getPost('service_competitor_id'))->delete();

        $res = $this->calcular_roi($this->request->getPost('user_id'), $this->request->getPost('position_id'));

        exit(json_encode(lang('Home.Se guardaron los datos correctamente.')));
    }

    public function get_detalles(){
        $serviceModel = new ServiceModel($db);

        $query = $db->table('services s');
        $query->select('*');
        $query->where('s.service_id', $this->request->getPost('service_id'));
        $res = $query->get()->getRowArray();

        exit(json_encode($res));
    }

    public function calcular_roi($user_id = null, $position_id = null){
        // 1-se calcula el promedio de la suma del precio ofrecido de los competidores del servicio del empleado
        // 2-el promedio se multiplica por la cantidad al mes
        // 3-se realiza el paso 1 y 2 por cada servicio que tenga el empleado
        // 4-se suma los resultados de los servicios y se divide por el total de servicios del empleado
        // 5-el resultado del del paso 4 se divide entre el salario del empleado que da como resultado el roi

        //ejemplo

        // *servicio 1
        // competidor1 30000
        // competidor2 30000
        // competidor2 30000
        // total       90000/competidores(3) = 30000 * cantidad al mes(3) = 90000

        // *servicio 2
        // competidor1 30000
        // total       30000/competidores(1) = 30000 * cantidad al mes(2) = 60000

        // roi 90000 + 60000 = 150000/numero de servicios(2) = 75000 / salario(18000) =  4.166

        $employeeModel = new EmployeeModel($db);

        if($user_id == null || $user_id == 0){
            $query = $db->table('employees e');
            $query->select('e.user_id, e.position_id, total');
            $query->join('users u', 'u.user_id = e.user_id');
            $query->where('e.position_id', $position_id);
            // $query->where('u.credential_id !=', 1);
            $resp['employees'] = $query->get()->getResultArray(); 
        }else{
            $query = $db->table('employees e');
            $query->select('e.user_id, e.position_id, total');
            $query->join('users u', 'u.user_id = e.user_id');
            $query->where('e.user_id', $user_id);
            // $query->where('u.credential_id !=', 1);
            $resp['employees'] = $query->get()->getResultArray();    
        }

        for($i=0; $i < count($resp['employees']); $i++) {
            $services = $db->table('services s');
            $services->select('s.service_id, s.service_id, s.monthly_amount, (AVG(sc.offered_price) * s.monthly_amount) total');
            $services->join('services_competitors sc', 'sc.service_id = s.service_id');
            $services->where('user_id', $resp['employees'][$i]['user_id']);
            $services->where('created_admin', 0);
            $services->where('s.deleted_at', NULL);
            $services->groupBy('s.service_id');
            $resp['employees'][$i]['services'] = $services->get()->getResultArray();

            $services_admin = $db->table('services s');
            $services_admin->select('s.service_id, s.service_id, s.monthly_amount, (AVG(sc.offered_price) * s.monthly_amount) total');
            $services_admin->join('services_competitors sc', 'sc.service_id = s.service_id');
            $services_admin->where('position_id', $resp['employees'][$i]['position_id']);
            $services_admin->where('created_admin !=', 0);
            $services_admin->where('s.deleted_at', NULL);
            $services_admin->groupBy('s.service_id');
            $resp['employees'][$i]['services_admin'] = $services_admin->get()->getResultArray();
        }
        

        foreach ($resp['employees'] as $e) {
            $salary_total = $e['total'];

            $total_services_user = 0;
            $total_services_admin = 0;
            foreach ($e['services'] as $s) {
                $total_services_user += round($s['total'], 2);
            }

            foreach ($e['services_admin'] as $sa) {
                $total_services_admin += round($sa['total'], 2);
            }

            $total_services = count($e['services']) + count($e['services_admin']);

            if($total_services == 0){
                $roi = 0;
            }else{            
                $roi = ($total_services_user + $total_services_admin) / $total_services;
                $roi = round($roi / $salary_total, 2);
            }

            $data = [
                'roi'  => $roi
            ];

            $query = $employeeModel->set($data)->where('user_id', $e['user_id'])->update();
        }

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        return true;
    }

    public function classify_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $serviceModel = new ServiceModel($db);

        $services_status = $db->table('services_status');
        $services_status->select('*');
        $data['services_status'] = $services_status->get()->getResultArray();

        $query = $db->table('organizations');
        $query->select('*');
        if($this->session->get('user_id') != 1){
            $query->where('organization_id', $this->session->get('organization_id'));
        }
        $query->where('deleted_at', NULL);
        $query->orderBy('organization', 'ASC');
        $data['organizations'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Clasificar funciones o servicios');
        $data['sub_title'] = 'Servicios';
        $data['custom'] = 'classify';
        $data['content'] = 'services/classify_view';

        return view('templates/common/Layout_view',$data); 
    }

    public function get_empleados(){
        $serviceModel = new ServiceModel($db);

        $query = $db->table('users u');
        $query->select('*');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        if($this->session->get('user_id') != 1){
            $query->join('chiefs c', 'c.employee_user_id = u.user_id', "left");
            $query->where('c.chief_user_id', $this->session->get('user_id'));
        }
        $query->where('e.organization_id', $this->request->getPost('organization_id'));
        $res = $query->get()->getResultArray();

        exit(json_encode($res));
    }

    public function get_servicios(){
        $serviceModel = new ServiceModel($db);

        $services = $db->table('services s');
        $services->select('*');
        $services->where('user_id', $this->request->getPost('user_id'));
        $services->where('status', 1);
        $services->where('deleted_at', NULL);
        $res['asignar'] = $services->get()->getResultArray();

        $services = $db->table('services s');
        $services->select('*');
        $services->where('user_id', $this->request->getPost('user_id'));
        $services->where('status', 2);
        $services->where('deleted_at', NULL);
        $res['comunes'] = $services->get()->getResultArray();

        $services = $db->table('services s');
        $services->select('*');
        $services->where('user_id', $this->request->getPost('user_id'));
        $services->where('status', 3);
        $services->where('deleted_at', NULL);
        $res['hibridos'] = $services->get()->getResultArray();

        $services = $db->table('services s');
        $services->select('*');
        $services->where('user_id', $this->request->getPost('user_id'));
        $services->where('status', 4);
        $services->where('deleted_at', NULL);
        $res['esporadicos'] = $services->get()->getResultArray();

        exit(json_encode($res));
    }

    public function cambiar_status(){
        $data = [
            'status'      => $this->request->getPost('service_status_id'),
            'status_validated'      => 1,
            'modified_by'  => $this->session->get('user_id'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        $serviceModel = new ServiceModel($db);

        $query = $serviceModel->set($data)->where('service_id', $this->request->getPost('service_id'))->update();
        exit(json_encode($query));   
    }

    public function approve_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $serviceModel = new ServiceModel($db);

        $services_status = $db->table('services_status');
        $services_status->select('*');
        $data['services_status'] = $services_status->get()->getResultArray();

        $query = $db->table('organizations');
        $query->select('*');
        if($this->session->get('user_id') != 1){
            $query->where('organization_id', $this->session->get('organization_id'));
        }
        $query->where('deleted_at', NULL);
        $query->orderBy('organization', 'ASC');
        $data['organizations'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Aprobar funciones o servicios');
        $data['sub_title'] = lang('Home.Servicios');
        $data['custom'] = 'approve';
        $data['content'] = 'services/approve_view';

        return view('templates/common/Layout_view',$data); 
    }

    public function cambiar_status_admin(){
        $data = [
            'status_validated'      => $this->request->getPost('status_validated'),
            'modified_by'  => $this->session->get('user_id'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        $serviceModel = new ServiceModel($db);

        $query = $serviceModel->set($data)->where('service_id', $this->request->getPost('service_id'))->update();
        exit(json_encode($query));   
    }

    public function weighing_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $serviceModel = new ServiceModel($db);

        $query = $db->table('services s');
        $query->select('s.*, o.organization, p.position');
        $query->join('organizations o', 'o.organization_id = s.organization_id', "left");
        $query->join('positions p', 'p.position_id = s.position_id', "left");
        $query->where('s.user_id', $this->session->get('user_id'));
        $query->where('s.deleted_at', NULL);
        // $query->where('s.created_by', $this->session->get('user_id'));
        // $query->orwhere("(s.position_id = ".$this->session->get('position_id')." AND created_admin > 0 AND user_id =".$this->session->get('user_id').")");
        // $where = '(s.status = 2 OR s.status = 3)';
        // $query->where($where);
        // $query->where('s.status_validated', 2);
        $data['services'] = $query->get()->getResultArray();

        $data['user_id'] = $this->session->get('user_id');

        $data['title'] = lang('Home.Servicios');
        $data['sub_title'] = lang('Home.Ponderación');
        $data['custom'] = 'services';
        $data['content'] = 'services/weighing_view';

        return view('templates/common/Layout_view',$data);
    }

    public function get_ponderaciones(){
        $serviceModel = new ServiceModel($db);

        $query = $db->table('services s');
        $query->select('s.*, o.organization, p.position');
        $query->join('organizations o', 'o.organization_id = s.organization_id', "left");
        $query->join('positions p', 'p.position_id = s.position_id', "left");
        $query->where('s.user_id', $this->request->getPost('user_id'));
        $query->where('s.deleted_at', NULL);
        $res = $query->get()->getResultArray(); 

        exit(json_encode($res));
    }

    public function actualizar_ponderaciones(){
        for ($i = 0; $i < count($this->request->getPost('service_id')) ; $i++) { 
            // var_dump($_POST['service_id'][$i]);
            // var_dump($_POST['weighing'][$i]);
            $data = [
                'weighing'      => $_POST['weighing'][$i],
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $serviceModel = new ServiceModel($db);

            $query = $serviceModel->set($data)->where('service_id', $_POST['service_id'][$i])->update();
        }

        exit(json_encode($query));
    }

    public function add_imagen(){
        helper(['form', 'url']);
        $carpeta = './public/servicios/'.$this->request->getPost('service_id');

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $validation =  \Config\Services::validation();

        $rules = [
            'profile_picture' => [
                'label' =>  lang('Home.Imagen'),
                'rules' => 'uploaded[profile_picture]|max_size[profile_picture,2097152]|mime_in[profile_picture,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                'errors' => [
                    'uploaded' => lang('Home.El campo Imagen no puede estar vacio o el archivo excede el tamaño permitido.'),
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
                'modified_by'  => $this->session->get('service_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $serviceModel = new ServiceModel($db);
            $query = $serviceModel->set($data)->where('service_id', $this->request->getPost('service_id'))->update();

            $response['status'] = "OK";
            $response['message'] = lang('Home.Se actualizó la imagen correctamente. Favor de recargar la pagina.');
        }
        
        exit(json_encode($response));
    }
}
