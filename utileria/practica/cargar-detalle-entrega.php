<?php
include('../operaciones/conexion.php');

$codigoAlumno = htmlentities(addslashes($_GET['codigoAlumno']));
$idPractica = htmlentities(addslashes($_GET['idPractica']));

try {
    if($codigoAlumno != '' && $idPractica != '') {
        $sql = 'SELECT * FROM cuestionario WHERE Practica_idPractica = :pip AND AlumnoUsuario_codigoAlumno = :auca';
        $resultado = $baseDatos->prepare($sql);
        $array = array(':pip'=>$idPractica, ':auca'=>$codigoAlumno);
        $resultado->execute($array);
        $cuestionario = $resultado->fetch(PDO::FETCH_OBJ);
?>

<div class="alert alert-light text-justify" role="alert">
    <h5 class="alert-heading">Respuesta de la pregunta 1</h5>
    <p><?php echo $cuestionario->respuestaPregunta1; ?></p>
</div>

<div class="alert alert-light text-justify" role="alert">
    <h5 class="alert-heading">Respuesta de la pregunta 2</h5>
    <p><?php echo $cuestionario->respuestaPregunta2; ?></p>
</div>

<div class="alert alert-light text-justify" role="alert">
    <h5 class="alert-heading">Respuesta de la pregunta 3</h5>
    <p><?php echo $cuestionario->respuestaPregunta3; ?></p>
</div>

<div class="alert alert-light text-justify" role="alert">
    <h5 class="alert-heading">Conclusión</h5>
    <p><?php echo $cuestionario->conclusion; ?></p>
</div>

<div class="alert alert-light text-justify" role="alert">
    <h5 class="alert-heading">Diagrama de control</h5>
    <button type="button" class="btn btn-sm btn-outline-success" onclick="descargarArchivo(<?php echo '\'' . $cuestionario->rutaArchivo . '\''; ?>);">Descargar archivo</button>
</div>

<div class="alert alert-light text-justify" role="alert">
    <form id="formCalificarPractica" name="formCalificarPractica" method="POST">
        <div class="form-group">
            <label for="nombreClase">Calificación de la practica *</label>
            <input type="number" class="form-control" id="nombreClase" name="nombreClase" placeholder="100" min="0" max="100" required="required">
        </div>

        <div class="form-group">
            <input type="hidden" class="form-control" id="codigoProfesorClase" name="codigoProfesorClase" value="<?php echo $cuestionario->Practica_idPractica; ?>" disabled="disabled">
        </div>
    </form>
</div>

<?php
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
