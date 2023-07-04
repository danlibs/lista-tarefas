<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function signIn()
    {
        $model = new Usuario();
        $data = $this->request->getPost();
        $user = $model->select()->where('email', $data['email'])->first();
        if ($user) {
            if (password_verify($data['senha'], $user->senha)) {
                session()->set('user', ['id' => $user->id, 'nome' => $user->nome, 'email' => $user->email]);
                return redirect('home');
            }
        }
        return redirect('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect('login');
    }
}
