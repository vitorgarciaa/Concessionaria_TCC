<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\MarcaDAO;
use App\Models\Entidades\Marca;
use App\Models\Validacao\MarcaValidador;

class MarcaController extends Controller
{


    public function salvar(){
        $marca = new Marca();

        $marca->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $marcaValidador = new MarcaValidador();
        $resultadoValidacao = $marcaValidador->validar($marca);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/carro/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $marcaDAO = new MarcaDAO();

        var_dump($marcaDAO->salvar($marca));

        Sessao::gravaMensagem("Marca cadastrada com Sucesso!");
        $this->redirect('/carro/cadastro');   
    }

    public function edicao()
    {
        $this->render('marca/edicao');
    }

    public function exclusao()
    {
        $this->render('marca/exclusao');
    }

    public function listar()
    {
        $this->render('marca/listar');
    }


}
