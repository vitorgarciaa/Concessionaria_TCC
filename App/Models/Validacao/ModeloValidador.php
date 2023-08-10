<?php 

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Modelo;

class ModeloValidador{

    public function validar(Modelo $modelo){
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($modelo->getId_marca())){
            $resultadoValidacao->addErro('id_marca', "Marca: Este campo não pode ser vazio");
        }
        if(empty($modelo->getNome())){
            $resultadoValidacao->addErro('nome', "Nome: Este campo não pode ser vazio");
        }
        return $resultadoValidacao;
    }
}
?>