<?php 

namespace App\Models\Entidades;

class Modelo{
     private $id;
     private $nome;
     private $id_marca;

     
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

   function getId_marca(){
        return $this->id_marca;
   }

   function setId_marca($id_marca){
        $this->id_marca = $id_marca;
   }
}
?>