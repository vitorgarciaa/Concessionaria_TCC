<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Cliente;

class ClienteDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS CLIENTES
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM cliente WHERE id = $id"
            );

            return $resultado->fetchObject(Cliente::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM cliente'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Cliente::class);
        }

        return false;
    }

    //FUNÇÃO PARA SALVAR OS CARROS
    public function salvar(Cliente $cliente){
        try {
            $nome = $cliente->getNome();
            $telefone = $cliente->getTelefone();
            $email = $cliente->getEmail();
            $cpf = $cliente->getCpf();
            $status = $cliente->getStatus();
            $cep = $cliente->getCep();
            $uf = $cliente->getUf();
            $cidade = $cliente->getCidade();
            $bairro = $cliente->getbairro();
            $logradouro  = $cliente->getLogradouro();
            $complemento  = $cliente->getComplemento();
            $numero  = $cliente->getNumero();
            return $this->insert(
                'cliente',
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
    public function atualizar(Cliente $cliente){
        try {
            $id = $cliente->getId();
            $nome = $cliente->getNome();
            $telefone = $cliente->getTelefone();
            $email = $cliente->getEmail();
            $cpf = $cliente->getCpf();
            $status = $cliente->getStatus();
            $cep = $cliente->getCep();
            $uf = $cliente->getUf();
            $cidade = $cliente->getCidade();
            $bairro = $cliente->getBairro();
            $logradouro  = $cliente->getLogradouro();
            $complemento  = $cliente->getComplemento();
            $numero  = $cliente->getNumero();
            return $this->update(
                'cliente',
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
    public function excluir(Cliente $cliente)
    {
        try {
            $id = $cliente->getId();

            return $this->delete('cliente', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
?>