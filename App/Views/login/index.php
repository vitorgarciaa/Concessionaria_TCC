<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifique as credenciais do usuário (substitua por sua lógica de autenticação)
    if ($username === 'usuario' && $password === 'senha') {
        echo "<p style='text-align: center; color: green;'>Login bem-sucedido!</p>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
          })</script>";
    }
}
?>

<?php if ($_SERVER['REQUEST_METHOD'] !== 'POST') : ?>
    <br><br><br>
    <div style='text-align: center; background-color: #f4f4f4; font-family: Arial, sans-serif;'>
        <div style='background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); text-align: center;'>
            <h2>Login</h2>
            <br>
            <form method="POST">
                <label for='usuario'>Usuário:</label><br>
                <input type='text' name='usuario' style='width: 200px; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;'><br>

                <label for='senha'>Senha:</label><br>
                <input type='password' name='senha' style='width: 200px; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;'><br>

                <input type='submit' value='Entrar' style='background-color: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 3px; cursor: pointer;'>
            </form>
        </div>

    </div>

    <div class="dropdown-menu">
  <form class="px-4 py-3">
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
    </div>
    <div class="mb-3">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="dropdownCheck">
        <label class="form-check-label" for="dropdownCheck">
          Remember me
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
  </form>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="#">New around here? Sign up</a>
  <a class="dropdown-item" href="#">Forgot password?</a>
</div>
    <br>
    </div>
<?php endif; ?>
