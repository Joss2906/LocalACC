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


// use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Loads extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $data['title'] = lang('Home.Carga de formato');
        $data['sub_title'] = 'Excel';
        $data['custom'] = 'loads';
        $data['content'] = 'loads/loads_view';

        return view('templates/common/Layout_view',$data);

    }

    public function validar_documento(){
        $data = array();
        $validar = array();

        $file_data = $this->request->getFile('archivo_excel');

        $validation =  \Config\Services::validation();

        $rules = [
            'archivo_excel' => [
                'label' => lang('Home.Formato'),
                'rules' => 'uploaded[archivo_excel]|ext_in[archivo_excel,xlsx]',
                'errors' => [
                    'uploaded' => lang('Home.El formato no puede estar vacio.'),
                    'ext_in'  => lang('El archivo tiene un extención invalida.'),
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $data['status'] = "ERROR";
            $data['message'] = $validation->listErrors();
        }else{      
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            $spreadsheet = $reader->load($file_data);
            $val = $spreadsheet->getActiveSheet()->toArray();

            $total_hojas_validas = $spreadsheet->getSheetCount();
            $total_hojas = 7;

            if($total_hojas_validas != 7){
                $data['status'] = "ERROR";
                $data['message'] = lang('Fomato invalido, hay mas hojas en la plantilla.');
                $data['data'] = '';
            }else{
                $data['emails_registrados'] = '';

                $hoja = array();

                for ($indice_hoja = 1; $indice_hoja <= 5; $indice_hoja++) {
                    $hoja_actual = $spreadsheet->getSheet($indice_hoja);
                    $num_rows = $hoja_actual->getHighestRow();
                    $hoja['h'.$indice_hoja.''] = $num_rows;
                }

                if ($hoja['h1'] === $hoja['h2'] && $hoja['h1'] === $hoja['h3'] && $hoja['h1'] === $hoja['h4'] && $hoja['h1'] === $hoja['h5']) {
                    for ($indice_hoja = 0; $indice_hoja < $total_hojas; $indice_hoja++) {
                        $hoja_actual = $spreadsheet->getSheet($indice_hoja);

                        // datos de la empresa
                        if($indice_hoja == 0){
                            if($hoja_actual->getCell('A2')->getValue() != null && $hoja_actual->getCell('B2')->getValue() != null){
                                $data['organizations']['organization'] = $hoja_actual->getCell('A2')->getValue();
                                $data['organizations']['maturity_id'] = $hoja_actual->getCell('B2')->getValue();
                            }
                        }

                        $positions = array();
                        $departments = array();
                        $emails = array();

                        // datos de los empleados
                        if($indice_hoja == 1){            
                            $highest_columns = $hoja_actual->getHighestColumn();
                            $num_cols = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highest_columns);
                            $num_rows = $hoja_actual->getHighestRow();

                            $num = 0;

                            for($row = 2; $row <= $num_rows; $row++) {
                                
                                for ($column = 1; $column <= $num_cols;){
                                    $data['users'][$num]['user'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['users'][$num]['password'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['users'][$num]['credential_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();

                                    $data['employees'][$num]['first_name'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['second_name'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['last_name'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['second_last_name'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['business_name'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['gender_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $birthday = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($hoja_actual->getCellByColumnAndRow($column++, $row)->getValue());
                                    $data['employees'][$num]['birthday'] = $birthday->format('Y-m-d');
                                    $data['employees'][$num]['email'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['street'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['number'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['suburb'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['estate'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['delegation'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['country_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['nationality_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['postal_code'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['phone'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['mobile'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['civil_status_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['economic_dependents'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    // $data['employees'][$num]['type_user_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['salary_amount'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['social_security'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['benefit_1'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['benefit_amount_1'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['benefit_2'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['benefit_amount_2'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['benefit_3'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['benefit_amount_3'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['benefit_4'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['benefit_amount_4'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['total'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getCalculatedValue();
                                    $data['employees'][$num]['position_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $date_admission = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($hoja_actual->getCellByColumnAndRow($column++, $row)->getValue());
                                    $date_admission->format('Y-m-d');  
                                    $data['employees'][$num]['date_admission'] = $date_admission->format('Y-m-d');
                                    $data['employees'][$num]['schooling_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['department_id'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['disc'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['mission'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['vision'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['competitive_advantages'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                    $data['employees'][$num]['comparative_advantages'] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();

                                    if(!empty($data['employees'][$num]['position_id'])){                                
                                        if (!in_array($data['employees'][$num]['position_id'], $positions)) {
                                            array_push($positions, $data['employees'][$num]['position_id']);
                                        }
                                    }

                                    if(!empty($data['employees'][$num]['department_id'])){                                
                                        if (!in_array($data['employees'][$num]['department_id'], $departments)) {
                                            array_push($departments, $data['employees'][$num]['department_id']);
                                        }
                                    }

                                    if(!empty($data['employees'][$num]['email'])){                                
                                        if (in_array($data['employees'][$num]['email'], $emails)) {
                                            $data['emails'] = 'error';
                                        }else{
                                            array_push($emails, $data['employees'][$num]['email']);
                                        }
                                    }

                                    $employeeModel = new EmployeeModel($db);

                                    $query = $db->table('employees');
                                    $query->select('count(*) total');
                                    $query->where('email', $data['employees'][$num]['email']);
                                    $validate_email = $query->get()->getRowArray();

                                    if($validate_email['total'] > 0){
                                        $data['emails_registrados'] = lang('Home.El Correo electrónico ya se encuentra registrado en el sistema.'.' '.$data['employees'][$num]['email'].'');
                                    }
                                }

                                $num++;
                                
                            }

                            $data['positions'] = $positions;
                            $data['departments'] = $departments;
                        }

                        // datos de los servicios o funciones de los empleados
                        if($indice_hoja == 2){            
                            $highest_columns = $hoja_actual->getHighestColumn();
                            $num_cols = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highest_columns);
                            $num_rows = $hoja_actual->getHighestRow();

                            $num = 0;

                            for($row = 2; $row <= $num_rows; $row++) {
                                $description = 5;
                                $frequency = 6;
                                $monthly_amount = 7;
                                $productivity = 8;
                                $quality = 9;
                                $service = 10;
                                $innovation = 11;
                                $s = 0;
                                    
                                $total_services = ($num_cols - 4) / 7;

                                for ($column = 1; $column <= $total_services; $column++){
                                    if($hoja_actual->getCellByColumnAndRow($description, $row)->getValue() != '' || $hoja_actual->getCellByColumnAndRow($description, $row)->getValue() != NULL){

                                        $data['services'][$num]['description'][$s] = $hoja_actual->getCellByColumnAndRow($description, $row)->getValue();
                                        $description = $description + 7;

                                        $data['services'][$num]['frequency'][$s] = $hoja_actual->getCellByColumnAndRow($frequency, $row)->getValue();
                                        $frequency = $frequency + 7;

                                        $data['services'][$num]['monthly_amount'][$s] = $hoja_actual->getCellByColumnAndRow($monthly_amount, $row)->getValue();
                                        $monthly_amount = $monthly_amount + 7;

                                        $data['services'][$num]['productivity'][$s] = $hoja_actual->getCellByColumnAndRow($productivity, $row)->getValue();
                                        $productivity = $productivity + 7;

                                        $data['services'][$num]['quality'][$s] = $hoja_actual->getCellByColumnAndRow($quality, $row)->getValue();
                                        $quality = $quality + 7;

                                        $data['services'][$num]['service'][$s] = $hoja_actual->getCellByColumnAndRow($service, $row)->getValue();
                                        $service = $service + 7;

                                        $data['services'][$num]['innovation'][$s] = $hoja_actual->getCellByColumnAndRow($innovation, $row)->getValue();
                                        $innovation = $innovation + 7;

                                        $s++;
                                    }
                                }

                                $num++;
                            }
                        }

                        // datos de las calificaciones de las competencias
                        if($indice_hoja == 3){            
                            $highest_columns = $hoja_actual->getHighestColumn();
                            $num_cols = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highest_columns);
                            $num_rows = $hoja_actual->getHighestRow();

                            $num = 0;

                            for($row = 2; $row <= $num_rows; $row++) {
                                $c = 0;
                                $competency_id = 0;
                                for ($column = 5; $column <= $num_cols;){

                                    // if($hoja_actual->getCellByColumnAndRow($column++, $row)->getValue() != null){                        
                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;

                                        $data['employees_competencies'][$num]['competency_id'][$c] = $competency_id++;
                                        $data['employees_competencies'][$num]['qualification'][$c] = $hoja_actual->getCellByColumnAndRow($column++, $row)->getValue();
                                        $c++;
                                    // }

                                }

                                $num++;
                            }
                        }

                        // datos de las innovaciones del empleado
                        if($indice_hoja == 4){            
                            $highest_columns = $hoja_actual->getHighestColumn();
                            $num_cols = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highest_columns);
                            $num_rows = $hoja_actual->getHighestRow();

                            $num = 0;

                            for($row = 2; $row <= $num_rows; $row++) {
                                $innovation = 5;
                                $description = 6;
                                $annual_value = 7;
                                $in = 0;
                                    
                                $total_innovations = ($num_cols - 4) / 3;

                                for ($column = 1; $column <= $total_innovations; $column++){
                                    if($hoja_actual->getCellByColumnAndRow($innovation, $row)->getValue() != '' || $hoja_actual->getCellByColumnAndRow($innovation, $row)->getValue() != NULL){

                                        $data['innovations'][$num]['innovation'][$in] = $hoja_actual->getCellByColumnAndRow($innovation, $row)->getValue();
                                        $innovation = $innovation + 3;

                                        $data['innovations'][$num]['description'][$in] = $hoja_actual->getCellByColumnAndRow($description, $row)->getValue();
                                        $description = $description + 3;

                                        $data['innovations'][$num]['annual_value'][$in] = $hoja_actual->getCellByColumnAndRow($annual_value, $row)->getValue();
                                        $annual_value = $annual_value + 3;

                                        $in++;
                                    }
                                }

                                $num++;
                            }
                        }

                        // datos de las resoluciones del empleado
                        if($indice_hoja == 5){            
                            $highest_columns = $hoja_actual->getHighestColumn();
                            $num_cols = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highest_columns);
                            $num_rows = $hoja_actual->getHighestRow();

                            $num = 0;

                            for($row = 2; $row <= $num_rows; $row++) {
                                $resolution = 5;
                                $description = 6;
                                $re = 0;
                                    
                                $total_resolutions = ($num_cols - 4) / 2;

                                for ($column = 1; $column <= $total_resolutions; $column++){
                                    if($hoja_actual->getCellByColumnAndRow($resolution, $row)->getValue() != '' || $hoja_actual->getCellByColumnAndRow($resolution, $row)->getValue() != NULL){

                                        $data['resolutions'][$num]['resolution'][$re] = $hoja_actual->getCellByColumnAndRow($resolution, $row)->getValue();
                                        $resolution = $resolution + 2;

                                        $data['resolutions'][$num]['description'][$re] = $hoja_actual->getCellByColumnAndRow($description, $row)->getValue();
                                        $description = $description + 2;

                                        $re++;
                                    }
                                }

                                $num++;
                            }
                        }

                    }

                    if(!empty($data)){
                        $data['status'] = "OK";
                        $data['message'] = lang('Los datos se leyeron correctamente.');
                    }else{
                        $data['status'] = "ERROR";
                        $data['message'] = lang('El archivo no contiene datos.');
                        $data['data'] = '';
                    }
                } else {
                    $data['status'] = "ERROR";
                    $data['message'] = lang('Validar que las hojas(usuarios, Funciones, Calificar Compentencias En, Innovaciones, Resoluciones) tengan el mismo numero de filas.');
                    $data['data'] = '';
                }
                
            }
        }

        exit(json_encode($data));
    }

    public function validar_organizacion(){
        $validation =  \Config\Services::validation();
    
        $rules = [
                'organization' => [
                    'label'  => 'Organización',
                    'rules'  => 'not_in_list[null]|trim|required|is_unique[organizations.organization, organization_id, {organization_id}]',
                    'errors' => [
                        'not_in_list' => lang('Home.El campo Organización no puede estar vacio.'),
                        'required' => lang('Home.El campo Organización no puede estar vacio.'),
                        'is_unique' => lang('El campo Organización ya se encuentra registrado en el sistema, favor de intentar con una organización diferente.'),
                    ],
                ],
                'maturity_id' => [
                    'label'  => 'Madurez empresarial',
                    'rules'  => 'not_in_list[null]|trim|required',
                    'errors' => [
                        'not_in_list' => lang('Home.El campo Madurez empresarial no puede estar vacío, ubicado en la hoja organización.'),
                        'required' => lang('Home.El campo Madurez empresarial no puede estar vacío, ubicado en la hoja organización.'),
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

    public function validar_departamentos(){
        $validation =  \Config\Services::validation();
    
        $rules = [
            'department' => [
                'label'  => lang('Home.Departamento'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Departamento no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Departamento no puede estar vacío, ubicado en la hoja usuarios.'),
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

    public function validar_puestos(){
        $validation =  \Config\Services::validation();
    
        $rules = [
            'position' => [
                'label'  => lang('Home.Puesto'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Puesto no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Puesto no puede estar vacío, ubicado en la hoja usuarios.'),
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

    public function validar_usuarios(){
        $validation =  \Config\Services::validation();

        $rules = [
            'user' => [
                'label'  => lang('Home.Usuario'),
                'rules'  => 'not_in_list[null]|trim|required|is_unique[users.user, user_id, {user_id}]',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Usuario no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Usuario no puede estar vacío, ubicado en la hoja usuarios.'),
                    'is_unique' => lang('Home.El campo Usuario ya se encuentra registrado en el sistema, favor de intentar con un usuario diferente, ubicado en la hoja usuarios.'),
                ],
            ],
            'password' => [
                'label'  => lang('Home.Contraseña'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Contraseña no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Contraseña no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'credential_id' => [
                'label'  => lang('Home.Credencial'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Credencial no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Credencial no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $this->request->getPost('user').'-'.$validation->listErrors();
        }else{
            $response['status'] = "OK";
            $response['message'] = lang('Home.Campos validados.');
        }
        
        exit(json_encode($response));
    }

    public function validar_empleados(){
        $validation =  \Config\Services::validation();

        $not_in_list = '';
        $errors_not_in_list = '';
        $required = '';
        $errors = '';
        if($this->request->getPost('credential_id') > 4 && ($this->request->getPost('business_name') == null || $this->request->getPost('business_name') == 'null')){                
            $not_in_list = 'not_in_list[null]|';
            $errors_not_in_list = lang('Home.El campo Razón social no puede estar vacío, ubicado en la hoja usuarios.');
            $required = 'required';
            $errors = lang('Home.El campo Razón social no puede estar vacío, ubicado en la hoja usuarios.');
        }

        $rules = [
            'first_name' => [
                'label'  => lang('Home.Usuario'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Usuario no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Usuario no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'last_name' => [
                'label'  => lang('Home.Apellido paterno'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Apellido paterno no puede estar vacio.'),
                    'required' => lang('Home.El campo Apellido paterno no puede estar vacio.'),
                ],
            ],
            'business_name' => [
                'label'  => lang('Home.Razón social'),
                'rules'  => ''.$not_in_list.'trim|'.$required.'',
                'errors' => [
                    'not_in_list' => ''.$errors_not_in_list.'',
                    'required' => ''.$errors.'',
                ],
            ],
            'gender_id' => [
                'label'  => lang('Home.Género'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Género no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Género no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'birthday' => [
                'label'  => lang('Home.Fecha de nacimiento'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Fecha de nacimiento no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Fecha de nacimiento no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'email' => [
                'label'  => lang('Home.Correo electronico'),
                'rules'  => 'not_in_list[null]|trim|required|valid_email|is_unique[employees.email, user_id, {user_id}]',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Correo electronico no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Correo electronico no puede estar vacío, ubicado en la hoja usuarios.'),
                    'is_unique' => lang('Home.El campo Correo electronico ya se encuentra registrado en el sistema, ubicado en la hoja usuarios.'),
                    'valid_email' => lang('Home.El campo Correo electronico no cuenta con la estructura correcta, ubicado en la hoja usuarios.'),
                ],
            ],
            'phone' => [
                'label'  => lang('Home.Teléfono'),
                'rules'  => 'not_in_list[null]|trim|required|integer',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Teléfono no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Teléfono no puede estar vacío, ubicado en la hoja usuarios.'),
                    'integer' => lang('Home.El campo Teléfono solo debe ser numeros, ubicado en la hoja usuarios.'),
                    // 'is_natural' => lang('Home.El campo Teléfono solo debe ser numeros, ubicado en la hoja usuarios.'),
                ],
            ],
            'mobile' => [
                'label'  => lang('Home.Celular'),
                'rules'  => 'not_in_list[null]|trim|required|integer',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Celular no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Celular no puede estar vacío, ubicado en la hoja usuarios.'),
                    'integer' => lang('Home.El campo Celular solo debe ser numeros, ubicado en la hoja usuarios.'),
                    // 'is_natural' => lang('Home.El campo Celular solo debe ser numeros, ubicado en la hoja usuarios.'),
                ],
            ],
            'civil_status_id' => [
                'label'  => lang('Home.Estado civil'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Estado civil no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Estado civil no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'economic_dependents' => [
                'label'  => lang('Home.Dependientes economicos'),
                'rules'  => 'not_in_list[null]|trim|required|numeric',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Dependientes economicos no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Dependientes economicos no puede estar vacío, ubicado en la hoja usuarios.'),
                    'numeric' => lang('Home.El campo Dependientes economicos solo debe ser numeros, ubicado en la hoja usuarios.'),
                ],
            ],
            'street' => [
                'label'  => lang('Home.Calle'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Calle no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Calle no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'number' => [
                'label'  => lang('Home.Numero'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Numero no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Numero no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'suburb' => [
                'label'  => lang('Home.Colonia'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Colonia no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Colonia no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'postal_code' => [
                'label'  => lang('Home.Codigo postal'),
                'rules'  => 'not_in_list[null]|trim|required|numeric',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Codigo postal no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Codigo postal no puede estar vacío, ubicado en la hoja usuarios.'),
                    'numeric' => lang('Home.El campo Codigo postal solo debe ser numeros, ubicado en la hoja usuarios.'),
                ],
            ],
            'estate' => [
                'label'  => lang('Home.Estado'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Estado no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Estado no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'delegation' => [
                'label'  => lang('Home.Delegación'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Delegación no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Delegación no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'country_id' => [
                'label'  => lang('Home.País'),
                'rules'  => 'is_natural|trim|required|less_than_equal_to[250]',
                'errors' => [
                    'not_in_list' => lang('Home.El campo País no puede estar vacío, ubicado en la hoja usuarios.'),
                    'is_natural' => lang('Home.El campo País no puede estar vacío, ubicado en la hoja usuarios.'),
                    'less_than_equal_to' => lang('Home.El campo País no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo País no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'nationality_id' => [
                'label'  => lang('Home.Nacionalidad'),
                'rules'  => 'is_natural|trim|required|less_than_equal_to[250]',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Nacionalidad no puede estar vacío, ubicado en la hoja usuarios.'),
                    'is_natural' => lang('Home.El campo Nacionalidad no puede estar vacío, ubicado en la hoja usuarios.'),
                    'less_than_equal_to' => lang('Home.El campo Nacionalidad no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Nacionalidad no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
        ];

        $not_in_list = '';
        $errors_not_in_list = '';
        $required = '';
        $errors = '';
        // if($this->request->getPost('type_user_id') == 1){
        //     $not_in_list = 'not_in_list[null]|';
        //     $errors_not_in_list = '{field}-'.lang('Home.El campo no puede estar vacío, ubicado en la hoja usuarios.'); 
        //     $required = 'required';
        //     $errors = '{field}-'.lang('Home.El campo no puede estar vacío, ubicado en la hoja usuarios.');
        // }
        if($this->request->getPost('credential_id') < 5){
            $not_in_list = 'not_in_list[null]|';
            $errors_not_in_list = lang('Home.El campo Seguro social no puede estar vacío, ubicado en la hoja usuarios.'); 
            $required = 'required';
            $errors = lang('Home.El campo Seguro social no puede estar vacío, ubicado en la hoja usuarios.');

            $not_in_list_total = 'not_in_list[null]|';
            $errors_not_in_list_total = lang('Home.El campo Total no puede estar vacío, ubicado en la hoja usuarios.'); 
            $required_total = 'required';
            $errors_total = lang('Home.El campo Total no puede estar vacío, ubicado en la hoja usuarios.');
        }

        $rules = [
            // 'type_user_id' => [
            //     'label'  => lang('Home.Tipo de usuario'),
            //     'rules'  => 'not_in_list[null]|trim|required',
            //     'errors' => [
            //         'not_in_list' => '{field}-'.lang('Home.El campo no puede estar vacío, ubicado en la hoja usuarios.'),
            //         'required' => '{field}-'.lang('Home.El campo no puede estar vacío, ubicado en la hoja usuarios.'),
            //     ],
            // ],
            'schooling_id' => [
                'label'  => lang('Home.Educación'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Educación no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Educación no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'date_admission' => [
                'label'  => lang('Home.Fecha de ingreso'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Fecha de ingreso no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Fecha de ingreso no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'salary_amount' => [
                'label'  => lang('Home.Salario o cantidad comprada'),
                'rules'  => 'not_in_list[null]|trim|required',
                'errors' => [
                    'not_in_list' => lang('Home.El campo Salario o cantidad comprada no puede estar vacío, ubicado en la hoja usuarios.'),
                    'required' => lang('Home.El campo Salario o cantidad comprada no puede estar vacío, ubicado en la hoja usuarios.'),
                ],
            ],
            'social_security' => [
                'label'  => lang('Home.Seguro social'),
                'rules'  => ''.$not_in_list.'trim|decimal|'.$required.'',
                'errors' => [
                    'not_in_list' => ''.$errors_not_in_list.'',
                    'required' => ''.$errors.'',
                    'decimal' => lang('Home.El campo Seguro social solo debe ser numeros y decimales, ubicado en la hoja usuarios.')
                ],
            ],
            'total' => [
                'label'  => lang('Home.Total'),
                'rules'  => ''.$not_in_list.'trim|decimal|'.$required.'',
                'errors' => [
                    'not_in_list' => ''.$errors_not_in_list.'',
                    'required' => ''.$errors.'',
                    'decimal' => lang('Home.El campo Total solo debe ser numeros y decimales, ubicado en la hoja usuarios.')
                ],
            ],
            'disc' => [
                'label'  => lang('Home.Disc'),
                'rules'  => 'not_in_list[null]|trim|required|less_than_equal_to[8]|is_natural',
                'errors' => [
                    'required' => lang('Home.El campo no puede estar vacío, debe ser un valor de 0 a 8, ubicado en la hoja usuarios.'),
                    'not_in_list' => lang('Home.El campo no puede estar vacío, ubicado en la hoja usuarios.'),
                    'less_than_equal_to' => lang('Home.El campo no puede ser mayor a 8, ubicado en la hoja usuarios'),
                    'is_natural' => lang('Home.El campo no puede ser negativo, debe ser un valor de 0 a 8, ubicado en la hoja usuarios.')
                ],
            ],
        ];


        if(is_numeric($_POST['phone']) && is_numeric($_POST['mobile'])){        
            if(!$this->validate($rules)){
                $response['status'] = "ERROR";
                $response['message'] = $this->request->getPost('first_name').' '.$this->request->getPost('last_name').'-'.$validation->listErrors();
            }else{
                $response['status'] = "OK";
                $response['message'] = lang('Home.Campos validados.');
            }
        }else{
            if(!is_numeric($_POST['phone'])){
                $response['status'] = "ERROR";
                $response['message'] = lang('Home.El campo Teléfono no puede estar vacío, ubicado en la hoja usuarios.');
            }

            if(!is_numeric($_POST['mobile'])){        
                $response['status'] = "ERROR";
                $response['message'] = lang('Home.El campo Celular no puede estar vacío, ubicado en la hoja usuarios.');
            }
        }

        
        exit(json_encode($response));
    }

    public function validar_calificaciones(){
        $data = array();
        $validar = array();

        $file_data = $this->request->getFile('archivo_excel');

        $validation =  \Config\Services::validation();

        $rules = [
            'qualification1' => [
                'label'  => lang('Home.Coeficiente Intelectual'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[200]',
                'errors' => [
                    'required' => lang('Home.El campo Coeficiente Intelectual no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Coeficiente Intelectual solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Coeficiente Intelectual no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Coeficiente Intelectual no puede ser mayor a 200 en.')
                ],
            ],
            'qualification2' => [
                'label'  => lang('Home.Competencia en Análisis de Problemas'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Análisis de Problemas no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia en Análisis de Problemas solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia en Análisis de Problemas no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia en Análisis de Problemas no puede ser mayor a 100 en.')
                ],
            ],
            'qualification3' => [
                'label'  => lang('Home.Competencia para la Toma de Decisiones'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para la Toma de Decisiones no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia para la Toma de Decisiones solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia para la Toma de Decisiones no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia para la Toma de Decisiones no puede ser mayor a 100 en.')
                ],
            ],
            'qualification4' => [
                'label'  => lang('Home.Competencia de Juicio'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia de Juicio no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia de Juicio solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia de Juicio no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia de Juicio no puede ser mayor a 100 en.')
                ],
            ],
            'qualification5' => [
                'label'  => lang('Home.Competencia en Comunicación'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Comunicación no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia en Comunicación solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia en Comunicación no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia en Comunicación no puede ser mayor a 100 en.')
                ],
            ],
            'qualification6' => [
                'label'  => lang('Home.Competencia en Liderazgo'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Liderazgo no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia en Liderazgo solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia en Liderazgo no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia en Liderazgo no puede ser mayor a 100 en.')
                ],
            ],
            'qualification7' => [
                'label'  => lang('Home.Competencia para la Delegación'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para la Delegación no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia para la Delegación solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia para la Delegación no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia para la Delegación no puede ser mayor a 100 en.')
                ],
            ],
            'qualification8' => [
                'label'  => lang('Home.Competencia para el Desarrollo de Colaboradores'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para el Desarrollo de Colaboradores no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia para el Desarrollo de Colaboradores solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia para el Desarrollo de Colaboradores no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia para el Desarrollo de Colaboradores no puede ser mayor a 100 en.')
                ],
            ],
            'qualification9' => [
                'label'  => lang('Home.Competencia para el Trabajo en Equipo'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para el Trabajo en Equipo no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia para el Trabajo en Equipo solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia para el Trabajo en Equipo no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia para el Trabajo en Equipo no puede ser mayor a 100 en.')
                ],
            ],
            'qualification10' => [
                'label'  => lang('Home.Competencia en Inteligencia Emocional'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Inteligencia Emocional no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia en Inteligencia Emocional solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia en Inteligencia Emocional no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia en Inteligencia Emocional no puede ser mayor a 100 en.')
                ],
            ],
            'qualification11' => [
                'label'  => lang('Home.Competencia para la Tolerancia a la Presión'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para la Tolerancia a la Presión no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia para la Tolerancia a la Presión solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia para la Tolerancia a la Presión no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia para la Tolerancia a la Presión no puede ser mayor a 100 en.')
                ],
            ],
            'qualification12' => [
                'label'  => lang('Home.Competencia en Actitud de Servicio'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Actitud de Servicio no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia en Actitud de Servicio solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia en Actitud de Servicio no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia en Actitud de Servicio no puede ser mayor a 100 en.')
                ],
            ],
            'qualification13' => [
                'label'  => lang('Home.Competencia para el Seguimiento y Control'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia para el Seguimiento y Control no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia para el Seguimiento y Control solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia para el Seguimiento y Control no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia para el Seguimiento y Control no puede ser mayor a 100 en.')
                ],
            ],
            'qualification14' => [
                'label'  => lang('Home.Competencia en Planeación y Organización'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Planeación y Organización no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia en Planeación y Organización solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia en Planeación y Organización no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia en Planeación y Organización no puede ser mayor a 100 en.')
                ],
            ],
            'qualification15' => [
                'label'  => lang('Home.Competencia en Enfoque a Resultados'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Competencia en Enfoque a Resultados no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Competencia en Enfoque a Resultados solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Competencia en Enfoque a Resultados no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Competencia en Enfoque a Resultados no puede ser mayor a 100 en.')
                ],
            ],
            'qualification16' => [
                'label'  => lang('Home.Gusto por la Venta'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Gusto por la Venta no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Gusto por la Venta solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Gusto por la Venta no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo campo Gusto por la Venta no puede ser mayor a 100 en.')
                ],
            ],
            'qualification17' => [
                'label'  => lang('Home.Capacidad de Negociación'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Capacidad de Negociación no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Capacidad de Negociación solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Capacidad de Negociación no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Capacidad de Negociación no puede ser mayor a 100 en.')
                ],
            ],
            'qualification18' => [
                'label'  => lang('Home.Habilidades de Comunicación'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Habilidades de Comunicación no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Habilidades de Comunicación solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Habilidades de Comunicación no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Habilidades de Comunicación no puede ser mayor a 100 en.')
                ],
            ],
            'qualification19' => [
                'label'  => lang('Home.Empatía'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Empatía no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Empatía solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Empatía no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Empatía no puede ser mayor a 100 en.')
                ],
            ],
            'qualification20' => [
                'label'  => lang('Home.Orientación a Resultados para las ventas'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Orientación a Resultados para las ventas no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Orientación a Resultados para las ventas solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Orientación a Resultados para las ventas no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Orientación a Resultados para las ventas no puede ser mayor a 100 en.')
                ],
            ],
            'qualification21' => [
                'label'  => lang('Home.Tolerancia al Rechazo'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Tolerancia al Rechazo no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Tolerancia al Rechazo solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Tolerancia al Rechazo no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Tolerancia al Rechazo no puede ser mayor a 100 en.')
                ],
            ],
            'qualification22' => [
                'label'  => lang('Home.Autodisciplina'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Autodisciplina no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Autodisciplina solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Autodisciplina no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Autodisciplina no puede ser mayor a 100 en.')
                ],
            ],
            'qualification23' => [
                'label'  => lang('Home.Liderazgo Directivo'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Directivo no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Liderazgo Directivo solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Liderazgo Directivo no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Liderazgo Directivo no puede ser mayor a 100 en.')
                ],
            ],
            'qualification24' => [
                'label'  => lang('Home.Liderazgo Participativo ó Democrático'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Participativo ó Democrático no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Liderazgo Participativo ó Democrático solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Liderazgo Participativo ó Democrático no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Liderazgo Participativo ó Democrático no puede ser mayor a 100 en.')
                ],
            ],
            'qualification25' => [
                'label'  => lang('Home.Liderazgo Delegativo'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Delegativo no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Liderazgo Delegativo solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Liderazgo Delegativo no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Liderazgo Delegativo no puede ser mayor a 100 en.')
                ],
            ],
            'qualification26' => [
                'label'  => lang('Home.Liderazgo Transformacional'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Transformacional no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Liderazgo Transformacional solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Liderazgo Transformacional no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Liderazgo Transformacional no puede ser mayor a 100 en.')
                ],
            ],
            'qualification27' => [
                'label'  => lang('Home.Liderazgo Transaccional'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Liderazgo Transaccional no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Liderazgo Transaccional solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Liderazgo Transaccional no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Liderazgo Transaccional no puede ser mayor a 100 en.')
                ],
            ],
            'qualification28' => [
                'label'  => lang('Home.Capacidad de Comunicación'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Capacidad de Comunicación no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Capacidad de Comunicación solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Capacidad de Comunicación no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Capacidad de Comunicación no puede ser mayor a 100 en.')
                ],
            ],
            'qualification29' => [
                'label'  => lang('Home.Inteligencia Emocional'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Inteligencia Emocional no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Inteligencia Emocional solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Inteligencia Emocional no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Inteligencia Emocional no puede ser mayor a 100 en.')
                ],
            ],
            'qualification30' => [
                'label'  => lang('Home.Toma de Decisiones'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Toma de Decisiones no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Toma de Decisiones solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Toma de Decisiones no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Toma de Decisiones no puede ser mayor a 100 en.')
                ],
            ],
            'qualification31' => [
                'label'  => lang('Home.Orientación a Resultados'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Orientación a Resultados no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Orientación a Resultados solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Orientación a Resultados no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Orientación a Resultados no puede ser mayor a 100 en.')
                ],
            ],
            'qualification32' => [
                'label'  => lang('Home.Habilidades de Negociación'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Habilidades de Negociación no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Habilidades de Negociación solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Habilidades de Negociación no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Habilidades de Negociación no puede ser mayor a 100 en.')
                ],
            ],
            'qualification33' => [
                'label'  => lang('Home.Capacidad de Mando'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Capacidad de Mando no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Capacidad de Mando solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Capacidad de Mando no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Capacidad de Mando no puede ser mayor a 100 en.')
                ],
            ],
            'qualification34' => [
                'label'  => lang('Home.Capacidad de Planeación'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Capacidad de Planeación no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Capacidad de Planeación solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Capacidad de Planeación no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Capacidad de Planeación no puede ser mayor a 100 en.')
                ],
            ],
            'qualification35' => [
                'label'  => lang('Home.Conciencia de sus Fortalezas'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Conciencia de sus Fortalezas no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Conciencia de sus Fortalezas solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Conciencia de sus Fortalezas no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Conciencia de sus Fortalezas no puede ser mayor a 100 en.')
                ],
            ],
            'qualification36' => [
                'label'  => lang('Home.Desarrollo Personal y de su Equipo'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Desarrollo Personal y de su Equipo no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Desarrollo Personal y de su Equipo solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Desarrollo Personal y de su Equipo no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Desarrollo Personal y de su Equipo no puede ser mayor a 100 en.')
                ],
            ],
            'qualification37' => [
                'label'  => lang('Home.Carisma y Habilidades Sociales'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Carisma y Habilidades Sociales no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Carisma y Habilidades Sociales solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Carisma y Habilidades Sociales no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Carisma y Habilidades Sociales no puede ser mayor a 100 en.')
                ],
            ],
            'qualification38' => [
                'label'  => lang('Home.Conciencia Social'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Conciencia Social no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Conciencia Social solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Conciencia Social no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Conciencia Social no puede ser mayor a 100 en.')
                ],
            ],
            'qualification39' => [
                'label'  => lang('Home.Creatividad e Innovación'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Creatividad e Innovación no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Creatividad e Innovación solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Creatividad e Innovación no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Creatividad e Innovación no puede ser mayor a 100 en.')
                ],
            ],
            'qualification40' => [
                'label'  => lang('Home.Responsabilidad'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Responsabilidad no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Responsabilidad solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Responsabilidad no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Responsabilidad no puede ser mayor a 100 en.')
                ],
            ],
            'qualification41' => [
                'label'  => lang('Home.Habilidad de Información'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Habilidad de Información no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Habilidad de Información solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Habilidad de Información no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Habilidad de Información no puede ser mayor a 100 en.')
                ],
            ],
            'qualification42' => [
                'label'  => lang('Home.Adaptación al Cambio'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Adaptación al Cambio no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Adaptación al Cambio solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Adaptación al Cambio no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Adaptación al Cambio no puede ser mayor a 100 en.')
                ],
            ],
            'qualification43' => [
                'label'  => lang('Home.Índice de Confianza'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Índice de Confianza no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Índice de Confianza solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Índice de Confianza no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Índice de Confianza no puede ser mayor a 100 en.')
                ],
            ],
            'qualification44' => [
                'label'  => lang('Home.Descripción del Nivel de Certidumbre y Confianza General'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Descripción del Nivel de Certidumbre y Confianza General no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Descripción del Nivel de Certidumbre y Confianza General solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Descripción del Nivel de Certidumbre y Confianza General no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Descripción del Nivel de Certidumbre y Confianza General no puede ser mayor a 100 en.')
                ],
            ],
            'qualification45' => [
                'label'  => lang('Home.Nivel de Honestidad'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Nivel de Honestidad no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Nivel de Honestidad solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Nivel de Honestidad no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Nivel de Honestidad no puede ser mayor a 100 en.')
                ],
            ],
            'qualification46' => [
                'label'  => lang('Home.Descripción del Nivel de Honestidad'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Descripción del Nivel de Honestidad no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Descripción del Nivel de Honestidad solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Descripción del Nivel de Honestidad no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Descripción del Nivel de Honestidad no puede ser mayor a 100 en.')
                ],
            ],
            'qualification47' => [
                'label'  => lang('Home.Nivel de ética'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Nivel de ética no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Nivel de ética solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Nivel de ética no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Nivel de ética no puede ser mayor a 100 en.')
                ],
            ],
            'qualification48' => [
                'label'  => lang('Home.Descripción del Nivel de ética'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Descripción del Nivel de ética no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Descripción del Nivel de ética solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Descripción del Nivel de ética no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Descripción del Nivel de ética no puede ser mayor a 100 en.')
                ],
            ],
            'qualification49' => [
                'label'  => lang('Home.Nivel de Valores'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Nivel de Valores no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Nivel de Valores solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Nivel de Valores no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Nivel de Valores no puede ser mayor a 100 en.')
                ],
            ],
            'qualification50' => [
                'label'  => lang('Home.Descripción del Nivel de Valores'),
                'rules'  => 'trim|required|numeric|is_natural|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Descripción del Nivel de Valores no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'numeric' => lang('Home.El campo Descripción del Nivel de Valores solo debe ser numeros y no puede estar vacío, ubicado en la hoja calificar competencias en.'),
                    'is_natural' => lang('Home.El campo Descripción del Nivel de Valores no puede ser un numero negativo, ubicado en la hoja calificar competencias en.'),
                        'less_than_equal_to' => lang('Home.El campo Descripción del Nivel de Valores no puede ser mayor a 100 en.')
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

    public function validar_innovaciones(){
        $validation =  \Config\Services::validation();

        for ($i=0; $i < $this->request->getPost('total'); $i++) { 
            $rules = [
                'innovation'.$i => [
                    'label'  => lang('Home.Innovación'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Innovación no puede estar vacío, ubicado en la hoja innovaciones.'),
                    ],
                ],
                'description'.$i => [
                    'label'  => lang('Home.Descripción'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Descripción no puede estar vacío, ubicado en la hoja innovaciones.'),
                    ],
                ],
                'annual_value'.$i => [
                    'label'  => lang('Home.Valor anual'),
                    'rules'  => 'trim|required|decimal',
                    'errors' => [
                        'required' => lang('Home.El campo Valor anual no puede estar vacío, ubicado en la hoja innovaciones.'),
                        'decimal' => lang('Home.El campo Valor anual solo debe ser numeros y decimales, ubicado en la hoja innovaciones.')
                    ],
                ]
            ];

            if(!$this->validate($rules)){
                $response['status'] = "ERROR";
                $response['message'] = $validation->listErrors();
                exit(json_encode($response));
            }else{
                $response['status'] = "OK";
                $response['message'] = lang('Home.Campos validados.');
            }
        }

        exit(json_encode($response));
    }

    public function validar_resoluciones(){
        $validation =  \Config\Services::validation();

        for ($i=0; $i < $this->request->getPost('total'); $i++) { 
            $rules = [
                'resolution'.$i => [
                    'label'  => lang('Home.Resolución'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Resolución no puede estar vacío, ubicado en la hoja resoluciones.'),
                    ],
                ],
                'description'.$i => [
                    'label'  => lang('Home.Descripción'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Descripción no puede estar vacío, ubicado en la hoja resoluciones.'),
                    ],
                ]
            ];

            if(!$this->validate($rules)){
                $response['status'] = "ERROR";
                $response['message'] = $validation->listErrors();
                exit(json_encode($response));
            }else{
                $response['status'] = "OK";
                $response['message'] = lang('Home.Campos validados.');
            }
        }

        exit(json_encode($response));
    }

    public function validar_servicios(){
        $validation =  \Config\Services::validation();

        for ($i=0; $i < $this->request->getPost('total'); $i++) { 
            $rules = [
                'description'.$i => [
                    'label'  => lang('Home.Descripción'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo no puede estar vacío, ubicado en la hoja funciones.'),
                    ],
                ],
                'frequency'.$i => [
                    'label'  => lang('Home.Frecuencia'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Frecuencia no puede estar vacío, ubicado en la hoja funciones.'),
                    ],
                ],
                'monthly_amount'.$i => [
                    'label'  => lang('Home.Cantidad al mes'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Cantidad al mes no puede estar vacío, ubicado en la hoja funciones.'),
                    ],
                ],
                'productivity'.$i => [
                    'label'  => lang('Home.Productividad'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Productividad no puede estar vacío, ubicado en la hoja funciones.'),
                    ],
                ],
                'quality'.$i => [
                    'label'  => lang('Home.Calidad'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Calidad no puede estar vacío, ubicado en la hoja funciones.'),
                    ],
                ],
                'innovation'.$i => [
                    'label'  => lang('Home.Innovación'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Innovación no puede estar vacío, ubicado en la hoja funciones.'),
                    ],
                ],
                'service'.$i => [
                    'label'  => lang('Home.Servicio'),
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => lang('Home.El campo Servicio no puede estar vacío, ubicado en la hoja funciones.'),
                    ],
                ]
            ];

            if(!$this->validate($rules)){
                $response['status'] = "ERROR";
                $response['message'] = $validation->listErrors();
                exit(json_encode($response));
            }else{
                $response['status'] = "OK";
                $response['message'] = lang('Home.Campos validados.');
            }
        }

        exit(json_encode($response));
    }

    public function guardar_organizacion(){
        $data = [
            'organization' => $this->request->getPost('organization'),
            'maturity_id'  => $this->request->getPost('maturity_id'),
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $organizationModel = new OrganizationModel($db);
        $db->table('organizations')->insert($data);
        $organization_id = $db->insertID();

        exit(json_encode($organization_id));
    }

    public function guardar_departamentos(){
        $data = [
            'department' => $this->request->getPost('department'),
            'organization_id'  => $this->request->getPost('organization_id'),
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $departmentModel = new DepartmentModel($db);
        $query = $db->table('departments')->insert($data);
        $res['department_id'] = $db->insertID();
        $res['department'] = $this->request->getPost('department');

        exit(json_encode($res));
    }

    public function guardar_puestos(){
        $data = [
            'position' => $this->request->getPost('position'),
            'organization_id'  => $this->request->getPost('organization_id'),
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $positionModel = new PositionModel($db);

        $query = $db->table('positions')->insert($data);
        $res['position_id'] = $db->insertID();
        $res['position'] = $this->request->getPost('position');

        exit(json_encode($res));
    }

    public function guardar_usuarios(){
        $data = [
            'user' => $this->request->getPost('user'),
            'password'  => md5($this->request->getPost('password')),
            'credential_id'  => $this->request->getPost('credential_id'),
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $userModel = new UserModel($db);

        $query = $db->table('users')->insert($data);
        $res['user_id'] = $db->insertID();

        $data = [
            'user_id' => $res['user_id'],
            'created_by'  => $this->session->get('user_id'),
            'created_at'  => date('Y-m-d H:i:s'),
            'deleted_at'  => NULL
        ];

        $query = $db->table('employees')->insert($data);
        $res['employee_id'] = $db->insertID();

        exit(json_encode($res));
    }

    public function guardar_empleados(){
        if($this->request->getPost('second_name') == 'null' || $this->request->getPost('second_name') == null){
            $second_name = '';
        }else{
            $second_name = $this->request->getPost('second_name');
        }

        if($this->request->getPost('second_last_name') == 'null' || $this->request->getPost('second_last_name') == null){
            $second_last_name = '';
        }else{
            $second_last_name = $this->request->getPost('second_last_name');
        }

        if($this->request->getPost('business_name') == 'null'){
            $business_name = '';
        }else{
            $business_name = $this->request->getPost('business_name');
        }

        if($this->request->getPost('benefit_1') == 'null'){
            $benefit_1 = '';
        }else{
            $benefit_1 = $this->request->getPost('benefit_1');
        }

        if($this->request->getPost('benefit_2') == 'null'){
            $benefit_2 = '';
        }else{
            $benefit_2 = $this->request->getPost('benefit_2');
        }

        if($this->request->getPost('benefit_3') == 'null'){
            $benefit_3 = '';
        }else{
            $benefit_3 = $this->request->getPost('benefit_3');
        }

        if($this->request->getPost('benefit_4') == 'null'){
            $benefit_4 = '';
        }else{
            $benefit_4 = $this->request->getPost('benefit_4');
        }

        $data = [
            'first_name'            => $this->request->getPost('first_name'),
            'second_name'            => $second_name,
            'last_name'            => $this->request->getPost('last_name'),
            'second_last_name'            => $second_last_name, 
            'business_name'            => $business_name,
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
            // 'type_user_id'            => $this->request->getPost('type_user_id'),
            'salary_amount'            => $this->request->getPost('salary_amount'),
            'social_security'            => $this->request->getPost('social_security'),
            'benefit_1'            => $benefit_1, 
            'benefit_amount_1'            => $this->request->getPost('benefit_amount_1'),
            'benefit_2'            => $benefit_2, 
            'benefit_amount_2'            => $this->request->getPost('benefit_amount_2'),
            'benefit_3'            => $benefit_3, 
            'benefit_amount_3'            => $this->request->getPost('benefit_amount_3'),
            'benefit_4'            => $benefit_4, 
            'benefit_amount_4'            => $this->request->getPost('benefit_amount_4'),
            'total'            => $this->request->getPost('total'),
            'disc'            => $this->request->getPost('disc'),
            'date_admission'            => $this->request->getPost('date_admission'), 
            'schooling_id'            => $this->request->getPost('schooling_id'), 
            'organization_id'            => $this->request->getPost('organization_id'), 
            'department_id'            => $this->request->getPost('department_id'), 
            'position_id'            => $this->request->getPost('position_id'),
            'mission'            => $this->request->getPost('mission'),
            'vision'            => $this->request->getPost('vision'),
            'competitive_advantages'            => $this->request->getPost('competitive_advantages'),
            'comparative_advantages'            => $this->request->getPost('comparative_advantages'),
            'modified_by'  => $this->session->get('user_id'),
            'updated_at'  => date('Y-m-d H:i:s'),
            'deleted_at'  => NULL
        ];

        $employeeModel = new EmployeeModel($db);

        $query = $employeeModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();

        exit(json_encode($query));
    }

    public function guardar_calificaciones(){
        $j = 1;
        $sumatoria = 0;
        for ($i=0; $i < 50; $i++) { 
            $data = [
                'user_id' => $this->request->getPost('user_id'.$j),
                'competency_id'  => $i + 1,
                'qualification'  => $this->request->getPost('qualification'.$j),
                'created_by'  => $this->session->get('user_id'.$j),
                'created_at'  => date('Y-m-d H:i:s')
            ];
            $employeescompetenciesModel = new EmployeesCompetenciesModel($db);
            $query = $db->table('employees_competencies')->insert($data);

            $sumatoria = $sumatoria + $this->request->getPost('qualification'.$j);
            $k = $j;
            $j++;
        }

        $promedio = round($sumatoria / 50, 2);
        $data = [
            'average'  => $promedio,
            'modified_by'  => $this->session->get('user_id'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $employeeModel = new EmployeeModel($db);

        $query = $employeeModel->set($data)->where('user_id', $this->request->getPost('user_id'.$k))->update();

        $res = lang('Home.Se guardaron los datos correctamente.');

        exit(json_encode($res));
    }

    public function guardar_innovaciones(){
        for ($i=0; $i < $this->request->getPost('total'); $i++) {
            $data = [
                'user_id' => $this->request->getPost('user_id'.$i),
                'innovation'  => trim($this->request->getPost('innovation'.$i)),
                'annual_value'  => trim($this->request->getPost('annual_value'.$i)),
                'description'  => trim($this->request->getPost('description'.$i)),
                'created_by'  => $this->session->get('user_id'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            $innovationModel = new InnovationModel($db);
            $query = $db->table('innovations')->insert($data);
        }

        $res = lang('Home.Se guardaron los datos correctamente.');

        exit(json_encode($res));
    }

    public function guardar_resoluciones(){
        for ($i=0; $i < $this->request->getPost('total'); $i++) {
            $data = [
                'user_id' => $this->request->getPost('user_id'.$i),
                'resolution'  => trim($this->request->getPost('resolution'.$i)),
                'description'  => trim($this->request->getPost('description'.$i)),
                'created_by'  => $this->session->get('user_id'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            $resolutionModel = new ResolutionModel($db);
            $query = $db->table('resolutions')->insert($data);
        }

        $res = lang('Home.Se guardaron los datos correctamente.');

        exit(json_encode($res));
    }

    public function guardar_servicios(){

        for ($i=0; $i < $this->request->getPost('total'); $i++) {
            $employeeModel = new EmployeeModel($db);

            $query = $db->table('employees');
            $query->select('organization_id, position_id');
            $query->where('user_id', $this->session->get('user_id'));
            $employees = $query->get()->getRowArray();

            $data = [
                'user_id'  => $this->request->getPost('user_id'.$i),
                'organization_id'  => $employees['organization_id'],
                'position_id'  => $employees['position_id'],
                'description'  => $this->request->getPost('description'.$i),
                'frequency'  => $this->request->getPost('frequency'.$i),
                'employee_cost'  => 0,
                'created_admin'  => 0,
                'monthly_amount'  => $this->request->getPost('monthly_amount'.$i),
                'productivity'  => $this->request->getPost('productivity'.$i),
                'quality'  => $this->request->getPost('quality'.$i),
                'innovation'  => $this->request->getPost('innovation'.$i),
                'service'  => $this->request->getPost('service'.$i),
                'weighing'  => 0,
                'status'  => 1,
                'created_by'  => $this->request->getPost('user_id'.$i),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            $serviceModel = new ServiceModel($db);
            $query = $db->table('services')->insert($data);
        }

        $res = lang('Home.Se guardaron los datos correctamente.');

        exit(json_encode($res));
    }

}
