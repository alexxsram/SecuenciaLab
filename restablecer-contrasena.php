<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php include('utileria/encabezados/encabezado-css.php'); ?>
  <link rel="stylesheet" type="text/css" media="screen" href="css/login-container.css">

  <!-- Título de la página -->
  <title> SecuenciaLab - Restablecer contraseña </title>
</head>
<body>

  <div class="container login-container">
    <div class="row">
      <div class="col-md-6 ads">
        <h1> <span id="fl">Secuencia</span><span id="sl">Lab</span> </h1>
        <div id="mensajeRestablecerContrasena"></div>
      </div>
      <div class="col-md-6 login-form">
        <div class="profile-img">
          <img src="images/restore-password/forgot-password.png" alt="forgot_password" height="140px" width="140px">
        </div>

        <h3>Restaura tu contraseña en la plataforma</h3>
        <div class="alert alert-info text-justify" role="alert">
          Para poder restaurar su contraseña ingrese su ID de usuario y la respuesta correcta a la pregunta de seguridad.
        </div>

        <form id="formRestablecerContrasena" name="formRestablecerContrasena" method="POST">
          <label for="claveUsuario"> <b> <i> Clave de usuario </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="claveUsuario" name="claveUsuario" class="form-control" placeholder="Ej. 215862742" required="required">
          </div>

          <label for="respuestaPreguntaSeg"> <b> <i> Respuesta </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-question-circle"></i> </div>
            </div>
            <input type="text" id="respuestaSeguridad" name="respuestaSeguridad" class="form-control" required="required">
          </div>

          <label for="nuevoPasswordUsuario"> <b> <i> Nueva contraseña </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-lock"></i> </div>
            </div>
            <input type="password" id="nuevoPasswordUsuario" name="nuevoPasswordUsuario" class="form-control" required="required">
          </div>

          <label for="confirmNuevoPasswordUsuario"> <b> <i> Contraseña de nuevo </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-lock"></i> </div>
            </div>
            <input type="password" id="confirmNuevoPasswordUsuario" name="confirNuevoPasswordUsuario" class="form-control" required="required">
          </div>

          <div class="float-right">
            <div class="input-group">
              <button class="btn btn-outline-primary" type="button" onclick="location.href='login.php';">
                Regresar <i class="fas fa-arrow-left"></i>
              </button>
              <button class="btn btn-outline-success" type="submit">
                Recuperar <i class="fas fa-user-check"></i>
              </button>
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
