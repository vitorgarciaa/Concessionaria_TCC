<?php

use App\Models\DAO\ImagemDAO;
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
?>

<div class="container">
    <br>
    <h4>Concessionária VG</h4>
    <br>
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
                                $imagem = $imagemDAO->listarPorCarro($carro->getId());

                                ?>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="<?php echo PATH_IMAGENS . 'uploads/' . $imagem[0]->getNome()?>" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo $marca->getNome() . ' - ' . $modelo->getNome(); ?>
                                            </h5>
                                            <p class="card-text"><?php echo "R$ " . number_format($carro->getPreco_venda(), 2, ',', '.'); ?></p>
                                            <p class="btn btn-primary"><a href="http://<?php echo APP_HOST; ?>/carro/informacoes/<?php echo $carro->getId(); ?>" style="text-decoration: none; color: white;" class="card-link">Mais informações</a></p>
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
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually"><</span>
            </a>
            <a class="carousel-control-next" href="#carCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually">></span>
            </a>
        </div>
    <?php } ?>
</div>
<br>

<style>
.carousel-control-prev,
.carousel-control-next {
    opacity: 0.5;

}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    position: relative;
    background-color: black;
}

.carousel-control-prev {
    left: -190px;
}

#carCarousel{
    height: 500px;
}

.carousel-control-next {
    right: -190px;
}
</style>