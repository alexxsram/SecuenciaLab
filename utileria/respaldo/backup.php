<?php 
$method = $_GET['method'];

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'secuencialab';

switch($method) {
    case 'export':
        $fecha = date('Ymd_His');
        $rutaDump = realpath('../../sql/backups').'\\'.$fecha.'\\';
        $filename = $database.'_'.$fecha.'.sql';
        if(!file_exists(is_dir($rutaDump))) {
            if(!mkdir($rutaDump, 0777, true)) {
                $error = error_get_last();
                echo $error['message'];
            }
        }
        $comando = "mysqldump -h {$host} -u {$user} -p {$password} --opt {$database} > {$rutaDump}{$filename}";
        exec($comando, $output, $resultado);
        switch($resultado) {
            case 0:
                echo 'success';
                break;
            case 1:
                echo 'Error al realizar la exportación';
                break;
        }
        break;
    case 'import':
        break;
}
?>