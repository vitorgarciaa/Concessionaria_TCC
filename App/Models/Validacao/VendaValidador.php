<?php 

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Venda;

class VendaValidador{

    public function validar(Venda $venda){
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($venda->getId_cliente())){
            $resultadoValidacao->addErro('id_cliente', "Cliente: Este campo não pode ser vazio");
        }

        if(empty($venda->getTipo_pagamento())){
            $resultadoValidacao->addErro('tipo_pagamento', "Tipo Pagamento: Este campo não pode ser vazio");
        }
        if(empty($venda->getSituacao_pedido())){
            $resultadoValidacao->addErro('situacao_pedido', "Tipo Situacao: Este campo não pode ser vazio");
        }
        return $resultadoValidacao;
    }
}
?>