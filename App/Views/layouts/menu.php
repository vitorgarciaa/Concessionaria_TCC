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

  .cabecario li{
    margin: 0 10px;
    transition: all 1s ease-in-out ;
    border-radius: 5px;
    font-family: cursive;
  }
  .cabecario li:hover{
    background-color: blue;
    
  }

  .hover:hover{
    color: gray ;
  }

  .hover{
    color: white;
    transition: all 0.5s ease-in-out ;
  }

  .navbar-toggler-icon {
    background-color: gray;
  }

  @media (max-width: 992px) {
    .cabecario li{
      margin: 10px 0;
      transition: all 1s ease-in-out ;
      border-radius: 5px;
      width: 40%;
      min-width: 120px;
      text-align: center;
      justify-items: center;
    }
  }

</style>

<nav class="navbar navbar-expand-lg text-white " style="background-color: #020147; padding: 40px 10px;">
  <div class="container-fluid">
    <a class="navbar-brand  hover" href="http://<?php echo APP_HOST; ?>/home/index">Concessionária Blackbeard</a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 cabecario">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="http://<?php echo APP_HOST; ?>/home/index">Home</a>
        </li>
        <li class="nav-item">
          <a href="http://<?php echo APP_HOST; ?>/carro/index" class="nav-link text-white">Listar Carros</a>
        </li>
        <li class="nav-item">
          <a href="http://<?php echo APP_HOST; ?>/sobre/index" class="nav-link text-white">Sobre Nós</a>
        </li>

        <?php
        if (isset($_SESSION['login'])) {
        ?>
          <li class="nav-item">
            <div class="dropdown">
              <a class="nav-item dropdown-toggle text-white manutencao" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Gerenciar
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <div class="dropdown-submenu dropright">
                  <a class="dropdown-item dropdown-toggle" href="#">Carro</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/carro/cadastro">Cadastro de Carro</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/carro/pesquisar">Pesquisar Carro</a>
                  </div>
                  <div class="dropdown-submenu dropright">
                    <a class="dropdown-item dropdown-toggle" href="#">Compra</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/compra/pesquisar">Pesquisar Compra</a>
                    </div>
                    <div class="dropdown-submenu dropright">
                      <a class="dropdown-item dropdown-toggle" href="#">Venda</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/venda/pesquisar">Pesquisar Venda</a>
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
        <?php
        }
        ?>
    </div>
    <div>

      <li class="nav-item" style="list-style: none;">
        <?php
        if (!isset($_SESSION['login'])) {
        ?>
          <a class="nav-link hover " href="http://<?php echo APP_HOST; ?>/login/index" style="color: green;">
            <i class="fas fa-sign-in-alt " style="color: green;"></i> Entrar
          </a>
        <?php
        } else {
        ?>
          <a href="http://<?php echo APP_HOST; ?>/login/sair" class="nav-link hover" style="color: red;">
            <i class="fas fa-sign-out-alt " style="color: red;"></i> Sair
          </a>
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