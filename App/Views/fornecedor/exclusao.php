<?php
use App\Models\DAO\FornecedorDAO;

$fornecedor = $viewVar['fornecedor'];

$fornecedorDAO = new FornecedorDAO();
$fornecedor = $fornecedorDAO->listar($fornecedor->getId());

session_start();

if (isset($_SESSION['login'])) {

?>
<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>EXCLUIR FORNECEDOR</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/fornecedor/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $fornecedor->getId(); ?>">

                <div class="panel panel-danger">
                    <div class="panel-body">
                        Deseja realmente excluir o fornecedor: <?php echo $fornecedor->getNome() ?>?
                    </div>
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/fornecedor/pesquisar" class="btn btn-info btn-sm">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
    <br>
    <br>
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