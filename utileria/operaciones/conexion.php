﻿<?php
// Descomentar para probar en local
// Hacer git checkout de este file para no subir los cambios de las cadenas de conexión local
// $HOST = 'mysql:host=localhost; dbname=secuencialab';
// $USER = 'root';
// $PASS = ''; // quitar esta contraseña y dejarla vacía

// Datos de conexión al server
$HOST = 'mysql:host=localhost; dbname=u952941344_secuencialab1';
$USER = 'u952941344_admi';//'id11295144_adminsecuencialab1';
$PASS = 'secuencialabcucei'; // quitar esta contraseña y dejarla vacía

try {
	$baseDatos = new PDO ($HOST, $USER, $PASS);
  	$baseDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$baseDatos->exec("SET CHARACTER SET UTF8");
} catch(Exception $exec) {
	die('Error al acceder a la base de datos: '. $exec->GetMessage());
}
?>
