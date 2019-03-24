<?php
session_start();
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
    header('Location: ../sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $estado = $_SESSION['estado'];
}
include('../operaciones/conexion.php');

$nrcClase = $_GET['nrcClase'];

$sql = "SELECT * FROM clase WHERE nrc = :nrc";
$resultado = $baseDatos->prepare($sql);
$resultado->bindValue(':nrc', $nrcClase);
$resultado->execute();

$clase = $resultado->fetch(PDO::FETCH_OBJ);
?>

<div class="jumbotron">
    <div class="container">
        <h1 class="display-4"> Clase: <?php echo $clase->nombreClase; ?> </h1>
        <p class="lead text-justify">
            En esta sección al profesor se le permite administrar las clases que imparte, ingresando a sus grupos, editar los datos generales
            de la clase en caso de error y/o eliminarla en el momento que desee.
        </p>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones de la clase <i class="fas fa-clipboard"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Agregar práctica</a>
                <a class="dropdown-item" href="#">Calificar práctica</a>
            </div>
        </div>
        <button type="button" class="btn btn-danger" onclick="redireccionarPagina('index.php');">Regresar <i class="fas fa-arrow-left"></i></button>
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name</th>
                <th>Job Position</th>
                <th>Since</th>
                <th class="text-right">Salary</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>Andrew Mike</td>
                <td>Develop</td>
                <td>2013</td>        
                <td class="text-right">€ 99,225</td>
                <td class="td-actions text-right">
                    <button type="button" rel="tooltip" class="btn btn-info btn-just-icon btn-sm" data-original-title="" title="">
                        <i class="material-icons">person</i>
                    </button>
                    
                    <button type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                    </button>
                    
                    <button type="button" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm" data-original-title="" title="">
                        <i class="material-icons">close</i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

