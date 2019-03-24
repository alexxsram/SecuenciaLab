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
        <!-- Aqui voy a ejecutar PHP -->
        <?php
        $sql = "SELECT * FROM clase WHERE ProfesorUsuario_codigoProfesor = :codigoProfesor ORDER BY claveSeccion ASC";
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
                    En esta sección al profesor se le permite administrar las clases que imparte, ingresando a sus grupos, editar los datos generales
                    de la clase en caso de error y/o eliminarla en el momento que desee.
                </p>
            </div>
        </div>
        <div class="row h-100" style="margin-top: -1%;">
            <?php 
            $clases = $resultado->fetchAll(PDO::FETCH_OBJ);
            foreach ($clases as $clase) {
            ?>
            <!-- Aqui voy a cargar las clases -->
            <div class="col-sm-3 py-2">
                <div class="card border-success">
                    <img class="card-img" src="images/index/fondo-card.jpg" alt="Card image">
                    <div class="card-body">    
                        <h4 class="card-title border-bottom pb-2" style="font-size: 16.5px; font-family: 'Candara';"> <i> <b> <?php echo $clase->nombreClase; ?> </b> </i></h4>
                        <p class="card-text text-center">
                            <b>NRC:</b> <?php echo $clase->nrc; ?>
                            <b>Sección:</b> <?php echo $clase->claveSeccion; ?> <br>
                        </p>
                        <button type="button" class="btn btn-sm btn-success" onclick="cargarContenido('#contenidoClase', 'utileria/materia/', 'ingresar-materia.php', '?nrcClase=' + <?php echo $clase->nrc; ?>);">Entrar <i class="fas fa-door-open"></i></button>
                            
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalEditarClase"
                        data-claveacceso="<?php echo $clase->claveAcceso; ?>"
                        data-nombremateria="<?php echo $clase->nombreMateria; ?>"
                        data-nrc="<?php echo $clase->nrc; ?>"
                        data-claveseccion="<?php echo $clase->claveSeccion; ?>"
                        data-nombreclase="<?php echo $clase->nombreClase; ?>"
                        data-aula="<?php echo $clase->aula; ?>"
                        data-anio="<?php echo $clase->anio; ?>"
                        data-cicloescolar="<?php echo $clase->cicloEscolar; ?>"
                        data-codigoprofesor="<?php echo $clase->ProfesorUsuario_codigoProfesor; ?>">Editar <i class="fas fa-edit"></i></button>
                            
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminar(<?php echo $clase->nrc; ?>);">Eliminar <i class="fas fa-trash"></i></button>
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
