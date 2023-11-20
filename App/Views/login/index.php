<?php
session_start();

if (!isset($_SESSION['login'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5" id="custom-target-element'">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Login</h2>
                    <form action="http://<?php echo APP_HOST; ?>/login/entrar" method="post" id="form_login">
                        <div class="form-group">
                            <label for="email">Usuário ou Email:</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" name="senha" id="senha" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="entrar" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.rawgit.com/elevateweb/elevatezoom/master/jquery.elevatezoom.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/elevateweb/elevatezoom/master/jquery.elevatezoom.css">

</body>
</html>

<?php
} else {
    echo "<h2>VOCÊ JÁ ESTÁ LOGADO</h2>";
}
?>
