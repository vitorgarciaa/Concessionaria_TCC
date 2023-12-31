<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CarroDAO;
use App\Models\DAO\CompraDAO;
use App\Models\DAO\ImagemDAO;
use App\Models\Entidades\Carro;
use App\Models\Validacao\CarroValidador;
use App\Models\DAO\MarcaDAO;
use App\Models\DAO\ModeloDAO;
use App\Models\Entidades\Compra;
use App\Models\Entidades\Imagem;

class CarroController extends Controller
{

    public function index()
    {
        $carroDAO = new CarroDAO();
        self::setViewParam('carro', $carroDAO->listarAtivo());
        self::setViewParam('carroMenorPreco', $carroDAO->listarMenorPreco());
        self::setViewParam('carroMaiorPreco', $carroDAO->listarMaiorPreco());
        self::setViewParam('carroMenorAno', $carroDAO->listarMenorAnoFabricacao());
        self::setViewParam('carroMaiorAno', $carroDAO->listarMaiorAnoFabricacao());

        $this->render('carro/index');
    }

    public function cadastro()
    {
        $marcaDAO = new MarcaDAO();
        self::setViewParam('marca', $marcaDAO->listar());

        $modeloDAO = new ModeloDAO();
        self::setViewParam('modelo', $modeloDAO->listar());

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->render('carro/cadastro');
    }

    public function salvar(){

        $preco_venda = preg_replace('/[^0-9]/', '', $_POST['preco_venda']);    
        $preco_venda = bcdiv($preco_venda, 100, 2);
        $preco_venda = strtr($preco_venda, ',', '.');

        $preco_custo = preg_replace('/[^0-9]/', '', $_POST['preco_custo']);    
        $preco_custo = bcdiv($preco_custo, 100, 2);
        $preco_custo = strtr($preco_custo, ',', '.');

        $carro = new Carro();
        $carro->setAno_fabricacao($_POST['ano_fabricacao']);
        $carro->setAno_modelo($_POST['ano_modelo']);
        $carro->setCor($_POST['cor']);
        $carro->setPreco_venda($preco_venda);
        $carro->setIdModelo($_POST['modeloId']);
        $carro->setTipo_tracao($_POST['tracao']);
        $carro->setTipo_freio($_POST['freio']);
        $carro->setTipo_combustivel($_POST['combustivel']);
        $carro->setModelo_transmissao($_POST['transmissao']);
        $carro->setModelo_direcao($_POST['direcao']);
        $carro->setObservacoes($_POST['observacao']);
        $carro->setDisponibilidade($_POST['disponibilidade']);
        $carro->setMotor($_POST['motor']);
        $carro->setQuilometragem($_POST['quilometragem']);
        $carro->setPlaca($_POST['placa']);

        Sessao::gravaFormulario($_POST);

        $carroValidador = new CarroValidador();
        $resultadoValidacao = $carroValidador->validar($carro);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/carro/cadastro');
        }

        $carroDAO = new CarroDAO();

        $carroDAO->salvar($carro);

        $carro = $carroDAO->listarUltimoCadastrado();

        $compra = new Compra();
        $compraDAO = new CompraDAO();

        $compra->setId_carro($carro[0]->getId());
        $compra->setId_fornecedor($_POST['id_fornecedor']);
        $compra->setId_vendedor($_SESSION['login']);
        $compra->setPreco_custo($preco_custo);
        $compra->setTipo_pagamento($_POST['tipo_pagamento']);

        var_dump($compraDAO->salvar($compra));

        $imagens = $_FILES['imagens'];
        if (isset($imagens)) {
        
        $qtdImagens = count($imagens['name']); 

            for ($cont=0; $cont < $qtdImagens; $cont++) { 
                $extensao = strtolower(substr($imagens['name'][$cont], -4)); // PEGA A EXTENSÃO E DEIXA TUDO MINUSCULO
                $novoNome = md5(time()) . $imagens['size'][$cont] . $extensao; //CRIPTOGRAFA PARA NÃO TER NOMES IGUAIS
                $diretorio =  "C:\\xampp\htdocs\\concessionaria_mvc\App\Views\imagens\uploads\\";

                move_uploaded_file($imagens['tmp_name'][$cont], $diretorio . $novoNome); //FAZ O UPLOAD
                
                $imagemDAO = new ImagemDAO();
                $imagem = new Imagem();

                $carro = $carroDAO->listarUltimoCadastrado();

                $imagem->setNome($novoNome);
                $imagem->setId_carro($carro[0]->getId());

                $imagemDAO->salvar($imagem);
            }
        }

        Sessao::gravaMensagem("Carro cadastrado com Sucesso!");
        $this->redirect('/carro/pesquisar');
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
        $preco_venda = preg_replace('/[^0-9]/', '', $_POST['preco_venda']);    
        $preco_venda = bcdiv($preco_venda, 100, 2);
        $preco_venda = strtr($preco_venda, ',', '.'); 
        
        $carro = new Carro();
        $carro->setId($_POST['id']);
        $carro->setAno_fabricacao($_POST['ano_fabricacao']);
        $carro->setAno_modelo($_POST['ano_modelo']);
        $carro->setCor($_POST['cor']);
        $carro->setPreco_venda($preco_venda);
        $carro->setIdModelo($_POST['modeloId']);
        $carro->setTipo_tracao($_POST['tracao']);
        $carro->setTipo_freio($_POST['freio']);
        $carro->setTipo_combustivel($_POST['combustivel']);
        $carro->setModelo_transmissao($_POST['transmissao']);
        $carro->setModelo_direcao($_POST['direcao']);
        $carro->setObservacoes($_POST['observacao']);
        $carro->setDisponibilidade($_POST['disponibilidade']);
        $carro->setMotor($_POST['motor']);
        $carro->setQuilometragem($_POST['quilometragem']);
        $carro->setPlaca($_POST['placa']);

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
        $this->redirect('/carro/pesquisar/');
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

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

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
        self::setViewParam('carro', $carroDAO->listarCarroPorCompra());
        self::setViewParam('carroMenorPreco', $carroDAO->listarMenorPreco());
        self::setViewParam('carroMaiorPreco', $carroDAO->listarMaiorPreco());
        self::setViewParam('carroMenorAno', $carroDAO->listarMenorAnoFabricacao());
        self::setViewParam('carroMaiorAno', $carroDAO->listarMaiorAnoFabricacao());
        self::setViewParam('disponivel', $carroDAO->listarCarroDisponivel());
        self::setViewParam('indisponivel', $carroDAO->listarCarroIndisponivel());

        $this->render('carro/pesquisar');
    }

    public function listarPorMarca()
    {
        $modeloDAO = new ModeloDAO();

        $marcaId = $_POST['marcaId'];

        $listaModelos = $modeloDAO->listarPorMarca($marcaId);
        if(empty($listaModelos)){
            echo '<div class="alert alert-info col-md-12" role="alert">Nenhuma modelo encontrado. <label class="input-group-text btn-primary" for="inputGroupSelect02" data-bs-toggle="modal" data-bs-target="#modalModelo" data-bs-whatever="@fat">Cadastrar Modelo</label></div>';
        }else{
                echo '<label for="selectModelo" class="form-label">Modelo</label>
                    <div class="input-group md-3">
                        <select class="form-select" id="inputGroupSelect02" name="modeloId">
                        <option selected>Selecione o Modelo</option>';
                        foreach($listaModelos as $modelo){
                            echo '<option value="'. $modelo->getId() .'">' . $modelo->getNome() . '</option>';
                        }
                echo '</select>
                <label class="input-group-text btn-primary" for="inputGroupSelect02" data-bs-toggle="modal" data-bs-target="#modalModelo" data-bs-whatever="@fat">Cadastrar Modelo</label>
                </div>';
        }
    }
}