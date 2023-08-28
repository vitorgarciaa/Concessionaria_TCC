<?php 

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Vendedor;

class VendedorValidador{

    public function validar(Vendedor $vendedor){
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($vendedor->getNome())){
            $resultadoValidacao->addErro('nome', "Nome: Este campo não pode ser vazio");
        }
        return $resultadoValidacao;
    }
}
?>