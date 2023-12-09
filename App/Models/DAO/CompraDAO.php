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
            $preco_custo = $compra->getPreco_custo();
            $tipo_pagamento = $compra->getTipo_pagamento();
            return $this->insert(
                'compra',
                ":id_carro, :id_fornecedor, :id_vendedor, :preco_custo, :tipo_pagamento",
                [
                    ':id_carro' => $id_carro,
                    ':id_fornecedor' => $id_fornecedor,
                    ':id_vendedor' => $id_vendedor,
                    ':preco_custo' => $preco_custo,
                    ':tipo_pagamento' => $tipo_pagamento,
                ]
            );
        } catch (\Exception $e) {
                echo '<pre>';
                var_dump($e);
                echo '</pre>';
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

    public function listarPorCarro($id_carro){
            $resultado = $this->select(
                "SELECT * FROM compra WHERE id_carro = $id_carro"
            );

            return $resultado->fetchObject(Compra::class);
    }
    
    //FUNÇÃO PARA LISTAR OS CARROS
    public function listarCarroPorVenda(){
        $resultado = $this->select(
            'SELECT c.*, IFNULL(venda.id, null) AS idVenda
            FROM compra c
            LEFT JOIN venda ON c.id_carro = venda.id_carro'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Compra::class);
    }

    public function listarDataAsc(){
            
        $resultado = $this->select(
            'SELECT * FROM compra ORDER BY data_compra ASC'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Compra::class);
    }

    public function listarDataDesc(){
            
        $resultado = $this->select(
            'SELECT * FROM compra ORDER BY data_compra DESC'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Compra::class);
    }
}
?>