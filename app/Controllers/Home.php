<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('login');
        }
        return view('home');
    }
}
