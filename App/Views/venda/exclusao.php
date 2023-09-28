<?php

use App\Models\DAO\CarroDAO;
use App\Models\DAO\ClienteDAO;
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;

$venda = $viewVar['venda'];

$carroDAO = new CarroDAO();
$carro = $carroDAO->listar($venda->getId_carro());

$modeloDAO = new ModeloDAO();
$modelo = $modeloDAO->listar($carro->getId_modelo());
$marcaDAO = new MarcaDAO();
$marca = $marcaDAO->listar($modelo->getId_marca());

session_start();

if (isset($_SESSION['login'])) {

?>
<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>EXCLUIR VENDA</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/venda/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $venda->getId(); ?>">

                <div class="panel panel-danger">
                    <div class="panel-body">
                        Deseja realmente excluir essa venda: <?php echo $marca->getNome() . "/" . $modelo->getNome(); ?>?
                    </div>
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/venda/pesquisar" class="btn btn-info btn-sm">Voltar</a>
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