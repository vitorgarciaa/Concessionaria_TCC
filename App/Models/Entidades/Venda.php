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

    public function getIdCarro() {
        return $this->id_carro;
    }

    public function setIdCarro($id_carro) {
        $this->id_carro = $id_carro;
    }

    public function getIdCliente() {
        return $this->id_cliente;
    }

    public function setIdCliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function getIdVendedor() {
        return $this->id_vendedor;
    }

    public function setIdVendedor($id_vendedor) {
        $this->id_vendedor = $id_vendedor;
    }

    public function getDataVenda() {
        return $this->data_venda;
    }

    public function setDataVenda($data_venda) {
        $this->data_venda = $data_venda;
    }

    public function getPrecoVenda() {
        return $this->preco_venda;
    }

    public function setPrecoVenda($preco_venda) {
        $this->preco_venda = $preco_venda;
    }

    public function getDesconto() {
        return $this->desconto;
    }

    public function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

    public function getValorTotal() {
        return $this->valor_total;
    }

    public function setValorTotal($valor_total) {
        $this->valor_total = $valor_total;
    }

    public function getTipoPagamento() {
        return $this->tipo_pagamento;
    }

    public function setTipoPagamento($tipo_pagamento) {
        $this->tipo_pagamento = $tipo_pagamento;
    }
}
?>