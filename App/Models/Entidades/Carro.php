<?php 

namespace App\Models\Entidades;

class Carro{
     private $id;
     private $ano;
     private $cor;
     private $preco;
     private $quilometragem;
     private $modelo_direcao;
     private $modelo_cambio;
     private $placa;
     private $obversacoes;
     private $disponibilidade;
     private $idModelo;

     public function getId(){
          return $this->id;
     }

     public function setId($id){
          $this->id = $id;
     }

     function getAno(){
          return $this->ano;
     }

     function setAno($ano){
          $this->ano = $ano;
     }

     public function getCor(){
          return $this->cor;
     }

     public function setCor($cor){
          $this->cor = $cor;
     }

     public function getPreco(){
          return $this->preco;
     }

     public function setPreco($preco){
          $this->preco = $preco;
     }

     public function getQuilometragem(){
          return $this->quilometragem;
     }

     public function setQuilometragem($quilometragem){
          $this->quilometragem = $quilometragem;
     }

     public function getModelo_direcao(){
          return $this->modelo_direcao;
     }

     public function setModelo_direcao($modelo_direcao){
          $this->modelo_direcao = $modelo_direcao;
     }

     public function getModelo_cambio(){
          return $this->modelo_cambio;
     }

     public function setModelo_cambio($modelo_cambio){
          $this->modelo_cambio = $modelo_cambio;
     }

     public function getPlaca(){
          return $this->placa;
     }

     public function setPlaca($placa){
          $this->placa = $placa;
     }

     public function getObversacoes(){
          return $this->obversacoes;
     }

     public function setObversacoes($obversacoes){
          $this->obversacoes = $obversacoes;
     }

     public function getDisponibilidade(){
          return $this->disponibilidade;
     }

     public function setDisponibilidade($disponibilidade){
          $this->disponibilidade = $disponibilidade;
     }

     public function getIdModelo(){
          return $this->idModelo;
     }

     public function setIdModelo($idModelo){
          $this->idModelo = $idModelo;
     }
}
?>
