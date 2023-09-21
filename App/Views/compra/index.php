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
    <h1>Painel de Compra</h1>
  <br>

    <br>
    <h5 class="text-center">Dados Fornecedor</h5>
    <br>

    <div class="row">
    <div class="col-md-1">
        <label for="inputCodigo" class="form-label">Código</label>
        <input type="text" class="form-control" id="inputCodigo" enable>
      </div>

        <div class="col-md-2">
                <label for="inputCpf" class="form-label">CPF / CNPJ</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('cpf');?>" onkeyup="cpfCheck(this)" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );" required><span id="cpfResponse"></span>
        </div>

      <div class="col-md-5">
      <label for="inputNome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="inputNome" name="nome" required>
      </div>
    </div>

    <br>
    <h5 class="text-center">Dados do Carro</h5>
    <br>


    
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

      
      $(document).ready(function(){
        $('#inputCpf').mask('000.000.000-00');
        $('#inputCnpj').mask('00.000.000/0000-00');
        $('.inputTelefone').mask('(99) 99999-9999');

      });


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

    <div class="col-md-12 d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Finalizar Compra</button>&nbsp&nbsp
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

