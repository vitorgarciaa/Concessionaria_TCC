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
     private $tipo_freio;
     private $torque;
     private $motor;
     private $tipo_combustivel;
     private $tipo_tracao;

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

     public function getTipo_freio(){
          return $this->tipo_freio;
     }

     public function setTipo_freio($tipo_freio){
          $this->tipo_freio = $tipo_freio;
     }

     public function getTorque(){
          return $this->torque;
     }

     public function setTorque($torque){
          $this->torque = $torque;
     }

     public function getMotor(){
          return $this->motor;
     }

     public function setMotor($motor){
          $this->motor = $motor;
     }

     public function getTipo_combustivel(){
          return $this->tipo_combustivel;
     }

     public function setTipo_combustivel($tipo_combustivel){
          $this->tipo_combustivel = $tipo_combustivel;
     }

     public function getTipo_tracao(){
          return $this->tipo_tracao;
     }

     public function setTipo_tracao($tipo_tracao){
          $this->tipo_tracao = $tipo_tracao;
     }
}
?>
