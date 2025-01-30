<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ServiceProviderModel;
use App\Models\SupplieModel;
use App\Models\ProviderModel;
use App\Models\ServiceModel;
use App\Models\EmployeeModel;

class Providers extends BaseController {

    protected $db;
    protected $session;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $serviceProviderModel = new ServiceProviderModel($this->db);

        $query = $this->db->table('service_providers sp')
                          ->select('sp.*, s.description service')
                          ->join('services s', 's.service_id = sp.service_id', 'left')
                          ->where('sp.deleted_at', NULL);//Este filtro establece que solo se seleccionarán los registros de service_providers donde el campo deleted_at sea NULL, lo que generalmente indica que el registro no ha sido "borrado lógicamente". El campo deleted_at probablemente se utiliza para llevar un registro de las eliminaciones sin borrar físicamente los datos.


        //Esta es una condición adicional que se aplica si el user_id de la sesión no es 1. Parece que el usuario con user_id = 1 tiene permisos de administrador, por lo que no se le restringen los resultados. Para los usuarios que no sean administradores (donde user_id no es 1), se agrega un filtro adicional que muestra solo los registros de service_providers que fueron creados por ese usuario. El campo created_by probablemente almacena el ID del usuario que creó el registro.                  
        if($this->session->get('user_id') != 1) {
            $query->where('sp.created_by', $this->session->get('user_id'));
        }

        //ejecuta la consulta, El método getResultArray() transforma ese objeto en un array de resultados. Cada fila de la consulta se devuelve como un arreglo asociativo (donde los nombres de las columnas son las claves).
        $data['services_providers'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Proveedores');
        $data['sub_title'] = 'Proveedores';
        $data['custom'] = 'providers';
        $data['content'] = 'providers/providers_view';

        return view('templates/common/Layout_view', $data);
    }

    public function load_employees() {
        $organization_id = $this->request->getGet('organization_id');
        if (!$organization_id) return $this->response->setJSON('');
    
        $employees = $this->db->table('employees')
                               ->select('*')
                               ->where('organization_id', $organization_id)
                               ->get()->getResultArray();
    
        $options = '<option value="">' . lang('Home.Seleccione una opción') . '</option>';
        foreach ($employees as $employee) {
            $options .= '<option value="' . $employee['user_id'] . '">' . $employee['name'] . '</option>';
        }
    
        echo $options;
    }
    
    public function load_services() {
        $user_id = $this->request->getGet('user_id');
        if (!$user_id) return $this->response->setJSON('');
    
        $services = $this->db->table('services')
                              ->select('*')
                              ->where('user_id', $user_id)
                              ->get()->getResultArray();
    
        $options = '<option value="">' . lang('Home.Seleccione una opción') . '</option>';
        foreach ($services as $service) {
            $options .= '<option value="' . $service['service_id'] . '">' . $service['description'] . '</option>';
        }
    
        echo $options;
    }
    

    public function form_view($service_provider_id) {
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }
    
        // Obtener organizaciones
        if (!$data['organizations'] = cache()->get('organizations_cache')) {
            $query = $this->db->table('organizations')->select('*');
            if ($this->session->get('user_id') != 1) {
                $query->where('organization_id', $this->session->get('organization_id'));
            }
            $query->where('deleted_at', NULL)->orderBy('organization', 'ASC');
            $data['organizations'] = $query->get()->getResultArray();
            cache()->save('organizations_cache', $data['organizations'], 3600);
        }
    
        // Obtener empleados
        if (!$data['employees'] = cache()->get('employees_cache')) {
            $query = $this->db->table('users u')
                              ->select('*')
                              ->join('employees e', 'e.user_id = u.user_id', 'left')
                              ->where('e.organization_id', $this->session->get('organization_id'))
                              ->where('e.user_id !=', $this->session->get('user_id'));
            $data['employees'] = $query->get()->getResultArray();
            cache()->save('employees_cache', $data['employees'], 3600);
        }
    
        // Obtener tipos de suministros
        $data['type_supplies'] = $this->db->table('type_supplies')->select('*')->get()->getResultArray();
    
        // Obtener servicios
        $data['services'] = $this->db->table('services')->select('*')->get()->getResultArray();
    
        // Obtener proveedor de servicios
        $data['services_providers'] = $this->db->table('service_providers')
                                              ->select('*')
                                              ->where('service_provider_id', $service_provider_id)
                                              ->get()->getRowArray();
    
        if (empty($data['services_providers'])) {
            $data['services_providers'] = [
                'service_provider_id' => '',
                'organization_id' => '',
                'user_id' => '',
                'service_id' => '',
                'description' => '',
                'date_service' => ''
            ];
        }
    
        // Configuración de la vista
        $data['title'] = lang('Home.Servicios proveedores');
        $data['sub_title'] = 'Agregar servicios proveedores';
        $data['custom'] = 'providers';
        $data['content'] = 'providers/form_view';
    
        return view('templates/common/Layout_view', $data);
    }
    

    public function get_clientes_competidores(){
        $providerModel = new ProviderModel($this->db);

        $providerCustomers = $this->db->table('providers_customers s')
                                      ->select('s.*, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) user, p.position')
                                      ->join('employees e', 'e.user_id = s.customer_id', 'left')
                                      ->join('positions p', 'p.position_id = s.position_customer_id', 'left')
                                      ->where('s.service_provider_id', $this->request->getPost('service_provider_id'))
                                      ->get()->getResultArray();

        $providerCompetitors = $this->db->table('providers_competitors s')
                                        ->select('*')
                                        ->where('s.service_provider_id', $this->request->getPost('service_provider_id'))
                                        ->get()->getResultArray();

        $res = [
            'providers_customers' => $providerCustomers,
            'providers_competitors' => $providerCompetitors
        ];

        return $this->response->setJSON($res);
    }

    public function validar_form(){
        $validation = \Config\Services::validation();
        $rules = [
            'organization_id' => 'trim|required',
            'user_id' => 'trim|required',
            'date_service' => 'trim|required',
            'service_id' => 'trim|required'
        ];

        if(!$this->validate($rules)){
            $response = [
                'status' => "ERROR",
                'message' => $validation->listErrors()
            ];
        } else {
            $response = [
                'status' => "OK",
                'message' => lang('Home.Campos validados.')
            ];
        }

        return $this->response->setJSON($response);
    }

    public function form_datos(){
        $postData = $this->request->getPost();
        $serviceProviderModel = new ServiceProviderModel($this->db);
    
        // Convertir la fecha y hora del formato 'Y-m-d\TH:i' a 'Y-m-d H:i:s'
        $dateService = isset($postData['date_service']) ? date('Y-m-d H:i:s', strtotime($postData['date_service'])) : NULL;
    
        $data = [
            'organization_id'  => $postData['organization_id'] ?? NULL,
            'user_id'          => $postData['user_id'] ?? NULL,
            'date_service'     => $dateService,
            'service_id'       => $postData['service_id'] ?? NULL,
            'created_by'       => $this->session->get('user_id'),
            'created_at'       => date('Y-m-d H:i:s')
        ];
    
        if(empty($postData['service_provider_id'])){
            $this->db->table('service_providers')->insert($data);
            $service_provider_id = $this->db->insertID();
        } else {
            $serviceProviderModel->set($data)->where('service_provider_id', $postData['service_provider_id'])->update();
            $service_provider_id = $postData['service_provider_id'];
        }
    
        if(isset($postData['supplies'])){
            foreach ($postData['supplies'] as $supply) {
                if($supply['supply_id'] == 0){
                    $this->db->table('supplies')->insert([
                        'service_provider_id' => $service_provider_id,
                        'type_supply_id' => $supply['type_supply_id'],
                        'supply' => $supply['supply'],
                        'created_by' => $this->session->get('user_id'),
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    $supply_id = $this->db->insertID();
                } else {
                    (new SupplieModel($this->db))->set([
                        'service_provider_id' => $service_provider_id,
                        'type_supply_id' => $supply['type_supply_id'],
                        'supply' => $supply['supply'],
                        'updated_by' => $this->session->get('user_id'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ])->where('supply_id', $supply['supply_id'])->update();
                    $supply_id = $supply['supply_id'];
                }
            }
        }
    
        if(isset($postData['customers'])){
            foreach ($postData['customers'] as $customer) {
                if($customer['customer_id'] == 0){
                    $this->db->table('providers_customers')->insert([
                        'service_provider_id' => $service_provider_id,
                        'customer_id' => $customer['customer_id'],
                        'position_customer_id' => $customer['position_customer_id'],
                        'created_by' => $this->session->get('user_id'),
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    (new ProviderModel($this->db))->set([
                        'customer_id' => $customer['customer_id'],
                        'position_customer_id' => $customer['position_customer_id'],
                        'updated_by' => $this->session->get('user_id'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ])->where('provider_customer_id', $customer['provider_customer_id'])->update();
                }
            }
        }
    
        if(isset($postData['competitors'])){
            foreach ($postData['competitors'] as $competitor) {
                if($competitor['competitor_id'] == 0){
                    $this->db->table('providers_competitors')->insert([
                        'service_provider_id' => $service_provider_id,
                        'competitor_id' => $competitor['competitor_id'],
                        'created_by' => $this->session->get('user_id'),
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    (new ProviderModel($this->db))->set([
                        'competitor_id' => $competitor['competitor_id'],
                        'updated_by' => $this->session->get('user_id'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ])->where('provider_competitor_id', $competitor['provider_competitor_id'])->update();
                }
            }
        }
    
        return $this->response->setJSON(['status' => 'OK', 'message' => 'Datos guardados']);
    }
    
}
