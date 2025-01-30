<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TaskModel;
use App\Models\EmployeeModel;

class Tasks extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
    }

	public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $taskModel = new TaskModel($db);

        $query = $db->table('tasks t');
        $query->select('t.*, ts.status, s.description');
        $query->join('tasks_status ts', 'ts.task_status_id = t.status_id', "left");
        $query->join('services s', 's.service_id = t.service_id', "left");
        $query->where('t.deleted_at', NULL);
        $query->where('t.my_productivity', 0);
        if($this->session->get('user_id') != 1){
            $query->where('t.created_by', $this->session->get('user_id'));
        }

        $data['tasks'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Servicios que he pedido');
        $data['sub_title'] = lang('Home.Servicios que he pedido');
		$data['custom'] = 'tasks';
        $data['content'] = 'tasks/tasks_view';

        return view('templates/common/Layout_view',$data);
	}

    public function validar_form(){
        $validation =  \Config\Services::validation();
        $rules = [
            'user_id' => [
                'label'  => lang('Home.Empleado'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Empleado no puede estar vacio.'),
                ],
            ],
            'service_id' => [
                'label'  => lang('Home.Servicio o Función'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Servicio o Función no puede estar vacio.'),
                ],
            ],
            'delivery_date' => [
                'label'  => lang('Home.Fecha para entrega del servicio'),
                'rules'  => 'trim|required',
                'errors' => [
                    'required' => lang('Home.El campo Fecha para entrega del servicio no puede estar vacio.'),
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

    public function form_view($task_id){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $taskModel = new TaskModel($db);

        $query = $db->table('users u');
        $query->select('u.*, e.position_id, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) name');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->where('organization_id', $this->session->get('organization_id'));
        $query->where('u.user_id !=', $this->session->get('user_id'));
        $data['employees'] = $query->get()->getResultArray();

        $query = $db->table('tasks');
        $query->select('*');
        $query->where('task_id', $task_id);
        $data['task'] = $query->get()->getRowArray();

        if(empty($data['task'])){
            $data['task']['task_id'] = '';
            $data['task']['user_id'] = '';
            $data['task']['service_id'] = '';
            $data['task']['delivery_date'] = '';
            $data['task']['productivity'] = '';
            $data['task']['quality'] = '';
            $data['task']['innovation'] = '';
            $data['task']['service'] = '';
        }

        $data['title'] = 'Tareas';
        $data['sub_title'] = 'Agregar tareas';
        $data['custom'] = 'tasks';
        $data['content'] = 'tasks/form_view';

        return view('templates/common/Layout_view',$data);
    }

    public function form_datos(){

        $taskModel = new TaskModel($db);

        if($this->request->getPost('my_productivity') == 0){        
            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'service_id'  => $this->request->getPost('service_id'),
                'delivery_date'  => $this->request->getPost('delivery_date'),
                'productivity'  => $this->request->getPost('productivity'),
                'quality'  => $this->request->getPost('quality'),
                'innovation'  => $this->request->getPost('innovation'),
                'service'  => $this->request->getPost('service'),
                'my_productivity'  => $this->request->getPost('my_productivity'),
                'created_by'  => $this->session->get('user_id'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            $query2 = $db->table('employees e');
            $query2->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) employee, e.email');
            $query2->where('e.user_id', $this->request->getPost('user_id'));
            $employee = $query2->get()->getRowArray();

            $query2 = $db->table('employees e');
            $query2->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) author, e.email');
            $query2->where('e.user_id', $this->session->get('user_id'));
            $author = $query2->get()->getRowArray();
        }else{
            $data = [
                'user_id'  => $this->session->get('user_id'),
                'service_id'  => $this->request->getPost('service_id'),
                'delivery_date'  => $this->request->getPost('delivery_date'),
                'productivity'  => $this->request->getPost('productivity'),
                'quality'  => $this->request->getPost('quality'),
                'innovation'  => $this->request->getPost('innovation'),
                'service'  => $this->request->getPost('service'),
                'my_productivity'  => $this->request->getPost('my_productivity'),
                'status_id'  => 3,
                'amount'  => $this->request->getPost('amount'),
                'created_by' => $this->request->getPost('user_id'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            $query2 = $db->table('employees e');
            $query2->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) employee, e.email');
            $query2->where('e.user_id', $this->session->get('user_id'));
            $employee = $query2->get()->getRowArray();

            $query2 = $db->table('employees e');
            $query2->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) author, e.email');
            $query2->where('e.user_id', $this->request->getPost('user_id'));
            $author = $query2->get()->getRowArray();
        }

        if(empty($this->request->getPost('task_id'))){
            $query = $db->table('tasks')->insert($data);
        }else{
            $query = $taskModel->set($data)->where('task_id', $this->request->getPost('task_id'))->update();
        }

        $subject = lang('Home.Solicitud de servicio');

        $message = lang("Home.Hola")." ".$employee['employee']."\n\n".lang("Home.Se te ha solicitado un servicio por parte de")." ".$author['author']."\n\n".lang("Home.Fecha del servicio").": ".$this->request->getPost('delivery_date')."\n\n".lang("Home.Productividad").": ".$this->request->getPost('productivity')."\n\n".lang("Home.Calidad").": ".$this->request->getPost('quality')."\n\n".lang("Home.Servicio").": ".$this->request->getPost('service')."\n\n".lang("Home.Innovación").": ".$this->request->getPost('innovation')."\n\n".lang("Home.Por favor, no responder a este correo electrónico generado de forma automática")." \n\n Business & Education Consulting Group";

        // Datos el email destino. Donde irá a parar el formulario
        $this->email->setTo(''.$employee['email'].'');
        $this->email->setCc(''.$author['email'].'');
        // $this->email->setCc('gerardofrancisco.rodriguez@hotmail.com');

        // Email desde el que se envía (el que hemos configurarado en el apartado anterior)
        $this->email->setFrom("no-reply@midominio.com", "ACCELE-RATE");

        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        $response = array();

        if($this->email->send()){
            $response['status'] = "OK";
            $response['message'] = lang('Home.Se envio un correo');
        }else{
            $response['status'] = "ERROR";
            $response['message'] = lang('Home.Email No enviado').'<br/>'. $this->email->printDebugger(['headers']);
        }

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($res));
    }

    public function eliminar_datos(){
        $taskModel = new TaskModel($db);
        $res = $taskModel->where('task_id', $this->request->getPost('task_id'))->delete();
        exit(json_encode($res));
    }

    public function get_services(){
        $taskModel = new TaskModel($db);

        $query = $db->table('services');
        $query->select('*');
        $query->where('user_id', $this->request->getPost('user_id'));
        $query->where('deleted_at', NULL);
        // $query->orwhere("(position_id = ".$this->request->getPost('position_id')." AND created_admin = 1)");
        $res = $query->get()->getResultArray();

        exit(json_encode($res));    
    }

    public function requested_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $taskModel = new TaskModel($db);

        $query = $db->table('tasks t');
        $query->select('t.*, ts.status, s.description');
        $query->join('tasks_status ts', 'ts.task_status_id = t.status_id', "left");
        $query->join('services s', 's.service_id = t.service_id', "left");
        $query->where('t.deleted_at', NULL);
        $query->where('t.user_id', $this->session->get('user_id'));
        // $query->orwhere("(s.position_id = ".$this->session->get('position_id')." AND created_admin = 1)");

        $data['tasks'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Servicios que me han pedido');
        $data['sub_title'] = 'Servicios que me han pedido';
        $data['custom'] = 'tasks';
        $data['content'] = 'tasks/requested_view';

        return view('templates/common/Layout_view',$data);
    }

    public function cambiar_status(){
        $data = [
            'status_id' => $this->request->getPost('status_id'),
            'modified_by'  => $this->session->get('user_id'),
            'updated_at'  => date('Y-m-d H:i:s')
        ];

        if($this->request->getPost('status_id') == 1){
            $status = 'Requisitado';
        }
        if($this->request->getPost('status_id') == 2){
            $status = 'En progreso';
            $data = [
                'start_date'  => date('Y-m-d H:i:s'),
                'status_id' => $this->request->getPost('status_id'),
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];
        }
        if($this->request->getPost('status_id') == 3){
            $status = 'Finalizado';
            $data = [
                'finish_date'  => date('Y-m-d H:i:s'),
                'status_id' => $this->request->getPost('status_id'),
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];
        }
        if($this->request->getPost('status_id') == 4){
            $status = lang('Home.Evaluado');
        }
        if($this->request->getPost('status_id') == 5){
            $status = lang('Home.Rechazado');
        }

        $taskModel = new TaskModel($db);

        $query2 = $db->table('employees e');
        $query2->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) employee, e.email');
        $query2->where('e.user_id', $this->request->getPost('user_id'));
        $employee = $query2->get()->getRowArray();

        $query2 = $db->table('employees e');
        $query2->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) author, e.email');
        $query2->where('e.user_id', $this->request->getPost('created_by'));
        $author = $query2->get()->getRowArray();

        $query2 = $db->table('tasks t');
        $query2->select('*');
        $query2->where('t.task_id', $this->request->getPost('task_id'));
        $tasks = $query2->get()->getRowArray();

        $message = lang("Home.Hola")." ".$employee['employee']."\n\n".lang("Se ha cambiado el estatus ha ".$status." solicitud de servicio de")." ".$author['author']."\n\n".lang("Home.Fecha del servicio").": ".$tasks['delivery_date']."\n\n".lang("Home.Productividad").": ".$tasks['productivity']."\n\n".lang("Home.Calidad").": ".$tasks['quality']."\n\n".lang("Home.Servicio").": ".$tasks['service']."\n\n".lang("Home.Innovación").": ".$tasks['innovation']."\n\n Por favor, no responder a este correo electrónico generado de forma automática \n\n Business & Education Consulting Group";

        $subject = lang('Home.Solicitud de servicio - Seguimiento');


        $this->email->setTo(''.$employee['email'].'');
        $this->email->setCc(''.$author['email'].'');
        // $this->email->setCc('gerardofrancisco.rodriguez@hotmail.com');
        $this->email->setFrom("no-reply@midominio.com", "ACCELE-RATE");
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        $query = $taskModel->set($data)->where('task_id', $this->request->getPost('task_id'))->update();

        $response = array();

        if($this->email->send()){
            $response['status'] = "OK";
            $response['message'] = lang('Home.Se envio un correo');
        }else{
            $response['status'] = "ERROR";
            $response['message'] = lang('Home.Email No enviado').'<br/>'. $this->email->printDebugger(['headers']);
        }

        if($query){
            $res = lang('Home.Se guardaron los datos correctamente.');
        }

        exit(json_encode($res));   
    }

    public function validar_form_documentos(){
        helper(['form', 'url']);
        $carpeta = './public/tareas/'.$this->request->getPost('task_id');

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $validation =  \Config\Services::validation();

        $required = '';
        $errors = '';
        $max_size = '';
        $errors_max_size = '';
        $ext_in = '';
        $errors_ext_in = '';

        if(empty($this->request->getPost('commentary')) && $this->request->getPost('document') == 'undefined'){                
            $required = '|required';
            $errors = lang('Home.Favor de llenar el campo Comentario ó de subir un Documento, los dos campos no pueden estar vacio. Validar que el archivo no excede el tamaño permitido.');
        }

        // dd($this->request->getPost('document'));
        // print_r($_FILES['document']);
        // exit;

        if($this->request->getPost('document') != 'undefined'){
            $max_size = '|uploaded[document]|max_size[document,50240]';
            $errors_max_size = lang('Home.El archivo excede el tamaño permitido.');
            $ext_in = '|ext_in[document,pdf, xlsx, docx, doc, xls, jpg, png, jpeg]';
            $errors_ext_in = lang('Home.El archivo tiene una extencion invalida.');
        }
        $rules = [
            'commentary' => [
                'label'  => lang('Home.Comentario'),
                'rules'  => 'trim'.$required.$max_size.'',
                'errors' => [
                    'required' => ''.$errors.'',
                    'max_size' => ''.$errors_max_size.'',
                    'ext_in' => ''.$errors_ext_in.''
                ],
            ],
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{

            if(isset($_FILES['document']['name'])){
                $imageFile = $this->request->getFile('document');
                $newName = $imageFile->getRandomName();
                $imageFile->move($carpeta, $newName);
            }else{
                $newName = '';
            }

            $data = [
                'finish_date' => date('Y-m-d H:i:s'),
                'document' => $newName,
                'commentary' => $this->request->getPost('commentary'),
                'status_id' => 3,
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $taskModel = new TaskModel($db);
            $query = $taskModel->set($data)->where('task_id', $this->request->getPost('task_id'))->update();

            $query2 = $db->table('employees e');
            $query2->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) employee, e.email');
            $query2->where('e.user_id', $this->request->getPost('user_id'));
            $employee = $query2->get()->getRowArray();

            $query2 = $db->table('employees e');
            $query2->select('CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) author, e.email');
            $query2->where('e.user_id', $this->request->getPost('created_by'));
            $author = $query2->get()->getRowArray();

            $query2 = $db->table('tasks t');
            $query2->select('*');
            $query2->where('t.task_id', $this->request->getPost('task_id'));
            $tasks = $query2->get()->getRowArray();

            $status = lang('Home.Finalizado');

            $message = lang("Home.Hola")." ".$employee['employee']."\n\n".lang("Se ha cambiado el estatus ha ".$status." solicitud de servicio de")." ".$author['author']."\n\n".lang("Home.Fecha del servicio").": ".$tasks['delivery_date']."\n\n".lang("Home.Productividad").": ".$tasks['productivity']."\n\n".lang("Home.Calidad").": ".$tasks['quality']."\n\n".lang("Home.Servicio").": ".$tasks['service']."\n\n".lang("Home.Innovación").": ".$tasks['innovation']."\n\n Por favor, no responder a este correo electrónico generado de forma automática \n\n Business & Education Consulting Group";

            $subject = lang('Home.Solicitud de servicio - Seguimiento');

            $this->email->setTo(''.$employee['email'].'');
            $this->email->setCc(''.$author['email'].'');
            // $this->email->setCc('gerardofrancisco.rodriguez@hotmail.com');
            $this->email->setFrom("no-reply@midominio.com", "ACCELE-RATE");
            $this->email->setSubject($subject);
            $this->email->setMessage($message);

            if($this->email->send()){
                $response['status'] = "OK";
                $response['message'] = lang('Home.Se envio un correo');
            }else{
                $response['status'] = "ERROR";
                $response['message'] = lang('Home.Email No enviado').'<br/>'. $this->email->printDebugger(['headers']);
            }

            $response['status'] = "OK";
            $response['message'] = lang('Home.Se guardó la información correctamente.');
        }

        exit(json_encode($response));
    }

    public function get_tareas_evaluacion(){
        $taskModel = new TaskModel($db);

        $query = $db->table('tasks t');
        $query->select('COUNT(*) total');
        $query->where('t.deleted_at', NULL);
        $query->where('t.created_by', $this->request->getPost('user_id'));
        $query->where('t.status_id', 3);
        $res = $query->get()->getRowArray();

        exit(json_encode($res));
    }

    public function get_tareas_solicitadas(){
        $taskModel = new TaskModel($db);

        $query = $db->table('tasks t');
        $query->select('COUNT(*) total');
        $query->where('t.deleted_at', NULL);
        $query->where('t.user_id', $this->request->getPost('user_id'));
        $query->where('t.status_id', 1);
        $res = $query->get()->getRowArray();

        exit(json_encode($res));
    }

    public function evaluation_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $taskModel = new TaskModel($db);

        $query = $db->table('tasks t');
        $query->select('t.*, ts.status, s.description');
        $query->join('tasks_status ts', 'ts.task_status_id = t.status_id', "left");
        $query->join('services s', 's.service_id = t.service_id', "left");
        $query->where('t.deleted_at', NULL);
        $query->where('t.status_id', 3);
        $query->where('t.created_by', $this->session->get('user_id'));
        $data['tasks'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Evaluar a otros');
        $data['sub_title'] = 'Evaluar a otros';
        $data['custom'] = 'tasks';
        $data['content'] = 'tasks/evaluation_view';

        return view('templates/common/Layout_view',$data);
    }

    public function comment_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $taskModel = new TaskModel($db);

        $query = $db->table('tasks t');
        $query->select('t.*, ts.status, s.description');
        $query->join('tasks_status ts', 'ts.task_status_id = t.status_id', "left");
        $query->join('services s', 's.service_id = t.service_id', "left");
        $query->where('t.deleted_at', NULL);
        $query->where('t.status_id', 4);
        $query->where('t.created_by', $this->session->get('user_id'));
        $query->orderBy('t.task_id', 'DESC');
        $data['tasks'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Felicitaciones y sugerencias');
        $data['sub_title'] = 'Evaluar a otros';
        $data['custom'] = 'tasks';
        $data['content'] = 'tasks/comment_view';

        return view('templates/common/Layout_view',$data);
    }

    public function add_calificacion(){
        $validation =  \Config\Services::validation();
        $rules = [
            'average_productivity' => [
                'label'  => lang('Home.Calificación de productividad'),
                'rules'  => 'trim|required|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Calificación de productividad no puede estar vacio.'),
                    'less_than_equal_to' => lang('Home.El campo Calificación de productividad no puede ser mayor a 100')
                ],
            ],
            'average_quality' => [
                'label'  => lang('Home.Calificación de calidad'),
                'rules'  => 'trim|required|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Calificación de calidad no puede estar vacio.'),
                    'less_than_equal_to' => lang('Home.El campo Calificación de calidad no puede ser mayor a 100')
                ],
            ],
            'average_innovation' => [
                'label'  => lang('Home.Calificación de innovación'),
                'rules'  => 'trim|required|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Calificación de innovación no puede estar vacio.'),
                    'less_than_equal_to' => lang('Home.El campo Calificación de innovación no puede ser mayor a 100')
                ],
            ],
            'average_service' => [
                'label'  => lang('Home.Calificación de servicio'),
                'rules'  => 'trim|required|less_than_equal_to[100]',
                'errors' => [
                    'required' => lang('Home.El campo Calificación de servicio no puede estar vacio.'),
                    'less_than_equal_to' => lang('Home.El campo Calificación de servicio no puede ser mayor a 100')
                ],
            ]
        ];

        if(!$this->validate($rules)){
            $response['status'] = "ERROR";
            $response['message'] = $validation->listErrors();
        }else{
            $data = [
                'average_productivity' => $this->request->getPost('average_productivity'),
                'commentary_productivity' => $this->request->getPost('commentary_productivity'),
                'average_quality' => $this->request->getPost('average_quality'),
                'commentary_quality' => $this->request->getPost('commentary_quality'),
                'average_innovation' => $this->request->getPost('average_innovation'),
                'commentary_innovation' => $this->request->getPost('commentary_innovation'),
                'average_service' => $this->request->getPost('average_service'),
                'commentary_service' => $this->request->getPost('commentary_service'),
                'status_id' => 4,
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $taskModel = new TaskModel($db);
            $query = $taskModel->set($data)->where('task_id', $this->request->getPost('task_id'))->update();

            $query = $db->table('tasks t');
            $query->select('AVG(average_productivity) average_productivity, AVG(average_quality) average_quality, AVG(average_innovation) average_innovation, AVG(average_service) average_service');
            $query->where('t.status_id', 4);
            $query->where('t.deleted_at', NULL);
            $query->where('t.user_id', $this->request->getPost('user_id'));
            $tasks = $query->get()->getRowArray();

            // $promedio = round(($tasks['average_productivity'] + $tasks['average_quality'] + $tasks['average_innovation'] + $tasks['average_service']) / 4, 2);

            // // var_dump($promedio);

            // $data = [
            //     'average'  => $promedio,
            //     'modified_by'  => $this->session->get('user_id'),
            //     'updated_at'  => date('Y-m-d H:i:s'),
            // ];

            // $employeeModel = new EmployeeModel($db);

            // $query = $employeeModel->set($data)->where('user_id', $this->request->getPost('user_id'))->update();

            $response['status'] = "OK";
            $response['message'] = lang('Home.Se guardó la información correctamente.');
        }

        exit(json_encode($response));
    }

    public function register_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $taskModel = new TaskModel($db);

        $inicio = date("Y-m-01").' 00:00:00';
        $fin = date("Y-m-t").' 23:59:59';

        $query = $db->table('tasks t');
        $query->select('t.*, ts.status, s.description, e.position_id, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) customer');
        $query->join('tasks_status ts', 'ts.task_status_id = t.status_id', "left");
        $query->join('services s', 's.service_id = t.service_id', "left");
        $query->join('employees e', 'e.user_id = t.created_by', "left");
        $query->where('t.deleted_at', NULL);
        $query->where('t.my_productivity', 1);
        $query->where('t.user_id', $this->session->get('user_id'));
        $query->where('t.created_at >=', $inicio);
        $query->where('t.created_at <=', $fin);
        $data['tasks'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Tareas');
        $data['sub_title'] = lang('Home.Tareas que he registrado');
        $data['custom'] = 'tasks';
        $data['content'] = 'tasks/register_view';

        return view('templates/common/Layout_view',$data);
    }

    public function form_register_view(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $taskModel = new TaskModel($db);

        $query = $db->table('users u');
        $query->select('u.*, e.position_id, CONCAT(e.first_name, " ", e.second_name,  " ", e.last_name,  " ", e.second_last_name) name');
        $query->join('employees e', 'e.user_id = u.user_id', "left");
        $query->where('organization_id', $this->session->get('organization_id'));
        $query->where('e.user_id !=', $this->session->get('user_id'));
        $data['employees'] = $query->get()->getResultArray();

        $query = $db->table('services');
        $query->select('*');
        $query->where('user_id', $this->session->get('user_id'));
        $query->where('deleted_at', NULL);
        // if($this->session->get('user_id') == 1){
        //     $query->orwhere("(position_id = ".$this->session->get('position_id')." AND created_admin = 1)");
        // }

        $data['services'] = $query->get()->getResultArray();

        $data['task']['task_id'] = '';
        $data['task']['user_id'] = '';
        $data['task']['amount'] = '';
        $data['task']['service_id'] = '';
        $data['task']['delivery_date'] = '';
        $data['task']['productivity'] = '';
        $data['task']['quality'] = '';
        $data['task']['innovation'] = '';
        $data['task']['service'] = '';

        $data['title'] = lang('Home.Tareas');
        $data['sub_title'] = lang('Home.Agregar tareas');
        $data['custom'] = 'tasks';
        $data['content'] = 'tasks/form_register_view';

        return view('templates/common/Layout_view',$data);
    }

    public function get_detalles(){
        $taskModel = new TaskModel($db);

        $query = $db->table('tasks t');
        $query->select('*');
        $query->where('t.task_id', $this->request->getPost('task_id'));
        $res = $query->get()->getRowArray();

        exit(json_encode($res));
    }
}
