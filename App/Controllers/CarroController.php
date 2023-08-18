<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CarroDAO;
use App\Models\Entidades\Carro;
use App\Models\Validacao\CarroValidador;
use App\Models\DAO\MarcaDAO;
use App\Models\DAO\ModeloDAO;

class CarroController extends Controller
{

    public function index()
    {
        $carroDAO = new CarroDAO();
        self::setViewParam('carro', $carroDAO->listar());

        $this->render('carro/index');
    }

    public function cadastro()
    {
        $marcaDAO = new MarcaDAO();
        self::setViewParam('marca', $marcaDAO->listar());

        $modeloDAO = new ModeloDAO();
        self::setViewParam('modelo', $modeloDAO->listar());

        $this->render('carro/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar(){

        $preco = preg_replace('/[^0-9]/', '', $_POST['preco']);    
        $preco = bcdiv($preco, 100, 2);
        $preco = strtr($preco, ',', '.');

        $carro = new Carro();
        $carro->setAno_fabricacao($_POST['ano_fabricacao']);
        $carro->setAno_modelo($_POST['ano_modelo']);
        $carro->setCor($_POST['cor']);
        $carro->setPreco($preco);
        $carro->setIdModelo($_POST['modeloId']);
        $carro->setTipo_tracao($_POST['tracao']);
        $carro->setTipo_freio($_POST['freio']);
        $carro->setTipo_combustivel($_POST['combustivel']);
        $carro->setModelo_cambio($_POST['cambio']);
        $carro->setModelo_direcao($_POST['direcao']);
        $carro->setObservacoes($_POST['observacao']);
        $carro->setDisponibilidade($_POST['disponibilidade']);
        $carro->setMotor($_POST['motor']);

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

        //print_r($carro);die;

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
