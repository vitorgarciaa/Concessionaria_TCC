<?php

use App\Models\DAO\ModeloDAO;
use App\Models\DAO\MarcaDAO;
use App\Models\DAO\CompraDAO;

$carrosPorPagina = 10;
$paginaAtual = isset($_GET['page']) ? intval($_GET['page']) : 1;
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

session_start();

if (isset($_SESSION['login'])) {
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
    <h3>Lista de Carros</h3>
    <br>

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

    <?php
    if ($Sessao::retornaMensagem()) { ?>
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="alert alert-success col-md-10" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php echo $Sessao::retornaMensagem(); ?> <br>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
    <?php } ?>

    <?php
    if ($Sessao::retornaErro()) { ?>
      <br>
      <div class="container">
        <div class="alert alert-warning" role="alert">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
            <?php echo $mensagem; ?> <br>
          <?php } ?>
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
          <th scope="col">Freio</th>
          <th scope="col">Motor</th>
          <th scope="col">Combustível</th>
          <th scope="col">Tração</th>
          <th scope="col">Observações</th>
          <th scope="col">Disponibilidade</th>
          <th scope="col">P.Venda</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Filtrar carros com base na pesquisa
        $carrosFiltrados = [];
        if (empty($pesquisa)) {
          $carrosFiltrados = $viewVar['carro'];
        } else {
          foreach ($viewVar['carro'] as $carro) {
            $modeloDAO = new ModeloDAO();
            $modelo = $modeloDAO->listar($carro->getId_modelo());
            $marcaDAO = new MarcaDAO();
            $marca = $marcaDAO->listar($modelo->getId_marca());
  
            if (stripos($marca->getNome(), $pesquisa) !== false || stripos($modelo->getNome(), $pesquisa) !== false  || stripos($carro->getPlaca(), $pesquisa) !== false ) {
              $carrosFiltrados[] = $carro;
            }
          }
        }

        if (empty($carrosFiltrados)) { ?>
          <tr>
            <td colspan="16">
              <div class="alert alert-info" role="alert">Nenhum carro encontrado!</div>
            </td>
          </tr>
          <?php } else {
          $indiceInicial = ($paginaAtual - 1) * $carrosPorPagina;
          $indiceFinal = $indiceInicial + $carrosPorPagina - 1;

          foreach ($carrosFiltrados as $index => $carro) {
            if ($index < $indiceInicial) {
              continue;
            }

            if ($index > $indiceFinal) {
              break;
            }

            $modeloDAO = new ModeloDAO();
            $modelo = $modeloDAO->listar($carro->getId_modelo());
            $marcaDAO = new MarcaDAO();
            $marca = $marcaDAO->listar($modelo->getId_marca());

            $compraDAO = new CompraDAO();
            $compra = $compraDAO->listarPorCarro($carro->getId());
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
              <td><?php echo "R$ " . number_format($carro->getPreco_venda(), 2, ',', '.'); ?></td>
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

    <nav aria-label="Page navigation">
      <ul class="pagination centralizar">
        <?php
        $totalCarros = count($carrosFiltrados);
        $totalPaginas = ceil($totalCarros / $carrosPorPagina);

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
    <h2>FAÇA LOGIN PARA CONTINUAR!</h2>
    <a href="http://<?php echo APP_HOST; ?>/login/index" class="btn btn-dark">FAZER LOGIN</a>
    <p>ou <a href="http://<?php echo APP_HOST; ?>/">Voltar para Página Inicial</a></p>
  </div>
  <br>
<?php
}
?>