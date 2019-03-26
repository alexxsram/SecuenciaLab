<?php
session_start();
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
    header('Location: ../sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $estado = $_SESSION['estado'];
}
include('../operaciones/conexion.php');

$nrcClase = $_GET['nrcClase'];

try {
    $sql = "SELECT * FROM clase WHERE nrc = :nrc";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':nrc', $nrcClase);
    $resultado->execute();
    $clase = $resultado->fetch(PDO::FETCH_OBJ);

    $sql = "SELECT * FROM cicloescolar WHERE idCicloEscolar = :idCicloEscolar";
    $resultado = $baseDatos->prepare($sql);
    $resultado->bindValue(':idCicloEscolar', $clase->CicloEscolar_idCicloEscolar);
    $resultado->execute();
    $ciclo = $resultado->fetch(PDO::FETCH_OBJ);
?>
    <!-- JUMBOTRON DONDE MUESTRO LOS DATOS DE LA CLASE -->
    <div class="jumbotron">
        <div class="container">
            <blockquote class="blockquote text-center"> <h1 class="display-4"> <?php echo $clase->nombreClase; ?> </h1></blockquote>
            <p class="h5"> Clave de acceso: <?php echo $clase->claveAcceso; ?>
            <button class="btn " style="background-color:transparent;" data-toggle="tooltip" title="Mostrar" onclick="expandirClaveAcceso(<?php echo '\''.$clase->claveAcceso.'\'' ?>);">
                <i class="fas fa-sign-in-alt"></i>
            </button>
            </p>
            <p class="h5"> <small class="text-muted"> Materia: <?php echo $clase->nombreMateria; ?> </small></p>
            <p class="h6"> <small class="text-muted"> Sección: <?php echo $clase->claveSeccion; ?> </small></p>
            <p class="h6"> <small class="text-muted"> Aula: <?php echo $clase->aula; ?> </small></p>
            <p class="h6"> <small class="text-muted"> Ciclo: <?php echo $clase->anio . " " . $ciclo->ciclo; ?> </small></p>
            <p class="lead text-justify">
                En la siguiente sección, el profesor puede crear las practicas de laboratorio relacionadas al manual
            </p>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acciones de la clase
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" data-toggle="modal" href="#modalCrearPractica" data-claveacceso="<?php echo $clase->claveAcceso; ?>" data-nrc="<?php echo $clase->nrc; ?>"><i class="fas fa-clipboard"></i> Agregar práctica</a>
                    <a class="dropdown-item" href="#">Calificar práctica</a>
                </div>
            </div>
            <button type="button" class="btn btn-danger" onclick="redireccionarPagina('index.php');">Regresar <i class="fas fa-arrow-left"></i></button>
        </div>
    </div>

    <!-- PESTAÑAS/TABS DEL CONTENIDO QUE VOY A MOSTRAR -->
    <div class="card border-dark mb-3">
        <div class="card-header bg-dark border-dark">
            <ul class="nav nav-tabs justify-content-end card-header-tabs text-white" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tablero-tab" data-toggle="tab" href="#tablero" role="tab" aria-controls="tablero" aria-selected="true">Tablero</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="practica-tab" data-toggle="tab" href="#practica" role="tab" aria-controls="practica" aria-selected="false">Práctica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="alumno-tab" data-toggle="tab" href="#alumno" role="tab" aria-controls="alumno" aria-selected="false">Alumno</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tablero" role="tabpanel" aria-labelledby="tablero-tab">
                    
                </div>
                
                <div class="tab-pane fade" id="practica" role="tabpanel" aria-labelledby="practica-tab">
                    <?php
                        $sql = "SELECT * FROM practica WHERE Clase_claveAcceso LIKE :claveAcceso";
                        $resultado = $baseDatos->prepare($sql);
                        $resultado->bindValue(':claveAcceso', $clase->claveAcceso);
                        $resultado->execute();

                        $numRow = $resultado->rowCount();
                        if($numRow == 0) {
                    ?>
                    
                    <div class="col-12 text-center">
                        <?php if($estado == 'INICIO_SESION_PROFESOR') { ?>
                            <h1 class="font-weight-light">La clase no cuenta con practicas que registrar</h1>
                            <p class="lead">Es necesario que crees una practica para que la puedan visualizar tus alumnos.</p>
                        <?php } else if($estado == 'INICIO_SESION_ALUMNO') { ?>
                            <h1 class="font-weight-light">Bienvenido a la página del alumno.</h1>
                            <p class="lead">Aquí podrás realizar tus practicas de tu(s) materias.</p>
                        <?php } ?>
                    </div>
                    
                    <?php 
                        } else { 
                            $practicas = $resultado->fetchAll(PDO::FETCH_OBJ);
                    ?>

                    <div class="card" style="border-radius: 5px;">
                        <table class="table table-hover table-stripped cart-wrap">
                            <thead class="text-muted">
                                <tr>
                                    <th scope="col" class="text-center">
                                        No. práctica
                                    </th>
                                    <th scope="col">
                                        Nombre
                                    </th>
                                    <th scope="col">
                                        Descripción
                                    </th>
                                    <th scope="col">
                                        Fecha limite de entrega
                                    </th>
                                    <th scope="col" class="text-center">
                                        Accion
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($practicas as $practica) { ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $practica->idPractica; ?>
                                    </td>
                                    <td> 
                                        <?php echo $practica->nombre; ?>
                                    </td>
                                    <td> 
                                        <?php echo $practica->descripcion; ?> 
                                    </td>
                                    <td>
                                        <?php echo $practica->fechaLimite; ?> 
                                    </td>
                                    <td class="text-center"> 
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalEditarPractica" data-idpractica="<?php echo $practica->idPractica; ?>"> <i class="fas fa-edit"></i> Editar</button> 
                                        <button type="button" class="btn btn-outline-danger" onclick="confirmarEliminar(<?php echo $clase->nrc; ?>, 'practica');"> <i class="fas fa-times"></i> Eliminar</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
                
                <div class="tab-pane fade" id="alumno" role="tabpanel" aria-labelledby="alumno-tab">
                    
                </div>
            </div>
        </div>
    </div>
<?php
} catch(Exception $exec) {
    die('Error en la base de datos: ' . $exec->getMessage());
}
?>
