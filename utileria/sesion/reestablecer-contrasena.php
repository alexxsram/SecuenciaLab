<?php
include('../operaciones/conexion.php'); 

try {
	$claveUsuario = base64_decode($_GET['cu']);

	$aux = substr($claveUsuario, 0, 1);

	$codigoUsuario = '';
	$nombreUsuario = '';
	if($aux == 'A' || $aux == 'a') {
		$sql = 'SELECT * FROM alumnousuario WHERE codigoAlumno = :ca';
		$resultado = $baseDatos->prepare($sql);
		$resultado->bindValue(':ca', $claveUsuario);
		$resultado->execute();

		$alumno = $resultado->fetch(PDO::FETCH_OBJ);
		$codigoUsuario = $alumno->codigoAlumno;
		$nombreUsuario = $alumno->nombrePila . ' ' . $alumno->apellidoPaterno . ' ' . $alumno->apellidoMaterno;

		$password = password_hash(substr($codigoUsuario, 1), PASSWORD_DEFAULT, array('cost' => 13)); 
		$sql = 'UPDATE alumnousuario SET password = :p WHERE codigoAlumno = :ca';
		$resultado = $baseDatos->prepare($sql);
		$array = array(
			':p' => $password,
			':ca' => $codigoUsuario
		);
		$resultado->execute($array);
	}
	if(($aux == 'P' || $aux == 'p') || ($aux == 'M' || $aux == 'm')) {
		$sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor = :cp';
		$resultado = $baseDatos->prepare($sql);
		$resultado->bindValue(':cp', $claveUsuario);
		$resultado->execute();

		$profesor = $resultado->fetch(PDO::FETCH_OBJ);
		$codigoUsuario = $profesor->codigoProfesor;
		$nombreUsuario = $profesor->nombrePila . ' ' . $profesor->apellidoPaterno . ' ' . $profesor->apellidoMaterno;

		$password = password_hash(substr($codigoUsuario, 1), PASSWORD_DEFAULT, array('cost' => 13));
		$sql = 'UPDATE profesorusuario SET password = :p WHERE codigoProfesor = :cp';
		$resultado = $baseDatos->prepare($sql);
		$array = array(
			':p' => $password,
			':cp' => $codigoUsuario
		);
		$resultado->execute($array);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('../encabezados/encabezado-css.1.php'); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/login-container.css">

    <title> SecuenciaLab - Reinicio de contraseña </title>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 ads">
                <h1> <span id="fl">Secuencia</span><span id="sl">Lab</span> </h1>
            </div>
            <div class="col-md-6 login-form">

                <h3>Restablecimiento de contraseña</h3>

                <div class="alert alert-success text-justify" role="alert">
                    Usuario <b><?php echo $nombreUsuario; ?></b> con código <b><?php echo $codigoUsuario; ?></b>, tu contraseña ha sido restablecida correctamente. Puedes ingresar a la plataforma con tu nueva contraseña la cual se compone de los dígitos de tu código, posteriormente puedes actualizar tu contraseña si así lo deseas.                    
                </div>
            </div>
        </div>
    </div>

    <footer class="footer fixed-bottom py-2 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; SecuenciaLab</small>
        </div>
    </footer>
    
    <?php include('../encabezados/encabezado-js.1.php'); ?>
</body>
</html

<?php
} catch(Exception $exec) {
	die('Error en la base de datos: ' . $exec->getMessage());
}
?>