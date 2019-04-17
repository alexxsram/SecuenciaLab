<?php
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
    header('Location: utileria/sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $estado = $_SESSION['estado'];
}
include('utileria/operaciones/conexion.php');
?>

<div class="masthead">
    <div class="container h-100" id="contenidoClase">
        <?php
        $sql = "SELECT * FROM clase WHERE ProfesorUsuario_codigoProfesor = :codigoProfesor ORDER BY anio DESC, nombreClase ASC, CicloEscolar_idCicloEscolar ASC";
        $resultado = $baseDatos->prepare($sql);
        $resultado->bindValue(':codigoProfesor', $codigo);
        $resultado->execute();
        $numRow = $resultado->rowCount();
        if($numRow == 0) {
        ?>

        <div class="row h-100 align-items-center">
            <div class="col-12 text-center">
                <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                    <h1 class="font-weight-light">Bienvenido a la página de administración del profesor</h1>
                    <p class="lead">Aquí podrás realizar todo lo necesario para llevar un control de tu(s) clase(s).</p>
                <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
                    <h1 class="font-weight-light">Bienvenido a la página del alumno.</h1>
                    <p class="lead">Aquí podrás realizar tus practicas de tu(s) materias.</p>
                <?php } ?>
            </div>
        </div>

        <?php
        } else {
        ?>

        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4"> <i class="fas fa-users"></i> Listado de clases</h1>
                <p class="lead text-justify">
                    En esta sección podrá administrar las clases que imparte, ingresando a sus grupos, editar los datos generales
                    de la clase en caso de error y/o eliminarla en el momento que desee.
                </p>
            </div>
        </div>

        <div class="row h-100" style="margin-top: -1%;">

            <?php
            $clases = $resultado->fetchAll(PDO::FETCH_OBJ);
            foreach ($clases as $clase) {
              $sql = "SELECT * FROM clase_has_alumnousuario WHERE Clase_claveAcceso= :Clase_claveAcceso";
              $resultado = $baseDatos->prepare($sql);
              $resultado->bindValue(':Clase_claveAcceso', $clase->claveAcceso);
              $resultado->execute();
              $numeroAlumnos = $resultado->rowCount();

              $sql = "SELECT * FROM cicloescolar WHERE idCicloEscolar = :idCicloEscolar";
              $resultado = $baseDatos->prepare($sql);
              $resultado->bindValue(':idCicloEscolar', $clase->CicloEscolar_idCicloEscolar);
              $resultado->execute();
              $ciclo = $resultado->fetch(PDO::FETCH_OBJ);

            ?>

            <!-- Aqui voy a cargar las clases -->
            <div class="col-lg-3 col-md-6 col-sm-12 py-2">
                <div class="card border-success">
                    <img class="card-img" src="images/index/fondo-card.jpg" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title border-bottom pb-2" style="text-align: center; font-size: 18.5px; font-family: 'Candara';"> <i> <b> <?php echo $clase->nombreClase; ?> </b> </i></h4>
                        <p class="card-text text-center" style="font-size: 12.5px;">
                            <b>NRC:</b> <?php echo $clase->nrc . " - " . $clase->anio . " " . $ciclo->ciclo; ?> <br>
                            <b>Sección:</b> <?php echo $clase->claveSeccion; ?> <br>
                            <b>Alumnos:</b> <?php echo $numeroAlumnos; ?> <br>
                        </p>
                        <div class="text-center">
                            <!-- <div class="btn-group"> -->
                                <button type="button" class="btn btn-sm btn-success" onclick="cargarContenido('contenidoClase', 'utileria/materia/', 'ingresar-materia.php', 'claveAccesoClase=' + <?php echo '\'' . $clase->claveAcceso . '\''; ?>);">Entrar <i class="fas fa-door-open"></i></button>
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalEditarClase"
                                data-claveacceso="<?php echo $clase->claveAcceso; ?>"
                                data-nombremateria="<?php echo $clase->nombreMateria; ?>"
                                data-nrc="<?php echo $clase->nrc; ?>"
                                data-claveseccion="<?php echo $clase->claveSeccion; ?>"
                                data-nombreclase="<?php echo $clase->nombreClase; ?>"
                                data-aula="<?php echo $clase->aula; ?>"
                                data-anio="<?php echo $clase->anio; ?>"
                                data-cicloescolar="<?php echo $clase->CicloEscolar_idCicloEscolar; ?>"
                                data-codigoprofesor="<?php echo $clase->ProfesorUsuario_codigoProfesor; ?>">Editar <i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminar(<?php echo '\'' . $clase->claveAcceso . '\''; ?>, 'clase');">Eliminar <i class="fas fa-trash"></i></button>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->

            <?php
            }
            ?>

        </div>

        <?php
        }
        ?>

    </div>
</div>
