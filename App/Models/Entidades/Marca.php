<?php 

namespace App\Models\Entidades;

class Marca{
     private $id;
     private $nome;

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
}
?>