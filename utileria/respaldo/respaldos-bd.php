<?php
session_start();
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO' || $_SESSION['estado'] == 'INICIO_SESION_ADMIN')) {
    header('Location: ../sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $estado = $_SESSION['estado'];
    if(isset($_SESSION['permiso'])) {
        $permiso = $_SESSION['permiso'];
    }
    // $tiempo = $_SESSION['tiempo_sesion'];
    // if(time() - $tiempo >= 10){
    //     header('Location: utileria/sesion/cerrar-sesion.php');
    // }
    // else {
    //     $_SESSION['tiempo_sesion'] = time();
    // }
}
include('../operaciones/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('../encabezados/encabezado-css.1.php'); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/index.css">

    <title>Respaldos</title>
</head>
<body>
    <div class="container" style="margin-bottom: 6%;">
        <div class="jumbotron">
            <div class="container">
                <blockquote class="blockquote text-justify">
                    <h1 class="display-4"> <i class="fas fa-users"></i> Respaldos </h1>
                </blackquote>
                <p class="lead text-justify">
                    En esta sección, a los usuarios con el permiso "dba" se les permite realizar copias de seguridad de la base de datos en caso de alguna emergencia.
                    Por lo que un usuario al exportar la base de datos esta se guarda con el formato .sql e importar una base de datos en la versión que el usuario desee.
                </p>
                <button type="button" class="btn btn-sm btn-danger" onclick="window.close();">Regresar <i class="fas fa-arrow-left"></i></button>
            </div>
        </div>

        <div class="card border-dark mb-3" id="maindashboard" name="maindashboard">
            <div class="card-header bg-dark border-dark text-white">
                <div class="float-right">
                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="accionarBackup('method=export', 'respaldos-bd.php');">
                        <i class="fas fa-file-export"></i> Exportar base de datos
                    </button>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>

    <footer class="footer fixed-bottom py-2 bg-light shadow text-dark-50">
        <div class="container text-center">
            <small>Copyright &copy; SecuenciaLab</small>
        </div>
    </footer>

    <?php include('../../modals.php'); ?>

    <?php include('../encabezados/encabezado-js.1.php'); ?>
</body>