<?php

use App\Models\DAO\ImagemDAO;
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;

?>

<style>
    .container {
        font-family: Arial, sans-serif;
    }

    #carCarousel {
        background: #333;
        border: 1px solid #ccc;
        width: calc(100vw - 250px);

    }



    .carousel-inner {
        border: 1px solid #ccc;
        border-radius: 5px;
        min-height: 300px;
        background: #444;
    }

    .carousel-control-prev,
    .carousel-control-next {
        opacity: 0.7;
        background-color: #007bff;
        width: 60px;
        background: #333;
        transition: all 0.3s ease-in-out;
    }

    .control-prev-icon,
    .control-next-icon {
        background-color: #fff;
        border-radius: 50%;
        padding: 10px;
    }

    .control-prev-icon i,
    .control-next-icon i {
        color: black;
    }

    .carousel-control-prev {
        left: -60px;
    }

    .carousel-control-next {
        right: -60px;
    }

    .card {
        border: none;
        text-align: center;
        background: #333;
        color: #ccc;
        height: 400px;
        transition: all 0.3s ease-in-out;
        transform: scale(0.8)
    }

    .card:hover {
        transform: scale(1)
    }

    .card-title {
        font-size: 16px;
    }

    .card-text {
        font-size: 14px;
    }

    .card-link {
        text-decoration: none;
        color: #007bff;
        transition: all 0.3s ease-in-out;
    }

    .card img {
        max-width: 100%;
        height: auto;
        object-fit: cover;
        min-height: 200px;
        height: 40vh;
    }

    .carousel {
        transition: transform 0.5s ease;
    }

    .carousel-item {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        transform: translateX(100%);
        transition: transform 0.5s ease;
    }

    .carousel-item.active {
        transform: translateX(0);
    }

    .margem {
        margin: 100px;
    }

    .card-body {
        height: 100%;
    }
</style>

<div class=" container margem">
    <h4>Concessionária VG</h4>

    <?php if (!count($viewVar['carro'])) { ?>
        <div class="alert alert-info" role="alert">Nenhum carro encontrado!</div>
    <?php } else { ?>
        <div id="carCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $carros = $viewVar['carro'];
                $chunks = array_chunk($carros, 4);
                foreach ($chunks as $index => $chunk) {
                    $active = $index === 0 ? 'active' : '';
                ?>
                    <div class="carousel-item <?php echo $active; ?>">
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            <?php
                            foreach ($chunk as $carro) {
                                $modeloDAO = new ModeloDAO();
                                $modelo = $modeloDAO->listar($carro->getId_modelo());

                                $marcaDAO = new MarcaDAO();
                                $marca = $marcaDAO->listar($modelo->getId_marca());

                                $imagemDAO = new ImagemDAO();
                                $imagens = $imagemDAO->listarPorCarro($carro->getId());

                                $imagem = $imagens[0];
                                $imagemPath = PATH_IMAGENS . 'uploads/' . $imagem->getNome();
                            ?>
                                <div class="col">
                                    <div class="card">
                                        <img src="<?php echo $imagemPath; ?>" alt="Car Image" class="img-fluid">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo $marca->getNome() . ' - ' . $modelo->getNome(); ?>
                                            </h5>
                                            <p class="card-text"><?php echo "R$ " . number_format($carro->getPreco_venda(), 2, ',', '.'); ?></p>
                                            <a href="http://<?php echo APP_HOST; ?>/carro/informacoes/<?php echo $carro->getId(); ?>" class="card-link">Mais informações</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carCarousel" role="button" data-bs-slide="prev">
                <span class="control-prev-icon" aria-hidden="true">
                    <i class="bi bi-arrow-left"></i>
                </span>
            </a>
            <a class="carousel-control-next" href="#carCarousel" role="button" data-bs-slide="next">
                <span class="control-next-icon" aria-hidden="true">
                    <i class="bi bi-arrow-right"></i>
                </span>
            </a>
        </div>

    <?php } ?>
</div>
<br>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>