<?php 

namespace App\Models\Entidades;
class Vendedor{
     private $id;
     private $nome;
     private $telefone;
     private $email;
     private $cpf;
     private $status;
     private $cep;
     private $uf;
     private $cidade;
     private $bairro;
     private $logradouro;
     private $complemento;
     private $numero;

     public function getId(){
        return $this->id;
   }

   public function setId($id){
        $this->id = $id;
   }

   function getNome(){
        return $this->nome;
   }

   function setNome($nome){
        $this->nome = $nome;
   }

   public function getTelefone(){
        return $this->telefone;
   }

   public function setTelefone($telefone){
        $this->telefone = $telefone;
   }

   public function getEmail(){
        return $this->email;
   }

   public function setEmail($email){
        $this->email = $email;
   }

   public function getCpf(){
         return $this->cpf;
   }

    public function setCpf($cpf){
        $this->cpf = $cpf;
   }

   public function getStatus(){
        return $this->status;
   }

   public function setStatus($status){
        $this->status = $status;
   }

   public function getCep(){
     return $this->cep;
   }
   
   public function setCep($cep){
       $this->cep = $cep;
   }
   
   public function getUf(){
       return $this->uf;
   }
   
   public function setUf($uf){
       $this->uf = $uf;
   }
   
   public function getCidade(){
       return $this->cidade;
   }
   
   public function setCidade($cidade){
       $this->cidade = $cidade;
   }
   
   public function getBairro(){
       return $this->bairro;
   }
   
   public function setBairro($bairro){
       $this->bairro = $bairro;
   }
   
   public function getLogradouro(){
       return $this->logradouro;
   }
   
   public function setLogradouro($logradouro){
       $this->logradouro = $logradouro;
   }
   
   public function getComplemento(){
       return $this->complemento;
   }
   
   public function setComplemento($complemento){
       $this->complemento = $complemento;
   }
   
   public function getNumero(){
       return $this->numero;
   }
   
   public function setNumero($numero){
       $this->numero = $numero;
   }
}
?>