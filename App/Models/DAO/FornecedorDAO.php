<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Fornecedor;

class FornecedorDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS FORNECEDORES
    public function listar($id = null){
        if($id){
            $resultado = $this->select(
                "SELECT * FROM fornecedor WHERE id = $id"
            );

            return $resultado->fetchObject(Fornecedor::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM fornecedor'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Fornecedor::class);
        }

        return false;
    }

    //FUNÇÃO PARA SALVAR OS FORNECEDORES
    public function salvar(Fornecedor $fornecedor){
        try {
            $nome = $fornecedor->getNome();
            $nome_fantasia = $fornecedor->getNome_fantasia();
            $telefone = $fornecedor->getTelefone();
            $email = $fornecedor->getEmail();
            $email_empresa  = $fornecedor->getEmail_empresa();
            $cpf = $fornecedor->getCpf();
            $cnpj  = $fornecedor->getCnpj();
            $status = $fornecedor->getStatus();
            $cep = $fornecedor->getCep();
            $uf = $fornecedor->getUf();
            $cidade = $fornecedor->getCidade();
            $bairro = $fornecedor->getbairro();
            $logradouro  = $fornecedor->getLogradouro();
            $complemento  = $fornecedor->getComplemento();
            $numero  = $fornecedor->getNumero();
            return $this->insert(
                'fornecedor',
                ":nome, :nome_fantasia, :telefone, :email, :email_empresa, :cpf, :cnpj, :status, :cep, :uf, :cidade, :bairro, :logradouro, :complemento, :numero",
                [
                    ':nome' => $nome,
                    ':nome_fantasia' => $nome_fantasia,
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
                    ':email_empresa' =>$email_empresa,
                    ':cnpj' =>$cnpj,

                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ".$e->__toString(), 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS FORNECEDORES
    public function atualizar(Fornecedor $fornecedor){
        try {
            $id = $fornecedor->getId();
            $nome = $fornecedor->getNome();
            $nome_fantasia = $fornecedor->getNome_fantasia();
            $telefone = $fornecedor->getTelefone();
            $email = $fornecedor->getEmail();
            $email_empresa  = $fornecedor->getEmail_empresa();
            $cpf = $fornecedor->getCpf();
            $cnpj  = $fornecedor->getCnpj();
            $status = $fornecedor->getStatus();
            $cep = $fornecedor->getCep();
            $uf = $fornecedor->getUf();
            $cidade = $fornecedor->getCidade();
            $bairro = $fornecedor->getBairro();
            $logradouro  = $fornecedor->getLogradouro();
            $complemento  = $fornecedor->getComplemento();
            $numero  = $fornecedor->getNumero();

            return $this->update(
                'fornecedor',
                "id = :id, nome = :nome, nome_fantasia = :nome_fantasia, telefone = :telefone, email = :email, email_empresa = :email_empresa, cpf = :cpf, cnpj = :cnpj, status = :status, cep = :cep, uf = :uf, cidade = :cidade, bairro = :bairro, logradouro = :logradouro,complemento = :complemento,numero = :numero",
                    [
                        ':id' => $id,
                        ':nome' => $nome,
                        ':nome_fantasia' => $nome_fantasia,
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
                        ':email_empresa' =>$email_empresa,
                        ':cnpj' =>$cnpj,
                    ],
                    "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }

    //FUNÇÃO PARA EXCLUIR OS FORNECEDORES
    public function excluir(Fornecedor $fornecedor)
    {
        try {
            $id = $fornecedor->getId();

            return $this->delete('fornecedor', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
?>