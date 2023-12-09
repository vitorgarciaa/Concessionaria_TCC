<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\VendedorDAO;
use App\Models\Entidades\Vendedor;
use App\Models\Validacao\VendedorValidador;


class VendedorController extends Controller
{

    public function index()
    {
        
        $this->render('carro/index');
    }

    public function pesquisar()
    {
        $vendedorDAO = new VendedorDAO();
        self::setViewParam('vendedor', $vendedorDAO->listarVendedorPorVenda());
        self::setViewParam('ativo', $vendedorDAO->listarAtivo());
        self::setViewParam('inativo', $vendedorDAO->listarInativo());

        $this->render('vendedor/pesquisar');
    }


    public function cadastro()
    {

        $this->render('vendedor/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params){
        $idVendedor = $params[0];

        $vendedorDAO = new VendedorDAO();

        $vendedor = $vendedorDAO->listar($idVendedor);

        if (!$vendedor) {
            Sessao::gravaMensagem("Vendedor Inexistente!");
            $this->redirect('/vendedor/pesquisar');
        }

        self::setViewParam('vendedor', $vendedor);

        $this->render('/vendedor/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar(){
        
        $senha = $_POST['senha'];
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        $vendedor = new Vendedor();
        $vendedor->setId($_POST['id']);
        $vendedor->setNome($_POST['nome']);
        $vendedor->setUsuario($_POST['usuario']);
        $vendedor->setSenha($senhaCriptografada);
        $vendedor->setEmail($_POST['email']);
        $vendedor->setTelefone($_POST['telefone']);
        $vendedor->setStatus($_POST['status']);
        $vendedor->setCpf($_POST['cpf']);
        $vendedor->setCep($_POST['cep']);
        $vendedor->setUf($_POST['uf']);
        $vendedor->setCidade($_POST['cidade']);
        $vendedor->setBairro($_POST['bairro']);
        $vendedor->setLogradouro($_POST['logradouro']);
        $vendedor->setComplemento($_POST['complemento']);
        $vendedor->setNumero($_POST['numero']);
        Sessao::gravaFormulario($_POST);

        $vendedorValidador = new VendedorValidador();
        $resultadoValidacao = $vendedorValidador->validar($vendedor);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/vendedor/edicao/'. $_POST['id']);
        }

        $vendedorDAO = new VendedorDAO();

        $vendedorDAO->atualizar($vendedor);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Informações atualizadas com sucesso!");
        $this->redirect('/vendedor/pesquisar/');
    }

    public function exclusao($params)
    {
        $idVendedor = $params[0];

        $vendedorDAO = new VendedorDAO();

        $vendedor = $vendedorDAO->listar($idVendedor);


        if (!$vendedor) {
            Sessao::gravaMensagem("Vendedor inexistente");
            $this->redirect('/vendedor/pesquisar');
        }

        self::setViewParam('vendedor', $vendedor);

        $this->render('/vendedor/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir(){
        $vendedor = new vendedor();
        $vendedor->setId($_POST['id']);

        $vendedorDAO = new VendedorDAO();

        if (!$vendedorDAO->excluir($vendedor)) {
            Sessao::gravaMensagem("Vendedor inexistente");
            $this->redirect('/vendedor/pesquisar');
        }

        Sessao::gravaMensagem("Vendedor excluído com sucesso!");

        $this->redirect('/vendedor/pesquisar');
    }

    public function salvar(){
        $vendedor = new Vendedor();


        $senha = $_POST['senha'];
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        $vendedor->setId($_POST['id']);
        $vendedor->setNome($_POST['nome']);
        $vendedor->setUsuario($_POST['usuario']);
        $vendedor->setSenha($senhaCriptografada);
        $vendedor->setEmail($_POST['email']);
        $vendedor->setTelefone($_POST['telefone']);
        $vendedor->setStatus($_POST['status']);
        $vendedor->setCpf($_POST['cpf']);
        $vendedor->setCep($_POST['cep']);
        $vendedor->setUf($_POST['uf']);
        $vendedor->setCidade($_POST['cidade']);
        $vendedor->setBairro($_POST['bairro']);
        $vendedor->setLogradouro($_POST['logradouro']);
        $vendedor->setComplemento($_POST['complemento']);
        $vendedor->setNumero($_POST['numero']);


        Sessao::gravaFormulario($_POST);

        $vendedorValidador = new VendedorValidador();
        $resultadoValidacao = $vendedorValidador->validar($vendedor);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/vendedor/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $vendedorDAO = new VendedorDAO();

        var_dump($vendedorDAO->salvar($vendedor));

        Sessao::gravaMensagem("Vendedor cadastrado com Sucesso!");
        $this->redirect('/vendedor/cadastro');   
        
    }
    

}