<?php


// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//   $ope = "register";
//   $cod_usu = $_POST['cod_usu'] ?? '';
//   $email = $_POST['email'] ?? '';
//   $psw = $_POST['psw'] ?? '';
//   // $psw  == $psw2
//   try {
//     $data = [
//       'ope' =>  $ope,
//       'cod_usu' => $cod_usu,
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
//     $result = json_decode($response, true);
//     if ($result["ESTADO"]) {
//       echo '<script>alert("Registro Guardado Exitosamente.");</script>';
//     } else {
      
//       echo '<script>alert("No se Puede Guardar.");</script>';
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
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/dist/css/adminlte.min.css">
</head>

<body class="register-page" style="min-height: 568.8px;">
  <div class="register-box">
    <div class="register-logo">
      <a href=""><b>Admin</b>LTE</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Registrarse</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="User name" name="cod_usu">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Correo Electronico" name="email">
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
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password" name="psw2">
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
              <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

       

        <a href="<?php echo HTTP_BASE; ?>/login/login" class="text-center">Iniciar Session</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
  <!-- jQuery -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URL_RESOURCES; ?>adminlte/dist/js/adminlte.min.js"></script>




</body>

</html>