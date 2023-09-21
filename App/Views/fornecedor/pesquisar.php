<?php
use App\Models\DAO\FornecedorDAO;

session_start();

if (isset($_SESSION['login'])) {

?>

<div class="container-fluid" style="margin-bottom: 60px;">
<br>
<h3>Lista de Fornecedores</h3>
<br>

<?php
if ($Sessao::retornaMensagem()) { ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="alert alert-success col-md-12" role="alert">
                <a href="" class="btn-close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $Sessao::retornaMensagem(); ?> <br>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
<?php } ?>

<?php
if($Sessao::retornaErro()){?>
    <br>
    <div class="container">
        <div class="alert alert-warning" role="alert">
            <a href="" class="btn-close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                <?php echo $mensagem; ?> <br>
            <?php }?>
        </div> 
    </div>
    <br>
<?php } ?>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">E-mail</th>
            <th scope="col">Nome Fantasia</th>
            <th scope="col">CNPJ</th>
            <th scope="col">E-mail Empresa</th>
            <th scope="col">Telefone</th>
            <th scope="col">CEP</th>
            <th scope="col">UF</th>
            <th scope="col">Cidade</th>
            <th scope="col">Bairro</th>
            <th scope="col">Logradouro</th>
            <th scope="col">Complemento</th>
            <th scope="col">Numero</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!count($viewVar['fornecedor'])) { ?>
            <div class="alert alert-info" role="alert">Nenhum fornecedor encontrado!</div>
        <?php } else {
            $fornecedorDAO = new FornecedorDAO();
            foreach ($viewVar['fornecedor'] as $fornecedor) {
        ?>
                <tr>
                    <th scope="row"><?php echo $fornecedor->getId(); ?></th>
                    <td><?php echo $fornecedor->getNome(); ?></td>
                    <td><?php echo $fornecedor->getCpf(); ?></td>
                    <td><?php echo $fornecedor->getEmail(); ?></td>
                    <td><?php echo $fornecedor->getNome_fantasia(); ?></td>
                    <td><?php echo $fornecedor->getCnpj(); ?></td>
                    <td><?php echo $fornecedor->getEmail_empresa(); ?></td>
                    <td><?php echo $fornecedor->getTelefone(); ?></td>
                    <td><?php echo $fornecedor->getCEP(); ?></td>
                    <td><?php echo $fornecedor->getUF(); ?></td>
                    <td><?php echo $fornecedor->getCidade(); ?></td>
                    <td><?php echo $fornecedor->getBairro(); ?></td>
                    <td><?php echo $fornecedor->getLogradouro(); ?></td>
                    <td><?php echo $fornecedor->getComplemento(); ?></td>
                    <td><?php echo $fornecedor->getNumero(); ?></td>
                    <td><?php echo $fornecedor->getStatus(); ?></td>
                    <td>
                        <a href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                        <a href="http://<?php echo APP_HOST; ?>/fornecedor/exclusao/<?php echo $fornecedor->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>
</div>

<?php

} else { ?>
<br>
    <div class="container">
        <h2> FAÇA LOGIN PARA CONTINUAR! </h2>
        <a href="http://<?php echo APP_HOST; ?>/login/index" class="btn btn-dark">FAZER LOGIN</a>
            <p>
                ou <a href="http://<?php echo APP_HOST;?>/">Voltar para Página Inicial</a>
            </p>
    </div>
<br>
<?php
    }
?>

<br>
