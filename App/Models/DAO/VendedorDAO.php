<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Vendedor;

class VendedorDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS CLIENTES
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM vendedor WHERE id = $id"
            );

            return $resultado->fetchObject(Vendedor::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM vendedor'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Vendedor::class);
        }

        return false;
    }

    //FUNÇÃO PARA SALVAR OS CARROS
    public function salvar(Vendedor $vendedor){
        try {
            $nome = $vendedor->getNome();
            $telefone = $vendedor->getTelefone();
            $email = $vendedor->getEmail();
            $cpf = $vendedor->getCpf();
            $endereco = $vendedor->getEndereco();
            $status = $vendedor->getStatus();
            return $this->insert(
                'vendedor',
                ":nome, :telefone, :email, :cpf, :endereco, :status",
                [
                    ':nome' => $nome,
                    ':telefone' => $telefone,
                    ':email' => $email,
                    ':cpf' => $cpf,
                    ':endereco' => $endereco,
                    ':status' => $status,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS CLIENTES
    public function atualizar(Vendedor $vendedor){
        try {
            $id = $vendedor->getId();
            $nome = $vendedor->getNome();
            $telefone = $vendedor->getTelefone();
            $email = $vendedor->getEmail();
            $cpf = $vendedor->getCpf();
            $endereco = $vendedor->getEndereco();
            $status = $vendedor->getStatus();
            return $this->update(
                'vendedor',
                "nome = :nome, telefone = :telefone, email = :email, cpf = :cpf, endereco = :endereco, status = :status",
                    [
                        ':nome' => $nome,
                        ':telefone' => $telefone,
                        ':email' => $email,
                        ':cpf' => $cpf,
                        ':endereco' => $endereco,
                        ':status' => $status,
                    ],
                    "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }

    //FUNÇÃO PARA EXCLUIR OS CARROS
    public function excluir(Vendedor $vendedor)
    {
        try {
            $id = $vendedor->getId();

            return $this->delete('cliente', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
?>