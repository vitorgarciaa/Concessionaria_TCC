<?php 

namespace App\Models\Entidades;

class Compra {
    private $id;
    private $id_carro;
    private $id_fornecedor;
    private $id_vendedor;
    private $data_compra;
    private $preco_custo;
    private $tipo_pagamento;


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

    public function getId_fornecedor() {
        return $this->id_fornecedor;
    }

    public function setId_fornecedor($id_fornecedor) {
        $this->id_fornecedor = $id_fornecedor;
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

    public function getPreco_custo() {
        return $this->preco_custo;
    }

    public function setPreco_custo($preco_custo) {
        $this->preco_custo = $preco_custo;
    }
    
    public function getTipo_pagamento() {
        return $this->tipo_pagamento;
    }

    public function setTipo_pagamento($tipo_pagamento) {
        $this->tipo_pagamento = $tipo_pagamento;
    }
}
?>