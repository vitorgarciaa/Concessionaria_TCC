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
  $compras = $viewVar['compra'];
  $separaUrl = explode("=", $_SERVER["REQUEST_URI"]);
  
  if (count($separaUrl) > 1 ){
      $filtro = $separaUrl[1];
      $compras = $viewVar['compra'];
  
      if ($filtro == 'dataAsc') {
          $compras = $viewVar['dataAsc'];
      }else 
      if ($filtro == 'dataDesc') {
          $compras = $viewVar['dataDesc'];
      }
  }


  $carrosPorPagina = 10;
  $paginaAtual = isset($_GET['page']) ? intval($_GET['page']) : 1;
  $filtroPesquisa = isset($_GET['filtro']) ? $_GET['filtro'] : '';

?>
<style>
  .container2{
    margin-bottom: 100px;
  }
  .centralizar{
        justify-content: center;
        margin-bottom: 10px;
    }
</style>
<div class="container-fluid container2">
<br>
<h3>Lista de Compras</h3>
<br>
<button type="button" class="btn btn-warning" aria-haspopup="true" aria-expanded="false" onclick="gerarPDF()">GERAR PDF</button>
  <div class="row centralizar">
      <div class="col-md-6">
        <form class="form-inline" action="" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pesquisar por Fornecedor ou Marca/Modelo" name="filtro" value="<?php echo htmlentities($filtroPesquisa); ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
                </div>
            </div>
        </form>
        </div>
    </div>

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
      <div class="table-responsive" id="tableCompras">
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
          <?php 
                $separaUrl = explode("=", $_SERVER["REQUEST_URI"]);
                if (count($separaUrl) > 1 ){
                    $filtro = $separaUrl[1];
                    if ($filtro == 'dataAsc') {
                    ?> 
                    <th scope="col">Data Compra <a href="http://<?= APP_HOST; ?>/compra/pesquisar/ordenar=dataDesc" style="text-decoration: none; color:black">⇅</a></th>
                    <?php } else if ($filtro == 'dataDesc') {
                        ?>
                        <th scope="col">Data Compra <a href="http://<?= APP_HOST; ?>/compra/pesquisar/ordenar=dataAsc" style="text-decoration: none; color:black">⇅</a></th>
                        <?php 
                    }
                    }else{ ?>
                    <th scope="col">Data Compra <a href="http://<?= APP_HOST; ?>/compra/pesquisar/ordenar=dataAsc" style="text-decoration: none; color:black">⇅</a></th>
                <?php }
            ?>
          <th scope="col">Forma Pagamento</th>
          <th scope="col">P.Custo</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        
      <?php
          $carrosFiltrados = [];
          if (!count($compras)) { ?>
            <div class="alert alert-info" role="alert">Nenhuma compra encontrada!</div>
          <?php } else {
            foreach ($compras as $compra) {

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

              $filtro = strtolower($filtroPesquisa);
              $marcaModelo = strtolower($marca->getNome() . " " . $modelo->getNome());
              $fornecedorNome = strtolower($fornecedor->getNome());
              $fornecedorCPF = strtolower($fornecedor->getCpf());
              
              if (empty($filtroPesquisa) || strpos($marcaModelo, $filtro) !== false || strpos($fornecedorNome, $filtro) !== false || strpos($fornecedorCPF, $filtro) !== false) {
              $carrosFiltrados[] = $compra;
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
    }
    ?>
      </tbody>
    </table>
      </div>
<nav aria-label="Page navigation">
      <ul class="pagination centralizar">
        <?php
        $totalCarros = count($carrosFiltrados);
        $totalPaginas = ceil($totalCarros / $carrosPorPagina);

        for ($i = 1; $i <= $totalPaginas; $i++) {
          $activeClass = ($i === $paginaAtual) ? 'active' : '';
          echo "<li class='page-item $activeClass'><a class='page-link' href='?page=$i&filtro=$filtroPesquisa'>$i</a></li>";
        }
        ?>
      </ul>
    </nav>
</div>
<script>
      //http://www.macoratti.net/18/09/js_pdf1.htm
      function gerarPDF() {
      var table = document.getElementById('tableCompras').innerHTML;
      var style = "<style>";

      style = style + "table {width: 100%;font: 20px Calibri;}";
      style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
      style = style + "padding: 2px 3px;text-align: center;}";
      style = style + "</style>";
      // CRIA UM OBJETO (JANELA)
      var win = window.open('', '', 'height=700,width=700');
      win.document.write('<html><head>');
      win.document.write('<title> Listagem de Compras </title>'); // <title> CABEÇALHO DO PDF.
      win.document.write(style); // INCLUI UM ESTILO NA TAB HEAD
      win.document.write('</head>');
      win.document.write('<body>');
      win.document.write(table); // O CONTEUDO DA TABELA DENTRO DA TAG BODY
      win.document.write('</body></html>');
      win.document.close(); // FECHA A JANELA
      win.print(); // IMPRIME O CONTEUDO
    }
  </script>
<?php

} else { ?>
    <br>
    <div class="container">
        <h2> FAÇA LOGIN PARA CONTINUAR! </h2>
        <a href="http://<?php echo APP_HOST; ?>/login/index" class="btn btn-dark">FAZER LOGIN</a>
        <p>
            ou <a href="http://<?php echo APP_HOST; ?>/">Voltar para Página Inicial</a>
        </p>
    </div>
    <br>
<?php
}
?>
<br>