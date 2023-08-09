<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CarroDAO;
use App\Models\Entidades\Carro;
use App\Models\Validacao\CarroValidador;

class CarroController extends Controller
{

    public function index()
    {
        $this->render('carro/index');
    }

    public function cadastro()
    {
        $this->render('carro/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar(){
        $carro = new Carro();

        $carro->setAno($_POST['ano']);
        $carro->setCor($_POST['cor']);
        $carro->setPreco($_POST['preco']);

        Sessao::gravaFormulario($_POST);

        $carroValidador = new CarroValidador();
        $resultadoValidacao = $carroValidador->validar($carro);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/carro/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $carroDAO = new CarroDAO();

        $carroDAO->salvar($carro);

        Sessao::gravaMensagem("Carro cadastrado com Sucesso!");
        $this->redirect('/carro/cadastro');   
    }

    public function edicao()
    {
        $this->render('carro/edicao');
    }

    public function exclusao()
    {
        $this->render('carro/exclusao');
    }

}
