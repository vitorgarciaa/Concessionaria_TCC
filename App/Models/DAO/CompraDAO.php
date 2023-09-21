<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Compra;

class CompraDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS CLIENTES
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM compra WHERE id = $id"
            );

            return $resultado->fetchObject(Compra::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM compra'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Compra::class);
        }

        return false;
    }

    //FUNÇÃO PARA SALVAR OS CARROS
    public function salvar(Compra $compra){
        try {
            $id_carro = $compra->getId_carro();
            $id_fornecedor = $compra->getId_fornecedor();
            $id_vendedor = $compra->getId_vendedor();
            $data_compra = $compra->getData_compra();
            $preco_custo = $compra->getPreco_custo();
            $tipo_pagamento = $compra->getTipo_pagamento();
            return $this->insert(
                'cliente',
                ":id_carro, :id_fornecedor, :id_vendedor, :data_compra, :preco_custo, :tipo_pagamento",
                [
                    ':id_carro' => $id_carro,
                    ':id_fornecedor' => $id_fornecedor,
                    ':id_vendedor' => $id_vendedor,
                    ':data_compra' => $data_compra,
                    ':preco_custo' => $preco_custo,
                    ':tipo_pagamento' => $tipo_pagamento,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CLIENTES
    public function atualizar(Compra $compra){
        try {
            $id = $compra->getId();
            $id_carro = $compra->getId_carro();
            $id_fornecedor = $compra->getId_fornecedor();
            $id_vendedor = $compra->getId_vendedor();
            $data_compra = $compra->getData_compra();
            $preco_custo = $compra->getPreco_custo();
            $tipo_pagamento = $compra->getTipo_pagamento();
            return $this->update(
                'compra',
                "id_carro = :id_carro, id_fornecedor = :id_fornecedor, id_vendedor = :id_vendedor, data_compra = :data_compra, preco_compra = :preco_compra, tipo_pagamento = :tipo_pagamento",
                    [
                        ':id_carro' => $id_carro,
                        ':id_fornecedor' => $id_fornecedor,
                        ':id_vendedor' => $id_vendedor,
                        ':data_compra' => $data_compra,
                        ':preco_custo' => $preco_custo,
                        ':tipo_pagamento' => $tipo_pagamento,
                    ],
                    "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }

    //FUNÇÃO PARA EXCLUIR OS CARROS
    public function excluir(Compra $compra)
    {
        try {
            $id = $compra->getId();

            return $this->delete('compra', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
?>