<?php

namespace App\Controllers;

use App\Models\DAO\VendedorDAO;

class LoginController extends Controller
{
    public function index(){
        if (isset($_SESSION['login'])) {
            $this->redirect('/home/index');
        }
        $this->render('/login/index');
    }

    public function entrar(){

        if (empty($_POST['email']) || empty($_POST['senha'])) {
            $this->render('/login/index');
            exit();
        }

        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        $vendedorDAO = new VendedorDAO();
        $vendedorDAO->logar($email, $senha);

        if (!isset($_SESSION['login'])) {
            $this->redirect('/login/index?usi=1');
        }
        $this->redirect('/carro/index');
    }

    public function sair(){ 
        session_unset();
        session_destroy(); 
        $this->redirect('/home/index');
    }
}