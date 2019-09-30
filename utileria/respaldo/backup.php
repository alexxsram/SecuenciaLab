<?php 
$method = $_POST['method'];

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'secuencialab';

switch($method) {
    case 'export':
        $fecha = date('Ymd_His');
        $rutaDump = realpath('../../backups').'\\'.$fecha.'\\';
        $filename = 'secuencialab_'.$fecha.'.sql';
        if(!file_exists($rutaDump)) {
            mkdir($rutaDump, 0777, true);
        }
        $comando = "(mysqldump -u {$user} -p {$password} {$database} > {$rutaDump}{$filename}) 2>&1";
        passthru($comando);
        die;
        // switch($resultado) {
        //     case 0:
        //         echo 'success';
        //         break;
        //     case 1:
        //         echo 'Error al realizar la exportación';
        //         break;
        // }
        break;
    case 'import':
        break;
}
?>