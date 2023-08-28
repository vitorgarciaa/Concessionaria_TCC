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
        $carro->setModelo_transmissao($_POST['transmissao']);
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

        $carroDAO->salvar($carro);

        Sessao::gravaMensagem("Carro cadastrado com Sucesso!");
        $this->redirect('/carro/cadastro');   
    }

    public function edicao($params){
        $idCarro = $params[0];

        $carroDAO = new CarroDAO();

        $carro = $carroDAO->listar($idCarro);

        if (!$carro) {
            Sessao::gravaMensagem("Carro Inexistente!");
            $this->redirect('/carro/pesquisar');
        }

        self::setViewParam('carro', $carro);

        $this->render('/carro/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar(){
        $preco = preg_replace('/[^0-9]/', '', $_POST['preco']);    
        $preco = bcdiv($preco, 100, 2);
        $preco = strtr($preco, ',', '.');
        
        $carro = new Carro();
        $carro->setId($_POST['id']);
        $carro->setAno_fabricacao($_POST['ano_fabricacao']);
        $carro->setAno_modelo($_POST['ano_modelo']);
        $carro->setCor($_POST['cor']);
        $carro->setPreco($preco);
        $carro->setIdModelo($_POST['modeloId']);
        $carro->setTipo_tracao($_POST['tracao']);
        $carro->setTipo_freio($_POST['freio']);
        $carro->setTipo_combustivel($_POST['combustivel']);
        $carro->setModelo_transmissao($_POST['transmissao']);
        $carro->setModelo_direcao($_POST['direcao']);
        $carro->setObservacoes($_POST['observacao']);
        $carro->setDisponibilidade($_POST['disponibilidade']);
        $carro->setMotor($_POST['motor']);

        Sessao::gravaFormulario($_POST);

        $carroValidador = new CarroValidador();
        $resultadoValidacao = $carroValidador->validar($carro);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/carro/edicao/'. $_POST['id']);
        }

        $carroDAO = new CarroDAO();

        $carroDAO->atualizar($carro);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Informações atualizadas com sucesso!");
        $this->redirect('/carro/edicao/' . $_POST['id']);
    }

    public function exclusao($params)
    {
        $idCarro = $params[0];

        $carroDAO = new CarroDAO();

        $carro = $carroDAO->listar($idCarro);

        if (!$carro) {
            Sessao::gravaMensagem("Carro inexistente");
            $this->redirect('/carro/pesquisar');
        }

        self::setViewParam('carro', $carro);

        $this->render('/carro/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir(){
        $carro = new carro();
        $carro->setId($_POST['id']);

        $carroDAO = new CarroDAO();

        if (!$carroDAO->excluir($carro)) {
            Sessao::gravaMensagem("Carro inexistente");
            $this->redirect('/carro/pesquisar');
        }

        Sessao::gravaMensagem("Carro excluído com sucesso!");

        $this->redirect('/carro/pesquisar');
    }

    public function informacoes($params)
    {
        $idCarro = $params[0];

        $carroDAO = new CarroDAO();
        self::setViewParam('carro', $carroDAO->listar($idCarro));

        $this->render('carro/informacoes');
    }

    public function pesquisar()
    {
        $carroDAO = new CarroDAO();
        self::setViewParam('carro', $carroDAO->listar());

        $this->render('carro/pesquisar');
    }

    public function listarPorMarca()
    {
        $modeloDAO = new ModeloDAO();

        $marcaId = $_POST['marcaId'];

        $listaModelos = $modeloDAO->listarPorMarca($marcaId);
        if(empty($listaModelos)){
            echo '<div class="alert alert-info col-md-12" role="alert">Nenhuma marca encontrada.</div>';
        }else{
                echo '<label for="selectModelo" class="form-label">Modelo</label>
                    <div class="input-group md-3">
                        <select class="form-select" id="inputGroupSelect02" name="modeloId">
                        <option selected>Selecione o Modelo</option>';
                        foreach($listaModelos as $modelo){
                            echo '<option value="Teste">' . $modelo->getNome() . '</option>';
                        }
                echo '</select>
                <label class="input-group-text btn-primary" for="inputGroupSelect02" data-bs-toggle="modal" data-bs-target="#modalModelo" data-bs-whatever="@fat">Cadastrar Modelo</label>
                </div>';
        }
    }
}