<?php
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
?>

<div class="container-fluid">
<br>
<h3>Lista de Carros</h3>
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
                    <a href="" class="btn-close" data-dimiss="alert" aria-label="close">&times;</a>
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
      <th scope="col">Placa</th>
      <th scope="col">Marca/Modelo</th>
      <th scope="col">Ano/Modelo</th>
      <th scope="col">Cor</th>
      <th scope="col">Quilometragem</th>
      <th scope="col">Direção</th>
      <th scope="col">Câmbio</th>
      <th scope="col">Tipo de Freio</th>
      <th scope="col">Motor</th>
      <th scope="col">Tipo de Combustivel</th>
      <th scope="col">Tipo de Tração</th>
      <th scope="col">Observações</th>
      <th scope="col">Disponibilidade</th>
      <th scope="col">Valor</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php if (!count($viewVar['carro'])) { ?>
                <div class="alert alert-info" role="alert">Nenhum carro encontrado!</div>
            <?php 
                }else{
              foreach($viewVar['carro'] as $carro){

                $modeloDAO = new ModeloDAO();
                $modelo = $modeloDAO->listar($carro->getId_modelo());
                $marcaDAO = new MarcaDAO();
                $marca = $marcaDAO->listar($modelo->getId_marca());
                            
            ?>
    <tr>
      <th scope="row"><?php echo $carro->getId(); ?></th>
      <td><?php echo $carro->getPlaca(); ?></td>
      <td><?php echo $marca->getNome() . "/" . $modelo->getNome(); ?></td>
      <td><?php echo $carro->getAno_fabricacao() . "/" . $carro->getAno_modelo(); ?></td>
      <td><?php echo $carro->getCor(); ?></td>
      <td><?php echo $carro->getQuilometragem(); ?></td>
      <td><?php echo $carro->getModelo_direcao(); ?></td>
      <td><?php echo $carro->getModelo_transmissao(); ?></td>
      <td><?php echo $carro->getTipo_freio(); ?></td>
      <td><?php echo $carro->getMotor(); ?></td>
      <td><?php echo $carro->getTipo_combustivel(); ?></td>
      <td><?php echo $carro->getTipo_tracao(); ?></td>
      <td><?php echo $carro->getObservacoes(); ?></td>
      <td><?php echo $carro->getDisponibilidade(); ?></td>
      <td><?php echo "R$ " . number_format($carro->getPreco(), 2, ',', '.'); ?></td>
      <td>
        <a href="http://<?php echo APP_HOST; ?>/carro/edicao/<?php echo $carro->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
        <a href="http://<?php echo APP_HOST; ?>/carro/exclusao/<?php echo $carro->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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