<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo URL_RESOURCES; ?>adminlte/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="login-page" style="min-height: 496.8px;">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="#" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>

            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>

          </div>
        </form>
        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p>
      </div>

    </div>
  </div>


  <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/jquery/jquery.min.js"></script>

  <script src="<?php echo URL_RESOURCES; ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo URL_RESOURCES; ?>adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>


</body>

</html>