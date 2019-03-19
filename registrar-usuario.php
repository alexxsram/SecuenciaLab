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
        <h2> <span id="fl">Registrar nuevo usuario</span></h2>
        <div id="mensajeNuevoUsuario" name="mensajeNuevoUsuario"></div>
      </div>
      <div class="col-md-6 login-form">
        <div class="profile-img">
          <img src="images/login/avatar.jpg" alt="imagen_perfil" height="140px" width="140px">
        </div>

        <h3>Registrar nuevo usuario en la plataforma</h3>
        <form id="formNuevoUsuario" name="formNuevoUsuario" method="POST">
          <label for="claveUsuario"> <b> <i>Clave de usuario:</i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="claveUsuario" name="claveUsuario" class="form-control" placeholder="Ej. 215862742" value= "P215861738" required="required">
          </div>

          <label for="nombrePilaUsuario"> <b> <i>Nombre:</i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="nombrePilaUsuario" name="nombrePilaUsuario" class="form-control" placeholder="Ej. Pedro" value= "cristian" required="required">
          </div>

          <label for="apellidoPaternoUsuario"> <b> <i>Apellido paterno:</i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="apellidoPaternoUsuario" name="apellidoPaternoUsuario" class="form-control" placeholder="Ej. Ramirez" value= "castillo" required="required">
          </div>

          <label for="apellidoMaternoUsuario"> <b> <i>Apellido materno :</i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-user"></i> </div>
            </div>
            <input type="text" id="apellidoMaternoUsuario" name="apellidoMaternoUsuario" class="form-control" placeholder="Ej. Perez" value= "serrano" required="required">
          </div>

          <label for="emailUsuario"> <b> <i>Correo electrónico:</i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-at"></i> </div>
            </div>
            <input type="text" id="emailUsuario" name="emailUsuario" class="form-control" value= "agua_cristian@hotmail.com" required="required">
          </div>

          <div class="form-group">
            <label for="preguntaSeguridad"><b>Pregunta de seguridad:</b></label>
            <select name="cicloEscolar" class="custom-select">
              <option selected value="pregunta1">¿Cúal es el nombre de tu mejor amigo de la infancia?</option>
              <option value="pregunta2">¿Cúal es el nombre de la ciudad de tu primer viaje?</option>
              <option value="pregunta3">¿Cúal es el nombre de tu primera mascota?</option>
            </select>
          </div>

          <label for="respuestaPreguntaSeg"> <b> <i> Respuesta </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-question-circle"></i> </div>
            </div>
            <input type="text" id="respuestaSeguridad" name="respuestaSeguridad" value= "sebastian" class="form-control" required="required">
          </div>

          <label for="password"> <b> <i> Nueva contraseña </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-lock"></i> </div>
            </div>
            <input type="password" id="password" name="password" class="form-control" value= "123456789" required="required">
          </div>

          <label for="confirPassword"> <b> <i> Contraseña de nuevo </i> </b> </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> <i class="fas fa-lock"></i> </div>
            </div>
            <input type="password" id="confirPassword" name="confirPassword" class="form-control" value= "123456789" required="required">
          </div>

          <div class="float-right">
            <div class="input-group">
              <button class="btn btn-outline-success" type="submit" href="#">
                Registrarse
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
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
      <a href="https://secuenciaLab.com/"> secuenciaLab.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
  <?php include('utileria/encabezados/encabezado-js.php'); ?>
</body>
</html>
