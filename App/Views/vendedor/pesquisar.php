<?php

use App\Models\DAO\VendedorDAO;

session_start();

if (isset($_SESSION['login'])) {


    $vendedores = $viewVar['vendedor'];
    $separaUrl = explode("=", $_SERVER["REQUEST_URI"]);
    
    if (count($separaUrl) > 1 ){
        $filtro = $separaUrl[1];
        $vendedores = $viewVar['vendedor'];
    
        if ($filtro == 'ativo') {
            $vendedores = $viewVar['ativo'];
        }else 
        if ($filtro == 'inativo') {
            $vendedores = $viewVar['inativo'];
        }
    }


    $vendedorDAO = new VendedorDAO();
    $vendedoresPorPagina = 10;
    $paginaAtual = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

    if (empty($pesquisa)) {
        $todosVendedores = $vendedores;
    } else {
        $todosVendedores = [];
        foreach ($vendedores as $vendedor) {
            // Verifica se a pesquisa está presente em cada propriedade individualmente
            if (stripos($vendedor->getNome(), $pesquisa) !== false ||
                stripos($vendedor->getEmail(), $pesquisa) !== false ||
                stripos($vendedor->getUsuario(), $pesquisa) !== false ||
                stripos($vendedor->getTelefone(), $pesquisa) !== false ||
                stripos($vendedor->getCEP(), $pesquisa) !== false ||
                stripos($vendedor->getUF(), $pesquisa) !== false ||
                stripos($vendedor->getCidade(), $pesquisa) !== false ||
                stripos($vendedor->getBairro(), $pesquisa) !== false ||
                stripos($vendedor->getLogradouro(), $pesquisa) !== false ||
                stripos($vendedor->getComplemento(), $pesquisa) !== false ||
                stripos($vendedor->getNumero(), $pesquisa) !== false ||
                stripos($vendedor->getStatus(), $pesquisa) !== false) {
                    $todosVendedores[] = $vendedor;
            }
        }
    }

    $totalVendedores = count($todosVendedores);
    $totalPaginas = ceil($totalVendedores / $vendedoresPorPagina);

    $indiceInicial = ($paginaAtual - 1) * $vendedoresPorPagina;
    $indiceFinal = min($indiceInicial + $vendedoresPorPagina, $totalVendedores);

    $vendedoresFiltrados = array_slice($todosVendedores, $indiceInicial, $vendedoresPorPagina);
?>
    <style>
        .pagination {
            justify-content: center;
        }

        .centralizar {
            justify-content: center;
            margin-bottom: 10px;
        }
        
    </style>
    <div class="container-fluid" style="margin-bottom: 60px;">
        <br>
        <h3>Lista de Vendedores</h3>
        <br>
        <button type="button" class="btn btn-warning" aria-haspopup="true" aria-expanded="false" onclick="gerarPDF()">GERAR PDF</button>
        <?php if ($Sessao::retornaMensagem()) { ?>
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

        <?php if ($Sessao::retornaErro()) { ?>
            <br>
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    <a href="" class="btn-close" data-dismiss="alert" aria-label="close">&times;</a>
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
        <div class="table-responsive" id="tableVendedores">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CEP</th>
                    <th scope="col">UF</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Logradouro</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">Numero</th>
                    <?php 
                        $separaUrl = explode("=", $_SERVER["REQUEST_URI"]);

                        if (count($separaUrl) > 1 ){
                            $filtro = $separaUrl[1];

                            if ($filtro == 'ativo') {
                            ?> 
                            <th scope="col">Status <a href="http://<?= APP_HOST; ?>/vendedor/pesquisar/ordenar=inativo" style="text-decoration: none; color:black">⇅</a></th>
                            <?php } else if ($filtro == 'inativo') {
                                ?>
                                <th scope="col">Status <a href="http://<?= APP_HOST; ?>/vendedor/pesquisar/ordenar=ativo" style="text-decoration: none; color:black">⇅</a></th>
                                <?php 
                            }
                            }else{ ?>
                            <th scope="col">Status <a href="http://<?= APP_HOST; ?>/vendedor/pesquisar/ordenar=ativo" style="text-decoration: none; color:black">⇅</a></th>
                        <?php }
                    ?>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($vendedoresFiltrados)) { ?>
                    <tr>
                        <td colspan="12">
                            <div class="alert alert-info" role="alert">Nenhum vendedor encontrado!</div>
                        </td>
                    </tr>
                    <?php } else {
                    foreach ($vendedoresFiltrados as $vendedor) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $vendedor->getId(); ?></th>
                            <td><?php echo $vendedor->getNome(); ?></td>
                            <td><?php echo $vendedor->getEmail(); ?></td>
                            <td><?php echo $vendedor->getUsuario(); ?></td>
                            <td><?php echo $vendedor->getTelefone(); ?></td>
                            <td><?php echo $vendedor->getCEP(); ?></td>
                            <td><?php echo $vendedor->getUF(); ?></td>
                            <td><?php echo $vendedor->getCidade(); ?></td>
                            <td><?php echo $vendedor->getBairro(); ?></td>
                            <td><?php echo $vendedor->getLogradouro(); ?></td>
                            <td><?php echo $vendedor->getComplemento(); ?></td>
                            <td><?php echo $vendedor->getNumero(); ?></td>
                            <td><?php echo $vendedor->getStatus(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/vendedor/edicao/<?php echo $vendedor->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <?php if($vendedor->getQtdVendasVendedor() != 0 ){ ?>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Não é possível excluir Vendedor que possui vendas vinculadas!">
                                    <a class="btn btn-danger btn-sm disabled">Excluir</a>
                                </span>
                                <?php }else{ ?>
                                    <a href="http://<?php echo APP_HOST; ?>/vendedor/exclusao/<?php echo $vendedor->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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
        <nav aria-label="Page navigation" class="mx-auto">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                    <li class="page-item <?php echo $i === $paginaAtual ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&pesquisa=<?php echo $pesquisa; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <script>
      //http://www.macoratti.net/18/09/js_pdf1.htm
      function gerarPDF() {
      var table = document.getElementById('tableVendedores').innerHTML;
      var style = "<style>";

      style = style + "table {width: 100%;font: 20px Calibri;}";
      style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
      style = style + "padding: 2px 3px;text-align: center;}";
      style = style + "</style>";
      // CRIA UM OBJETO (JANELA)
      var win = window.open('', '', 'height=700,width=700');
      win.document.write('<html><head>');
      win.document.write('<title> Listagem de Vendedores </title>'); // <title> CABEÇALHO DO PDF.
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
}
?>