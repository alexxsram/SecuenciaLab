<?php
include('../operaciones/conexion.php');

$sql = 'SELECT * FROM profesorusuario';
$resultado = $baseDatos->prepare($sql);
$resultado->execute();

$pUsuarios = $resultado->fetchAll(PDO::FETCH_OBJ);

foreach($pUsuarios as $usuario) {
    $passwordHash = password_hash($usuario->password, PASSWORD_DEFAULT, array('cost' => 12));
}

// echo "<pre>";
// print_r($pUsuarios);
// die;
?>