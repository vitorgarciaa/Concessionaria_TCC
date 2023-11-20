<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CarroDAO;
use App\Models\Entidades\Venda;
use App\Models\DAO\VendaDAO;
use App\Models\Entidades\Carro;
use App\Models\Validacao\VendaValidador;


class VendaController extends Controller
{

    public function index()
    {
        
        $this->render('venda/index');
    }

    public function cadastro($params)
    {

        $idCarro = $params[0];

        $carroDAO = new CarroDAO();

        $carro = $carroDAO->listar($idCarro);

        if (!$carro) {
            Sessao::gravaMensagem("Carro Inexistente!");
            $this->redirect('/carro/pesquisar');
        }

        self::setViewParam('carro', $carro);

        $this->render('venda/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar(){
        $venda = new Venda();
        $preco_venda = preg_replace('/[^0-9]/', '', $_POST['preco_venda']);    
        $preco_venda = bcdiv($preco_venda, 100, 2);
        $preco_venda = strtr($preco_venda, ',', '.');

        $venda->setId_carro($_POST['id_carro']);
        $venda->setId_cliente($_POST['id_cliente']);
        $venda->setId_vendedor($_SESSION['login']);
        $venda->setPreco_venda($preco_venda);
        $venda->setTipo_pagamento($_POST['tipo_pagamento']);
        $venda->setSituacao_pedido($_POST['situacao_pedido']);

        $carro = new Carro();
        
        $carro->setId($_POST['id_carro']);
        $carro->setDisponibilidade('Indisponível');

        $carroDAO = new CarroDAO();

        $carroDAO->atualizarSituacao($carro);


        Sessao::gravaFormulario($_POST);

        $vendaValidador = new VendaValidador();
        $resultadoValidacao = $vendaValidador->validar($venda);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/venda/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $vendaDAO = new VendaDAO();

        $vendaDAO->salvar($venda);

        Sessao::gravaMensagem("Venda cadastrada com Sucesso!");
        $this->redirect('/venda/pesquisar');   
    }

    public function edicao($params){
        $idVenda = $params[0];

        $vendaDAO = new VendaDAO();

        $venda = $vendaDAO->listar($idVenda);

        if (!$venda) {
            Sessao::gravaMensagem("Venda Inexistente!");
            $this->redirect('/venda/pesquisar');
        }

        self::setViewParam('venda', $venda);

        $this->render('/venda/editar');

        Sessao::limpaMensagem();
    }

    public function pesquisar()
    {
        $vendaDAO = new VendaDAO();
        self::setViewParam('venda', $vendaDAO->listar());

        $this->render('venda/pesquisar');
    }

    public function atualizar(){

        $venda = new Venda();
        $venda->setId_carro($_POST['id_carro']);
        $venda->setId_cliente($_POST['id_cliente']);
        $venda->setPreco_venda($_POST['preco_venda']);
        $venda->setTipo_pagamento($_POST['tipo_pagamento']);
        $venda->setSituacao_pedido($_POST['situacao_pedido']);
        Sessao::gravaFormulario($_POST);

        $VendaValidador = new VendaValidador();
        $resultadoValidacao = $VendaValidador->validar($venda);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/venda/edicao/'. $_POST['id']);
        }

        $vendaDAO = new VendaDAO();

        $vendaDAO->atualizar($venda);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Informações atualizadas com sucesso!");
        $this->redirect('/venda/pesquisar');
    }

    public function exclusao($params)
    {
        $idVenda = $params[0];

        $vendaDAO = new VendaDAO();

        $venda = $vendaDAO->listar($idVenda);

        if (!$venda) {
            Sessao::gravaMensagem("Venda inexistente");
            $this->redirect('/venda/pesquisar');
        }

        self::setViewParam('venda', $venda);

        $this->render('/venda/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir(){
        $venda = new Venda();
        $venda->setId($_POST['id']);

        $vendaDAO = new VendaDAO();

        $venda = $vendaDAO->listar($_POST['id']);

        if (!$vendaDAO->excluir($venda)) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/venda/pesquisar');
        }

        $carro = new Carro();
        
        $carro->setId($venda->getId_carro());
        $carro->setDisponibilidade('Disponivel');

        $carroDAO = new CarroDAO();

        $carroDAO->atualizarSituacao($carro);


        Sessao::gravaMensagem("Venda excluída com sucesso!");

        $this->redirect('/venda/pesquisar');

    }

    public function atualizarSituacao(){

        $venda = new Venda();
        $venda->setId($_POST['id_venda']);
        $venda->setTipo_pagamento($_POST['tipo_pagamento']);
        $venda->setSituacao_pedido($_POST['situacao_pedido']);
        Sessao::gravaFormulario($_POST);

        $VendaValidador = new VendaValidador();
        $resultadoValidacao = $VendaValidador->validar($venda);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/venda/edicao/'. $_POST['id']);
        }

        $vendaDAO = new VendaDAO();

        $vendaDAO->atualizarSituacao($venda);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Informações atualizadas com sucesso!");
        $this->redirect('/venda/pesquisar');
    }
    
}