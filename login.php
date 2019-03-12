<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="fontawesome-free-5.7.2/css/all.css">

    <link rel="stylesheet" type="text/css" media="screen" href="css/login-container.css">

    <!-- Título de la página -->
    <title> Bienvenido </title>
</head>
<body>

    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 ads">
                <h1> <span id="fl">Secuencia</span> <span id="sl">Lab</span> </h1>
            </div>

            <div class="col-md-6 login-form">
                <div class="profile-img">
                    <img src="images/login/avatar.jpg" alt="imagen_perfil" height="140px" width="140px">
                </div>    

                <h3>Inicio de sesión a la plataforma</h3>

                <form method="GET" id="formLogin">
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

    <script src="js/jquery/jquery-3.3.1.slim.min.js"></script>
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/validation-form-plugin/jquery-validate.min.js"></script>
    <script src="js/validation-form-plugin/additional-methods.min.js"></script>
    <script src="js/validation-form-plugin/validacion-formularios.js"></script>
    <script defer src="fontawesome-free-5.7.2/js/all.js"></script>
</body>
</html>