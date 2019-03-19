<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php include('utileria/encabezados/encabezado-css.php'); ?>
  <link rel="stylesheet" type="text/css" media="screen" href="css/login-container.css">

  <!-- Título de la página -->
  <title> SecuenciaLab - Registrar Usuario </title>
</head>
<body>

  <div class="container login-container">
    <div class="row">
      <div class="col-md-6 ads">
        <h1> <span id="fl">Secuencia</span><span id="sl">Lab</span> </h1>
        <div id="mensajeNuevoUsuario"></div>
      </div>
      <div class="col-md-6 login-form">
        <div class="profile-img">
          <img src="images/login/avatar.jpg" alt="imagen_perfil" height="140px" width="140px">
        </div>

        <h3>Registrar nuevo usuario en la plataforma</h3>
        <div class="alert alert-info text-justify" role="alert">
          Los campos con (*) son obligatorios
        </div>

        <form id="formNuevoUsuario" name="formNuevoUsuario" method="POST">
          <label for="claveUsuario"> <b> <i> Clave de usuario * </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="claveUsuario" name="claveUsuario" class="form-control" placeholder="Ej. P215861738" required="required">
          </div>

          <label for="nombrePilaUsuario"> <b> <i> Nombre * </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="nombrePilaUsuario" name="nombrePilaUsuario" class="form-control" placeholder="Ej. Cristian" required="required">
          </div>

          <label for="apellidoPaternoUsuario"> <b> <i> Apellido paterno * </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="apellidoPaternoUsuario" name="apellidoPaternoUsuario" class="form-control" placeholder="Ej. Castillo" required="required">
          </div>

          <label for="apellidoMaternoUsuario"> <b> <i> Apellido materno * </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="apellidoMaternoUsuario" name="apellidoMaternoUsuario" class="form-control" placeholder="Ej. Serrano" required="required">
          </div>

          <label for="emailUsuario"> <b> <i>Correo electrónico * </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-at"></i> </div>
            </div>
            <input type="text" id="emailUsuario" name="emailUsuario" class="form-control" placeholder="Ej. agua_cristian@hotmail.com" required="required">
          </div>

          <div class="form-group">
            <label for="preguntaSeguridad"> <b> <i> Pregunta de seguridad * </i> </b> </label>
            <select id="preguntaSeguridad" name="preguntaSeguridad" class="custom-select">
              <option value="">Selecciona...</option>
              <option value="pregunta1">¿Cúal es el nombre de tu mejor amigo de la infancia?</option>
              <option value="pregunta2">¿Cúal es el nombre de la ciudad de tu primer viaje?</option>
              <option value="pregunta3">¿Cúal es el nombre de tu primera mascota?</option>
            </select>
          </div>

          <label for="respuestaSeguridad"> <b> <i> Respuesta * </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-question-circle"></i> </div>
            </div>
            <input type="text" id="respuestaSeguridad" name="respuestaSeguridad" placeholder= "Ej. sebastian" class="form-control" required="required">
          </div>

          <label for="passwordUsuario"> <b> <i> Nueva contraseña * </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-lock"></i> </div>
            </div>
            <input type="password" id="passwordUsuario" name="passwordUsuario" class="form-control" placeholder="Ej. 123456789" required="required">
          </div>

          <label for="confirmPasswordUsuario"> <b> <i> Contraseña de nuevo * </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-lock"></i> </div>
            </div>
            <input type="password" id="confirmPasswordUsuario" name="confirmPasswordUsuario" class="form-control" placeholder="Ej. 123456789" required="required">
          </div>

          <div class="float-right">
            <div class="input-group">
              <button class="btn btn-outline-primary" type="button" onclick="location.href='login.php';">
                Regresar <i class="fas fa-arrow-left"></i>
              </button>
              <button class="btn btn-outline-success" type="submit">
                Registrarse <i class="fas fa-user-check"></i>
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
