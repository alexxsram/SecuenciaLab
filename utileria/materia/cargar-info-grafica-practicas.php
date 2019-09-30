<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = $_POST['claveAcceso'];
  $claveUsuario = $_POST['claveUsuario'];
  //Estraer datos de una clase
  $sql = "SELECT * FROM practica
  WHERE Clase_claveAcceso = :Clase_claveAcceso AND eliminado != true";

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':Clase_claveAcceso', $claveAcceso);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    echo "<li class=\"list-group-item active disabled\">Lista de prácticas</li>";

    echo "<button id=\"info-alumno-btn-promedio-calificacion\"
    name=\"info-alumno-btn-promedio-calificacion\" type=\"button\"
    class=\"list-group-item list-group-item-action\"
    value=-1
    onclick=\"cargarGraficaDePractica('-2', 'Promedio', '$claveUsuario');\">
    Promedio</button>";

    echo "<button id=\"info-alumno-btn-todas-practica\"
    name=\"info-alumno-btn-todas-practica\" type=\"button\"
    class=\"list-group-item list-group-item-action\"
    value=-1
    onclick=\"cargarGraficaDePractica('-1', 'Todas las prácticas', '$claveUsuario');\">
    Todas las prácticas</button>";

    $practicasClase = $resultado->fetchAll(PDO::FETCH_OBJ);
    foreach ($practicasClase as $practica) {
      if(true){//$practica->nombre != "Evaluación difusa de la clase"
        $cuestionarioEntregado = false;
        $sql = 'SELECT EV.*, CU.*
        FROM cuestionario CU
        INNER JOIN evaluacion EV
        ON EV.Cuestionario_idCuestionario = CU.idCuestionario
        WHERE CU.Practica_idPractica = :pracIdPrac
        AND CU.AlumnoUsuario_codigoAlumno = :alumCod';
        //$sql = "SELECT * FROM cuestionario WHERE Practica_idPractica = :pracIdPrac and AlumnoUsuario_codigoAlumno = :alumCod";
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':pracIdPrac', $practica->idPractica);
        $resultado->bindValue(':alumCod', $claveUsuario);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow == 1){
          $cuestionario = $resultado->fetch(PDO::FETCH_OBJ);
          $cuestionarioEntregado = true;
        }
        $elementoListaPracticas = "<li id=\"info-alumno-btn-practica\"
        name=\"info-alumno-btn-practica\" type=\"button\"
        class=\"list-group-item list-group-item-action
        d-flex justify-content-between align-items-center\"
        value=$practica->idPractica
        onclick=\"cargarGraficaDePractica('$practica->idPractica', '$practica->nombre', '$claveUsuario');\">
        ";
        $botonDescargarPractica = "";
        if($cuestionarioEntregado){
          $calificacionPractica = $cuestionario->califiacion;
          if($calificacionPractica == 0) {
            $colorEstado = 'secondary';
          } else if($calificacionPractica >= 1 and $calificacionPractica <= 59) {
            $colorEstado = 'danger';
          } else if($calificacionPractica >= 60 and $calificacionPractica <= 70) {
            $colorEstado = 'warning';
          } else if($calificacionPractica >= 71 and $calificacionPractica <= 90) {
            $colorEstado = 'primary';
          }else if($calificacionPractica >= 91 and $calificacionPractica <= 100) {
            $colorEstado = 'success';
          } else {
            $colorEstado = 'muted';
          }
          $rutaArchivo = substr($cuestionario->rutaArchivo, 6, strlen($cuestionario->rutaArchivo));
          $claveAccessoBase64 = base64_encode($claveAcceso);
          $codigoAlumnoBase64 = base64_encode($claveUsuario);
          $idPracticaBase64 = base64_encode($practica->idPractica);
          $span = "<span class=\"badge badge-$colorEstado\">
          $calificacionPractica</span>";

          $botonDescargarPractica = "<div>";
          $botonDescargarPractica .= "<button type=\"button\"
          class=\"btn btn-sm btn-outline-success\"
          onclick=\"cargarContenido('DOCS/examples/',
          'reporte-una-practica-alumno.php',
          'claveAccesoClase=$claveAccessoBase64
          &codigoAlumno=$codigoAlumnoBase64
          &idPractica=$idPracticaBase64');\">Reporte</button>";

          $botonDescargarPractica .= "<button type=\"button\"
          class=\"btn btn-sm btn-outline-success\"
          onclick=\"descargarArchivo('$rutaArchivo',
          '$cuestionario->nombreOriginal');\">Diagrama</button>";

          $botonDescargarPractica .= "</div>";
        }else{
          $span = "<span class=\"badge badge-secondary\">0</span>";
          $botonDescargarPractica = "<div>";
          $botonDescargarPractica .= "<button type=\"button\"
          class=\"btn btn-sm btn-outline-danger\"
          disabled>Reporte</button>";

          $botonDescargarPractica .= "<button type=\"button\"
          class=\"btn btn-sm btn-outline-danger\"
          disabled>Diagrama</button>";
          $botonDescargarPractica .= "</div>";
        }
        if($practica->nombre == "Evaluación difusa de la clase"){
          $botonDescargarPractica = "";
        }
        $elementoListaPracticas = $elementoListaPracticas
        . "<h6 style=\"font-size: 12px;\">" . $span. " - "
        . $practica->nombre  . "</h6>" . $botonDescargarPractica . "</li>";
        echo $elementoListaPracticas;
      }
    }
  }else{
    echo "<p class=\"card-text\"
    id=\"info-alumno-promedio-alumno\"
    name=\"info-alumno-promedio-alumno\">
    <b>No hay prácticas relacionadas con la clase.</b></p>";
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
