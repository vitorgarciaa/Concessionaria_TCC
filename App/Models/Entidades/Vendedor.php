<?php 

namespace App\Models\Entidades;

class Vendedor{
     private $id;
     private $nome;
     private $telefone;
     private $email;
     private $cpf;
     private $endereco;
     private $status;

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

   public function getEndereco(){
        return $this->endereco;
   }

   public function setEndereco($endereco){
        $this->endereco = $endereco;
   }

   
   public function getStatus(){
        return $this->status;
   }

   public function setStatus($status){
        $this->status = $status;
   }
}
?>