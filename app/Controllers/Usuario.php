<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario as ModelsUsuario;

class Usuario extends BaseController
{
    public function index()
    {
        return view('cadastro');
    }

    public function save()
    {
        $model = new ModelsUsuario();
        $data = $this->request->getPost();
        $data['senha'] = password_hash($this->request->getPost()['senha'], PASSWORD_DEFAULT);

        $model->insert($data);
        return redirect('login');
    }

    public function delete()
    {
        $model = new ModelsUsuario();
        $id = session('user')['id'];

        $model->delete($id);
        session()->destroy();
        return $this->response->setJSON('Conta apagada com sucesso')->setStatusCode(200);
    }
}
