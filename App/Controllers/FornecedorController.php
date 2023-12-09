<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\FornecedorDAO;
use App\Models\Entidades\Fornecedor;
use App\Models\Validacao\FornecedorValidador;


class FornecedorController extends Controller
{

    public function index()
    {
        
        $this->render('carro/index');
    }

    public function pesquisar()
    {
        $fornecedorDAO = new FornecedorDAO();
        self::setViewParam('fornecedor', $fornecedorDAO->listarPorCompras());
        self::setViewParam('ativo', $fornecedorDAO->listarAtivo());
        self::setViewParam('inativo', $fornecedorDAO->listarInativo());

        $this->render('fornecedor/pesquisar');
    }


    public function cadastro()
    {

        $this->render('fornecedor/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params){
        $idFornecedor = $params[0];

        $fornecedorDAO = new FornecedorDAO();

        $fornecedor = $fornecedorDAO->listar($idFornecedor);

        if (!$fornecedor) {
            Sessao::gravaMensagem("Fornecedor Inexistente!");
            $this->redirect('/fornecedor/pesquisar');
        }

        self::setViewParam('fornecedor', $fornecedor);

        $this->render('/fornecedor/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar(){

        $fornecedor = new Fornecedor();
        $fornecedor->setId($_POST['id']);
        $fornecedor->setNome($_POST['nome']);
        $fornecedor->setNome_fantasia($_POST['nome_fantasia']);
        $fornecedor->setEmail($_POST['email']);
        $fornecedor->setEmail_empresa($_POST['email_empresa']);
        $fornecedor->setTelefone($_POST['telefone']);
        $fornecedor->setStatus($_POST['status']);
        $fornecedor->setCpf($_POST['cpf']);
        $fornecedor->setCnpj($_POST['cnpj']);
        $fornecedor->setCep($_POST['cep']);
        $fornecedor->setUf($_POST['uf']);
        $fornecedor->setCidade($_POST['cidade']);
        $fornecedor->setBairro($_POST['bairro']);
        $fornecedor->setLogradouro($_POST['logradouro']);
        $fornecedor->setComplemento($_POST['complemento']);
        $fornecedor->setNumero($_POST['numero']);
        Sessao::gravaFormulario($_POST);

        $fornecedorValidador = new FornecedorValidador();
        $resultadoValidacao = $fornecedorValidador->validar($fornecedor);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/edicao/'. $_POST['id']);
        }

        $fornecedorDAO = new FornecedorDAO();

        $fornecedorDAO->atualizar($fornecedor);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Informações atualizadas com sucesso!");
        $this->redirect('/fornecedor/pesquisar/');
    }

    public function exclusao($params)
    {
        $idFornecedor = $params[0];

        $fornecedorDAO = new FornecedorDAO();

        $fornecedor = $fornecedorDAO->listar($idFornecedor);


        if (!$fornecedor) {
            Sessao::gravaMensagem("Fornecedor inexistente");
            $this->redirect('/fornecedor/pesquisar');
        }

        self::setViewParam('fornecedor', $fornecedor);

        $this->render('/fornecedor/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir(){
        $fornecedor = new fornecedor();
        $fornecedor->setId($_POST['id']);

        $fornecedorDAO = new FornecedorDAO();

        if (!$fornecedorDAO->excluir($fornecedor)) {
            Sessao::gravaMensagem("Fornecedor inexistente");
            $this->redirect('/fornecedor/pesquisar');
        }

        Sessao::gravaMensagem("Fornecedor excluído com sucesso!");

        $this->redirect('/fornecedor/pesquisar');
    }

    public function salvar(){
        $fornecedor = new Fornecedor();

        $fornecedor->setId($_POST['id']);
        $fornecedor->setNome($_POST['nome']);
        $fornecedor->setNome_fantasia($_POST['nome_fantasia']);
        $fornecedor->setEmail($_POST['email']);
        $fornecedor->setEmail_empresa($_POST['email_empresa']);
        $fornecedor->setTelefone($_POST['telefone']);
        $fornecedor->setStatus($_POST['status']);
        $fornecedor->setCpf($_POST['cpf']);
        $fornecedor->setCnpj($_POST['cnpj']);
        $fornecedor->setCep($_POST['cep']);
        $fornecedor->setUf($_POST['uf']);
        $fornecedor->setCidade($_POST['cidade']);
        $fornecedor->setBairro($_POST['bairro']);
        $fornecedor->setLogradouro($_POST['logradouro']);
        $fornecedor->setComplemento($_POST['complemento']);
        $fornecedor->setNumero($_POST['numero']);


        Sessao::gravaFormulario($_POST);

        $fornecedorValidador = new FornecedorValidador();
        $resultadoValidacao = $fornecedorValidador->validar($fornecedor);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/cadastro');
        }
        

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $fornecedorDAO = new FornecedorDAO();

        var_dump($fornecedorDAO->salvar($fornecedor));

        Sessao::gravaMensagem("Fornecedor cadastrado com Sucesso!");
        $this->redirect('/fornecedor/cadastro');   

        
    }

    public function listarPorNome()
    {
        $fornecedorDAO = new FornecedorDAO();

        $resultados = $fornecedorDAO->listar();

        if(empty($resultados)){
            echo '<div class="alert alert-info col-md-12" role="alert">Nenhuma fornecedor encontrado. <label class="input-group-text btn-primary" for="inputGroupSelect02" data-bs-toggle="modal" data-bs-target="#modalModelo" data-bs-whatever="@fat">Cadastrar Modelo</label></div>';
        }else{
                foreach($resultados as $fornecedor){
                    echo '<option value="' . 'ID: ' . $fornecedor->getId() . ' | CPF: ' . $fornecedor->getCpf() .  ' | ' . $fornecedor->getNome() . '">' . $fornecedor->getCpf() .  ' | ' . $fornecedor->getNome() . '</option>';
                };
        }

    }
    

}