<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Modelo;

class ModeloDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS CLIENTES
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM modelo WHERE id = $id"
            );

            return $resultado->fetchObject(Modelo::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM modelo'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Modelo::class);
        }

        return false;
    }

    //FUNÇÃO PARA SALVAR OS CARROS
    public function salvar(Modelo $modelo){
        try {
            $nome = $modelo->getNome();
            $id_marca = $modelo->getId_marca();
            return $this->insert(
                'modelo',
                ":nome, :id_marca",
                [
                    ':nome' => $nome,
                    ':id_marca' => $id_marca,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CLIENTES
    public function atualizar(Modelo $modelo){
        try {
            $nome = $modelo->getNome();
            $id_marca = $modelo->getId_marca();
            return $this->update(
                'modelo',
                "nome = :nome, id_marca = :id_marca",
                    [
                        "id = :id",
                        ':nome' => $nome,
                        ':id_marca' => $id_marca,
                    ]
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }

    //FUNÇÃO PARA EXCLUIR OS CARROS
    public function excluir(Modelo $modelo)
    {
        try {
            $id = $modelo->getId();

            return $this->delete('modelo', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }

    
    //FUNÇÃO ADICIONAL
    public function listar_marca($id_marca){

        $resultado = $this->select(
            "SELECT * FROM modelo WHERE id_marca = $id_marca"
        );

        return $resultado->fetchObject(Marca::class);

}
}
?>