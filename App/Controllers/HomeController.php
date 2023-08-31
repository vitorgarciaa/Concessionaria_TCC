<?php

namespace App\Controllers;
use App\Models\DAO\CarroDAO;

class HomeController extends Controller
{
    public function index()
    {
        $carroDAO = new CarroDAO();
        self::setViewParam('carro', $carroDAO->listar());

        $this->render('home/index');
    }
}