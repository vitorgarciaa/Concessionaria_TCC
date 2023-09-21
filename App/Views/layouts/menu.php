<style>
  .dropdown-submenu {
    position: relative;
  }

  .dropdown-submenu a::after {
    transform: rotate(-90deg);
    position: absolute;
    right: 6px;
    top: .8em;
  }

  .dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-left: .1rem;
    margin-right: .1rem;
  }

  .manutencao {
    margin-top: 8px;
    text-decoration: none;
    margin-left: 3px;
  }
</style>

<nav class="navbar navbar-expand-lg text-white bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="http://<?php echo APP_HOST; ?>/home/index">Concessionária VG</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="http://<?php echo APP_HOST; ?>/home/index">Home</a>
        </li>
        <li class="nav-item">
          <a href="http://<?php echo APP_HOST; ?>/carro/index" class="nav-link text-white">Listar Carros</a>
        </li>
        <li class="nav-item">
          <a href="http://<?php echo APP_HOST; ?>/compra/index" class="nav-link text-white">Painel de Compra</a>
        </li>
        <li class="nav-item">
          <a href="http://<?php echo APP_HOST; ?>/venda/index" class="nav-link text-white">Painel de Vendas</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-item dropdown-toggle text-white manutencao" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Manutencao
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

              <div class="dropdown-submenu dropright">
                <a class="dropdown-item dropdown-toggle" href="#">Carro</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/carro/cadastro">Cadastro de Carro</a>
                  <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/carro/pesquisar">Pesquisar Carro</a>
                </div>
                <div class="dropdown-submenu dropright">
                  <a class="dropdown-item dropdown-toggle" href="#">Pessoa</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/cliente/cadastro">Cadastrar Cliente</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/cliente/pesquisar">Pesquisar Cliente</a>
                    <br>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/fornecedor/cadastro">Cadastrar Fornecedor</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/fornecedor/pesquisar">Pesquisar Fornecedor</a>
                    <br>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/vendedor/cadastro">Cadastrar Vendedor</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/vendedor/pesquisar">Pesquisar Vendedor</a>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
    </div>
    <div>

      <li class="nav-item">
        <?php
        if (!isset($_SESSION['login'])) {
        ?>
          <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>/login/index">Entrar</a>
        <?php
        } else {
        ?>
          <a href="http://<?php echo APP_HOST; ?>/login/sair" class="nav-link text-white">Sair</a>
        <?php
        }
        ?>
      </li>
      </ul>
    </div>
    <script>
      $(document).ready(function() {
        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
          if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
          }
          var $subMenu = $(this).next(".dropdown-menu");
          $subMenu.toggleClass('show');

          $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
          });

          return false;
        });
      });
    </script>
</nav>