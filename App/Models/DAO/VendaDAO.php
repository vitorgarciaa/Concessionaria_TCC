<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Venda;

class VendaDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS CLIENTES
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM venda WHERE id = $id"
            );

            return $resultado->fetchObject(Venda::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM venda'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Venda::class);
        }

        return false;
    }

    //FUNÇÃO PARA SALVAR OS CARROS
    public function salvar(Venda $venda){
        try {
            $id_carro = $venda->getId_carro();
            $id_cliente = $venda->getId_cliente();
            $id_vendedor = $venda->getId_vendedor();
            $data_venda = $venda->getData_venda();
            $preco_venda = $venda->getPreco_venda();
            $desconto = $venda->getDesconto();
            $valor_total = $venda->getValor_total();
            $tipo_pagamento = $venda->getTipo_pagamento();
            return $this->insert(
                'modelo',
                ":id_carro, :id_cliente,:id_vendedor, :data_venda,:preco_venda, :desconto,:valor_total, :tipo_pagamento",
                [
                    ':id_carro' => $id_carro,
                    ':id_cliente' => $id_cliente,
                    ':id_vendedor' => $id_vendedor,
                    ':data_venda' => $data_venda,
                    ':preco_venda' => $preco_venda,
                    ':desconto' => $desconto,
                    ':valor_total' => $valor_total,
                    ':tipo_pagamento' => $tipo_pagamento,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CLIENTES
    public function atualizar(Venda $venda){
        try {
            $id_carro = $venda->getId_carro();
            $id_cliente = $venda->getId_cliente();
            $id_vendedor = $venda->getId_vendedor();
            $data_venda = $venda->getData_venda();
            $preco_venda = $venda->getPreco_venda();
            $desconto = $venda->getDesconto();
            $valor_total = $venda->getValor_total();
            $tipo_pagamento = $venda->getTipo_pagamento();

            return $this->update(
                'modelo',
                "id_carro = :id_carro, id_cliente = :id_cliente, id_vendedor = :id_vendedor, data_venda = :data_venda, preco_venda = :preco_venda, desconto = :desconto, valor_total = :valor_total, tipo_pagamento = :tipo_pagamento",
                    [
                        "id = :id",
                        ':id_carro' => $id_carro,
                        ':id_cliente' => $id_cliente,
                        ':id_vendedor' => $id_vendedor,
                        ':data_venda' => $data_venda,
                        ':preco_venda' => $preco_venda,
                        ':desconto' => $desconto,
                        ':valor_total' => $valor_total,
                        ':tipo_pagamento' => $tipo_pagamento,
                    ]
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }

    //FUNÇÃO PARA EXCLUIR OS CARROS
    public function excluir(Venda $Venda)
    {
        try {
            $id = $Venda->getId();

            return $this->delete('venda', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
?>