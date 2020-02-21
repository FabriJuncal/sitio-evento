<?php
  // Abrimos la sesion y comprobamos que exista la variable "$_GET['cerrar_sesion']" en el caso que si, cerramos la sesion  
  session_start();
  if(isset($_GET['cerrar_sesion'])){
    session_destroy();
  }
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
?>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a  href= "../index.php">
        <img class="img-login" src="../img/logo.svg" alt="Logo GDLWEBCAMP">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Inicia sesión aquí</p>
        <form name="login-admin-form" id="login-admin" method="post" action="insertar-admin.php">
          <div class="input-group mb-3">
            <input type="text" name="usuario" class="form-control" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="login-admin">
              <button type="submit"  class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->


<?php
  include_once 'templates/footer.php';
?>


