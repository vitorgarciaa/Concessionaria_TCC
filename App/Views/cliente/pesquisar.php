<?php
use App\Models\DAO\ClienteDAO;
?>

<div class="container-fluid">
<br>
<h3>Lista de Clientes</h3>
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
            <th scope="col">E-mail</th>
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
        if (!count($viewVar['cliente'])) { ?>
            <div class="alert alert-info" role="alert">Nenhum cliente encontrado!</div>
        <?php } else {
            $clienteDAO = new ClienteDAO();
            foreach ($viewVar['cliente'] as $cliente) {
        ?>
                <tr>
                    <th scope="row"><?php echo $cliente->getId(); ?></th>
                    <td><?php echo $cliente->getNome(); ?></td>
                    <td><?php echo $cliente->getEmail(); ?></td>
                    <td><?php echo $cliente->getTelefone(); ?></td>
                    <td><?php echo $cliente->getCEP(); ?></td>
                    <td><?php echo $cliente->getUF(); ?></td>
                    <td><?php echo $cliente->getCidade(); ?></td>
                    <td><?php echo $cliente->getBairro(); ?></td>
                    <td><?php echo $cliente->getLogradouro(); ?></td>
                    <td><?php echo $cliente->getComplemento(); ?></td>
                    <td><?php echo $cliente->getNumero(); ?></td>
                    <td><?php echo $cliente->getStatus(); ?></td>
                    <td>
                        <a href="http://<?php echo APP_HOST; ?>/cliente/edicao/<?php echo $cliente->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                        <a href="http://<?php echo APP_HOST; ?>/cliente/exclusao/<?php echo $cliente->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>
</div>
<br>
