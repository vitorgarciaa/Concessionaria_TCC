<?php

use App\Models\DAO\CarroDAO;
use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
use App\Models\DAO\VendaDAO;
use App\Models\DAO\ClienteDAO;
use App\Models\DAO\VendedorDAO;
use App\Models\Entidades\Fornecedor;

session_start();

if (isset($_SESSION['login'])) {
?>

  <style>
    .container2 {
      margin-bottom: 100px;
    }

    .centralizar {
      justify-content: center;
      margin-bottom: 10px;
    }
  </style>

  <div class="container-fluid ">
    <br>
    <h3>Lista de Vendas</h3>
    <br>

    <?php
    if ($Sessao::retornaMensagem()) { ?>
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-6"></div>
          <div class="alert alert-success col-md-12" role="alert">
            <a href="" class="btn-close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $Sessao::retornaMensagem(); ?> <br>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
    <?php } ?>

    <?php
    if ($Sessao::retornaErro()) { ?>
      <br>
      <div class="container centralizar">
        <div class="alert alert-warning centralizar" role="alert">
          <a href="" class="btn-close" data-dimiss="alert" aria-label="close">&times;</a>
          <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
            <?php echo $mensagem; ?> <br>
          <?php } ?>
        </div>
      </div>
      <br>
    <?php } ?>

    <div class="row centralizar">
      <div class="col-md-6">
        <form class="form-inline" action="" method="GET">
          <div class="input-group">
            <input type="text" class="form-control" name="pesquisa" placeholder="Pesquisar">
            <div class="input-group-append">
              <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
            </div>
          </div>
        </form>
      </div>
    </div>


    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">CPF</th>
          <th scope="col">Nome Cliente</th>
          <th scope="col">E-mail</th>
          <th scope="col">Marca/Modelo</th>
          <th scope="col">Ano/Modelo</th>
          <th scope="col">Vendedor</th>
          <th scope="col">Data Venda</th>
          <th scope="col">Forma Pagamento</th>
          <th scope="col">Situacao Pedido</th>
          <th scope="col">P.Venda</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($viewVar['venda'])) { ?>
          <tr>
            <td colspan="12">
              <div class="alert alert-info" role="alert">Nenhuma venda encontrada!</div>
            </td>
          </tr>
          <?php } else {
          $carrosPorPagina = 10;
          $paginaAtual = isset($_GET['page']) ? intval($_GET['page']) : 1;
          $carrosFiltrados = $viewVar['venda'];

          // Filtro de pesquisa
          $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
          if (!empty($pesquisa)) {
            $carrosFiltrados = array_filter($carrosFiltrados, function ($venda) use ($pesquisa) {
              $carroDAO = new CarroDAO();
              $carro = $carroDAO->listar($venda->getId_carro());

              $modeloDAO = new ModeloDAO();
              $modelo = $modeloDAO->listar($carro->getId_modelo());
              $marcaDAO = new MarcaDAO();
              $marca = $marcaDAO->listar($modelo->getId_marca());

              $clienteDAO = new ClienteDAO();
              $cliente = $clienteDAO->listar($venda->getId_cliente());

              $vendedorDAO = new VendedorDAO();
              $vendedor = $vendedorDAO->listar($venda->getId_vendedor());

              return (stripos($cliente->getCpf(), $pesquisa) !== false ||
                stripos($cliente->getNome(), $pesquisa) !== false ||
                stripos($cliente->getEmail(), $pesquisa) !== false ||
                stripos($marca->getNome(), $pesquisa) !== false ||
                stripos($modelo->getNome(), $pesquisa) !== false ||
                stripos($carro->getAno_fabricacao(), $pesquisa) !== false ||
                stripos($carro->getAno_modelo(), $pesquisa) !== false ||
                stripos($vendedor->getNome(), $pesquisa) !== false ||
                stripos($venda->getData_venda(), $pesquisa) !== false ||
                stripos($venda->getTipo_pagamento(), $pesquisa) !== false ||
                stripos($venda->getSituacao_pedido(), $pesquisa) !== false ||
                stripos($venda->getPreco_venda(), $pesquisa) !== false
              );
            });
          }

          $totalVendas = count($carrosFiltrados);
          $totalPaginas = ceil($totalVendas / $carrosPorPagina);
          $indiceInicial = ($paginaAtual - 1) * $carrosPorPagina;
          $indiceFinal = $indiceInicial + $carrosPorPagina - 1;

          foreach ($carrosFiltrados as $index => $venda) {
            if ($index < $indiceInicial) {
              continue;
            }

            if ($index > $indiceFinal) {
              break;
            }

            $carroDAO = new CarroDAO();
            $carro = $carroDAO->listar($venda->getId_carro());

            $modeloDAO = new ModeloDAO();
            $modelo = $modeloDAO->listar($carro->getId_modelo());
            $marcaDAO = new MarcaDAO();
            $marca = $marcaDAO->listar($modelo->getId_marca());

            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->listar($venda->getId_cliente());

            $vendedorDAO = new VendedorDAO();
            $vendedor = $vendedorDAO->listar($venda->getId_vendedor());
          ?>
            <tr>
              <th scope="row"><?php echo $venda->getId(); ?></th>
              <td><?php echo $cliente->getCpf(); ?></td>
              <td><?php echo $cliente->getNome(); ?></td>
              <td><?php echo $cliente->getEmail(); ?></td>
              <td><?php echo $marca->getNome() . "/" . $modelo->getNome(); ?></td>
              <td><?php echo $carro->getAno_fabricacao() . "/" . $carro->getAno_modelo(); ?></td>
              <td><?php echo $vendedor->getNome(); ?></td>
              <td><?php echo date('d/m/Y', strtotime($venda->getData_venda())); ?></td>
              <td><?php echo $venda->getTipo_pagamento(); ?></td>
              <td><?php echo $venda->getSituacao_pedido(); ?></td>
              <td><?php echo "R$ " . number_format($venda->getPreco_venda(), 2, ',', '.'); ?></td>
              <td>
                <a href="http://<?php echo APP_HOST; ?>/venda/edicao/<?php echo $venda->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                <a href="http://<?php echo APP_HOST; ?>/venda/exclusao/<?php echo $venda->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
              </td>
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>

    <nav aria-label="Page navigation">
      <ul class="pagination centralizar">
        <?php
        for ($i = 1; $i <= $totalPaginas; $i++) {
          $activeClass = ($i === $paginaAtual) ? 'active' : '';
          echo "<li class='page-item $activeClass'><a class='page-link' href='?page=$i'>$i</a></li>";
        }
        ?>
      </ul>
    </nav>
  </div>

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