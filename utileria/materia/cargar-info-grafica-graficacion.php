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

          if($practica->idPractica == $idPractica or $idPractica==-1 or $idPractica==-2){
              //$data = $baseDatos->query("SELECT AlumnoUsuario_codigoAlumno FROM clase_has_alumnousuario WHERE
              //AlumnoUsuario_codigoAlumno = '$claveUsuario' and Clase_claveAcceso = '$claveAcceso'")->fetchAll();
            //Falta hacer función para optener los valores de las graficas
            echo "[{
              \"categoria\": \"Alumno\",
              \"calificacion\": 59,
              \"value\": {\"value1\": 5, \"value2\": -10}
            }, {
              \"categoria\": \"Mínimo\",
              \"calificacion\": 10,
              \"value\": {\"value1\": 3, \"value2\": 4}
            }, {
              \"categoria\": \"Máximo\",
              \"calificacion\": 100,
              \"value\": {\"value1\": 15, \"value2\": 4}
            }, {
              \"categoria\": \"Promedio\",
              \"calificacion\": 85,
              \"value\": {\"value1\": 20, \"value2\": 4}
            }, {
              \"categoria\": \"Media\",
              \"calificacion\": 77,
              \"value\": {\"value1\": 3, \"value2\": 25}
            }, {
              \"categoria\": \"Moda\",
              \"calificacion\": 85,
              \"value\": {\"value1\": 3, \"value2\": 4}
            }]";

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
