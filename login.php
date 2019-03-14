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
    <title> Bienvenido </title>
</head>
<body>

    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 ads">
                <h1> <span id="fl">Secuencia</span> <span id="sl">Lab</span> </h1>

                <div id="mensajeLogin"></div>
            </div>

            <div class="col-md-6 login-form">
                <div class="profile-img">
                    <img src="images/login/avatar.jpg" alt="imagen_perfil" height="140px" width="140px">
                </div>    

                <h3>Inicio de sesión a la plataforma</h3>

                <form id="formLogin" method="POST">
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
                            <button class="btn btn-outline-success" type="submit" href="#">
                                Log in <i class="fas fa-sign-in-alt"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('utileria/encabezados/encabezado-js.php'); ?>
    
</body>
</html>