<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CompraDAO;
use App\Models\Entidades\Compra;
use App\Models\Validacao\CompraValidador;


class CompraController extends Controller
{ 

    public function edicao($params){
        $idCompra = $params[0];

        $compraDAO = new CompraDAO();

        $compra = $compraDAO->listar($idCompra);

        if (!$compra) {
            Sessao::gravaMensagem("Compra Inexistente!");
            $this->redirect('/compra/pesquisar');
        }

        self::setViewParam('compra', $compra);

        $this->render('/compra/editar');

        Sessao::limpaMensagem();
    }

    public function pesquisar()
    {
        $compraDAO = new CompraDAO();
        self::setViewParam('compra', $compraDAO->listar());

        $this->render('compra/pesquisar');
    }

    public function atualizar(){

        $compra = new Compra();
        $compra->setId($_POST['id']);
        $compra->setCpnj($_POST['cnpj']);
        $compra->setNome_fornecedor($_POST['nome_fornecedor']);
        $compra->setTelefone($_POST['telefone']);
        $compra->setStatus($_POST['status']);
        $compra->setCpf($_POST['cpf']);
        $compra->setCep($_POST['cep']);
        $compra->setUf($_POST['uf']);
        $compra->setCidade($_POST['cidade']);
        $compra->setBairro($_POST['bairro']);
        $compra->setLogradouro($_POST['logradouro']);
        $compra->setComplemento($_POST['complemento']);
        $compra->setNumero($_POST['numero']);
        Sessao::gravaFormulario($_POST);

        $CompraValidador = new CompraValidador();
        $resultadoValidacao = $CompraValidador->validar($compra);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/compra/edicao/'. $_POST['id']);
        }

        $compraDAO = new CompraDAO();

        $compraDAO->atualizar($compra);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Informações atualizadas com sucesso!");
        $this->redirect('/compra/pesquisar');
    }

    public function exclusao($params)
    {

        $idCompra = $params[0];

        $compraDAO = new CompraDAO();

        $compra = $compraDAO->listar($idCompra);

        if (!$compra) {
            Sessao::gravaMensagem("Compra inexistente");
            $this->redirect('/compra/pesquisar');
        }

        self::setViewParam('compra', $compra);

        $this->render('/compra/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir(){
        $compra = new Compra();
        $compra->setId($_POST['id']);

        $compraDAO = new CompraDAO();

        if (!$compraDAO->excluir($compra)) {
            Sessao::gravaMensagem("Cmpra inexistente");
            $this->redirect('/compra/pesquisar');
        }

        Sessao::gravaMensagem("Compra excluídoa com sucesso!");

        $this->redirect('/compra/pesquisar');
    }


}