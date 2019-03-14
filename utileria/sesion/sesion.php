<?php
session_start();
if(isset($_SESSION['codigo']) && $_SESSION['estado'] == 'INICIO_SESION_PROFESOR') {
    header('Location: ../../index.php');
} 
else {
	header('Location: ../../login.php');
};
?>
