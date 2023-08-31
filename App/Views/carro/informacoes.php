<?php
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;

$carro = $viewVar['carro'];

$modeloDAO = new ModeloDAO();
$modelo = $modeloDAO->listar($carro->getId_modelo());

$marcaDAO = new MarcaDAO();
$marca = $marcaDAO->listar($modelo->getId_marca());

?>

<div class="container">
    <br>
    <h3>Mais Informações</h3>
    <br>
    <div class="row">
        <div class="col-md-12 col-sm-12 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-car-front"></i> <?php  echo $marca->getNome() . ' - ' . $modelo->getNome(); ?></h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-calendar3"></i></h1>
                    <h5 class="card-text">Ano de Fabricação: <?php echo $carro->getAno_fabricacao(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-calendar3"></i></h1>
                    <h5 class="card-text">Ano de Modelo: <?php echo $carro->getAno_modelo(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-paint-bucket"></i></i></h1>
                    <h5 class="card-text">Cor: <?php echo $carro->getCor(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-speedometer"></i></h1>
                    <h5 class="card-text">Quilometragem: <?php echo $carro->getQuilometragem(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-vinyl"></i></h1>
                    <h5 class="card-text">Direcao: <?php echo $carro->getModelo_direcao(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-sliders2-vertical"></i></h1>
                    <h5 class="card-text">Transmissão: <?php echo $carro->getModelo_transmissao(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-card-list"></i></i></h1>
                    <h5 class="card-text">Observações: <?php echo $carro->getObservacoes(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-check-lg"></i></h1>
                    <h5 class="card-text">Disponibilidade: <?php echo $carro->getDisponibilidade(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-sign-stop-fill"></i></h1>
                    <h5 class="card-text">Tipo de Freio: <?php echo $carro->getTipo_freio(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-shift-fill"></i></h1>
                    <h5 class="card-text">Motor: <?php echo $carro->getMotor(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-fuel-pump"></i></h1>
                    <h5 class="card-text">Tipo de Combustivel: <?php echo $carro->getTipo_combustivel(); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-gear"></i></h1>
                    <h5 class="card-text">Tipo de Tração: <?php echo $carro->getTipo_tracao(); ?></h5>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-cash-coin"></i></h1>
                    <h5 class="card-text">Valor: <?php echo "R$ " . number_format($carro->getPreco(), 2, ',', '.'); ?></h5>
                </div>
            </div>
        </div>

        </div>
    <a href="http://<?php echo APP_HOST; ?>/carro" class="btn btn-primary">Voltar</a>
    </div>
<br>