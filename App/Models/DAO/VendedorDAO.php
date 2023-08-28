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
            $status = $vendedor->getStatus();
            $cep = $vendedor->getCep();
            $uf = $vendedor->getUf();
            $cidade = $vendedor->getCidade();
            $bairro = $vendedor->getbairro();
            $logradouro  = $vendedor->getLogradouro();
            $complemento  = $vendedor->getComplemento();
            $numero  = $vendedor->getNumero();
            return $this->insert(
                'vendedor',
                ":nome, :telefone, :email, :cpf, :status, :cep, :uf, :cidade, :bairro, :logradouro, :complemento, :numero",
                [
                    ':nome' => $nome,
                    ':telefone' => $telefone,
                    ':email' => $email,
                    ':cpf' => $cpf,
                    ':status' => $status,
                    ':cep' => $cep,
                    ':uf' => $uf,
                    ':cidade' => $cidade,
                    ':bairro' => $bairro,
                    ':logradouro' => $logradouro,
                    ':complemento' => $complemento,
                    ':numero' => $numero,

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
            $status = $vendedor->getStatus();
            $cep = $vendedor->getCep();
            $uf = $vendedor->getUf();
            $cidade = $vendedor->getCidade();
            $bairro = $vendedor->getBairro();
            $logradouro  = $vendedor->getLogradouro();
            $complemento  = $vendedor->getComplemento();
            $numero  = $vendedor->getNumero();
            return $this->update(
                'vendedor',
                "nome = :nome, telefone = :telefone, email = :email, cpf = :cpf, status = :status cep = :cep, uf = :uf, cidade = :cidade, bairro = :bairro, logradouro = :logradouro,complemento = :complemento,numero = :numero",
                    [
                        ':nome' => $nome,
                        ':telefone' => $telefone,
                        ':email' => $email,
                        ':cpf' => $cpf,
                        ':status' => $status,
                        ':cep' => $cep,
                        ':uf' => $uf,
                        ':cidade' => $cidade,
                        ':bairro' => $bairro,
                        ':logradouro' => $logradouro,
                        ':complemento' => $complemento,
                        ':numero' => $numero,
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