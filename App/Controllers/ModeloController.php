<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ModeloDAO;
use App\Models\Entidades\Modelo;
use App\Models\Validacao\ModeloValidador;

class ModeloController extends Controller
{

    public function index()
    {
        $this->render('modelo/cadastro');
    }

    public function cadastro()
    {
        $this->render('modelo/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar(){
        $modelo = new Modelo();

        $modelo->setId_marca($_POST['marca']);

        Sessao::gravaFormulario($_POST);

        $modeloValidador = new ModeloValidador();
        $resultadoValidacao = $modeloValidador->validar($modelo);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/modelo/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $modeloDAO = new ModeloDAO();

        $modeloDAO->salvar($modelo);

        Sessao::gravaMensagem("Carro cadastrado com Sucesso!");
        $this->redirect('/modelo/cadastro');   
    }

    public function edicao()
    {
        $this->render('modelo/edicao');
    }

    public function exclusao()
    {
        $this->render('modelo/exclusao');
    }

}
