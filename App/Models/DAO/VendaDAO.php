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
            $preco_venda = $venda->getPreco_venda();
           // $desconto = $venda->getDesconto();
            $tipo_pagamento = $venda->getTipo_pagamento();
            $situacao_pedido = $venda->getSituacao_pedido();
            return $this->insert(
                'venda',
                ":id_carro, :id_cliente,:id_vendedor, :preco_venda, :tipo_pagamento, :situacao_pedido",
                [
                    ':id_carro' => $id_carro,
                    ':id_cliente' => $id_cliente,
                    ':id_vendedor' => $id_vendedor,
                    ':preco_venda' => $preco_venda,
                    ':tipo_pagamento' => $tipo_pagamento,
                    ':situacao_pedido' => $situacao_pedido,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ".$e, 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CLIENTES
    public function atualizar(Venda $venda){
        try {
            $id_carro = $venda->getId_carro();
            $id_cliente = $venda->getId_cliente();
            $id_vendedor = $venda->getId_vendedor();
            $preco_venda = $venda->getPreco_venda();
           // $desconto = $venda->getDesconto();
            $tipo_pagamento = $venda->getTipo_pagamento();
            $situacao_pedido = $venda->getSituacao_pedido();

            return $this->update(
                'venda',
                "id_carro = :id_carro, id_cliente = :id_cliente, id_vendedor = :id_vendedor, preco_venda = :preco_venda, tipo_pagamento = :tipo_pagamento, situacao_pedido = :situacao_pedido",
                    [
                        "id = :id",
                        ':id_carro' => $id_carro,
                        ':id_cliente' => $id_cliente,
                        ':id_vendedor' => $id_vendedor,
                        ':preco_venda' => $preco_venda,
                        ':tipo_pagamento' => $tipo_pagamento,
                        ':situacao_pedido' => $situacao_pedido,
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

    public function atualizarSituacao(Venda $venda){
        try {
            $id = $venda->getId();
            $tipo_pagamento = $venda->getTipo_pagamento();
            $situacao_pedido = $venda->getSituacao_pedido();
            
            return $this->update(
                'venda',
                "tipo_pagamento = :tipo_pagamento, situacao_pedido = :situacao_pedido",
                [
                        ':id' => $id,
                        ':tipo_pagamento' => $tipo_pagamento,
                        ':situacao_pedido' => $situacao_pedido,
                    ],
                    "id = :id"
            );
        }catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar".$e, 500);
        }
    }
}
?>