<?php
include('../../operaciones/conexion.php');

try {
  $codigoAlumno = $_POST['codigoAlumno'];
  $idPractica = $_POST['idPractica'];
  $claveDeAcceso = $_POST['claveAcceso'];
  //Estraer datos de una clase
  $sql = "SELECT *
  FROM cuestionario
  WHERE Practica_idPractica = :idPrac
  AND AlumnoUsuario_codigoAlumno = :codAlum";

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':idPrac', $idPractica);
  $resultado->bindValue(':codAlum', $codigoAlumno);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow != 0){
    $cuestionario = $resultado->fetch(PDO::FETCH_OBJ);
    echo "{\"ruta\": \"$cuestionario->rutaArchivo\",
      \"nombreOriginal\": \"$cuestionario->nombreOriginal\"}";
    }else{
      //echo "No hay cuestionario anterior: " . $numRow;
      echo "[{\"ruta\": \"no_hay_ruta\", \"nombreOriginal\": nombre_original}]";
    }
  } catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
  }
  ?>
