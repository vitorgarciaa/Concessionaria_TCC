<?php
    session_start();

if (!isset($_SESSION['login'])) {

?>
            
<div class="container">
    <br><br>
    <?php 
            if ($Sessao::retornaMensagem()) { ?>
            <br>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="alert alert-success col-md-10" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $Sessao::retornaMensagem(); ?> <br>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            <?php } ?>
        <br>
        
        <form action="http://<?php echo APP_HOST; ?>/login/entrar" method="post" id="form_login" >
            <div class="form-group">
                <label for="email">Usuario ou Email: </label>
                <input type="text" class="form-control" id="email" name="email" require>            
            </div>
            <div class="form-group">
                <label for="senha">Senha: </label>
                <input type="password" class="form-control" name="senha" id="senha" require>
            </div>
            <br>
            <button type="submit" name="entrar" class="btn btn-primary">Entrar</button>
        </form>
    <br><br><br>
</div> 

<?php

} else {
    echo "<h2> VOCÊ JÁ ESTÁ LOGADO </h2>";
}
?>