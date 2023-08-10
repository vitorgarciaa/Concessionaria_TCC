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
  

    
    <div class="col-md-4">
      <label for="inputCor" class="form-label">Nome</label>
      <input type="text" class="form-control" id="inputCor" name="cor">
    </div>

    <div class="col-5">
      <label for="selectMarca" class="form-label">Marca</label>
        <select class="form-select" aria-label="Selecione a Marca" id="selectMarca" name="marca">
          <option selected>Selecione a Marca</option>
        </select>
    </div>
  
    
    <div class="col-md-12 d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Cadastrar</button>&nbsp&nbsp
      <button type="button" class="btn btn-danger">Cancelar</button>
    </div>

  </form>

  <br>
</div> 
