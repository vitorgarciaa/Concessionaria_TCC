<?php

use App\Models\DAO\VendedorDAO;

session_start();

if (isset($_SESSION['login'])) {
    $vendedorDAO = new VendedorDAO();
    $vendedoresPorPagina = 10;
    $paginaAtual = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

    if (empty($pesquisa)) {
        $todosVendedores = $viewVar['vendedor'];
    } else {
        $todosVendedores = [];
        foreach ($viewVar['vendedor'] as $vendedor) {
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
                    <th scope="col">Status</th>
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
<?php
}
?>