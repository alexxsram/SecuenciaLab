<?php
include('../operaciones/conexion.php');

date_default_timezone_get('America/Mexico_City'); // Para la zona horaria del centro

try {
  $respuestaPregunta1 = htmlentities(addslashes($_POST['respuestaPregunta1']));
  $respuestaPregunta2 = htmlentities(addslashes($_POST['respuestaPregunta2']));
  $respuestaPregunta3 = htmlentities(addslashes($_POST['respuestaPregunta3']));
  $conclusion = htmlentities(addslashes($_POST['conclusion']));
  $fechaEntrega = date('Y-m-d H:i:s');

  $nombreArchivo = $_FILES['nombreArchivo']['name']; // nombre del archivo
  $tmpArchivo = $_FILES['nombreArchivo']['tmp_name']; // nombre del temporal del archivo
  $tamanoArchivo = $_FILES['nombreArchivo']['size']; // tamaño del archivo

  $idPractica = htmlentities(addslashes($_POST['idPractica']));
  $codigoAlumno = htmlentities(addslashes($_POST['codigoAlumno']));

  //Convertir elementos de texto en codificación UTF-8
  $respuestaPregunta1 = html_entity_decode($respuestaPregunta1, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $respuestaPregunta2 = html_entity_decode($respuestaPregunta2, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $respuestaPregunta3 = html_entity_decode($respuestaPregunta3, ENT_QUOTES | ENT_HTML401, 'UTF-8');
  $conclusion = html_entity_decode($conclusion, ENT_QUOTES | ENT_HTML401, 'UTF-8');

  $sql = 'SELECT *
  FROM alumnousuario
  WHERE codigoAlumno = :ca';

  $resultado = $baseDatos->prepare($sql);
  $resultado->bindValue(':ca', $codigoAlumno);
  $resultado->execute();
  $numRow = $resultado->rowCount();
  if($numRow == 0) {
    echo 'Error. No se pudo encontrar al alumno, no es posible subir la práctica.';
  } else {
    $alumno = $resultado->fetch(PDO::FETCH_OBJ);
    $nombreAlumno = $alumno->apellidoPaterno . '-'
    . $alumno->apellidoMaterno . '-' . $alumno->nombrePila;
    $directorio = '../../images/files/';
    //$directorio = $directorio . $nombreAlumno . '/';
    if(!file_exists($directorio)) {
      mkdir($directorio, 0777, true);
    }

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

    $sql = 'SELECT *
    FROM cuestionario
    WHERE Practica_idPractica = :pracIdPrac
    AND AlumnoUsuario_codigoAlumno = :AlumCod';

    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':pracIdPrac', $idPractica);
    $resultado->bindValue(':AlumCod', $codigoAlumno);
    $resultado->execute();
    $numRow = $resultado->rowCount();
    $flagPrimeraVezCuestionario=true;
    if($numRow == 0) {
      //Esto se realiza si es la primera vez que el alumno sube el cuestionario
      $cadena_base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $cadena_base .= '0123456789';
      $limite = strlen($cadena_base) - 1;
      $nombreArchivoClave = '';
      for($i=0; $i < 10; $i++) {
        $nombreArchivoClave .= $cadena_base[rand(0, $limite)];
      }
      $nombreArchivoClave = $nombreArchivoClave.'.'.$imageFileType;
    }else{
      $flagPrimeraVezCuestionario = false;
      $cuestionarioAnterior = $resultado->fetch(PDO::FETCH_OBJ);
      $nombreArchivoClave = substr($cuestionarioAnterior->nombreClave, 0, 10) . '.' . $imageFileType;
    }
    $target_file = $directorio . $nombreArchivoClave;
    // Comprobar si el archivo es una imagen
    $check = getimagesize($tmpArchivo);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      echo 'El archivo no es una imagen.';
      $uploadOk = 0;
    }
    // Comprobar el tamaño de la imagen
    $tamanoMegas = 10;
    if($tamanoArchivo > ($tamanoMegas * 1000000)) {
      echo 'Error. El tamaño de la imagen es muy grande.
      El tamaño máximo permitido es de: ' . $tamanoMegas . ' MB.';
      echo 'Su archivo pesa: ' . $tamanoArchivo / 1000000 . ' MB.';
      $uploadOk = 0;
    }
    // Comrpobar formato de los archivos
    if($imageFileType != 'jpg'
    && $imageFileType != 'png'
    && $imageFileType != 'jpeg'
    && $imageFileType != 'gif'
    && $imageFileType != 'pdf') {
      echo 'Error. Solo se permiten archivos JPG, JPEG, PNG, GIF y PDF.';
      $uploadOk = 0;
    }
    // Revisar si $uploadOk tiene u valor 0 por cualquier error
    if($uploadOk == 0) {
      echo 'Error. Tu archivo no fue subido correctamente.';
    } else {
      if(move_uploaded_file($tmpArchivo, $target_file)) {
        if($flagPrimeraVezCuestionario){
          $sql = 'INSERT INTO cuestionario
           (respuestaPregunta1, respuestaPregunta2, respuestaPregunta3,
             conclusion, fechaEntrega, rutaArchivo, Practica_idPractica,
              AlumnoUsuario_codigoAlumno, nombreClave, nombreOriginal)
              VALUES (:rp1, :rp2, :rp3, :c, :fe, :ra, :pip, :auca, :nc, :no)';

          $resultado = $baseDatos->prepare($sql);
          $array = array(':rp1'=>$respuestaPregunta1,
          ':rp2'=>$respuestaPregunta2,
          ':rp3'=>$respuestaPregunta3,
          ':c'=>$conclusion,
          ':fe'=>$fechaEntrega,
          ':ra'=>$target_file,
          ':pip'=>$idPractica,
          ':auca'=>$codigoAlumno,
          ':nc'=>$nombreArchivoClave,
          ':no'=>$nombreArchivo);
          $resultado->execute($array);
          echo 'success';
        }else{
          $sql = 'UPDATE cuestionario
          SET respuestaPregunta1 = :rp1,
          respuestaPregunta2 = :rp2,
          respuestaPregunta3 = :rp3,
          conclusion = :c,
          fechaEntrega = :fe,
          rutaArchivo = :ra,
          Practica_idPractica = :pip,
          AlumnoUsuario_codigoAlumno = :auca,
          nombreClave = :nc,
          nombreOriginal = :no
          WHERE idCuestionario = :idCues';

          $resultado = $baseDatos->prepare($sql);
          $array = array(':rp1'=>$respuestaPregunta1,
          ':rp2'=>$respuestaPregunta2,
          ':rp3'=>$respuestaPregunta3,
          ':c'=>$conclusion,
          ':fe'=>$fechaEntrega,
          ':ra'=>$target_file,
          ':pip'=>$idPractica,
          ':auca'=>$codigoAlumno,
          ':nc'=>$nombreArchivoClave,
          ':no'=>$nombreArchivo,
          'idCues'=>$cuestionarioAnterior->idCuestionario);
          $resultado->execute($array);
          echo 'success';
        }
      } else {
        echo 'Error. Hubo un error subiendo el archivo.';
      }
    }
  }
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
