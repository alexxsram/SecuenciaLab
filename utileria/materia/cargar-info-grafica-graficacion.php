<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = $_POST['claveAcceso'];
  $claveUsuario = $_POST['claveUsuario'];
  $idPractica = $_POST['idPractica'];
  $nombrePractica = $_POST['nombrePractica'];
  $codigoAlumno = $_POST['codigoAlumno'];//Para confirmación

  $sql = "SELECT * FROM clase WHERE claveAcceso = :claveAcceso";
  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAcceso);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    $data = $baseDatos->query("SELECT AlumnoUsuario_codigoAlumno FROM clase_has_alumnousuario WHERE
      AlumnoUsuario_codigoAlumno = '$claveUsuario' and Clase_claveAcceso = '$claveAcceso'")->fetchAll();
      //$cuenta = mysql_num_rows($data);
      if(count($data)){
        $sql = "SELECT * FROM practica WHERE idPractica = :idPractica";
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':idPractica', $idPractica);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow != 0 or $idPractica==-1 or $idPractica==-2){
          $practica = $resultado->fetch(PDO::FETCH_OBJ);
          if(true){
            if( $idPractica==-1){//Todas las prácticas
              //calificacion para una practica de un alumno
              $dataPracticas = $baseDatos->query("SELECT * from practica where Clase_claveAcceso = '$claveAcceso'")->fetchAll();
              $dataCalificacion = $baseDatos->query("SELECT * FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE AlumnoUsuario_codigoAlumno = '$claveUsuario')")->fetchAll();
              $dataCuestionarios = $baseDatos->query("SELECT * FROM cuestionario WHERE AlumnoUsuario_codigoAlumno = '$claveUsuario'")->fetchAll();
              $cadenaGrafica = "[";
              //$cadenaGrafica = $cadenaGrafica . "{\"categoria\":\"" . "hola" . "\", \"calificacion\": 999, \"value\": {\"value1\": 5, \"value2\": -10}}";
              foreach ($dataPracticas as $rowPractica) {
                $calificacionEncontrada = false;
                $cadenaGrafica = $cadenaGrafica . "{\"categoria\":\"" . $rowPractica['nombre'] . "\", ";
                foreach ($dataCuestionarios as $rowCuestionario) {
                  if($rowCuestionario['Practica_idPractica'] == $rowPractica['idPractica']){
                    foreach ($dataCalificacion as $rowCalificacion) {
                      if($rowCuestionario['idCuestionario'] == $rowCalificacion['Cuestionario_idCuestionario']){
                        $calificacionEncontrada = true;
                        $cadenaGrafica = $cadenaGrafica . "\"calificacion\":" . $rowCalificacion['califiacion'] . ", \"value\": {\"value1\": 5, \"value2\": -10}}, ";
                        break;
                      }
                    }
                    break;
                  }
                }
                if(!$calificacionEncontrada){
                  $cadenaGrafica = $cadenaGrafica . "\"calificacion\": 0, \"value\": {\"value1\": 5, \"value2\": -10}}, ";
                }
              }
              $cadenaGrafica = substr($cadenaGrafica, 0, -2);
              $cadenaGrafica = $cadenaGrafica . "]";
              echo $cadenaGrafica;
              /*echo "[{
              \"categoria\": \"Alumno\",
              \"calificacion\": 999,
              \"value\": {\"value1\": 5, \"value2\": -10}
            }, {
            \"categoria\": \"Grupal\",
            \"calificacion\": 500,
            \"value\": {\"value1\": 3, \"value2\": 4}
          }]";*/
        }else if( $idPractica==-2){//Promedio alumno vs clase
          //calificacion para una practica de un alumno
          $data = $baseDatos->query("SELECT AVG(califiacion) AS promedio FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE AlumnoUsuario_codigoAlumno = '$claveUsuario')")->fetchAll();
          $promedioAlumno = -1;
          foreach ($data as $row) {
            $promedioAlumno = $row['promedio'];
          }
          if(!$promedioAlumno){
            $promedioAlumno=-1;
          }

          //Calcular promedio de todos los alumnos para una práctica
          $data = $baseDatos->query("SELECT AVG(califiacion) as promedio FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE Practica_idPractica IN (SELECT practica.idPractica FROM practica WHERE practica.Clase_claveAcceso = '$claveAcceso'))")->fetchAll();
          $promedioAlumnos = -1;
          foreach ($data as $row) {
            $promedioAlumnos = $row['promedio'];
          }
          if(!$promedioAlumnos){
            $promedioAlumnos=-1;
          }

          echo "[{
            \"categoria\": \"Alumno\",
            \"calificacion\": $promedioAlumno,
            \"value\": {\"value1\": 5, \"value2\": -10}
          }, {
            \"categoria\": \"Grupal\",
            \"calificacion\": $promedioAlumnos,
            \"value\": {\"value1\": 3, \"value2\": 4}
          }]";

        }else{
          //calificacion para una practica de un alumno
          $data = $baseDatos->query("SELECT califiacion FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE Practica_idPractica = '$idPractica' AND AlumnoUsuario_codigoAlumno = '$claveUsuario')")->fetchAll();
          $calificacionAlumnoPractica = -1;
          foreach ($data as $row) {
            $calificacionAlumnoPractica = $row['califiacion'];
          }
          if(!$calificacionAlumnoPractica){
            $calificacionAlumnoPractica=-1;
          }

          //Calcular promedio de todos los alumnos para una práctica
          $data = $baseDatos->query("SELECT AVG(califiacion) as promedio FROM evaluacion WHERE Cuestionario_idCuestionario IN (SELECT idCuestionario FROM cuestionario WHERE Practica_idPractica IN (SELECT practica.idPractica FROM practica WHERE practica.Clase_claveAcceso = '$claveAcceso' AND practica.idPractica = '$idPractica'))")->fetchAll();
          $promedioAlumnosPractica = -1;
          foreach ($data as $row) {
            $promedioAlumnosPractica = $row['promedio'];
          }
          if(!$promedioAlumnosPractica){
            $promedioAlumnosPractica=-1;
          }

          //Calcular Maximo de todos los alumnos para una práctica
          $data = $baseDatos->query("SELECT MAX(califiacion) as maximo FROM evaluacion WHERE evaluacion.Cuestionario_idCuestionario IN (SELECT cuestionario.idCuestionario FROM cuestionario WHERE cuestionario.Practica_idPractica IN (SELECT practica.idPractica from practica where practica.idPractica = '$idPractica' and practica.Clase_claveAcceso = '$claveAcceso'))")->fetchAll();
          $maximoAlumnosPractica = -1;
          foreach ($data as $row) {
            $maximoAlumnosPractica = $row['maximo'];
          }
          if(!$maximoAlumnosPractica){
            $maximoAlumnosPractica=-1;
          }

          //Calcular Minimo de todos los alumnos para una práctica
          $data = $baseDatos->query("SELECT MIN(califiacion) as minimo FROM evaluacion WHERE evaluacion.Cuestionario_idCuestionario IN (SELECT cuestionario.idCuestionario FROM cuestionario WHERE cuestionario.Practica_idPractica IN (SELECT practica.idPractica from practica where practica.idPractica = '$idPractica' and practica.Clase_claveAcceso = '$claveAcceso'))")->fetchAll();
          $minimoAlumnosPractica = -1;
          foreach ($data as $row) {
            $minimoAlumnosPractica = $row['minimo'];
          }
          if(!$minimoAlumnosPractica){
            $minimoAlumnosPractica=-1;
          }

          //Calcular Moda de todos los alumnos para una práctica
          $data = $baseDatos->query("SELECT califiacion as moda FROM evaluacion WHERE evaluacion.Cuestionario_idCuestionario IN (SELECT cuestionario.idCuestionario FROM cuestionario WHERE cuestionario.Practica_idPractica IN (SELECT practica.idPractica from practica where practica.idPractica = '$idPractica' and practica.Clase_claveAcceso = '$claveAcceso')) GROUP BY califiacion ORDER BY COUNT(*) DESC LIMIT 1")->fetchAll();
          $modaAlumnosPractica = -1;
          foreach ($data as $row) {
            $modaAlumnosPractica = $row['moda'];
          }
          if(!$modaAlumnosPractica){
            $modaAlumnosPractica=-1;
          }

          //Calcular Media de todos los alumnos para una práctica
          $data = $baseDatos->query("SELECT califiacion as media FROM evaluacion WHERE evaluacion.Cuestionario_idCuestionario IN (SELECT cuestionario.idCuestionario FROM cuestionario WHERE cuestionario.Practica_idPractica IN (SELECT practica.idPractica from practica where practica.idPractica = '$idPractica' and practica.Clase_claveAcceso = '$claveAcceso')) ORDER BY califiacion DESC ")->fetchAll();
          $numeroRegistrosMedia=0;
          $mediaAlumnosPractica = -1;
          foreach ($data as $row) {
            $numeroRegistrosMedia++;
          }
          if($numeroRegistrosMedia !=0){
            $numeroRegistrosMedia=round($numeroRegistrosMedia/2);
            $i=0;
            foreach ($data as $row) {
              if($i==$numeroRegistrosMedia){
                $mediaAlumnosPractica = $row['media'];
                break;
              }
              $i++;
            }
            if(!$mediaAlumnosPractica){
              $mediaAlumnosPractica=-1;
            }
          }

          echo "[{
            \"categoria\": \"Alumno\",
            \"calificacion\": $calificacionAlumnoPractica,
            \"value\": {\"value1\": 5, \"value2\": -10}
          }, {
            \"categoria\": \"Mínimo\",
            \"calificacion\": $minimoAlumnosPractica,
            \"value\": {\"value1\": 3, \"value2\": 4}
          }, {
            \"categoria\": \"Máximo\",
            \"calificacion\": $maximoAlumnosPractica,
            \"value\": {\"value1\": 15, \"value2\": 4}
          }, {
            \"categoria\": \"Promedio\",
            \"calificacion\": $promedioAlumnosPractica,
            \"value\": {\"value1\": 20, \"value2\": 4}
          }, {
            \"categoria\": \"Media\",
            \"calificacion\": $mediaAlumnosPractica,
            \"value\": {\"value1\": 3, \"value2\": 25}
          }, {
            \"categoria\": \"Moda\",
            \"calificacion\": $modaAlumnosPractica,
            \"value\": {\"value1\": 3, \"value2\": 4}
          }]";
        }
      }else{
        echo "Error. El id o nombre de la práctica es invalido.";
      }
    }else{
      echo "Error. El id de la práctica es invalido.";
    }
  }else{
    echo "Error. El alumno no se encuentra registrado en la clase indicada.";
  }
}else{
  echo "Error. La clave de acceso de la clase es invalida.";
}
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
