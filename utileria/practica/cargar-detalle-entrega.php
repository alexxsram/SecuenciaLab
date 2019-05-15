<?php
include('../operaciones/conexion.php');

$codigoAlumno = htmlentities(addslashes($_GET['codigoAlumno']));
$idPractica = htmlentities(addslashes($_GET['idPractica']));

try {
    if($codigoAlumno != '' && $idPractica != '') {
        $sql = 'SELECT P.*, C.* FROM cuestionario C INNER JOIN practica P ON P.idPractica = C.Practica_idPractica WHERE C.Practica_idPractica = :pip AND C.AlumnoUsuario_codigoAlumno = :auca';
        $resultado = $baseDatos->prepare($sql);
        $array = array(':pip'=>$idPractica, ':auca'=>$codigoAlumno);
        $resultado->execute($array);

        $numRow = $resultado->rowCount();
        if($numRow != 0) {
            $cuestionario = $resultado->fetch(PDO::FETCH_OBJ);
?>
<div class="card border-dark mb-3">
    <div class="card-header border-dark">
        Información de la práctica
    </div>

    <div class="card-body text-dark">
        <h5 class="card-title">Descripcion del problema</h5>
        <p class="card-text"><?php echo $cuestionario->descripcion; ?></p>

        <hr>

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
            <button type="button" class="btn btn-sm btn-outline-success" onclick="descargarArchivo(<?php echo '\'' . $cuestionario->rutaArchivo . '\''; ?> , <?php echo '\'' . $cuestionario->nombreOriginal . '\''; ?> );">Descargar archivo</button>
        </div>

        <form id="formCalificarPractica" name="formCalificarPractica" method="POST">
            <div class="alert alert-light text-justify" role="alert">
                <div class="form-group">
                    <label for="calificacion">Calificación de la practica *</label>
                    <input type="text" class="form-control" id="calificacion" name="calificacion" placeholder="0/100" min="0" max="100" required="required">
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" id="idCuestionario" name="idCuestionario" value="<?php echo $cuestionario->idCuestionario; ?>" disabled="disabled">
                </div>
                        
                <div class="form-group">
                    <input type="hidden" class="form-control" id="idPractica" name="idPractica" value="<?php echo $cuestionario->Practica_idPractica; ?>" disabled="disabled">
                </div>

                <div class="form-group ">
                    <button type="submit" class="btn btn-sm btn-outline-primary float-right">Calificar <i class="fas fa-save"></i> </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
        include('../encabezados/encabezado-js.1.php'); // con esto funciona el form  
        }
    }
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
