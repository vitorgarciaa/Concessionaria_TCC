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
        self::setViewParam('vendedor', $vendedorDAO->listar());

        $this->render('vendedor/pesquisar');
    }


    public function cadastro()
    {

        $this->render('vendedor/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar(){
        $vendedor = new Vendedor();

        $vendedor->setNome($_POST['nome']);
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