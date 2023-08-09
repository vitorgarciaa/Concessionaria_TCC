<?php 

namespace App\Models\Entidades;

class Compra {
    private $id;
    private $id_carro;
    private $id_cliente;
    private $id_vendedor;
    private $data_compra;
    private $preco_compra;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId_carro() {
        return $this->id_carro;
    }

    public function setId_carro($id_carro) {
        $this->id_carro = $id_carro;
    }

    public function getId_cliente() {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function getId_vendedor() {
        return $this->id_vendedor;
    }

    public function setId_vendedor($id_vendedor) {
        $this->id_vendedor = $id_vendedor;
    }

    public function getData_compra() {
        return $this->data_compra;
    }

    public function setData_compra($data_compra) {
        $this->data_compra = $data_compra;
    }

    public function getPreco_compra() {
        return $this->preco_compra;
    }

    public function setPreco_compra($preco_compra) {
        $this->preco_compra = $preco_compra;
    }
}
?>