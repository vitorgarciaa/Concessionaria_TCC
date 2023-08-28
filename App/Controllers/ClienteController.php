<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ClienteDAO;
use App\Models\Entidades\Cliente;
use App\Models\Validacao\ClienteValidador;


class ClienteController extends Controller
{

    public function index()
    {
        
        $this->render('carro/index');
    }

    public function cadastro()
    {

        $this->render('cliente/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar(){
        $cliente = new Cliente();

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

}