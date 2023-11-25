<?php

use App\Models\DAO\ImagemDAO;
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;

$carro = $viewVar['carro'];

$modeloDAO = new ModeloDAO();
$modelo = $modeloDAO->listar($carro->getId_modelo());

$marcaDAO = new MarcaDAO();
$marca = $marcaDAO->listar($modelo->getId_marca());

$imagemDAO = new ImagemDAO();
$imagem = $imagemDAO->listarPorCarro($carro->getId());

?>
<style>
    .info-card {
        height: 200px;
    }

    .card-body {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #imageCarousel .carousel-inner {
        transition: transform 0.3s ease-in-out;
    }

    #imageCarousel .carousel-item {
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 0.3s ease-in-out;
        cursor: pointer;
    }

    #imageCarousel .carousel-item.active {
        opacity: 1;
    }

    #imageCarousel .carousel-item:not(.active) {
        opacity: 0;
    }

    .modal-dialog.modal-lg {
        max-width: 90vw;
        height: 100%;
    }

    .modal-content {
        height: 80vh;
    }

    .modal-body {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-item.active {
        z-index: 1;
    }

    .carousel-control-prev,
    .carousel-control-next {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        font-size: 24px;
        color: #fff;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        transition: background-color 0.3s ease-in-out;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .custom-close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        border: none;
        font-size: 24px;
        cursor: pointer;
        z-index: 2;
        height: 50px;
        width: 50px;
    }

    .custom-close-icon {
        font-size: 30px;
    }

    .custom-close-button:hover {
        color: #ff0000;
    }
    .modal-container {
        overflow: hidden;
    }
    
    .info-card h6.card-title{
        color: gray;
    }

    
    
    .modal-content{
        margin: auto;
        width: 50vw;
    }

    

</style>
<br>
<div class="container">
    <br>
    <h3>Mais Informações</h3>
    <br>
    <div class="row">
        <div class="col-md-12 col-sm-12 mb-4">
            <div class="card info-card">
                <div class="card-body">
                    <h1 class="card-title"><i class="fa fa-car"></i> <?php echo $marca->getNome() . ' - ' . $modelo->getNome(); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($imagem as $index => $img) : ?>
                <?php
                $modalId = 'imagemModal' . $index;
                ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <a href="#" onclick="openImageModal('<?= $modalId ?>')">
                        <img src="<?= PATH_IMAGENS . 'uploads/' . $img->getNome() ?>" class="d-block w-100 img-fluid" alt="..." style="object-fit: cover; height: 400px;">
                    </a>
                </div>
                <div class="modal fade modal-container" id="<?= $modalId ?>" tabindex="-1" role="dialog" aria-labelledby="imagemModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close custom-close-button" onclick="closeModal('<?= $modalId ?>')" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="custom-close-icon">&times;</span>
                            </button>
                            <div class="modal-body">
                                <img src="<?= PATH_IMAGENS . 'uploads/' . $img->getNome() ?>" class="d-block w-100 img-fluid" alt="..." style="object-fit: cover; height: auto; max-height: 68vh;">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
    <?php foreach ($imagem as $index => $img) : ?>
        <div class="modal fade" id="imagemModal<?= $index ?>" tabindex="-1" role="dialog" aria-labelledby="imagemModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="<?= PATH_IMAGENS . 'uploads/' . $img->getNome() ?>" class="d-block w-100 img-fluid" alt="..." style="object-fit: cover; height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <br>
    <div class="row">
        <div class="col-md-3 col-sm-6 mb-4">
            <div class=" info-card">
                <h6 class="card-title">Ano de Fabricação:</h6>
                <h5 class="card-text"><?php echo $carro->getAno_fabricacao(); ?></h5>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Ano de Modelo:</h1>
                    <h5 class="card-text"><?php echo $carro->getAno_modelo(); ?></h5>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Cor:</h1>
                    <h5 class="card-text"><?php echo $carro->getCor(); ?></h5>
            </div>
        </div>
        <?php
        if ($carro->getQuilometragem() != 0) {
        ?>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="info-card">
                    
                        <h6 class="card-title">Quilometragem:</h1>
                        <h5 class="card-text"><?php echo $carro->getQuilometragem(); ?></h5>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="info-card">
                    
                        <h6 class="card-title">Placa:</h1>
                        <h5 class="card-text"><?php echo $carro->getPlaca(); ?></h5>
                </div>
            </div>

        <?php
        } else {
        ?>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="info-card">
                    
                        <h5 class="card-text">Carro Novo</h5>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Direcao:</h1>
                    <h5 class="card-text"><?php echo $carro->getModelo_direcao(); ?></h5>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Disponibilidade:</h1>
                    <h5 class="card-text"><?php echo $carro->getDisponibilidade(); ?></h5>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Observações:</h1>
                    <h5 class="card-text"><?php echo $carro->getObservacoes(); ?></h5>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Transmissão:</h1>
                    <h5 class="card-text"><?php echo $carro->getModelo_transmissao(); ?></h5>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Tipo de Freio:</h1>
                    <h5 class="card-text"><?php echo $carro->getTipo_freio(); ?></h5>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Motor:</h1>
                    <h5 class="card-text"><?php echo $carro->getMotor(); ?></h5>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Tipo de Combustivel:</h1>
                    <h5 class="card-text"><?php echo $carro->getTipo_combustivel(); ?></h5>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Tipo de Tração:</h1>
                    <h5 class="card-text"><?php echo $carro->getTipo_tracao(); ?></h5>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
            <div class="info-card">
                
                    <h6 class="card-title">Valor:</h1>
                    <h5 class="card-text"><?php echo "R$ " . number_format($carro->getPreco_venda(), 2, ',', '.'); ?></h5>
            </div>
        </div>
    </div>
    <a href="http://<?php echo APP_HOST; ?>/carro" class="btn btn-primary">Voltar</a>
</div>
<br>
<br>
<br>
<br>
<script>
    function openImageModal(modalId) {
        $('#' + modalId).modal('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        $('#' + modalId).modal('hide');
        document.body.style.overflow = 'auto'; 
    }
</script>