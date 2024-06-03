<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $ope = 'login';
  $p_correo_electronico = $_POST['email'];
  $p_contrasena = $_POST['psw'];
  //Validar
  try {
    $data = [
      'ope' => $ope,
      'correo' => $p_correo_electronico,
      'password' => $p_contrasena,
    ];
    $context = stream_context_create([
      'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($data),
      ]
    ]);
    $url = HTTP_BASE . "/controller/Seg_LoginController.php";
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);
    //echo json_encode($response["ESTADO"] . " << login state");
    //echo json_encode($result);
    //echo $result['DATA'][0];
    if ($result["ESTADO"] && isset($result['DATA']) && !empty($result['DATA'])) {
      $_SESSION['login'] = $result['DATA'][0];
      if (isset($_SESSION['login']['nombre'])) {
        echo "<script>alert('Acceso Autorizado');</script>";
        //A CONTINUACION ENRUTAR A LA PAGINA QUE IRA CUANDO SE INICIE SESION
        echo '<script>window.location.href ="' . HTTP_BASE . '/login";</script>';
      } else {
        echo "<script>alert('Acceso No Autorizado');</script>";
      }
    } else {
      echo "<script>alert('Hubo un problema, Contactarse con el Administrador de Sistemas');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Hubo un problema, Contactarse con el Administrador de Sistemas 1');</script>";
  }
}
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>login</title>

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

  <script src="https://kit.fontawesome.com/f0d04e9f6f.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/adminlte.min.css?v=3.2.0">
</head>

<body class="login-page bg-gradient-dark" style="min-height: 496.8px;">
  <div class="login-box">
    <div class="col-md-3">
      <div class="header-logo">
        <a href="#" class="logo">
          <img src="<?php echo URL_RESOURCES; ?>img/logo.png" alt="logo is here">
        </a>
      </div>
    </div>

    <div class="card rounded-lg border">
      <div class="card-body login-card-body">
        <p class="login-box-msg">INICIAR SESION</p>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Correo Electronico" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Contraseña" name="psw">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>

          <div class="col-auto">
            <button type="submit" class="btn btn-block btn-primary">Iniciar Sesión</button>
          </div>
        </form>

        <p class="mb-1">
          <a href="<?php echo HTTP_BASE . '/register'; ?>">Olvide mi Contraseña</a>
        </p>
        <p class="mb-0">
          <a href="<?php echo HTTP_BASE . '/register'; ?>" class="text-center">Crear una cuenta</a>
        </p>
      </div>

    </div>
  </div>


  <script src="<?php echo URL_RESOURCES; ?>js/jquery.min.js"></script>

  <script src="<?php echo URL_RESOURCES; ?>js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo URL_RESOURCES; ?>js/adminlte.min.js?v=3.2.0"></script>


</body>

</html>