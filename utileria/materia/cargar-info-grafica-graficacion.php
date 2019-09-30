<?php
include('../operaciones/conexion.php');

try {
  $claveAcceso = $_POST['claveAcceso'];
  $claveUsuario = $_POST['claveUsuario'];
  $idPractica = $_POST['idPractica'];
  $nombrePractica = $_POST['nombrePractica'];
  $codigoAlumno = $_POST['codigoAlumno'];//Para confirmación

  $sql = "SELECT *
  FROM clase
  WHERE claveAcceso = :claveAcceso";

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':claveAcceso', $claveAcceso);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    $data = $baseDatos->query("SELECT AlumnoUsuario_codigoAlumno
      FROM clase_has_alumnousuario WHERE
      AlumnoUsuario_codigoAlumno = '$claveUsuario'
      AND Clase_claveAcceso = '$claveAcceso'")->fetchAll();

      //$cuenta = mysql_num_rows($data);
      if(count($data)){
        $sql = "SELECT *
        FROM practica
        WHERE idPractica = :idPractica";

        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':idPractica', $idPractica);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow != 0 or $idPractica==-1 or $idPractica==-2){
          $practica = $resultado->fetch(PDO::FETCH_OBJ);
          if(true){
            if( $idPractica==-1){//Todas las prácticas
              //calificacion para una practica de un alumno
              $dataPracticas = $baseDatos->query("SELECT *
                FROM practica
                WHERE practica.Clase_claveAcceso = '$claveAcceso' AND practica.eliminado = 0")->fetchAll();

                $dataCalificacion = $baseDatos->query("SELECT *
                  FROM evaluacion
                  WHERE Cuestionario_idCuestionario IN
                  (SELECT idCuestionario
                    FROM cuestionario
                    WHERE AlumnoUsuario_codigoAlumno = '$claveUsuario')")->fetchAll();

                    $dataCuestionarios = $baseDatos->query("SELECT *
                      FROM cuestionario
                      WHERE AlumnoUsuario_codigoAlumno = '$claveUsuario'")->fetchAll();

                      $cadenaGrafica = "[";
                      //$cadenaGrafica = $cadenaGrafica . "{\"categoria\":\"" . "hola" . "\", \"calificacion\": 999, \"value\": {\"value1\": 5, \"value2\": -10}}";
                      foreach ($dataPracticas as $rowPractica) {
                        $calificacionEncontrada = false;
                        $cadenaGrafica = $cadenaGrafica
                        . "{\"categoria\":\"" . $rowPractica['nombre'] . "\", ";
                          foreach ($dataCuestionarios as $rowCuestionario) {
                            if($rowCuestionario['Practica_idPractica'] == $rowPractica['idPractica']){
                              foreach ($dataCalificacion as $rowCalificacion) {
                                if($rowCuestionario['idCuestionario'] == $rowCalificacion['Cuestionario_idCuestionario']){
                                  $calificacionEncontrada = true;
                                  $cadenaGrafica = $cadenaGrafica
                                  . "\"calificacion\":"
                                  . $rowCalificacion['califiacion']
                                  . ", \"value\": {\"value1\": 5,
                                    \"value2\": -10}}, ";
                                    break;
                                  }
                                }
                                break;
                              }
                            }
                            if(!$calificacionEncontrada){
                              $cadenaGrafica = $cadenaGrafica
                              . "\"calificacion\": 0,
                              \"value\": {\"value1\": 5, \"value2\": -10}}, ";
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
                      $data = $baseDatos->query("SELECT AVG(califiacion) as promedio
                      FROM evaluacion
                      WHERE Cuestionario_idCuestionario IN
                      (SELECT idCuestionario
                        FROM cuestionario
                        WHERE Practica_idPractica IN
                        (SELECT practica.idPractica
                          FROM practica
                          WHERE Clase_claveAcceso = '$claveAcceso'
                          AND practica.eliminado = 0)
                          AND AlumnoUsuario_codigoAlumno = '$claveUsuario')")->fetchAll();
                        $promedioAlumno = -1;
                        foreach ($data as $row) {
                          $promedioAlumno = $row['promedio'];
                        }
                        if(!$promedioAlumno){
                          $promedioAlumno=-1;
                        }

                        //Calcular promedio de todos los alumnos para una práctica
                        /*$sql = 'SELECT EV.*, CU.*, PRAC.* FROM cuestionario CU INNER JOIN evaluacion EV ON EV.Cuestionario_idCuestionario = CU.idCuestionario INNER JOIN practica PRAC ON CU.Practica_idPractica = PRAC.idPractica WHERE PRAC.Clase_claveAcceso = :claveAcce';
                        $resultado = $baseDatos->prepare($sql);
                        $resultado->bindValue(':claveAcce', $claveAcceso);
                        $resultado->execute();
                        $numRow = $resultado->rowCount();
                        $data = $resultado->fetchAll(PDO::FETCH_OBJ);*/

                        $data = $baseDatos->query("SELECT AVG(califiacion) as promedio
                        FROM evaluacion
                        WHERE Cuestionario_idCuestionario IN
                        (SELECT idCuestionario
                          FROM cuestionario
                          WHERE Practica_idPractica IN
                          (SELECT practica.idPractica
                            FROM practica
                            WHERE practica.Clase_claveAcceso = '$claveAcceso' AND practica.eliminado = 0))")->fetchAll();
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
                            $data = $baseDatos->query("SELECT califiacion
                              FROM evaluacion
                              WHERE Cuestionario_idCuestionario IN
                              (SELECT idCuestionario
                                FROM cuestionario
                                WHERE Practica_idPractica = '$idPractica'
                                AND AlumnoUsuario_codigoAlumno = '$claveUsuario')")->fetchAll();
                                $calificacionAlumnoPractica = -1;
                                foreach ($data as $row) {
                                  $calificacionAlumnoPractica = $row['califiacion'];
                                }

                                //Calcular promedio de todos los alumnos para una práctica
                                $data = $baseDatos->query("SELECT AVG(califiacion) as promedio
                                FROM evaluacion
                                WHERE Cuestionario_idCuestionario IN
                                (SELECT idCuestionario
                                  FROM cuestionario
                                  WHERE Practica_idPractica IN
                                  (SELECT practica.idPractica
                                    FROM practica
                                    WHERE practica.Clase_claveAcceso = '$claveAcceso'
                                    AND practica.idPractica = '$idPractica'))")->fetchAll();
                                    $promedioAlumnosPractica = -1;
                                    foreach ($data as $row) {
                                      $promedioAlumnosPractica = $row['promedio'];
                                    }

                                    //Calcular Maximo de todos los alumnos para una práctica
                                    $data = $baseDatos->query("SELECT MAX(califiacion) as maximo
                                    FROM evaluacion
                                    WHERE evaluacion.Cuestionario_idCuestionario IN
                                    (SELECT cuestionario.idCuestionario
                                      FROM cuestionario
                                      WHERE cuestionario.Practica_idPractica IN
                                      (SELECT practica.idPractica
                                        FROM practica
                                        WHERE practica.idPractica = '$idPractica'
                                        AND practica.Clase_claveAcceso = '$claveAcceso'))")->fetchAll();
                                        $maximoAlumnosPractica = -1;
                                        foreach ($data as $row) {
                                          $maximoAlumnosPractica = $row['maximo'];
                                        }

                                        //Calcular Minimo de todos los alumnos para una práctica
                                        $data = $baseDatos->query("SELECT MIN(califiacion) as minimo
                                        FROM evaluacion
                                        WHERE evaluacion.Cuestionario_idCuestionario IN
                                        (SELECT cuestionario.idCuestionario
                                          FROM cuestionario
                                          WHERE cuestionario.Practica_idPractica IN
                                          (SELECT practica.idPractica
                                            FROM practica
                                            WHERE practica.idPractica = '$idPractica'
                                            AND practica.Clase_claveAcceso = '$claveAcceso'))")->fetchAll();
                                            $minimoAlumnosPractica = -1;
                                            foreach ($data as $row) {
                                              $minimoAlumnosPractica = $row['minimo'];
                                            }

                                            //Calcular Moda de todos los alumnos para una práctica
                                            $data = $baseDatos->query("SELECT califiacion as moda
                                              FROM evaluacion
                                              WHERE evaluacion.Cuestionario_idCuestionario IN
                                              (SELECT cuestionario.idCuestionario
                                                FROM cuestionario
                                                WHERE cuestionario.Practica_idPractica IN
                                                (SELECT practica.idPractica
                                                  FROM practica
                                                  WHERE practica.idPractica = '$idPractica'
                                                  AND practica.Clase_claveAcceso = '$claveAcceso'))
                                                  GROUP BY califiacion
                                                  ORDER BY COUNT(*)
                                                  DESC LIMIT 1")->fetchAll();
                                                  $modaAlumnosPractica = -1;
                                                  foreach ($data as $row) {
                                                    $modaAlumnosPractica = $row['moda'];
                                                  }

                                                  //Calcular Media de todos los alumnos para una práctica
                                                  $sql = 'SELECT EV.*, CU.*
                                                  FROM cuestionario CU
                                                  INNER JOIN evaluacion EV
                                                  ON EV.Cuestionario_idCuestionario = CU.idCuestionario
                                                  WHERE CU.Practica_idPractica = :idPrac
                                                  ORDER BY EV.califiacion DESC';
                                                  //$data = $baseDatos->query("SELECT califiacion as media FROM evaluacion WHERE evaluacion.Cuestionario_idCuestionario IN (SELECT cuestionario.idCuestionario FROM cuestionario WHERE cuestionario.Practica_idPractica = 7)")->fetchAll();
                                                  $resultado = $baseDatos->prepare($sql);
                                                  $resultado->bindValue(':idPrac', $idPractica);
                                                  $resultado->execute();
                                                  $numRowCalificadas = $resultado->rowCount();
                                                  $data = $resultado->fetchAll(PDO::FETCH_OBJ);
                                                  $numeroRegistrosMedia=$numRowCalificadas;
                                                  $mediaAlumnosPractica = -1;
                                                  if($numeroRegistrosMedia !=0){
                                                    $paridad = $numeroRegistrosMedia%2;
                                                    $numeroRegistrosMedia=round($numeroRegistrosMedia/2)-1;
                                                    $i=0;
                                                    foreach ($data as $row) {
                                                      if($i==$numeroRegistrosMedia){
                                                        $mediaAlumnosPractica = $row->califiacion;
                                                        break;
                                                      }
                                                      $i++;
                                                    }
                                                    if($paridad==0){
                                                      $i=0;
                                                      foreach ($data as $row) {
                                                        if($i==$numeroRegistrosMedia+1){
                                                          $mediaAlumnosPractica += $row->califiacion;
                                                          $mediaAlumnosPractica = $mediaAlumnosPractica /2;
                                                          break;
                                                        }
                                                        $i++;
                                                      }
                                                    }
                                                    /*if(!$mediaAlumnosPractica){
                                                    $mediaAlumnosPractica=-1;
                                                  }*/
                                                }
                                                //$mediaAlumnosPractica = $numeroRegistrosMedia;

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
