<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Confecciones Nuevo Mundo System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../public/templates/AdminLTE-3.2.0//plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../public/templates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <!-- Notificaciones -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition login-page">
<div class="login-box">

  <?php
  session_start();
  if(isset($_SESSION['mensaje'])){
      $respuesta = $_SESSION['mensaje'];?>
      <script>
        Swal.fire({
          position: "center",
          icon: "error",
          title: "<?php echo  $respuesta ?>",
          showConfirmButton: false,
          text: "Usuario o contraseña incorrectos!",
          timer: 1000,
          backdrop: false, // Evita oscurecer el fondo
        });
      </script>
  <?php
  unset($_SESSION['mensaje']);
  }

  if(isset($_SESSION['msj_noexiste'])){
    $respuesta = $_SESSION['msj_noexiste'];?>
    <script>
      Swal.fire({
        position: "center",
        title: "<?php echo  $respuesta ?>",
        showConfirmButton: false,
        icon: "question",
        timer: 1000,
        backdrop: false, // Evita oscurecer el fondo
      });
    </script>
  <?php
  unset($_SESSION['msj_noexiste']);
  }

  if(isset($_SESSION['msj_llenar'])){
    $respuesta = $_SESSION['msj_llenar'];?>
    <script>
      Swal.fire({
        position: "center",
        icon: "info",
        title: "<?php echo  $respuesta ?>",
        showConfirmButton: false,
        timer: 1000,
        backdrop: false, // Evita oscurecer el fondo
      });
    </script>
  <?php
  unset($_SESSION['msj_llenar']);
  }
  ?>

  <!-- /.login-logo -->
   <center>
    <img src="https://img.freepik.com/vector-gratis/gente-haciendo-dinero-ilustracion-concepto-referencia_52683-22927.jpg?t=st=1739476028~exp=1739479628~hmac=f72653f793bb3f323ed2ef0e1a382dfb1dbb62a31da673d24524131f97bfd6ed&w=900" 
    alt="" width="300px">
   </center>
   <br>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../public/templates/AdminLTE-3.2.0/index2.html" class="h1"><b>Sistema</b> de Ventas</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Ingrese sus datos</p>

      <form action="../../recursos/controllers/login/login_controler.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_user" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <!-- btn ingresar -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../public/templates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../public/templates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>
