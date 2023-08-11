<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Marca;

class MarcaDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS CLIENTES
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM marca WHERE id = $id"
            );

            return $resultado->fetchObject(Marca::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM marca'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Marca::class);
        }

        return false;
    }


    //FUNÇÃO PARA SALVAR OS CARROS
    public function salvar(Marca $marca){
        try {
            $nome = $marca->getNome();
            return $this->insert(
                'marca',
                ":nome",
                [
                    ':nome' => $nome
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CLIENTES
    public function atualizar(Marca $marca){
        try {
            $nome = $marca->getNome();
            return $this->update(
                'marca',
                "marca = :marca",
                    [
                        "id = :id",
                        ':nome' => $nome
                    ]
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }
    

    //FUNÇÃO PARA EXCLUIR OS CARROS
    public function excluir(Marca $marca)
    {
        try {
            $id = $marca->getId();

            return $this->delete('marca', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
?>