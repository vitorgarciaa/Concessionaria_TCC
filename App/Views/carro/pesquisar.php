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
    .container2 {
      margin-bottom: 100px;
    }

    .centralizar {
      justify-content: center;
      margin-bottom: 10px;
    }
  </style>

  <div class="container-fluid container2">
    <br>
    <h3>Lista de Carros</h3>
    <br>
    <button type="button" class="btn btn-warning" aria-haspopup="true" aria-expanded="false" onclick="gerarPDF()">GERAR PDF</button>
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
    <div class="table-responsive" id="tableCarros">
      <table id='teiblo' class="table table-hover table-bordered">
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
          $carrosFiltrados = [];
          if (empty($pesquisa)) {
            $carrosFiltrados = $viewVar['carro'];
          } else {
            foreach ($viewVar['carro'] as $carro) {
              $modeloDAO = new ModeloDAO();
              $modelo = $modeloDAO->listar($carro->getId_modelo());
              $marcaDAO = new MarcaDAO();
              $marca = $marcaDAO->listar($modelo->getId_marca());

              $searchFound = false;

              $columnsToSearch = [
                $marca->getNome(),
                $modelo->getNome(),
                $carro->getPlaca(),
                $carro->getAno_fabricacao(),
                $carro->getAno_modelo(),
                $carro->getCor(),
                $carro->getQuilometragem(),
                $carro->getModelo_direcao(),
                $carro->getModelo_transmissao(),
                $carro->getTipo_freio(),
                $carro->getMotor(),
                $carro->getTipo_combustivel(),
                $carro->getTipo_tracao(),
                $carro->getObservacoes(),
                $carro->getDisponibilidade(),
                $carro->getPreco_venda()
              ];

              foreach ($columnsToSearch as $column) {
                if (stripos($column, $pesquisa) !== false) {
                  $searchFound = true;
                  break;
                }
              }

              if ($searchFound) {
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
                  <?php if ($carro->getQtdCarroCompra() != 0) { ?>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Não é possível excluir Carro que possui Compra vinculada!">
                      <a class="btn btn-danger btn-sm disabled">Excluir</a>
                    </span>
                  <?php } else { ?>
                    <a href="http://<?php echo APP_HOST; ?>/carro/exclusao/<?php echo $carro->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

  <script>
    function exportToXLS() {
      var htmlTable = document.getElementById('teiblo');
      var workbook = XLSX.utils.table_to_book(htmlTable);


      /* Converter o livro para Blob */
      var blob = XLSX.write(workbook, {
        bookType: 'xls',
        mimeType: 'application/vnd.ms-excel'
      });

      /* Converter a string para Blob */
      var blobData = new Blob([blob], {
        type: 'application/vnd.ms-excel'
      });

      /* Criar um URL para o Blob e criar um link temporário para download */
      var blobURL = URL.createObjectURL(blobData);
      var a = document.createElement('a');
      a.href = blobURL;
      a.download = 'carros.xls';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    }




    //http://www.macoratti.net/18/09/js_pdf1.htm
    function gerarPDF() {
      var table = document.getElementById('tableCarros').innerHTML;
      var style = "<style>";

      style = style + "table {width: 100%;font: 20px Calibri;}";
      style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
      style = style + "padding: 2px 3px;text-align: center;}";
      style = style + "</style>";
      // CRIA UM OBJETO (JANELA)
      var win = window.open('', '', 'height=700,width=700');
      win.document.write('<html><head>');
      win.document.write('<title> Listagem de carros </title>'); // <title> CABEÇALHO DO PDF.
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
    <h2>FAÇA LOGIN PARA CONTINUAR!</h2>
    <a href="http://<?php echo APP_HOST; ?>/login/index" class="btn btn-dark">FAZER LOGIN</a>
    <p>ou <a href="http://<?php echo APP_HOST; ?>/">Voltar para Página Inicial</a></p>
  </div>
  <br>
<?php
}
?>