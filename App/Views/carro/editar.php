<?php 
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;

$carro = $viewVar['carro'];

$modeloDAO = new ModeloDAO();
$modelo = $modeloDAO->listar($carro->getId_modelo());

$marcaDAO = new MarcaDAO();
$marca = $marcaDAO->listar($modelo->getId_marca());

session_start();

if (isset($_SESSION['login'])) {
?>
<script>
      
      $(document).ready(function(){
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
      });

      $(document).ready(function(){
        $("#ano_fabricacao").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years"
        });
      });

      $(document).ready(function(){
        $("#ano_modelo").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years"
        });
      });
</script>

<div class="container">
  <br>
    <h1>Editar Carro</h1>
  <br>
      <?php 
            if ($Sessao::retornaMensagem()) { ?>
            <br>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="alert alert-success col-md-12" role="alert">
                        <a href="" class="btn-close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $Sessao::retornaMensagem(); ?> <br>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            <?php } ?>

        <?php 
            if($Sessao::retornaErro()){?>
            <br>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="btn-close" data-dimiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php }?>
                </div> 
        <?php } ?>

  <form action="http://<?php echo APP_HOST; ?>/carro/atualizar" method="post" class="row g-3">
    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $carro->getId(); ?>">

    <div class="row">
      <div class="col-md-1">
        <label for="id" class="form-label">Código</label>
        <input type="text" class="form-control" value="<?php echo $carro->getId(); ?>" disabled>
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $carro->getId(); ?>">
      </div>

      <div class="col-md-3">
        <label for="inputMarca" class="form-label">Marca</label>
        <input type="text" class="form-control" id="inputMarca" value="<?php echo $marca->getNome(); ?>" disabled>
      </div>

      <div class="col-md-3">
        <label for="inputModelo" class="form-label">Modelo</label>
        <input type="text" class="form-control" id="inputModelo" value="<?php echo $modelo->getNome(); ?>" disabled>
        <input type="text" class="form-control" name="modeloId" value="<?php echo $modelo->getId(); ?>" hidden>
      </div>
    </div>

    <div class="row">
        <div class="col-md-2">
          <label for="selectTransmissaos" class="form-label">Transmissão</label>
            <select class="form-select" aria-label="Selecione o Cambio" id="selectTransmissao" name="transmissao">
              <option <?php echo ($carro->getModelo_transmissao() == "Transmissão Manual" ) ? "selected" : null ; ?> value="Transmissão Manual">Transmissão Manual</option>
              <option <?php echo ($carro->getModelo_transmissao() == "Transmissão Automático" ) ? "selected" : null ; ?> value="Transmissão Automático">Transmissão Automático</option>
            </select>
        </div>

        <div class="col-md-2">
          <label for="selectDirecao" class="form-label">Direção</label>
            <select class="form-select" aria-label="Selecione a Direção" id="selectDirecao" name="direcao">
              <option <?php echo ($carro->getModelo_direcao() == "Manual" ) ? "selected" : null ; ?> value="Manual">Direção Manual</option>
              <option <?php echo ($carro->getModelo_direcao() == "Hidráulica" ) ? "selected" : null ; ?> value="Hidráulica">Direção Hidráulica</option>
              <option <?php echo ($carro->getModelo_direcao() == "Elétrica" ) ? "selected" : null ; ?> value="Elétrica">Direção Elétrica</option>
              <option <?php echo ($carro->getModelo_direcao() == "Eletro-hidráulica" ) ? "selected" : null ; ?> value="Eletro-hidráulica">Direção Eletro-hidráulica</option>
            </select>
        </div>
        
        <div class="col-md-2">
          <label for="selectTracao" class="form-label">Tração</label>
            <select class="form-select" aria-label="Selecione a Tração" id="selectTracao" name="tracao">
              <option <?php echo ($carro->getTipo_tracao() == "Traseira" ) ? "selected" : null ; ?> value="Traseira">Traseira</option>
              <option <?php echo ($carro->getTipo_tracao() == "Dianteira" ) ? "selected" : null ; ?> value="Dianteira">Dianteira</option>
              <option <?php echo ($carro->getTipo_tracao() == "4x4" ) ? "selected" : null ; ?> value="4x4">4x4</option>
            </select>
        </div>

        <div class="col-md-2">
          <label for="selectFreio" class="form-label">Freio</label>
            <select class="form-select" aria-label="Selecione o Tipo do Freio" id="selectFreio" name="freio">
              <option <?php echo ($carro->getTipo_tracao() == "ABS" ) ? "selected" : null ; ?> value="ABS">Freio ABS</option>
              <option <?php echo ($carro->getTipo_tracao() == "a Disco" ) ? "selected" : null ; ?> value="a Disco">Freio a Disco</option>
            </select>
        </div>
      
        <div class="col-md-2">
          <label for="selectCombustivel" class="form-label">Combustivel</label>
            <select class="form-select" aria-label="Tipo do Combustivel" id="selectCombustivel" name="combustivel">
              <option <?php echo ($carro->getTipo_freio() == "Álcool" ) ? "selected" : null ; ?> value="Álcool">Álcool</option>
              <option <?php echo ($carro->getTipo_freio() == "Disel" ) ? "selected" : null ; ?> value="Disel">Diesel</option>
              <option <?php echo ($carro->getTipo_freio() == "Flex" ) ? "selected" : null ; ?> value="Flex">Flex</option>
              <option <?php echo ($carro->getTipo_freio() == "Gasolina" ) ? "selected" : null ; ?> value="Gasolina">Gasolina</option>
            </select>
        </div>

        <div class="col-md-2">
          <label for="selectDisponibilidade" class="form-label">Disponibilidade</label>
            <select class="form-select" aria-label="Disponibildiade" id="selectDisponibilidade" name="disponibilidade">
              <option <?php echo ($carro->getDisponibilidade() == "Disponível" ) ? "selected" : null ; ?> value="Disponível">Disponivel</option>
              <option <?php echo ($carro->getDisponibilidade() == "Reservado" ) ? "selected" : null ; ?> value="Reservado">Reservado</option>
              <option <?php echo ($carro->getDisponibilidade() == "Indisponível" ) ? "selected" : null ; ?> value="Indisponível">Indisponível</option>
            </select>
        </div>
      </div>

    <div class="row">
      <div class="col-md-2">
        <label for="inputAno_modelo" class="form-label">Ano Fabricação</label>
        <input type="text" class="form-control" id="ano_fabricacao" name="ano_fabricacao" value="<?php echo $carro->getAno_fabricacao(); ?>">
      </div>

      <div class="col-md-2">
        <label for="inputAno_modelo" class="form-label">Ano Modelo</label>
        <input type="text" class="form-control" id="ano_modelo" name="ano_modelo" value="<?php echo $carro->getAno_modelo(); ?>">
      </div>

      <div class="col-md-2">
        <label for="inputCor" class="form-label">Cor</label>
        <input type="text" class="form-control" id="inputCor" name="cor" value="<?php echo $carro->getCor(); ?>">
      </div>

      <div class="col-md-2">
        <label for="inputMotor" class="form-label">Motor</label>
        <input type="text" class="form-control" id="inputMotor" name="motor" value="<?php echo $carro->getMotor(); ?>">
      </div>

      <div class="col-md-2">
          <label for="inputPreco" class="form-label">Preço</label>
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text">R$</span>
              </div>
              <input type="text" class="form-control money" id="inputPreco_venda" name="preco_venda" value="<?php echo number_format($carro->getPreco_venda(), 2, ',', '.'); ?>">
          </div>
      </div>

      <?php

      if ($carro->getQuilometragem() != 0) {
      ?>
      <div class="col-md-2">
        <label for="inputQuilometragem" class="form-label">Quilometragem</label>
        
        <input type="text" class="form-control" id="inputQuilometragem" name="quilometragem"  value="<?php echo $carro->getQuilometragem(); ?>">
    </div>
    <div class="col-md-2">
        <label for="inputPlaca" class="form-label">Placa</label>
        
        <input type="text" class="form-control" id="inputPlaca" name="placa" value="<?php echo $carro->getPlaca(); ?>">
    </div>


<?php    }
            ?>  

      <div class="col-md-6">
        <label for="inputObservacao" class="form-label">Observaoces</label>
        <textarea type="textarea" class="form-control" id="inputObservacao" name="observacao"><?php echo $carro->getObservacoes(); ?></textarea>
      </div>
    </div>

    <div class="col-md-12 d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Atualizar</button>&nbsp&nbsp
      <a href="http://<?php echo APP_HOST; ?>/carro/pesquisar" class="btn btn-danger btn-sm">Cancelar</a>
   </div>

      </form>
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