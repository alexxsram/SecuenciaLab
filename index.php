<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('utileria/encabezados/encabezado-css.php'); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/login-container.css">

    <title> SecuenciaLab </title>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 ads">
                <h1> <span id="fl">Secuencia</span><span id="sl">Lab</span> </h1>
                <br><br><br><br>
                <h5> Para descargar el simulador clic <span id="fl"> <a class="text-white" href="download-simulador.php">aquí</a> </span></h5>
            </div>

            <div class="col-md-6 login-form">
                <div class="profile-img">
                    <img src="images/login/avatar.jpg" alt="imagen_perfil" height="140px" width="140px">
                </div>

                <h3>Inicio de sesión a la plataforma</h3>

                <form id="formLogin" name="formLogin" method="POST">
                    <label for="claveUsuario"> <b> <i> Código de usuario * </i> </b> </label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"> <i class="fas fa-user"></i> </div>
                        </div>
                        <input type="text" id="claveUsuario" name="claveUsuario" class="form-control" placeholder="Ej. A215862742" required="required">
                    </div>

                    <label for="passwordUsuario"> <b> <i> Contraseña * </i> </b> </label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"> <i class="fas fa-lock"></i> </div>
                        </div>
                        <input type="password" id="passwordUsuario" name="passwordUsuario" class="form-control" required="required">
                    </div>

                    <div class="float-right">
                        <div class="input-group">
                            <button class="btn btn-sm btn-outline-primary" type="button" onclick="redireccionarPagina('registrar-usuario.php');">
                                Registrar <i class="fas fa-edit"></i>
                            </button>
                            
                            <button class="btn btn-sm btn-outline-success" type="submit">
                                Ingresar <i class="fas fa-sign-in-alt"></i>
                            </button>
                        </div>
                    </div>

                    <div class="input-group mb-2 mr-sm-2">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <button type="button" onclick="redireccionarPagina('restablecer-contrasena.php');" tabindex="5" class="btn btn-sm btn-link forgot-password">¿Has olvidado tu contraseña?</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer fixed-bottom py-2 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; SecuenciaLab</small>
        </div>
    </footer>

    <?php include('utileria/encabezados/encabezado-js.php'); ?>
</body>
</html>
