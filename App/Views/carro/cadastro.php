<?php 
use App\Models\DAO\ModeloDAO;
$modeloDAO = new ModeloDAO;

?>
<script>
      
      $(document).ready(function(){
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
      });
</script>
<div class="container">
  <br>
    <h1>Cadastro de Carro</h1>
  <br>
      <?php 
            if ($Sessao::retornaMensagem()) { ?>
            <br>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="alert alert-success col-md-12" role="alert">
                        <a href="" class="btn-close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $Sessao::retornaMensagem(); ?> <br>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            <?php } ?>

        <?php 
            if($Sessao::retornaErro()){?>
            <br>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="btn-close" data-dimiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php }?>
                </div> 
        <?php } ?>

  <form action="http://<?php echo APP_HOST; ?>/carro/salvar" enctype="multipart/form-data" method="post" class="row g-3">

    <div class="row">
      <div class="col-md-1">
        <label for="inputCodigo" class="form-label">Código</label>
        <input type="text" class="form-control" id="inputCodigo" disabled>
      </div>

      <div class="col-md-5">
      <label for="selectMarca" class="form-label">Marca</label>
        <div class="input-group md-3">
          <select class="form-select" name="marcaId" id="marca" onchange="funcaoMarca()">
          <option selected>Selecione a Marca</option>

          <?php if (!count($viewVar['marca'])) { ?>
                <div class="alert alert-info" role="alert">Nenhuma marca encontrado!</div>
            <?php 
                }else{
              foreach($viewVar['marca'] as $marca){
            ?>
            <option value="<?php echo $marca->getId(); ?>"><?php echo $marca->getNome(); ?></option>
            <?php 
                }
              }
            ?>

          </select>
          <label class="input-group-text btn-primary" for="marca" data-bs-toggle="modal" data-bs-target="#modalMarca" data-bs-whatever="@fat">Cadastrar Marca</label>
        </div>
        
      </div>
      <div id="divModelo" class="col-md-6">
      </div>
    </div>
    
    <script>
      function funcaoMarca(){
        var marca = document.getElementById("marca").value;
            $.ajax({
                url: 'http://<?php echo APP_HOST; ?>/carro/listarPorMarca',
                type: 'POST',
                data: {
                  marcaId: marca
                },
                success: function(data) {
                    $("#divModelo").html(data);

                },
                error: function(data) {
                    alert("Houve um erro ao carregar");
                }
            });
      }
    </script>

    <div class="row">
        <div class="col-md-2">
          <label for="selectTransmissao" class="form-label">Transmissão</label>
            <select class="form-select" aria-label="Selecione o Transmissao" id="selectTransmissao" name="transmissao">
              <option selected>Selecione a Transmissão</option>
              <option value="Transmissão Manual">Transmissão Manual</option>
              <option value="Transmissão Automático">Transmissão Automático</option>
            </select>
        </div>

        <div class="col-md-2">
          <label for="selectDirecao" class="form-label">Direção</label>
            <select class="form-select" aria-label="Selecione a Direção" id="selectDirecao" name="direcao">
              <option selected>Selecione a Direção</option>
              <option value="Manual">Direção Manual</option>
              <option value="Hidráulica">Direção Hidráulica</option>
              <option value="Elétrica">Direção Elétrica</option>
              <option value="Eletro-hidráulica">Direção Eletro-hidráulica</option>
            </select>
        </div>
        
        <div class="col-md-2">
          <label for="selectTracao" class="form-label">Tração</label>
            <select class="form-select" aria-label="Selecione a Tração" id="selectTracao" name="tracao">
              <option selected>Selecione a Tração</option>
              <option value="Traseira">Traseira</option>
              <option value="Dianteira">Dianteira</option>
              <option value="4x4">4x4</option>
            </select>
        </div>

        <div class="col-md-2">
          <label for="selectFreio" class="form-label">Freio</label>
            <select class="form-select" aria-label="Selecione o Tipo do Freio" id="selectFreio" name="freio">
              <option selected>Selecione O Freio</option>
              <option value="ABS">Freio ABS</option>
              <option value="a Disco">Freio a Disco</option>
            </select>
        </div>
      
        <div class="col-md-2">
          <label for="selectCombustivel" class="form-label">Combustivel</label>
            <select class="form-select" aria-label="Tipo do Combustivel" id="selectCombustivel" name="combustivel">
              <option selected>Tipo Combustivel</option>
              <option value="Álcool">Álcool</option>
              <option value="Diesel">Diesel</option>
              <option value="Flex">Flex</option>
              <option value="Gasolina">Gasolina</option>
            </select>
        </div>

        <div class="col-md-2">
          <label for="selectDisponibilidade" class="form-label">Disponibilidade</label>
            <select class="form-select" aria-label="Disponibildiade" id="selectDisponibilidade" name="disponibilidade">
              <option selected>Selecione a Disponibiliade</option>
              <option value="Disponível">Disponivel</option>
              <option value="Reservado">Reservado</option>
              <option value="Indisponível">Indisponível</option>
            </select>
        </div>
      </div>

    <div class="row">
      <div class="col-md-2">
        <label for="inputAno_modelo" class="form-label">Ano Fabricação</label>
        <input type="text" class="form-control" id="ano_fabricacao" name="ano_fabricacao">
      </div>

      <div class="col-md-2">
        <label for="inputAno_modelo" class="form-label">Ano Modelo</label>
        <input type="text" class="form-control" id="ano_modelo" name="ano_modelo">
      </div>

      <div class="col-md-2">
        <label for="inputCor" class="form-label">Cor</label>
        <input type="text" class="form-control" id="inputCor" name="cor">
      </div>

      <div class="col-md-2">
        <label for="inputMotor" class="form-label">Motor</label>
        <input type="text" class="form-control" id="inputMotor" name="motor">
      </div>

      <div class="col-md-2">
        <label for="inputQuilometragem" class="form-label">Quilometragem</label>
        <select class="form-select" aria-label="Quilometragem" id="selectQuilometragem" name="quilometragem" onchange="toggleQuilometragemInput()">
            <option value="0">Novo</option>
            <option>Semi-Novo</option>
        </select>
        <input type="text" class="form-control" id="inputQuilometragem" name="quilometragem" style="display: none;" placeholder="Digite a Quilometragem">
    </div>

    <script>
        function toggleQuilometragemInput() {
            var selectElement = document.getElementById("selectQuilometragem");
            var inputElement = document.getElementById("inputQuilometragem");

            if (selectElement.value === "0") {
                inputElement.style.display = "none";
            } else {
                inputElement.style.display = "block";
            }
        }
    </script>

      <div class="col-md-2">
          <label for="inputPreco" class="form-label">Preço</label>
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text">R$</span>
              </div>
              <input type="text" class="form-control money" id="inputPreco" name="preco">
          </div>
      </div>

      <div class="col-md-6">
        <label for="inputObservacao" class="form-label">Observações</label>
        <textarea type="textarea" class="form-control" id="inputObservacao" name="observacao"></textarea>
      </div>

      <div class="col-md-6">
          <label for="inputImagem" class="form-label">Imagens</label>    
          <input type="file" class="form-control " id="inputImagem" accept="image/*" name="imagens[]" multiple>
      </div>
    </div>
    <div id="imagePreview" class="d-flex mt-3"></div>
      <div id="imageModal" class="modal fade" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <img id="modalImage" src="" alt="Imagem Ampliada" class="w-100">
              </div>
            </div>
          </div>
      </div>
      
    <div class="col-md-12">
        <label for="inputAno" class="form-label">Opcionais</label>
        <div class="form-check">
          <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">Ar condicionado
          <br>
          <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">Vidros Elétricos
          <br>
          <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">Travas Elétricas
          <br>
          <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">AirBags
          <br>
          <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">Som
        </div>
    </div>

    <div class="col-md-12 d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Cadastrar</button>&nbsp&nbsp
      <button type="button" class="btn btn-danger">Cancelar</button>
   </div>

      </form>
        <br>
    </div> 

      <div class="col-md-6">
          <div class="modal fade" id="modalModelo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Modelo</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="http://<?php echo APP_HOST; ?>/modelo/salvar" method="post">
                    <div class="mb-3">
                      <label for="inputCor" class="form-label">Nome</label>
                      <input type="text" class="form-control" id="inputCor" name="nome">
                    </div>
                    <div class="mb-3">
                    <label for="selectMarca" class="form-label">Marca</label>
                      <select class="form-select" aria-label="Selecione a Marca" id="selectMarca" name="marca">
                        <option selected>Selecione a Marca</option>

                        <?php if (!count($viewVar['marca'])) { ?>
                            <div class="alert alert-info" role="alert">Nenhuma marca encontrado!</div>
                          <?php 
                              }else{
                            foreach($viewVar['marca'] as $marca){
                          ?>
                          <option value="<?php echo $marca->getId(); ?>"><?php echo $marca->getNome(); ?></option>
                          <?php 
                              }
                            }
                        ?>
                      </select>
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                       <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
    
    <div class="col-md-6">
          <div class="modal fade" id="modalMarca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Marca</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <form action="http://<?php echo APP_HOST; ?>/marca/salvar" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                          <label for="inputCor" class="form-label">Nome</label>
                          <input type="text" class="form-control" id="inputCor" name="nome">
                        </div>
                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
    </div>
    <script>
      
      $(document).ready(function(){
        $("#ano_fabricacao").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years"
        });
      });

      $(document).ready(function(){
        $("#ano_modelo").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years"
        });
      });

    const imagePreview = document.getElementById('imagePreview');
    const modalImage = document.getElementById('modalImage');

    document.getElementById('inputImagem').addEventListener('change', function(e) {
      imagePreview.innerHTML = '';

      if (e.target.files.length === 3) {
        for (const file of e.target.files) {
          const img = document.createElement('img');
          img.src = URL.createObjectURL(file);
          img.className = 'm-2';
          img.style = 'width: 200px; height: 200px; object-fit: cover; cursor: pointer;'
          img.alt = 'Imagem';
          img.addEventListener('click', function() {
            modalImage.src = img.src;
            $('#imageModal').modal('show');
          });
          imagePreview.appendChild(img);
        }
      } else {
        alert('Por favor, selecione exatamente 3 imagens.');
        e.target.value = ''; // Limpar a seleção de imagens
      }
    });

</script>