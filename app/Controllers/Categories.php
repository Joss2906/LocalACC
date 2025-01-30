<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SatisfactionCategorieModel;

class Categories extends BaseController {

    public function __construct(){
        $db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index(){
        if (!$this->session->get('is_logued_in')) {
            return redirect()->to(base_url().'/auth');
        }

        $SatisfactionCategorieModel = new SatisfactionCategorieModel($db);

        $query = $db->table('satisfaction_categories');
        $query->select('*');
        $data['categories'] = $query->get()->getResultArray();

        $data['title'] = lang('Home.Categorías');
        $data['sub_title'] = 'Categorias/Imágenes';
        $data['custom'] = 'categories';
        $data['content'] = 'categories/categories_view';

        return view('templates/common/Layout_view',$data);
    }

    public function validar_form(){
        helper(['form', 'url']);
        $carpeta = './public/cuestionarios/';

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $validation =  \Config\Services::validation();

        $rules = [
            'image' => [
                'label' => lang('Home.Imagen'),
                'rules' => 'uploaded[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                'errors' => [
                    'uploaded' => lang('Home.El campo Foto de perfil no puede estar vacio o el archivo excede el tamaño permitido.'),
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
            $imageFile = $this->request->getFile('image');
            $newName = $imageFile->getRandomName();
            $imageFile->move($carpeta, $newName);

            $data = [
                'image' => $newName,
                'modified_by'  => $this->session->get('user_id'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $SatisfactionCategorieModel = new SatisfactionCategorieModel($db);
            $query = $SatisfactionCategorieModel->set($data)->where('satisfaction_category_id', $this->request->getPost('satisfaction_category_id'))->update();

            $response['status'] = "OK";
            $response['message'] = 'Se actualizó la imagen correctamente. Favor de recargar la página.';
        }
        
        exit(json_encode($response));
    }

}
