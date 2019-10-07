<?php
session_start();
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO' || $_SESSION['estado'] == 'INICIO_SESION_ADMIN')) {
    header('Location: ../sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $estado = $_SESSION['estado'];
    $permiso = isset($_SESSION['permiso']) ? $_SESSION['permiso'] : '';
    // $tiempo = $_SESSION['tiempo_sesion'];
    // if(time() - $tiempo >= 10){
    //     header('Location: utileria/sesion/cerrar-sesion.php');
    // }
    // else {
    //     $_SESSION['tiempo_sesion'] = time();
    // }
}
include('../operaciones/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('../encabezados/encabezado-css.1.php'); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/index.css">

    <title>Permisos de usuario</title>
</head>
<body>
    <div class="container" style="margin-bottom: 6%;">
        <div class="jumbotron">
            <div class="container">
                <blockquote class="blockquote text-justify">
                    <h1 class="display-4"> <i class="fas fa-users"></i> Permisos de usuarios profesor</h1>
                </blackquote>
                <p class="lead text-justify">
                    En esta sección, los usuarios que tengan el permiso correspondiente podrán conceder ciertos permisos a otros usuarios.
                </p>
                <button type="button" class="btn btn-sm btn-danger" onclick="window.close();">Regresar <i class="fas fa-arrow-left"></i></button>
            </div>
        </div>

        <div class="card border-dark mb-3" id="maindashboard" name="maindashboard">
            <div class="card-header bg-dark border-dark text-white">Usuario: <?php echo $nombre; ?> <br> Permiso actual: <?php echo $permiso; ?></div>
            <div class="card-body">
                <?php
                $sql = 'SELECT * FROM profesorusuario WHERE codigoProfesor != :cp ORDER BY apellidoPaterno ASC';
                $resultado = $baseDatos->prepare($sql);
                $resultado->bindValue(':cp', $codigo);
                $resultado->execute();

                $numRow = $resultado->rowCount();

                if($numRow != 0) {
                    $limitePaginador = 10;
                    $paginas = ceil($numRow/$limitePaginador);
                    $profesores = $resultado->fetchAll(PDO::FETCH_OBJ);

                    if(!isset($_GET['pagina'])) {
                        header('Location: ./permiso-usuarios.php?pagina=1');
                    }
                ?>
                <div class="card table-responsive" style="border-radius: 5px;">
                    <table class="table table-hover table-stripped cart-wrap">
                        <thead class="text-muted">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col" class="text-center">Permiso</th>
                                <th scope="col" class="text-center">Conceder permiso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($profesores as $profesor) { 
                                $color = '';
                                if($profesor->permiso == 'dba') {
                                    $color = 'danger';
                                }
                                if($profesor->permiso == 'padmin') {
                                    $color = 'success';
                                }
                                if($profesor->permiso == 'pnormal') {
                                    $color = 'primary';
                                }
                            ?>
                            <tr>
                                <td>
                                    <?php echo $profesor->codigoProfesor; ?>
                                </td>
                                <td>
                                    <?php echo $profesor->apellidoPaterno . ' ' . $profesor->apellidoMaterno . ', ' . $profesor->nombrePila; ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-<?php echo $color; ?>"><?php echo $profesor->permiso; ?></span>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $noConcesionPermisoDba = '';
                                    $noConcesionPermisoPadmin = '';
                                    $noConcesionPermisoPnormal = '';

                                    if($permiso == 'dba') {
                                        $noConcesionPermisoDba = 'disabled="disabled"';
                                        if($profesor->permiso == $permiso) {
                                            $noConcesionPermisoPadmin = 'disabled="disabled"';
                                            $noConcesionPermisoPnormal = 'disabled="disabled"';
                                        }
                                        if($profesor->permiso == 'padmin') {
                                            $noConcesionPermisoPadmin = 'disabled="disabled"';
                                        }
                                        if($profesor->permiso == 'pnormal') {
                                            $noConcesionPermisoPnormal = 'disabled="disabled"';
                                        }
                                    }
                                    if($permiso == 'padmin') {
                                        $noConcesionPermisoDba = 'disabled="disabled"';
                                        if($profesor->permiso == 'dba') {
                                            $noConcesionPermisoPadmin = 'disabled="disabled"';
                                            $noConcesionPermisoPnormal = 'disabled="disabled"';
                                        }
                                        if($profesor->permiso == $permiso) {
                                            $noConcesionPermisoPadmin = 'disabled="disabled"';
                                        }
                                        if($profesor->permiso == 'pnormal') {
                                            $noConcesionPermisoPnormal = 'disabled="disabled"';
                                        }
                                    }
                                    ?>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="accionarConsulta('POST', '', 'actualizar-permiso.php', 'html', 'codigoProfesor=<?php echo $profesor->codigoProfesor; ?>&permiso=dba', 'permiso-usuarios.php');" <?php echo $noConcesionPermisoDba; ?>>
                                        dba
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="accionarConsulta('POST', '', 'actualizar-permiso.php', 'html', 'codigoProfesor=<?php echo $profesor->codigoProfesor; ?>&permiso=padmin', 'permiso-usuarios.php');"  <?php echo $noConcesionPermisoPadmin; ?>>
                                        padmin
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="accionarConsulta('POST', '', 'actualizar-permiso.php', 'html', 'codigoProfesor=<?php echo $profesor->codigoProfesor; ?>&permiso=pnormal', 'permiso-usuarios.php');"  <?php echo $noConcesionPermisoPnormal; ?>>
                                        pnormal
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation example" style="margin-top: 10px;">
                    <ul class="pagination">
                        <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="permiso-usuarios.php?pagina=<?php echo $_GET['pagina'] - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php for($i = 0; $i < $paginas; $i++) {  ?>
                            <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : ''; ?>">
                                <a class="page-link" href="permiso-usuarios.php?pagina=<?php echo $i + 1; ?>">
                                    <?php echo $i + 1; ?>
                                </a> 
                            </li>
                        <?php } ?>
                        <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : ''; ?>">
                        <a class="page-link" href="permiso-usuarios.php?pagina=<?php echo $_GET['pagina'] + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                        </li>
                    </ul>
                </nav>

                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="footer fixed-bottom py-2 bg-light shadow text-dark-50">
        <div class="container text-center">
            <small>Copyright &copy; SecuenciaLab</small>
        </div>
    </footer>

    <?php include('../../modals.php'); ?>

    <?php include('../encabezados/encabezado-js.1.php'); ?>
</body>