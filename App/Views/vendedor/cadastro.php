
<?php
session_start();

if (isset($_SESSION['login'])) {
?>

<script>
      
      $(document).ready(function(){
        $('#inputCpf').mask('000.000.000-00');
      });
</script>

<script>
      
      $(document).ready(function(){
        $('#inputTelefone').mask('(99) 99999-9999');
      });
</script>


<!-- Adicionando Javascript -->
<script type="text/javascript" >

//FUNÇÃO PARA VALIDAR CPF 
// https://pt.stackoverflow.com/questions/295564/como-validar-cpf-com-m%C3%A1scara-em-javascript

        function is_cpf (c) {

        if((c = c.replace(/[^\d]/g,"")).length != 11)
            return false

        if (c == "00000000000" || c == "11111111111" || c == "22222222222" || c == "33333333333" || c == "44444444444" || c == "55555555555" || c == "66666666666" || c == "77777777777" || c == "88888888888" || c == "99999999999")
            return false;

            var r;
            var s = 0;

            for (i=1; i<=9; i++)
                s = s + parseInt(c[i-1]) * (11 - i);

                r = (s * 10) % 11;

            if ((r == 10) || (r == 11))
                r = 0;

            if (r != parseInt(c[9]))
            return false;

                s = 0;

            for (i = 1; i <= 10; i++)
                s = s + parseInt(c[i-1]) * (12 - i);

                r = (s * 10) % 11;

            if ((r == 10) || (r == 11))
                r = 0;

            if (r != parseInt(c[10]))
                return false;

            return true;
            }


            function fMasc(objeto,mascara) {
                obj=objeto
                masc=mascara
                setTimeout("fMascEx()",1)
            }

            function fMascEx() {
                obj.value=masc(obj.value)
            }

            function mCPF(cpf){
                cpf=cpf.replace(/\D/g,"")
                cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
                cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
                cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
                return cpf
            }

            cpfCheck = function (el) {
                document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? null : '<span style="color:red">CPF Inválido</span>';
                if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
            }

    //FUNÇÃO API CORREIOS CEP
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('cep').value=("");
            document.getElementById('logradouro').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
           
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('logradouro').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

<div class="container">
  <br>
    <h1>Cadastro de Vendedor</h1>
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

  <form action="http://<?php echo APP_HOST; ?>/vendedor/salvar" method="post" class="row g-3">

    <div class="row">
        <div class="col-md-3">
                <label for="inputCpf" class="form-label">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('cpf');?>" onkeyup="cpfCheck(this)" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );" required><span id="cpfResponse"></span>
        </div>

      <div class="col-md-5">
      <label for="inputNome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="inputNome" name="nome" required>
      </div>
      
      <div class="col-md-4">
      <label for="inputEmail" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="inputEmail" name="email" required>
      </div>
    </div>

    <div class="row">

      <div class="col-md-2">
          <label for="inputUsuario" class="form-label">Usuario</label>
          <input type="text" class="form-control" id="inputUsuario" name="usuario" required>
        </div>



        <div class="col-md-2">
          <label for="inputTelefone" class="form-label">Telefone</label>
          <input type="tel" class="form-control" id="inputTelefone" name="telefone" required>
        </div>

        <div class="col-md-2">
        <label for="inputSenha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="inputSenha" name="senha" required>
        </div>

        

        <div class="col-md-2">
        <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
        <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required>
        </div>
        <div class="col-md-2">
          <label for="selectStatus" class="form-label">Status</label>
            <select class="form-select" aria-label="Status" id="selectStatus" name="status">
              <option selected>Selecione o Status</option>
              <option value="Ativo">Ativo</option>
              <option value="Inativo">Inativo</option>
            </select>
        </div>

        <div id="senhaFeedback"></div>

        <script>
        $(document).ready(function() {
            $('#inputSenha').on('input', function() {
            var senha = $(this).val();
            var strength = verificarForcaSenha(senha);
            exibirFeedbackForcaSenha(strength);
            });
        });
        
        function verificarForcaSenha(senha) {
            var letrasMaiusculas = /[A-Z]/;
            var letrasMinusculas = /[a-z]/;
            var numeros = /[0-9]/;
            var caracteresEspeciais = /[!@#$%^&*()-_]/;

            var forca = 0;

            if (letrasMaiusculas.test(senha)) {
            forca++;
            }

            if (letrasMinusculas.test(senha)) {
            forca++;
            }

            if (numeros.test(senha)) {
            forca++;
            }

            if (caracteresEspeciais.test(senha)) {
            forca++;
            }

            // Avalie a força da senha com base nos requisitos
            if (forca < 3) {
            return 'fraca';
            } else {
            return 'forte';
            }
        }

        function exibirFeedbackForcaSenha(forca) {
            var feedbackDiv = $('#senhaFeedback');
            if (forca === 'fraca') {
            feedbackDiv.html('Senha fraca').css('color', 'red');
            const elemento = document.querySelector('#validaSenha');
            elemento.classList.add('disabled');
            } else {
            feedbackDiv.html('Senha forte').css('color', 'green');
            const elemento = document.querySelector('#validaSenha');
            elemento.classList.remove('disabled');
            }
        }
    
        </script>
      </div> 

    <h5 class="text-center">Endereço</h5>
            <div class="row">
                <div class="col-md-2">
                    <label for="cep" class="form-label">CEP *: </label>
                    <input type="text" class="form-control" name="cep" id="cep" maxlength="8" placeholder="Somente Números" onblur="pesquisacep(this.value);" required>
                </div>
                
                
                <div class="form-group col-md-1">
                <label for="uf" class="form-label">UF *: </label>
                    <input type="text" class="form-control disabled" name="uf" id="uf" size="2" maxlength="2" readonly>
                </div>

                
                <div class="form-group col-md-4">
                <label for="cidade" class="form-label">Cidade *: </label>
                    <input type="text" class="form-control" name="cidade" id="cidade" readonly>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="bairro"class="form-label">Bairro: </label>
                    <input type="text" class="form-control" name="bairro" id="bairro">
                </div>

                <div class="form-group col-md-7">
                    <label for="logradouro"class="form-label">Rua: </label>
                    <input type="text" class="form-control" name="logradouro" id="logradouro">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-5">
                    <label for="complemento"class="form-label">Complemento: </label>
                    <input type="text" class="form-control" name="complemento" id="complemento">
                </div>

                <div class="form-group col-md-1">
                    <label for="numero"class="form-label">Número: </label>
                    <input type="text" class="form-control" name="numero" id="numero">
                </div>
            </div>

    <div class="col-md-12 d-flex justify-content-end">
      <button type="submit" class="btn btn-success" id="validaSenha">Cadastrar</button>&nbsp&nbsp
      <button type="button" class="btn btn-danger">Cancelar</button>
   </div>

  </form>
  <br>
</div>

<?php

} else { ?>
<br>
    <div class="container">
        <h2> FAÇA LOGIN PARA CONTINUAR! </h2>
        <a href="http://<?php echo APP_HOST; ?>/login/index" class="btn btn-dark">FAZER LOGIN</a>
            <p>
                ou <a href="http://<?php echo APP_HOST;?>/">Voltar para Página Inicial</a>
            </p>
    </div>
<br>
<?php
    }
?>
