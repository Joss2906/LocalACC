<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrganizationModel;
use App\Models\UserModel;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\PositionModel;
use App\Models\ServiceModel;
use App\Models\EmployeesCompetenciesModel;
use App\Models\InnovationModel;
use App\Models\ResolutionModel;

class Statistics extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

	public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $organizationModel = new OrganizationModel($db);

        $query = $db->table('organizations');
        $query->select('*');
        if($this->session->get('user_id') != 1){
            $query->where('organization_id', $this->session->get('organization_id'));
        }
        $query->where('deleted_at', NULL);
        $query->orderBy('organization', 'ASC');
        $data['organizations'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Estadísticas');
        $data['sub_title'] = lang('Home.Estadísticas');
		$data['custom'] = 'statistics';
        $data['content'] = 'statistics/statistics_view';

        return view('templates/common/Layout_view',$data);

	}

    public function statistics_employees_view($user_id = null, $position_id = null){
        $data['user_id'] = $user_id;
        $data['position_id'] = $position_id;
        $data['title'] = lang('Home.Estadísticas');
        $data['sub_title'] = lang('Home.Estadísticas');
        $data['custom'] = 'statistics';
        $data['content'] = 'statistics/statistics_employees_view';;

        return view('templates/common/Layout_view',$data);
    }

    public function get_empleados_organizacion(){
        $serviceModel = new ServiceModel($db);

        $res = array();

        $query = $db->table('users u');
        $query->select('e.*, p.position');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->join('positions p', 'p.position_id = e.position_id', "left");
        $query->where('e.organization_id', $this->request->getPost('organization_id'));
        if($this->session->get('credential_id') != 1){
            $query->where('e.user_id', $this->session->get('user_id'));
        }
        $query->where('e.deleted_at', NULL);
        $res = $query->get()->getResultArray();

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

        $query = $db->table('tasks t');
        $query->select('average_productivity, average_quality, average_innovation, average_service, s.description service, t.updated_at');
        $query->join('services s', 's.service_id = t.service_id', "left");
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        $query->where('t.user_id', $this->request->getPost('user_id'));
        $res['tasks'] = $query->get()->getResultArray();

        $query = $db->table('services s');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, s.weighing, s.description service, t.updated_at');
        $query->join('tasks t', 's.service_id = t.service_id', "left");
        $query->where('s.user_id', $this->request->getPost('user_id'));
        $query->where('s.deleted_at', NULL);
        $query->groupBy('s.service_id');
        $res['tasks_weighings'] = $query->get()->getResultArray();

        exit(json_encode($res));
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

    // vista del panorama general

    public function general_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $serviceModel = new ServiceModel($db);
 
        $data['title'] = lang('Home.Estadísticas');
        $data['sub_title'] = lang('Home.Generales');
        $data['custom'] = 'statistics';
        $data['content'] = 'statistics/general_view';

        return view('templates/common/Layout_view',$data);
    }

    public function get_grafica_general(){
        $res = array();
        $res['estadisticas']['average_productivity'] = round(0, 2);
        $res['estadisticas']['average_quality'] = round(0, 2);
        $res['estadisticas']['average_innovation'] = round(0, 2);
        $res['estadisticas']['average_service'] = round(0, 2);
        
        $serviceModel = new ServiceModel($db);

        $query = $db->table('users u');
        $query->select('u.user_id, u.profile_picture');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $res['employee'] = $query->get()->getResultArray();

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service');
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);

        if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
            $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
            $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
        }

        $where_or = '';

        for ($i=0; $i < COUNT($res['employee']); $i++) {
            $where_or .= ' t.user_id = '.$res['employee'][$i]['user_id'].' OR ';
        }
        $where_or = rtrim($where_or, "OR  ");

        $query->where('('.$where_or.')');
        $tasks = $query->get()->getRowArray();

        $res['estadisticas']['average_productivity'] = round($tasks['average_productivity'], 2);
        $res['estadisticas']['average_quality'] = round($tasks['average_quality'], 2);
        $res['estadisticas']['average_innovation'] = round($tasks['average_innovation'], 2);
        $res['estadisticas']['average_service'] = round($tasks['average_service'], 2);

        exit(json_encode($res));
    }

    public function get_grafica_educacion(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, schooling');
        $query->join('employees e', 'e.user_id = t.user_id', "left");
        $query->join('schooling s', 'e.schooling_id = s.schooling_id', "left");
        $query->join('users u', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
            $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
            $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
        }
        $query->groupBy('e.schooling_id');
        $tasks = $query->get()->getResultArray();
        exit(json_encode($tasks));
    }

    public function get_grafica_edades(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, (DATE_FORMAT( CURDATE( ) , "%Y-%m-%d" ) - DATE_FORMAT( e.birthday, "%Y-%m-%d" )) AS age');
        $query->join('employees e', 'e.user_id = t.user_id', "left");
        $query->join('genders g', 'e.gender_id = g.gender_id', "left");
        $query->join('users u', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
            $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
            $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
        }
        $query->groupBy('age');
        $tasks = $query->get()->getResultArray();

        exit(json_encode($tasks));
    }

    public function get_grafica_generos(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, gender');
        $query->join('employees e', 'e.user_id = t.user_id', "left");
        $query->join('genders g', 'e.gender_id = g.gender_id', "left");
        $query->join('users u', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
            $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
            $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
        }
        $query->groupBy('e.gender_id');
        $tasks = $query->get()->getResultArray();

        exit(json_encode($tasks));
    }

    public function get_grafica_departamentos(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, department');
        $query->join('employees e', 'e.user_id = t.user_id', "left");
        $query->join('departments d', 'e.department_id  = d.department_id', "left");
        $query->join('users u', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
            $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
            $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
        }
        $query->groupBy('e.department_id ');
        $tasks = $query->get()->getResultArray();

        exit(json_encode($tasks));
    }

    public function get_grafica_puestos(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, position');
        $query->join('employees e', 'e.user_id = t.user_id', "left");
        $query->join('positions p', 'e.position_id  = p.position_id', "left");
        $query->join('users u', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
            $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
            $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
        }
        $query->groupBy('e.position_id ');
        $tasks = $query->get()->getResultArray();

        exit(json_encode($tasks));
    }

    public function get_grafica_periodo(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, Date_format(delivery_date,"%M") month');
        $query->join('employees e', 'e.user_id = t.user_id', "left");
        $query->join('users u', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
            $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
            $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
        }
        $query->groupBy('month');
        $tasks = $query->get()->getResultArray();

        exit(json_encode($tasks));
    }

    public function get_grafica_empleados(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('tasks t');
        $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) name');
        $query->join('employees e', 'e.user_id = t.user_id', "left");
        $query->join('users u', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $query->where('t.status_id', 4);
        $query->where('t.deleted_at', NULL);
        if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
            $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
            $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
        }
        $query->groupBy('e.user_id ');
        $tasks = $query->get()->getResultArray();

        exit(json_encode($tasks));
    }

    public function get_grafica_competencias(){
        $res = array();

        $serviceModel = new ServiceModel($db);

        $query = $db->table('employees_competencies ec');
        $query->select('AVG(ec.qualification) qualification, c.competency');
        $query->join('employees e', 'e.user_id = ec.user_id', "left");
        $query->join('competencies c', 'c.competency_id = ec.competency_id ', "left");
        $query->join('users u', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id <', 5);
        $query->groupBy('ec.competency_id');
        $tasks = $query->get()->getResultArray();

        $i = 0;
        foreach ($tasks as $t) {
            $res[$i]['competency'] = lang('Home.'.$t['competency'].'');
            $res[$i]['qualification'] = $t['qualification'];
            $i++;
        }

        exit(json_encode($res));
    }

    public function get_grafica_general_clientes(){
        $res = array();
        $res['estadisticas']['average_productivity'] = round(0, 2);
        $res['estadisticas']['average_quality'] = round(0, 2);
        $res['estadisticas']['average_innovation'] = round(0, 2);
        $res['estadisticas']['average_service'] = round(0, 2);

        $serviceModel = new ServiceModel($db);

        $query = $db->table('users u');
        $query->select('u.user_id, u.profile_picture');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id', 5);
        $res['employee'] = $query->get()->getResultArray();

        if(COUNT($res['employee']) > 0){        
            $query = $db->table('tasks t');
            $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service');
            $query->where('t.status_id', 4);
            $query->where('t.deleted_at', NULL);
            if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
                $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
                $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
            }

            $where_or = '';

            for ($i=0; $i < COUNT($res['employee']); $i++) {
                $where_or .= ' t.user_id = '.$res['employee'][$i]['user_id'].' OR ';
            }
            $where_or = rtrim($where_or, "OR  ");

            $query->where('('.$where_or.')');
            $tasks = $query->get()->getRowArray();

            $res['estadisticas']['average_productivity'] = round($tasks['average_productivity'], 2);
            $res['estadisticas']['average_quality'] = round($tasks['average_quality'], 2);
            $res['estadisticas']['average_innovation'] = round($tasks['average_innovation'], 2);
            $res['estadisticas']['average_service'] = round($tasks['average_service'], 2);
        }


        exit(json_encode($res));
    }

    public function get_grafica_general_proveedores(){
        $res = array();
        $res['estadisticas']['average_productivity'] = round(0, 2);
        $res['estadisticas']['average_quality'] = round(0, 2);
        $res['estadisticas']['average_innovation'] = round(0, 2);
        $res['estadisticas']['average_service'] = round(0, 2);

        $serviceModel = new ServiceModel($db);

        $query = $db->table('users u');
        $query->select('u.user_id, u.profile_picture');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->where('e.organization_id', $this->session->get('organization_id'));
        $query->where('u.credential_id', 6);
        $res['employee'] = $query->get()->getResultArray();

        if(COUNT($res['employee']) > 0){        
            $query = $db->table('tasks t');
            $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service');
            $query->where('t.status_id', 4);
            $query->where('t.deleted_at', NULL);
            if(!empty($this->request->getPost('initial_date')) && !empty($this->request->getPost('final_date'))){        
                $query->where('t.delivery_date >=', $this->request->getPost('initial_date').' 00:00:00');
                $query->where('t.delivery_date <=', $this->request->getPost('final_date').' 23:59:59');
            }

            $where_or = '';

            for ($i=0; $i < COUNT($res['employee']); $i++) {
                $where_or .= ' t.user_id = '.$res['employee'][$i]['user_id'].' OR ';
            }
            $where_or = rtrim($where_or, "OR  ");

            $query->where('('.$where_or.')');
            $tasks = $query->get()->getRowArray();

            $res['estadisticas']['average_productivity'] = round($tasks['average_productivity'], 2);
            $res['estadisticas']['average_quality'] = round($tasks['average_quality'], 2);
            $res['estadisticas']['average_innovation'] = round($tasks['average_innovation'], 2);
            $res['estadisticas']['average_service'] = round($tasks['average_service'], 2);
        }

        exit(json_encode($res));
    }

}
