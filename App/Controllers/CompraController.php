<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CompraDAO;
use App\Models\Entidades\Compra;

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
        self::setViewParam('compra', $compraDAO->listarCarroPorVenda());

        $this->render('compra/pesquisar');
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

        Sessao::gravaMensagem("Compra excluída com sucesso!");

        $this->redirect('/compra/pesquisar');
    }


}