<?php
  session_start();

  if(isset($_SESSION["login"]))
  {
    header("Location: datamahasiswa.php");
    exit;
  }
  
  require 'function.php';

  $error = false;

  if(isset($_POST["login"]))
  {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT *FROM user WHERE username='$username'";

    $result = mysqli_query($koneksi, $query);

    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0)
    {
      if(password_verify($password, $user["password"]))
      {
        $_SESSION["login"] = $user["id"];

        header("Location: datamahasiswa.php");
        exit;
      }
    }

    $error = true;
  }
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN | WEB INFORMATIKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      .login-container {
        max-width: 400px;
        margin: 80px auto;
      }
    </style>
  </head>

  <body>
    <div class="container login-container">
      <h1 class="text-center mb-4">LOGIN</h1>

      <?php if($error) : ?>
        <div class="alert alert-danger text-center" role="alert">
          Username atau Password salah!
        </div>
      <?php endif; ?>

      <div class="card shadow-sm">
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Masukkan username" required />
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Masukkan password" required />
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
          </form>

          <div class="mt-3 text-center">
            <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
