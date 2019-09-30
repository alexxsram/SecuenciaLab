<?php
session_start();
if(isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO' || $_SESSION['estado'] != 'INICIO_SESION_ADMON')) {
  header('Location: ../../index-clase.php');
}
else {
  header('Location: ../../index.php');
};
?>
