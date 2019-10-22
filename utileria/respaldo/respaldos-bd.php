<?php
session_start();
if(!isset($_SESSION['codigo']) && $_SESSION['permiso'] == '') {
    header('Location: ../sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $permiso = $_SESSION['permiso'];
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
        <!--<div id="loaderDiv" name="loaderDiv"><img src="..\..\images\loading\ajax-loader.gif"/></div>-->
        <div class="card border-dark mb-3" id="maindashboard" name="maindashboard">
            <div class="card-header bg-dark border-dark text-white">
                <div class="float-right">
                    <button name="btn-exportar-importar" id="btn-exportar-importar" type="button" class="btn btn-sm btn-outline-warning" onclick="accionarRespaldo('method=export', 'respaldos-bd.php');">
                        <i class="fas fa-file-export"></i> Exportar
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="loadingDiv" class="progress progress-striped active">
                    <div id="loadingbar" class="progress-bar" style="width: 0%; display: false;">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
                <br>

                <?php
                $fileBackups = realpath('../../sql/backups').'/backups.json';
                if(file_exists($fileBackups)) {
                    $json = file_get_contents($fileBackups);
                    $array = json_decode($json, true);
                    $dumps = $array['dumps'];
                    $total = count($dumps);
                ?>

                <div class="card table-responsive" style="border-radius: 5px;">
                    <table class="table table-hover table-stripped cart-wrap">
                        <thead class="text-muted">
                            <tr>
                                <th scope="col">Archivo SQL</th>
                                <th scope="col">Archivo de imágenes</th>
                                <th scope="col">Fecha de exportación</th>
                                <th scope="col" class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < $total; $i++) { ?>
                            <tr>
                                <td>
                                    <?php echo $dumps[$i]['sql_filename']; ?>
                                </td>
                                <td>
                                    <?php echo $dumps[$i]['zip_foldername']; ?>
                                </td>
                                <td>
                                    <?php echo $dumps[$i]['export_date']; ?>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="accionarRespaldo('method=import&sql_filename=<?php echo $dumps[$i]['sql_filename']; ?>&zip_foldername=<?php echo $dumps[$i]['zip_foldername']; ?>&path=<?php echo urlencode($dumps[$i]['path']); ?>', 'respaldos-bd.php');">
                                        <i class="fas fa-file-import"></i> Importar
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

              <?php } else { ?>
                <p class="lead text-justify">
                    No hay copias de seguridad disponibles.
                </p>
              <?php } ?>
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
