<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Carro;

class CarroDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS CARROS
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM carro WHERE id = $id"
            );

            return $resultado->fetchObject(Carro::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM carro'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Carro::class);
        }

        return false;
    }

    //FUNÇÃO PARA SALVAR OS CARROS
    public function salvar(Carro $carro){
        try {
            $ano = $carro->getAno();
            $cor = $carro->getCor();
            $preco = $carro->getPreco();
            $quilometragem = $carro->getQuilometragem();
            $modelo_direcao = $carro->getModelo_direcao();
            $modelo_cambio = $carro->getModelo_cambio();
            $placa = $carro->getPlaca();
            $observacores = $carro->getObversacoes();
            $disponibilidade = $carro->getDisponibilidade();
            $id_modelo = $carro->getIdModelo();

            return $this->insert(
                'carro',
                ":ano, :cor, :preco, :id_modelo",
                [
                    ':ano' => $ano,
                    ':cor' => $cor,
                    ':preco' => $preco,
                    ':quilometragem' => $quilometragem,
                    ':modelo_direcao' => $modelo_direcao,
                    ':modelo_cambio' => $modelo_cambio,
                    ':placa' => $placa,
                    ':observacores' => $observacores,
                    ':disponibilidade' => $disponibilidade,
                    ':id_modelo' => $id_modelo
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CARROS
    public function atualizar(Carro $carro){
        try {
            $id = $carro->getId();
            $ano = $carro->getAno();
            $cor = $carro->getCor();
            $preco = $carro->getPreco();
            $quilometragem = $carro->getQuilometragem();
            $modelo_direcao = $carro->getModelo_direcao();
            $modelo_cambio = $carro->getModelo_cambio();
            $placa = $carro->getPlaca();
            $observacores = $carro->getObversacoes();
            $disponibilidade = $carro->getDisponibilidade();
            $id_modelo = $carro->getIdModelo();

            return $this->update(
                'carro',
                "ano = :ano, cor = :cor, preco = :preco, quilometragem = :quilometragem, modelo_direcao = :modelo_direcao, modelo_cambio = :modelo_cambio, placa = :placa, observacores = :observacores, disponibilidade = :disponibilidade, id_modelo = :id_modelo",
                    [
                        ':id' => $id,
                        ':ano' => $ano,
                        ':cor' => $cor,
                        ':preco' => $preco,
                        ':quilometragem' => $quilometragem,
                        ':modelo_direcao' => $modelo_direcao,
                        ':modelo_cambio' => $modelo_cambio,
                        ':placa' => $placa,
                        ':observacores' => $observacores,
                        ':disponibilidade' => $disponibilidade,
                        ':id_modelo' => $id_modelo
                    ],
                    "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }

    //FUNÇÃO PARA EXCLUIR OS CARROS
    public function excluir(Carro $carro)
    {
        try {
            $id = $carro->getId();

            return $this->delete('carro', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
?>