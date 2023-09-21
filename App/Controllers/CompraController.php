<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CompraDAO;
use App\Models\Entidades\Compra;
use App\Models\Validacao\CompraValidador;


class CompraController extends Controller
{

    public function index()
    {
        
        $this->render('compra/index');
    }

    public function cadastro()
    {

        $this->render('cliente/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar(){
        $cliente = new Compra();

        $cliente->setNome($_POST['nome']);
        $cliente->setEmail($_POST['email']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setStatus($_POST['status']);
        $cliente->setCpf($_POST['cpf']);
        $cliente->setCep($_POST['cep']);
        $cliente->setUf($_POST['uf']);
        $cliente->setCidade($_POST['cidade']);
        $cliente->setBairro($_POST['bairro']);
        $cliente->setLogradouro($_POST['logradouro']);
        $cliente->setComplemento($_POST['complemento']);
        $cliente->setNumero($_POST['numero']);
        
        Sessao::gravaFormulario($_POST);

        $clienteValidador = new ClienteValidador();
        $resultadoValidacao = $clienteValidador->validar($cliente);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/cliente/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $clienteDAO = new ClienteDAO();

        $clienteDAO->salvar($cliente);

        Sessao::gravaMensagem("Cliente cadastrado com Sucesso!");
        $this->redirect('/cliente/cadastro');   
    }

    public function edicao($params){
        $idCliente = $params[0];

        $clienteDAO = new ClienteDAO();

        $cliente = $clienteDAO->listar($idCliente);

        if (!$cliente) {
            Sessao::gravaMensagem("Cliente Inexistente!");
            $this->redirect('/cliente/pesquisar');
        }

        self::setViewParam('cliente', $cliente);

        $this->render('/cliente/editar');

        Sessao::limpaMensagem();
    }

    public function pesquisar()
    {
        $clienteDAO = new ClienteDAO();
        self::setViewParam('cliente', $clienteDAO->listar());

        $this->render('cliente/pesquisar');
    }

    public function atualizar(){

        $cliente = new Cliente();
        $cliente->setId($_POST['id']);
        $cliente->setNome($_POST['nome']);
        $cliente->setEmail($_POST['email']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setStatus($_POST['status']);
        $cliente->setCpf($_POST['cpf']);
        $cliente->setCep($_POST['cep']);
        $cliente->setUf($_POST['uf']);
        $cliente->setCidade($_POST['cidade']);
        $cliente->setBairro($_POST['bairro']);
        $cliente->setLogradouro($_POST['logradouro']);
        $cliente->setComplemento($_POST['complemento']);
        $cliente->setNumero($_POST['numero']);
        Sessao::gravaFormulario($_POST);

        $ClienteValidador = new ClienteValidador();
        $resultadoValidacao = $ClienteValidador->validar($cliente);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/cliente/edicao/'. $_POST['id']);
        }

        $clienteDAO = new ClienteDAO();

        $clienteDAO->atualizar($cliente);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Informações atualizadas com sucesso!");
        $this->redirect('/cliente/pesquisar');
    }

    public function exclusao($params)
    {
        $idCliente = $params[0];

        $clienteDAO = new ClienteDAO();

        $cliente = $clienteDAO->listar($idCliente);

        if (!$cliente) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/cliente/pesquisar');
        }

        self::setViewParam('cliente', $cliente);

        $this->render('/cliente/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir(){
        $cliente = new Cliente();
        $cliente->setId($_POST['id']);

        $clienteDAO = new ClienteDAO();

        if (!$clienteDAO->excluir($cliente)) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/cliente/pesquisar');
        }

        Sessao::gravaMensagem("Cliente excluído com sucesso!");

        $this->redirect('/cliente/pesquisar');
    }


}