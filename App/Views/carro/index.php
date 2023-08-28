<?php
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
?>

<div class="container">
<br>
<h3>Lista de Carros</h3>
<br>

    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if (!count($viewVar['carro'])) { ?>
                <div class="alert alert-info" role="alert">Nenhum carro encontrado!</div>
            <?php 
                }else{
              foreach($viewVar['carro'] as $carro){
            ?>
            
            <div class="col">
                <div class="card h-100">
                    <img src="data:image/png;base64,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" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php 
                            
                            $modeloDAO = new ModeloDAO();
                            $modelo = $modeloDAO->listar($carro->getId_modelo());

                            $marcaDAO = new MarcaDAO();
                            $marca = $marcaDAO->listar($modelo->getId_marca());


                            echo $marca->getNome() . ' - ' . $modelo->getNome(); 
                            ?>
                        </h5>
                        <p class="card-text"><?php echo $carro->getObservacoes(); ?></p>
                        <p class="card-text"><?php echo "R$ " . number_format($carro->getPreco(), 2, ',', '.'); ?></p>
                        <p class="btn btn-primary "><a href="http://<?php echo APP_HOST; ?>/carro/informacoes/<?php echo $carro->getId(); ?>" style="text-decoration: none; color: white;" class="card-link">Mais informações</a></p>
                    </div>
                </div>
            </div>


            <?php 
                }
              }
            ?>

    </div>

</div>
<br>