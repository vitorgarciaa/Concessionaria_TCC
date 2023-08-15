<?php 

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Carro;

class CarroValidador{

    public function validar(Carro $carro){
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($carro->getAno_fabricacao())){
            $resultadoValidacao->addErro('ano', "Ano: Este campo não pode ser vazio");
        }
        if(empty($carro->getCor())){
            $resultadoValidacao->addErro('cor', "Cor: Este campo não pode ser vazio");
        }
        return $resultadoValidacao;
    }
}
?>