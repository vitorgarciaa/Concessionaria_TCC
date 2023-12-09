<?php

use App\Models\DAO\FornecedorDAO;
use App\Models\Entidades\Fornecedor;

session_start();

if (isset($_SESSION['login'])) {

    $separaUrl = explode("=", $_SERVER["REQUEST_URI"]);
    $fornecedores = $viewVar['fornecedor'];
if (count($separaUrl) > 1 ){
    $filtro = $separaUrl[1];
    $fornecedores = $viewVar['fornecedor'];

    if ($filtro == 'ativo') {
        $fornecedores = $viewVar['ativo'];
    }else 
    if ($filtro == 'inativo') {
        $fornecedores = $viewVar['inativo'];
    }
}

    $fornecedorDAO = new FornecedorDAO();
    $clientesPorPagina = 10;
    $paginaAtual = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

    if (empty($pesquisa)) {
        $todosFornecedores = $fornecedores;
    } else {
        $todosFornecedores = [];
        foreach ($fornecedores as $fornecedor) {
            if (
                stripos($fornecedor->getId(), $pesquisa) !== false ||
                stripos($fornecedor->getNome(), $pesquisa) !== false ||
                stripos($fornecedor->getCpf(), $pesquisa) !== false ||
                stripos($fornecedor->getEmail(), $pesquisa) !== false ||
                stripos($fornecedor->getNome_fantasia(), $pesquisa) !== false ||
                stripos($fornecedor->getCnpj(), $pesquisa) !== false ||
                stripos($fornecedor->getEmail_empresa(), $pesquisa) !== false ||
                stripos($fornecedor->getTelefone(), $pesquisa) !== false ||
                stripos($fornecedor->getCEP(), $pesquisa) !== false ||
                stripos($fornecedor->getUF(), $pesquisa) !== false ||
                stripos($fornecedor->getCidade(), $pesquisa) !== false ||
                stripos($fornecedor->getBairro(), $pesquisa) !== false ||
                stripos($fornecedor->getLogradouro(), $pesquisa) !== false ||
                stripos($fornecedor->getComplemento(), $pesquisa) !== false ||
                stripos($fornecedor->getNumero(), $pesquisa) !== false ||
                stripos($fornecedor->getStatus(), $pesquisa) !== false
            ) {
                $todosFornecedores[] = $fornecedor;
            }
        }
    }

    $totalFornecedores = count($todosFornecedores);
    $totalPaginas = ceil($totalFornecedores / $clientesPorPagina);
    $indiceInicial = ($paginaAtual - 1) * $clientesPorPagina;
    $indiceFinal = min($indiceInicial + $clientesPorPagina, $totalFornecedores);
    $fornecedoresFiltrados = array_slice($todosFornecedores, $indiceInicial, $clientesPorPagina);
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

    <div class="container-fluid" style="margin-bottom: 60px;">
        <br>
        <h3>Lista de Fornecedores</h3>
        <br>
        <button type="button" class="btn btn-warning" aria-haspopup="true" aria-expanded="false" onclick="gerarPDF()">GERAR PDF</button>

        <?php if ($Sessao::retornaMensagem()) { ?>
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
    <div class="table-responsive" id="tableFornecedores">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">E-mail Empresa</th>
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
                            <th scope="col">Status <a href="http://<?= APP_HOST; ?>/fornecedor/pesquisar/ordenar=inativo" style="text-decoration: none; color:black">⇅</a></th>
                            <?php } else if ($filtro == 'inativo') {
                                ?>
                                <th scope="col">Status <a href="http://<?= APP_HOST; ?>/fornecedor/pesquisar/ordenar=ativo" style="text-decoration: none; color:black">⇅</a></th>
                                <?php 
                            }
                            }else{ ?>
                            <th scope="col">Status <a href="http://<?= APP_HOST; ?>/fornecedor/pesquisar/ordenar=ativo" style="text-decoration: none; color:black">⇅</a></th>
                        <?php }
                    ?>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($fornecedoresFiltrados)) { ?>
                    <tr>
                        <td colspan="12">
                            <div class="alert alert-info" role="alert">Nenhum fornecedor encontrado!</div>
                        </td>
                    </tr>
                    <?php } else {
                    foreach ($fornecedoresFiltrados as $fornecedor) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $fornecedor->getId(); ?></th>
                            <td><?php echo $fornecedor->getNome(); ?></td>
                            <td><?php echo $fornecedor->getCpf(); ?></td>
                            <td><?php echo $fornecedor->getEmail(); ?></td>
                            <td><?php echo $fornecedor->getNome_fantasia(); ?></td>
                            <td><?php echo $fornecedor->getCnpj(); ?></td>
                            <td><?php echo $fornecedor->getEmail_empresa(); ?></td>
                            <td><?php echo $fornecedor->getTelefone(); ?></td>
                            <td><?php echo $fornecedor->getCEP(); ?></td>
                            <td><?php echo $fornecedor->getUF(); ?></td>
                            <td><?php echo $fornecedor->getCidade(); ?></td>
                            <td><?php echo $fornecedor->getBairro(); ?></td>
                            <td><?php echo $fornecedor->getLogradouro(); ?></td>
                            <td><?php echo $fornecedor->getComplemento(); ?></td>
                            <td><?php echo $fornecedor->getNumero(); ?></td>
                            <td><?php echo $fornecedor->getStatus(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <?php if($fornecedor->getQtdCompras() != 0 ){ ?>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Não é possível excluir Fornecedor que possui compras vinculadas!">
                                    <a class="btn btn-danger btn-sm disabled">Excluir</a>
                                </span>
                                <?php }else{ ?>
                                    <a href="http://<?php echo APP_HOST; ?>/fornecedor/exclusao/<?php echo $fornecedor->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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
                <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
                    <li class="page-item <?php echo $i === $paginaAtual ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&pesquisa=<?php echo $pesquisa; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <script>
      //http://www.macoratti.net/18/09/js_pdf1.htm
      function gerarPDF() {
      var table = document.getElementById('tableFornecedores').innerHTML;
      var style = "<style>";

      style = style + "table {width: 100%;font: 20px Calibri;}";
      style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
      style = style + "padding: 2px 3px;text-align: center;}";
      style = style + "</style>";
      // CRIA UM OBJETO (JANELA)
      var win = window.open('', '', 'height=700,width=700');
      win.document.write('<html><head>');
      win.document.write('<title> Listagem de Fornecedores </title>'); // <title> CABEÇALHO DO PDF.
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