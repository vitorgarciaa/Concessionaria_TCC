<?php 

namespace App\Models\Entidades;
class Fornecedor{
     private $id;
     private $nome;
     private $nome_fantasia;
     private $telefone;
     private $email;
     private $email_empresa;
     private $cpf;
     private $cnpj;
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
   
    function getNome_fantasia(){
        return $this->nome_fantasia;
    }

    function setNome_fantasia($nome_fantasia){
        $this->nome_fantasia = $nome_fantasia;
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
    public function getEmail_empresa(){
        return $this->email_empresa;
    }

    public function setEmail_empresa($email_empresa){
        $this->email_empresa = $email_empresa;
    }

    public function getCnpj(){
        return $this->cnpj;
    }

    public function setCnpj($cnpj){
        $this->cnpj = $cnpj;
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

   // VARIÁVEIS AUXILIARES
   private $qtdCompras;

   public function getQtdCompras(){
       return $this->qtdCompras;
   }
}
?>