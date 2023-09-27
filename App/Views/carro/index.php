<?php
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
use App\Models\DAO\ImagemDAO;
?>

<div class="container" style="margin-bottom: 60px;">
<br>
<h3>Lista de Carros</h3>
<br>

    <div class="row row-cols-1 row-cols-md-3 g-4" >
    <?php if (!count($viewVar['carro'])) { ?>
                <div class="alert alert-info" role="alert">Nenhum carro encontrado!</div>
            <?php 
                }else{
              foreach($viewVar['carro'] as $carro){

                $imagemDAO = new ImagemDAO();
                $imagem = $imagemDAO->listarPorCarro($carro->getId());

            ?>
            
            <div class="col">
                <div class="card h-100">
                <img src="<?php echo PATH_IMAGENS . 'uploads/' . $imagem[0]->getNome()?>" alt="...">
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
                        <p class="card-text"><?php echo "R$ " . number_format($carro->getPreco_venda(), 2, ',', '.'); ?></p>
                        <p class="btn btn-primary "><a href="http://<?php echo APP_HOST; ?>/carro/informacoes/<?php echo $carro->getId(); ?>" style="text-decoration: none; color: white;" class="card-link">Mais informações</a></p> &emsp;
                        
                        <?php
                        if (isset($_SESSION['login'])) {
                        ?>
                        <p class="btn btn-success "><a href="http://<?php echo APP_HOST; ?>/carro/informacoes/<?php echo $carro->getId(); ?>" style="text-decoration: none; color: white;" class="card-link">Vender</a></p>

                        <?php
                        }
                        ?>
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
