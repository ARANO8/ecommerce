<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ope = 'register';
    $p_correo_electronico = $_POST['email'];
    $p_nombre = $_POST['nombre'];
    $p_user = $_POST['user'];
    $p_contrasena = $_POST['psw'];
    $p_contrasena1 = $_POST['psw1'];
    $p_direccion = $_POST['ubicacion'];

    //Validar
    try {
        $data = [
            'ope' => $ope,
            'nombre' => $p_nombre,
            'correo' => $p_correo_electronico,
            'user' => $p_user,
            'password' => $p_contrasena,
            'direccion' => $p_direccion,
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
        //echo $response;
        $result = json_decode($response, true);
        //var_dump($result["ESTADO"]);
        //var_dump($result);
        if ($result["ESTADO"]) {
            echo "<script>alert('Se realizo la operacion de manera Exitosa');</script>";
            echo "<script>window.location.href ='" . HTTP_BASE . "/login';</script>";
        } else {
            echo "<script>alert('Hubo un problema, Contactarse con el Administrador de Sistemas1');</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Hubo un problema, Contactarse con el Administrador de Sistemas');</script>";
    }
}



?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Registration Page</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>css/adminlte.min.css?v=3.2.0">

</head>

<body class="register-page" style="min-height: 570.8px;">
    <div class="register-box">
        <div class="register-logo">
            <a href="<?php echo URL_RESOURCES; ?>adminlte/index2.html"><b>LA</b>CASE</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a nuevo usuario</p>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nombre completo" name="nombre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Correo" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Usuario" name="user">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Repetir Contraseña" name="psw1">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Dirección" name="ubicacion">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-marker-alt"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="">terms</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>

                    </div>
                </form>
                <p class="mb-0">
                    <a href="<?php echo HTTP_BASE . '/login'; ?>" class="text-center">Ya tengo
                        cuenta.</a>
                </p>
            </div>

        </div>
    </div>


    <script src="<?php echo URL_RESOURCES; ?>js/jquery.min.js"></script>

    <script src="<?php echo URL_RESOURCES; ?>js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo URL_RESOURCES; ?>js/adminlte.min.js?v=3.2.0"></script>


</body>

</html>