<?php

namespace App\Models\Entidades;

class Venda {
    private $id;
    private $id_carro;
    private $id_cliente;
    private $id_vendedor;
    private $data_venda;
    private $preco_venda;
    private $desconto;
    private $valor_total;
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

    public function getData_venda() {
        return $this->data_venda;
    }

    public function setData_venda($data_venda) {
        $this->data_venda = $data_venda;
    }

    public function getPreco_venda() {
        return $this->preco_venda;
    }

    public function setPreco_venda($preco_venda) {
        $this->preco_venda = $preco_venda;
    }

    public function getDesconto() {
        return $this->desconto;
    }

    public function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

    public function getValor_total() {
        return $this->valor_total;
    }

    public function setValor_total($valor_total) {
        $this->valor_total = $valor_total;
    }

    public function getTipo_pagamento() {
        return $this->tipo_pagamento;
    }

    public function setTipo_pagamento($tipo_pagamento) {
        $this->tipo_pagamento = $tipo_pagamento;
    }
}
?>