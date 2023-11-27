<?php

use App\Models\DAO\CarroDAO;
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
use App\Models\DAO\CompraDAO;
use App\Models\DAO\FornecedorDAO;
use App\Models\DAO\VendedorDAO;
use App\Models\Entidades\Fornecedor;

session_start();

if (isset($_SESSION['login'])) {
?>

<div class="container-fluid">
<br>
<h3>Lista de Compras</h3>
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
      <th scope="col">CPF</th>
      <th scope="col">CNPJ Empresa</th>
      <th scope="col">Nome Fornecedor / Cliente</th>
      <th scope="col">Nome Fantasia</th>
      <th scope="col">E-mail</th>
      <th scope="col">Marca/Modelo</th>
      <th scope="col">Ano/Modelo</th>
      <th scope="col">Comprador</th>
      <th scope="col">Data Compra</th>
      <th scope="col">Forma Pagamento</th>
      <th scope="col">P.Custo</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php if (!count($viewVar['compra'])) { ?>
                <div class="alert alert-info" role="alert">Nenhuma compra encontrado!</div>
            <?php 
                }else{
              foreach($viewVar['compra'] as $compra){

                $carroDAO = new CarroDAO();
                $carro = $carroDAO->listar($compra->getId_carro());
        
                $modeloDAO = new ModeloDAO();
                $modelo = $modeloDAO->listar($carro->getId_modelo());
                $marcaDAO = new MarcaDAO();
                $marca = $marcaDAO->listar($modelo->getId_marca());

                $fornecedorDAO = new FornecedorDAO();
                $fornecedor = $fornecedorDAO->listar($compra->getId_fornecedor());
                
                $vendedorDAO = new VendedorDAO();
                $vendedor = $vendedorDAO->listar($compra->getId_vendedor());          
            ?>
    <tr>
      <th scope="row"><?php echo $compra->getId(); ?></th>
      <td><?php echo $fornecedor->getCpf(); ?></td>
      <td><?php echo $fornecedor->getCnpj(); ?></td>
      <td><?php echo $fornecedor->getNome(); ?></td>
      <td><?php echo $fornecedor->getNome_fantasia(); ?></td>
      <td><?php echo $fornecedor->getEmail(); ?></td>
      <td><?php echo $marca->getNome() . "/" . $modelo->getNome(); ?></td>
      <td><?php echo $carro->getAno_fabricacao() . "/" . $carro->getAno_modelo(); ?></td>
      <td><?php echo $vendedor->getNome(); ?></td>
      <td><?php echo date('d/m/Y', strtotime($compra->getData_compra())) ; ?></td>
      <td><?php echo $compra->getTipo_pagamento(); ?></td>
      <td><?php echo "R$ " . number_format($compra->getPreco_custo(), 2, ',', '.'); ?></td>

      <td>    
      <?php if(!is_null($compra->getIdVenda())){ ?>
          <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Não é possível excluir Compra que possui Venda vinculada!">
              <a class="btn btn-danger btn-sm disabled">Excluir</a>
          </span>
          <?php }else{ ?>
            <a href="http://<?php echo APP_HOST; ?>/compra/exclusao/<?php echo $compra->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
          <?php } ?>
       </td>
    </tr>
    <?php 
    }
  }
?>
  </tbody>
</table>


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
<br>