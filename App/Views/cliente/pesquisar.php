<?php

use App\Models\DAO\ClienteDAO;
use App\Models\Entidades\Cliente;
use App\Lib\Sessao;

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

        .button {
            height: 50vw;
        }
    </style>
    <div class="container-fluid">
        <br>
        <h3>Lista de Clientes</h3>
        <br>

        <?php if ($Sessao::retornaMensagem()) { ?>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="alert alert-success col-md-12" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <th scope="col">Telefone</th>
                    <th scope="col">CEP</th>
                    <th scope="col">UF</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Logradouro</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clientesFiltrados = [];

                $clientesPorPagina = 10;
                $paginaAtual = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

                if (empty($pesquisa)) {
                    $clientesFiltrados = $viewVar['cliente'];
                } else {
                    $clienteDAO = new ClienteDAO();
                    foreach ($viewVar['cliente'] as $cliente) {
                        $clienteData = [
                            $cliente->getId(),
                            $cliente->getNome(),
                            $cliente->getEmail(),
                            $cliente->getTelefone(),
                            $cliente->getCEP(),
                            $cliente->getUF(),
                            $cliente->getCidade(),
                            $cliente->getBairro(),
                            $cliente->getLogradouro(),
                            $cliente->getComplemento(),
                            $cliente->getNumero(),
                            $cliente->getStatus()
                        ];
                
                        $encontrado = false;
                        foreach ($clienteData as $campo) {
                            if (stripos($campo, $pesquisa) !== false) {
                                $encontrado = true;
                                break;
                            }
                        }
                
                        if ($encontrado) {
                            $clientesFiltrados[] = $cliente;
                        }
                    }
                }

                $totalClientes = count($clientesFiltrados);
                $totalPaginas = ceil($totalClientes / $clientesPorPagina);
                $indiceInicial = ($paginaAtual - 1) * $clientesPorPagina;
                $indiceFinal = min($indiceInicial + $clientesPorPagina, $totalClientes);

                if (empty($clientesFiltrados)) { ?>
                    <tr>
                        <td colspan="12">
                            <div class="alert alert-info" role="alert">Nenhum cliente encontrado!</div>
                        </td>
                    </tr>
                    <?php } else {
                    for ($i = $indiceInicial; $i < $indiceFinal; $i++) {
                        $cliente = $clientesFiltrados[$i];
                    ?>
                        <tr>
                            <th scope="row"><?php echo $cliente->getId(); ?></th>
                            <td><?php echo $cliente->getNome(); ?></td>
                            <td><?php echo $cliente->getEmail(); ?></td>
                            <td><?php echo $cliente->getTelefone(); ?></td>
                            <td><?php echo $cliente->getCEP(); ?></td>
                            <td><?php echo $cliente->getUF(); ?></td>
                            <td><?php echo $cliente->getCidade(); ?></td>
                            <td><?php echo $cliente->getBairro(); ?></td>
                            <td><?php echo $cliente->getLogradouro(); ?></td>
                            <td><?php echo $cliente->getComplemento(); ?></td>
                            <td><?php echo $cliente->getNumero(); ?></td>
                            <td><?php echo $cliente->getStatus(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/cliente/edicao/<?php echo $cliente->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <?php if($cliente->getQtdVendas() != 0){ ?>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Não é possível excluir Cliente que possui Compra vinculada!">
                                    <a class="btn btn-danger btn-sm disabled">Excluir</a>
                                </span>
                                <?php }else{ ?>
                                    <a href="http://<?php echo APP_HOST; ?>/cliente/exclusao/<?php echo $cliente->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                                <?php } ?>
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
        <h2>FAÇA LOGIN PARA CONTINUAR!</h2>
        <a href="http://<?php echo APP_HOST; ?>/login/index" class="btn btn-dark">FAZER LOGIN</a>
        <p>ou <a href="http://<?php echo APP_HOST; ?>/">Voltar para Página Inicial</a></p>
    </div>
    <br>
<?php
}
?>