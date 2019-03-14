<?php
$HOST = 'mysql:host=localhost; dbname=SecuenciaLab';
$USER = 'root';
$PASS = '';

try {
    $baseDatos = new PDO ($HOST, $USER, $PASS);
    $baseDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $baseDatos->exec("SET CHARACTER SET UTF8");
} catch(Exception $e) {
    die('Error al acceder a la base de datos: '. $e->GetMessage());
}
?>