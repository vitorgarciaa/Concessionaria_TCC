<?php 

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Marca;

class MarcaValidador{

    public function validar(Marca $marca){
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($marca->getNome())){
            $resultadoValidacao->addErro('nome', "Nome: Este campo não pode ser vazio");
        }
        return $resultadoValidacao;
    }
}
?>