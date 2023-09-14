<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Imagem;

class ImagemDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS CLIENTES
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM imagem WHERE id = $id"
            );

            return $resultado->fetchObject(Imagem::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM imagem'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Imagem::class);
        }

        return false;
    }


    //FUNÇÃO PARA SALVAR OS 6ARROS
    public function salvar(Imagem $imagem){
        try {
            $nome = $imagem->getNome();
            $id_carro = $imagem->getId_carro();

            return $this->insert(
                'imagem',
                ":nome, :id_carro",
                [
                    ':nome' => $nome,
                    ':id_carro' => $id_carro
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CLIENTES
    public function atualizar(Imagem $imagem){
        try {
            $id = $imagem->getId();
            $nome = $imagem->getNome();
            $id_carro = $imagem->getId_carro();   
            return $this->update(
                'imagem',
                "nome = :nome, id_carro = :id_carro",
                    [
                        ':id' => $id,
                        ':nome' => $nome,
                        ':id_carro' => $id_carro
                    ],
                    "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }
    

    //FUNÇÃO PARA EXCLUIR OS CARROS
    public function excluir(Imagem $imagem)
    {
        try {
            $id = $imagem->getId();

            return $this->delete('imagem', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }

    public function excluirImagemPorCarro(Imagem $imagem)
    {
        try {
            $id_carro = $imagem->getId();

            return $this->deleteImagemPorCarro('imagem', $id_carro);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }

    //FUNÇÃO ADICIONAL
    public function listarPorCarro($id_carro){
        $resultado = $this->select(
            "SELECT * FROM imagem WHERE id_carro = $id_carro"
        );

        return $resultado->fetchAll(\PDO::FETCH_CLASS, Imagem::class);
    }
}
?>