<div class="container">
  <br>
    <h1>Cadastro de Carro</h1>
  <br>

      <?php 
            if ($Sessao::retornaMensagem()) { ?>
            <br>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="alert alert-success col-md-10" role="alert">
                        <a href="#" class="btn-close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $Sessao::retornaMensagem(); ?> <br>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            <?php } ?>

        <?php 
            if($Sessao::retornaErro()){?>
            <br>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="btn-close" data-dimiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php }?>
                </div> 
        <?php } ?>

  <form action="http://<?php echo APP_HOST; ?>/carro/salvar" method="post" class="row g-3">

    <div class="col-md-1">
      <label for="inputCodigo" class="form-label">Código</label>
      <input type="text" class="form-control" id="inputCodigo" disabled>
    </div>
   
    <div class="col-md-6">
      <label for="inputNome" class="form-label">Nome</label>
      <input type="text" class="form-control" id="inputNome" name="Nome">
    </div>

    <div class="col-md-6">
      <label for="inputMarca" class="form-label">Marca</label>
      <input type="text" class="form-control" id="inputMarca" name="Marca">
    </div>

    <div class="col-md-11">
      <label for="inputAno" class="form-label">Ano</label>
      <input type="date" class="form-control" id="inputAno" name="ano">
    </div>

    <div class="col-md-6">
      <label for="inputCor" class="form-label">Cor</label>
      <input type="text" class="form-control" id="inputCor" name="cor">
    </div>

    <div class="col-4">
      <label for="selectCambio" class="form-label">Cambio</label>
        <select class="form-select" aria-label="Selecione o Cambio" id="selectCambio" name="cambio">
          <option selected>Selecione a Direção</option>
          <option value="manual">Direção manual</option>
          <option value="hidraulica">Direção automatico</option>
        </select>
    </div>

    <div class="col-4">
      <label for="selectDirecao" class="form-label">Direção</label>
        <select class="form-select" aria-label="Selecione a Direção" id="selectDirecao" name="direcao">
          <option selected>Selecione a Direção</option>
          <option value="manual">Direção manual</option>
          <option value="hidraulica">Direção hidráulica</option>
          <option value="eletrica">Direção elétrica</option>
          <option value="eletro-hidraulica">Direção eletro-hidráulica</option>
        </select>
    </div>

    <div class="col-md-2">
        <label for="inputPreco" class="form-label">Preço</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">R$</span>
          </div>
          <input type="text" class="form-control" name="preco">
        </div>
    </div>
    
    <div class="col-md-12 d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Cadastrar</button>&nbsp&nbsp
      <button type="button" class="btn btn-danger">Cancelar</button>
    </div>

  </form>

  <br>
</div> 
