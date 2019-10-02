<?php 
$method = $_GET['method'];

// $host = 'localhost';
// $user = 'root';
// $password = '';
// $database = 'secuencialab';

$host = 'localhost';
$user = 'id10689217_secuencialaboperaciones';
$password = 'develsecuencialab';
$database = 'id10689217_secuencialab';

switch($method) {
    case 'export':
        $rutaCarpetaBackups = realpath('../../sql/backups');
        $fecha = date('Ymd_His');
        $rutaDump = $rutaCarpetaBackups.'\\'.$fecha.'\\';
        $filename = $database.'_'.$fecha.'.sql';
        if(!file_exists(is_dir($rutaDump))) {
            if(!mkdir($rutaDump, 0777, true)) {
                $error = error_get_last();
                echo $error['message'];
            }
        }
        $comando = "mysqldump --host={$host} --user={$user} --password={$password} {$database} > {$rutaDump}{$filename}";
        exec($comando, $output, $resultado);
        switch($resultado) {
            case 0:
                echo 'success';
                break;
            case 1:
                echo 'Error al realizar la exportación de la base de datos';
                break;
        }
        break;
    case 'import':
        break;
}
?>