<?php 

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Venda;

class VendaValidador{

    public function validar(Venda $venda){
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($venda->getTipo_pagamento())){
            $resultadoValidacao->addErro('Tipo Pagamento', "Tipo Pagamento: Este campo não pode ser vazio");
        }
        if(empty($venda->getSituacao_pedido())){
            $resultadoValidacao->addErro('Tipo Situacao', "Tipo Situacao: Este campo não pode ser vazio");
        }
        return $resultadoValidacao;
    }
}
?>