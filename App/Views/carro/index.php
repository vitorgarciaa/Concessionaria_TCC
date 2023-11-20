<?php

use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
use App\Models\DAO\ImagemDAO;
?>

<style>
    .border {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 100px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        padding-bottom: 100px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 18px rgba(0, 0, 0, 0.2);
    }

    .card img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .card-text {
        font-size: 14px;
    }

    .btn-custom {
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-custom-primary {
        background-color: #007BFF;
        color: white;
    }

    .btn-custom-primary:hover {
        background-color: #0056b3;
    }

    .btn-custom-success {
        background-color: #28a745;
        color: white;
    }

    .btn-custom-success:hover {
        background-color: #1f8c42;
    }

    .centro {
        justify-content: center;
        align-items: center;
        display: flex;
        padding: 20px;
    }

    .cutumBTN {
        margin: 10px 0;
        width: calc(100% - 10px);
        position: absolute;
        left: 5px;
        z-index: 1;
    }

    .cutumBTN2 {
        margin: 10px 0;
        width: calc(100% - 10px);
        position: absolute;
        left: 5px;
        bottom: 0px;
        z-index: 1;
    }

    .cardBonito::before,
    .cardBonito::after {
        content: "";
        position: absolute;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
        transition: all 0.3s;
    }


    .cardBonito::before {
        border-left: 2px solid black;
        border-right: 2px solid black;
        transform: scaleY(0);
    }

    .cardBonito::after {
        border-top: 2px solid black;
        border-bottom: 2px solid black;
        transform: scaleX(0);
    }

    .cardBonito:hover::before {
        transform: scaleY(1);
    }

    .cardBonito:hover::after {
        transform: scaleX(1);
    }

</style>

<div class="container">
    <div class="centro">
        <h3>Lista de Carros</h3>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 border">
        <?php if (empty($viewVar['carro'])) { ?>
            <div class="alert alert-info" role="alert">Nenhum carro encontrado!</div>
            <?php } else {
            foreach ($viewVar['carro'] as $carro) {
                $imagemDAO = new ImagemDAO();
                $imagem = $imagemDAO->listarPorCarro($carro->getId());
                $modeloDAO = new ModeloDAO();
                $modelo = $modeloDAO->listar($carro->getId_modelo());
                $marcaDAO = new MarcaDAO();
                $marca = $marcaDAO->listar($modelo->getId_marca());
            ?>
                <div class="col ">
                    <div class="card w-100 ">
                        <div class="cardBonito">
                            <img src="<?= PATH_IMAGENS . 'uploads/' . $imagem[0]->getNome() ?>" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $marca->getNome() . ' - ' . $modelo->getNome(); ?>
                                </h5>
                                <p class="card-text"><?= $carro->getObservacoes(); ?></p>
                                <p class="card-text"><?= "R$ " . number_format($carro->getPreco_venda(), 2, ',', '.'); ?></p>
                                <a href="http://<?= APP_HOST; ?>/carro/informacoes/<?= $carro->getId(); ?>" class="btn btn-custom btn-custom-primary cutumBTN">Mais informações</a>
                                <?php if (isset($_SESSION['login'])) { ?>
                                    <a href="http://<?= APP_HOST; ?>/venda/cadastro/<?= $carro->getId(); ?>" class="btn btn-custom btn-custom-success cutumBTN2">Vender</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>