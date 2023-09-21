<?php 

namespace App\Models\Entidades;

class Carro{
     private $id;
     private $ano_fabricacao;
     private $ano_modelo;
     private $cor;
     private $preco_venda;
     private $quilometragem;
     private $modelo_direcao;
     private $modelo_transmissao;
     private $placa;
     private $observacoes;
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

     function getAno_fabricacao(){
          return $this->ano_fabricacao;
     }

     function setAno_fabricacao($ano_fabricacao){
          $this->ano_fabricacao = $ano_fabricacao;
     }

     function getAno_modelo(){
          return $this->ano_modelo;
     }

     function setAno_modelo($ano_modelo){
          $this->ano_modelo = $ano_modelo;
     }
     public function getCor(){
          return $this->cor;
     }

     public function setCor($cor){
          $this->cor = $cor;
     }

     public function getPreco_venda(){
          return $this->preco_venda;
     }

     public function setPreco_venda($preco_venda){
          $this->preco_venda = $preco_venda;
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

     public function getModelo_transmissao(){
          return $this->modelo_transmissao;
     }

     public function setModelo_transmissao($modelo_transmissao){
          $this->modelo_transmissao = $modelo_transmissao;
     }

     public function getPlaca(){
          return $this->placa;
     }

     public function setPlaca($placa){
          $this->placa = $placa;
     }

     public function getObservacoes(){
          return $this->observacoes;
     }

     public function setObservacoes($observacoes){
          $this->observacoes = $observacoes;
     
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

     //variaveis adicionais 
     private $id_modelo;

     public function getId_modelo(){
          return $this->id_modelo;
     }


}
?>
