<?php

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//   $ope = "login";
//   $email = $_POST['email'] ?? '';
//   $psw = $_POST['psw'] ?? '';

//   try {
//     $data = [
//       'ope' =>  $ope,
//       'email' => $email,
//       'psw' => $psw,
//     ];
//     $context = stream_context_create([
//       'http' => [
//         'method' => 'POST',
//         'header' => "Content-Type: application/json",
//         'content' => json_encode($data),
//       ]
//     ]);
//     $response = file_get_contents(HTTP_BASE . '/controller/Seg_usuarioLoginController.php', false, $context);
//     var_dump(@$response);
//     $result = json_decode($response, true);
//     if (isset($result['DATA']) && !empty($result['DATA'])) {
//       $_SESSION['login'] = $result['DATA'][0];
//       if (isset($_SESSION['login']['cod_usu'])) {
//         echo '<script>alert("Acceso Autorizado");</script>';
//         echo '<script>window.location.href ="' . HTTP_BASE . '/seg/seg_modulo/list"</script>';
//       } else {
//         echo '<script>alert("Usuario No autorizado");</script>';
//       }
//     } else {
//       echo '<script>alert("Usuario No autorizado");</script>';
//     }
//   } catch (Exception $e) {
//     echo '<script>alert("Ocurrió un error al guardar.");</script>';
//   }
// }

?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/dist/css/adminlte.min.css">
</head>

<body class="login-page" style="min-height: 494.8px;">
  <div class="login-box">
    <div class="login-logo">
      <a href=""><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"> Usuario Login</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="psw">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">

            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">

        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">

        </p>
        <p class="mb-0">
          <a href="<?php echo HTTP_BASE; ?>/login/register" class="text-center">Registrar</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/dist/js/adminlte.min.js"></script>


</body>

</html>