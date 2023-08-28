<?php

namespace App\Controllers;

class LoginController extends Controller
{
    public function index()
    {
        $this->render('login/index');
    }
}