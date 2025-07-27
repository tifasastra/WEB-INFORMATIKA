<?php
    require 'function.php';

    if (isset($_POST["submit"])) {
        $message = register($_POST);

        echo "
            <script>
               alert('" . addslashes($message) . "');
            </script>
        ";
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - Web Informatika</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .password-wrapper {
      position: relative;
    }
    .password-wrapper .toggle-password {
      position: absolute;
      top: 75%;
      right: 15px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
    }
  </style>
</head>

<body class="bg-light">

  <div class="container py-5">

    <!-- Title -->
    <h1 class="mb-4 text-center">Daftar Akun</h1>

    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">

            <form action="" method="post" enctype="multipart/form-data">

              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
              </div>

              <div class="mb-3 password-wrapper">
                <label for="password1" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control pe-5" id="password1" name="password1" placeholder="Masukkan kata sandi" required>
                <i class="bi bi-eye-slash toggle-password" toggle="#password1"></i>
              </div>

              <div class="mb-3 password-wrapper">
                <label for="password2" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" class="form-control pe-5" id="password2" name="password2" placeholder="Ulangi kata sandi" required>
                <i class="bi bi-eye-slash toggle-password" toggle="#password2"></i>
              </div>

              <button type="submit" name="submit" class="btn btn-primary w-100">Daftar</button>

            </form>

          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(element) {
      element.addEventListener('click', function() {
        const input = document.querySelector(this.getAttribute('toggle'));
        if (input.getAttribute('type') === 'password') {
          input.setAttribute('type', 'text');
          this.classList.remove('bi-eye-slash');
          this.classList.add('bi-eye');
        } else {
          input.setAttribute('type', 'password');
          this.classList.remove('bi-eye');
          this.classList.add('bi-eye-slash');
        }
      });
    });
  </script>
</body>
</html>
