<?php 

namespace App\Models\DAO;
use App\Models\Entidades\Vendedor;

class VendedorDAO extends BaseDAO{

    //FUNÇÃO PARA LISTAR OS VENDEDORES
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

    //FUNÇÃO PARA SALVAR OS VENDEDORES
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
            $usuario  = $vendedor->getUsuario();
            $senha  = $vendedor->getSenha();
            return $this->insert(
                'vendedor',
                ":nome, :senha, :usuario, :telefone, :email, :cpf, :status, :cep, :uf, :cidade, :bairro, :logradouro, :complemento, :numero",
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
                    ':usuario' =>$usuario,
                    ':senha' =>$senha,

                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar dados! ", 500);      
        }
    }

    //FUNÇÃO PARA ATUALIZAR OS VENDEDOR
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
            $usuario  = $vendedor->getUsuario();
            $senha  = $vendedor->getSenha();
            return $this->update(
                'vendedor',
                "id = :id, nome = :nome, usuario = :usuario, senha = :senha, telefone = :telefone, email = :email, cpf = :cpf, status = :status, cep = :cep, uf = :uf, cidade = :cidade, bairro = :bairro, logradouro = :logradouro,complemento = :complemento,numero = :numero",
                    [
                        ':id' => $id,
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
                        ':usuario' =>$usuario,
                        ':senha' =>$senha,
                    ],
                    "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar dados!", 500);
        }
    }

    //FUNÇÃO PARA EXCLUIR OS VENDEDORES
    public function excluir(Vendedor $vendedor)
    {
        try {
            $id = $vendedor->getId();

            return $this->delete('vendedor', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }

    public function logar($email, $senha){
        try {
            $resultado = $this->select(
            "SELECT * FROM vendedor WHERE email = '{$email}' AND senha = '{$senha}' AND status = 'Ativo' OR usuario = '{$email}' AND senha = '{$senha}' AND status = 'Ativo'"
            );

            $resultado = $resultado->fetchAll(\PDO::FETCH_ASSOC);

            if (count($resultado) > 0) {
                $arrayVendedor = $resultado[0];
                $idVendedor = $arrayVendedor['id'];
                $nomeVendedor = $arrayVendedor['nome'];
                session_start();
                $_SESSION['login'] = $idVendedor;
                $_SESSION['nome'] = $nomeVendedor;

            }else{
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>alert('You clicked the button!')</script>";
            }
        } catch (\Exception $e) {
            throw new \Exception("Erro ao logar ", 500);
        }
    }
}
?>