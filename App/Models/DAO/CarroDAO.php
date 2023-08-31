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
            $ano_fabricacao = $carro->getAno_fabricacao();
            $ano_modelo = $carro->getAno_modelo();
            $cor = $carro->getCor();
            $preco = $carro->getPreco();
            $quilometragem = $carro->getQuilometragem();
            $modelo_direcao = $carro->getModelo_direcao();
            $modelo_transmissao = $carro->getModelo_transmissao();
            $placa = $carro->getPlaca();
            $observacoes = $carro->getObservacoes();
            $disponibilidade = $carro->getDisponibilidade();
            $id_modelo = $carro->getIdModelo(); 
            $tipo_freio = $carro->getTipo_freio();
            $motor = $carro->getMotor();
            $tipo_combustivel = $carro->getTipo_combustivel();
            $tipo_tracao = $carro->getTipo_tracao();

            return $this->insert(
                'carro',
                ":ano_fabricacao, :ano_modelo, :cor, :preco, :quilometragem, :modelo_direcao, :modelo_transmissao, :placa, :observacoes, :disponibilidade, :id_modelo, :tipo_freio, :motor, :tipo_combustivel, :tipo_tracao",
                [
                    ':ano_fabricacao' => $ano_fabricacao,
                    ':ano_modelo' => $ano_modelo,
                    ':cor' => $cor,
                    ':preco' => $preco,
                    ':quilometragem' => $quilometragem,
                    ':modelo_direcao' => $modelo_direcao,
                    ':modelo_transmissao' => $modelo_transmissao,
                    ':placa' => $placa,
                    ':observacoes' => $observacoes,
                    ':disponibilidade' => $disponibilidade,
                    ':id_modelo' => $id_modelo,
                    ':tipo_freio' => $tipo_freio,
                    ':motor' => $motor,
                    ':tipo_combustivel' => $tipo_combustivel,
                    ':tipo_tracao' => $tipo_tracao
                ]
            );
        } catch (\Exception $e) {
            echo '<pre>';
            var_dump($e);
            echo '</pre>';
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CARROS
    public function atualizar(Carro $carro){
        try {
            $id = $carro->getId();
            $ano_fabricacao = $carro->getAno_fabricacao();
            $ano_modelo = $carro->getAno_modelo();
            $cor = $carro->getCor();
            $preco = $carro->getPreco();
            $quilometragem = $carro->getQuilometragem();
            $modelo_direcao = $carro->getModelo_direcao();
            $modelo_transmissao = $carro->getModelo_transmissao();
            $placa = $carro->getPlaca();
            $observacoes = $carro->getObservacoes();
            $disponibilidade = $carro->getDisponibilidade();
            $id_modelo = $carro->getIdModelo();
            $tipo_freio = $carro->getTipo_freio();
            $motor = $carro->getMotor();
            $tipo_combustivel = $carro->getTipo_combustivel();
            $tipo_tracao = $carro->getTipo_tracao();

            return $this->update(
                'carro',
                "ano_fabricacao = :ano_fabricacao, ano_modelo = :ano_modelo, cor = :cor, preco = :preco, quilometragem = :quilometragem, modelo_direcao = :modelo_direcao, modelo_transmissao = :modelo_transmissao, placa = :placa, observacoes = :observacoes, disponibilidade = :disponibilidade, id_modelo = :id_modelo, tipo_freio = :tipo_freio, motor = :motor, tipo_combustivel = :tipo_combustivel, tipo_tracao = :tipo_tracao",
                [
                        ':id' => $id,
                        ':ano_fabricacao' => $ano_fabricacao,
                        ':ano_modelo' => $ano_modelo,
                        ':cor' => $cor,
                        ':preco' => $preco,
                        ':quilometragem' => $quilometragem,
                        ':modelo_direcao' => $modelo_direcao,
                        ':modelo_transmissao' => $modelo_transmissao,
                        ':placa' => $placa,
                        ':observacoes' => $observacoes,
                        ':disponibilidade' => $disponibilidade,
                        ':id_modelo' => $id_modelo,
                        ':tipo_freio' => $tipo_freio,
                        ':motor' => $motor,
                        ':tipo_combustivel' => $tipo_combustivel,
                        ':tipo_tracao' => $tipo_tracao
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
    
    //FUNÇÃO AUXILIARES
    public function listarUltimoCadastrado(){
        $resultado = $this->select(   
            "SELECT id FROM carro ORDER BY id DESC LIMIT 1"
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Carro::class);
    }
}
?>