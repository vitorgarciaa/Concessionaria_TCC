<?php

use App\Models\DAO\CarroDAO;
use App\Models\DAO\ClienteDAO;
use App\Models\DAO\ImagemDAO;
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
use App\Models\DAO\VendaDAO;

$venda = $viewVar['venda'];


$vendaDAO = new VendaDAO();
$venda = $vendaDAO->listar($venda->getId());

$carroDAO = new CarroDAO();
$carro = $carroDAO->listar($venda->getId_carro());

$modeloDAO = new ModeloDAO();
$modelo = $modeloDAO->listar($carro->getId_modelo());

$marcaDAO = new MarcaDAO();
$marca = $marcaDAO->listar($modelo->getId_marca());

$clienteDAO = new ClienteDAO();
$cliente = $clienteDAO->listar($venda->getId_cliente());

?>
<script>
      
      $(document).ready(function(){
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        $('.inputData_compra').mask('##/##/####');
      });
      



</script>
<div class="container">
  <br>
    <h1>Editor de Vendas</h1>
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

  <form action="http://<?php echo APP_HOST; ?>/venda/atualizarSituacao" method="post" class="row g-3">

    <br>
    <h5 class="text-center">Dados Cliente</h5>
    <br>

    <div class="row">
      <div class="col-md-8">
        <label for="input_cliente">Digite para buscar um cliente:</label>
        <input name="input_cliente" class="form-control" id="input_cliente" value="<?php echo 'CPF: ' . $cliente->getCpf() .  ' | ' . $cliente->getNome();?>" disabled>
      </div>
    </div>
    <input type="hidden" name="id_cliente" id="id_cliente">
    <input type="hidden" name="id_venda" value="<?php echo $venda->getId();?>">

      
    
    <br>
    <h5 class="text-center">Dados Carro</h5>
    <br>


    


    <div class="row">


    <div class="row">
      <div class="col-md-8">
        <label for="input_carro">Dados do Carro :</label>
            <input type="text" class="form-control" value="<?php  echo $marca->getNome() . ' - ' . $modelo->getNome() . ' | ' . $carro->getCor() . ' | ' . $carro->getAno_fabricacao() . '/' . $carro->getAno_modelo(); ?>" disabled>
        </div>
        
      </div>
    </div>
    <input type="hidden" name="id_carro" value="<?php echo $carro->getId(); ?>">
      

    <div class="col-md-2">
        <label for="inputTipo_pagamento" class="form-label">Tipo de Pagamento</label>
          <select class="form-control" id="inputTipo_pagamento" name="tipo_pagamento">
              <option <?php echo ($venda->getTipo_pagamento() == "Dinheiro" ) ? "selected" : null ; ?> value="Dinheiro">Dinheiro</option>
              <option <?php echo ($venda->getTipo_pagamento() == "Cartão" ) ? "selected" : null ; ?> value="Cartão">Cartão</option>
              <option <?php echo ($venda->getTipo_pagamento() == "Cheque" ) ? "selected" : null ; ?> value="Cheque">Cheque</option>
              <option <?php echo ($venda->getTipo_pagamento() == "Vale" ) ? "selected" : null ; ?> value="Vale">Vale</option>
          </select>
      </div>

      <div class="col-md-2">
        <label for="inputSituacao_pedido" class="form-label">Situação Pedido</label>
          <select class="form-control" id="inputSituacao_pedido" name="situacao_pedido">
              <option <?php echo ($venda->getSituacao_pedido() == "Orçado" ) ? "selected" : null ; ?> value="Orçado">Orçado</option>
              <option <?php echo ($venda->getSituacao_pedido() == "Fechado" ) ? "selected" : null ; ?> value="Fechado">Fechado</option>
              <option <?php echo ($venda->getSituacao_pedido() == "Cancelado" ) ? "selected" : null ; ?> value="Cancelado">Cancelado</option>
          </select>
      </div>

      <div class="col-md-2">
          <label for="inputPreco_venda" class="form-label">Preço Venda</label>
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text">R$</span>
              </div>
              <input type="text" class="form-control money" id="inputPreco_venda" name="preco_venda" value="<?php echo number_format($carro->getPreco_venda(), 2, ',', '.'); ?>">
          </div>
      </div>

      <div class="col-md-12 d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Salvar</button>&nbsp&nbsp
      <a href="http://<?php echo APP_HOST; ?>/venda/pesquisar" class="btn btn-danger btn-sm">Cancelar</a>
    </div>

</div>

<br>
<br>