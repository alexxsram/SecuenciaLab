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

try {
    $sql = "SELECT * FROM clase WHERE nrc = :nrc";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':nrc', $nrcClase);
    $resultado->execute();
    $clase = $resultado->fetch(PDO::FETCH_OBJ);
    $sql = "SELECT * FROM cicloescolar WHERE idCicloEscolar = :idCicloEscolar";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':idCicloEscolar', $clase->CicloEscolar_idCicloEscolar);
    $resultado->execute();
    $ciclo = $resultado->fetch(PDO::FETCH_OBJ);
?>

<div class="jumbotron">
    <div class="container">
        <blockquote class="blockquote text-center"> <h1 class="display-4"> <?php echo $clase->nombreClase; ?> </h1></blockquote>
        <p class="h5"> <?php echo "Clave de acceso: " . $clase->claveAcceso; ?>
          <button class="btn " style="background-color:transparent;" data-toggle="tooltip" title="Mostrar" onclick="exparndirClaveAcceso(<?php echo '\''.$clase->claveAcceso.'\'' ?>);">
            <i class="fas fa-sign-in-alt"></i>
          </button>
        </p>
        <p class="h5"> <small class="text-muted"><?php echo "Materia: " . $clase->nombreMateria; ?> </small></p>
        <p class="h6"> <small class="text-muted"><?php echo "Sección: " . $clase->claveSeccion; ?> </small></p>
        <p class="h6"> <small class="text-muted"><?php echo "Aula: " . $clase->aula; ?> </small></p>
        <p class="h6"> <small class="text-muted"><?php echo "Ciclo: " . $clase->anio . " " . $ciclo->ciclo; ?> </small></p>
        <p class="lead text-justify">
            En la siguiente sección, el profesor puede crear las practicas de laboratorio relacionadas al manual
        </p>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones de la clase
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" data-toggle="modal" href="#modalCrearPractica" data-claveacceso="<?php echo $clase->claveAcceso; ?>" data-nrc="<?php echo $clase->nrc; ?>"><i class="fas fa-clipboard"></i> Agregar práctica</a>
                <a class="dropdown-item" href="#">Calificar práctica</a>
            </div>
        </div>
        <button type="button" class="btn btn-danger" onclick="redireccionarPagina('index.php');">Regresar <i class="fas fa-arrow-left"></i></button>
    </div>
</div>

<?php
    $sql = "SELECT * FROM practica WHERE Clase_claveAcceso LIKE :claveAcceso";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':claveAcceso', $clase->claveAcceso);
    $resultado->execute();

    $numRow = $resultado->rowCount();
    if($numRow == 0) {
?>

<div class="row h-100 align-items-center">
    <div class="col-12 text-center">
        <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
            <h1 class="font-weight-light">La clase no cuenta con practicas que registrar</h1>
            <p class="lead">Es necesario que crees una practica para que la puedan visualizar tus alumnos.</p>
        <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
            <h1 class="font-weight-light">Bienvenido a la página del alumno.</h1>
            <p class="lead">Aquí podrás realizar tus practicas de tu(s) materias.</p>
        <?php } ?>
    </div>
</div>

<?php
    } else {
        $practicas = $resultado->fetchAll(PDO::FETCH_OBJ);
?>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No. práctica</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de entrega</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($practicas as $practica) { ?>
            <tr>
                <td class="text-center"> <?php echo $practica->idPractica; ?> </td>
                <td> <?php echo $practica->nombre; ?> </td>
                <td> <?php echo $practica->descripcion; ?> </td>
                <td> <?php echo $practica->fechaLimite; ?> </td>
                <td class="td-actions text-center">
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
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
