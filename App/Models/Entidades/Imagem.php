<?php 

namespace App\Models\Entidades;

class Imagem{
     private $id;
     private $nome;
     private $id_carro;

     
     public function getNome(){
          return $this->nome;
     }
  
     public function setNome($nome){
          $this->nome = $nome;
     }

     public function getId(){
        return $this->id;
   }

   public function setId($id){
        $this->id = $id;
   }

   function getId_carro(){
        return $this->id_carro;
   }

   function setId_carro($id_carro){
        $this->id_carro = $id_carro;
   }
}
?>