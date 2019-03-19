<?php
session_start(); //aqui iniciamos la sesión
//require('utileria/sesion/duracion-sesion.php'); //con esto definimos la duración de la sesión actual
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php include('utileria/encabezados/encabezado-css.php'); ?>
  <link rel="stylesheet" type="text/css" media="screen" href="css/login-container.css">

  <!-- Título de la página -->
  <title> SecuenciaLab </title>
</head>
<body>

  <div class="container login-container">
    <div class="row">
      <div class="col-md-6 ads">
        <h1> <span id="fl">Secuencia</span><span id="sl">Lab</span> </h1>
        <div id="mensajeLogin"></div>
      </div>
      <div class="col-md-6 login-form">
        <div class="profile-img">
          <img src="images/login/avatar.jpg" alt="imagen_perfil" height="140px" width="140px">
        </div>

        <h3>Inicio de sesión a la plataforma</h3>

        <form id="formLogin" name="formLogin" method="POST">
          <label for="claveUsuario"> <b> <i> Clave de usuario </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="claveUsuario" name="claveUsuario" class="form-control" placeholder="Ej. 215862742" required="required">
          </div>

          <label for="passwordUsuario"> <b> <i> Contraseña </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-lock"></i> </div>
            </div>
            <input type="password" id="passwordUsuario" name="passwordUsuario" class="form-control" required="required">
          </div>

          <div class="float-right">
            <div class="input-group">
              <button class="btn btn-outline-primary" type="button" onclick="location.href='registrar-usuario.php';">
                Sing in <i class="fas fa-edit"></i>
              </button>
              <button class="btn btn-outline-success" type="submit">
                Log in <i class="fas fa-sign-in-alt"></i>
              </button>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-lg-12">
                <div class="text-center">
                  <a href="restablecer-contrasena.php" tabindex="5" class="forgot-password">¿Has olvidado tu contraseña?</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="page-footer font-small blue">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
      <h2>
        <span class="badge badge-light"> 
          © 2019 Copyright: <a href="https://secuenciaLab.com/"> secuenciaLab.com</a> 
        </span>
      </h2>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <?php include('utileria/encabezados/encabezado-js.php'); ?>
</body>
</html>
