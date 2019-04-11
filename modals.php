<?php
if(!isset($_SESSION['codigo']) && ($_SESSION['estado'] != 'INICIO_SESION_PROFESOR' || $_SESSION['estado'] != 'INICIO_SESION_ALUMNO')) {
    header('Location: utileria/sesion/sesion.php');
} else {
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $estado = $_SESSION['estado'];
}
?>

<!-- El modal para actualizar la contraseña -->
<div class="modal fade" id="modalCambiarPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Cambiar contraseña</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="formCambiarPassword" name="formCambiarContrasena" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info text-justify" role="alert">
                        Por preferencia al usuario, puede actualizar su contraseña si así lo desea.
                        Todos los campos con (*) son obligatorios.
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="claveUsuario" name="claveUsuario" required="required" disabled="disabled">
                    </div>

                    <div class="form-group">
                        <label for="nuevaContrasenaUsuario">Nueva contraseña *</label>
                        <input type="password" class="form-control" id="nuevaPasswordUsuario" name="nuevaPasswordUsuario"  required="required">
                    </div>

                    <div class="form-group">
                        <label for="confirmarNuevaContrasenaUsuario">Confirmar nueva contraseña *</label>
                        <input type="password" class="form-control" id="confirmarNuevaPasswordUsuario" name="confirmarNuevaPasswordUsuario" required="required">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
                    <button type="submit" class="btn btn-primary">Guardar <i class="fas fa-save"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- El modal para crear una clase -->
<div class="modal fade" id="modalCrearClase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Crear una clase</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="formCrearMateria" name="formCrearMateria" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info text-justify" role="alert">
                        Aquí los profesores que impartan materias pueden crear sus secciones.
                        Todos los campos con (*) son obligatorios.
                    </div>

                    <div class="form-group">
                        <label for="nombreClase">Nombre de la clase *</label>
                        <input type="text" class="form-control" id="nombreClase" name="nombreClase"  placeholder="Ej. Laboratorio de Control Secuencial" required="required">
                    </div>

                    <div class="form-group">
                        <label for="nrcClase">NRC *</label>
                        <input type="number" class="form-control" id="nrcClase" name="nrcClase" placeholder="Ej. 46259" min=1 required="required">
                    </div>

                    <div class="form-group">
                        <label for="seccionClase">Sección *</label>
                        <input type="text" class="form-control" id="seccionClase" name="seccionClase" placeholder="Ej. D01" required="required">
                    </div>

                    <div class="form-group">
                        <label for="materiaClase">Materia *</label>
                        <input type="text" class="form-control" id="materiaClase" name="materiaClase" placeholder="Ej. Control Secuencial" required="required">
                    </div>

                    <div class="form-group">
                        <label for="aulaClase">Aula *</label>
                        <input type="text" class="form-control" id="aulaClase" name="aulaClase"  placeholder="Ej. X-25" required="required">
                    </div>

                    <!-- ESTO PODRIA DEJARSE COMO TEXTO Y VALIDARLO CON UN PATRON O USAR UN DATEPICKER -->
                    <div class="form-group">
                        <label for="anoClase">Año *</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="anoClase" name="anoClase" placeholder="Ej. 2019">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cicloEscolarClase">Ciclo escolar *</label>
                        <select id="cicloEscolarClase" name="cicloEscolarClase" class="custom-select">
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="codigoProfesorClase" name="codigoProfesorClase" value="<?php echo $codigo; ?>" disabled="disabled">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
                    <button type="submit" class="btn btn-primary">Crear <i class="fas fa-check-circle"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- El modal para editar una clase -->
<div class="modal fade" id="modalEditarClase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Editar datos de una clase</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="formEditarMateria" name="formEditarMateria" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info text-justify" role="alert">
                        Aquí los profesores pueden editar los datos de la clase, en caso de cometer un error al capturar la información.
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="editarClaveAccesoClase" name="editarClaveAccesoClase" disabled="disabled">
                    </div>

                    <div class="form-group">
                        <label for="nombreClase">Nombre de la clase *</label>
                        <input type="text" class="form-control" id="editarNombreClase" name="editarNombreClase"  placeholder="Ej. Laboratorio de Control Secuencial" required="required">
                    </div>

                    <div class="form-group">
                        <label for="nrcClase">NRC *</label>
                        <input type="number" class="form-control" id="editarNrcClase" name="editarNrcClase" placeholder="Ej. 46259" min=1 required="required">
                    </div>

                    <div class="form-group">
                        <label for="seccionClase">Sección *</label>
                        <input type="text" class="form-control" id="editarSeccionClase" name="editarSeccionClase" placeholder="Ej. D01" required="required">
                    </div>

                    <div class="form-group">
                        <label for="materiaClase">Materia *</label>
                        <input type="text" class="form-control" id="editarMateriaClase" name="editarMateriaClase" placeholder="Ej. Control Secuencial" required="required">
                    </div>

                    <div class="form-group">
                        <label for="aulaClase">Aula *</label>
                        <input type="text" class="form-control" id="editarAulaClase" name="editarAulaClase"  placeholder="Ej. X-25" required="required">
                    </div>

                    <!-- ESTO PODRIA DEJARSE COMO TEXTO Y VALIDARLO CON UN PATRON O USAR UN DATEPICKER -->
                    <div class="form-group">
                        <label for="anoClase">Año *</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="editarAnoClase" name="editarAnoClase" placeholder="Ej. 2019">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cicloEscolarClase">Ciclo escolar *</label>
                        <select id="editarCicloEscolarClase" name="editarCicloEscolarClase" class="custom-select">
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="editarCodigoProfesorClase" name="editarCodigoProfesorClase" disabled="disabled">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
                    <button type="submit" class="btn btn-primary">Guardar <i class="fas fa-save"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- El modal para crear una practica -->
<div class="modal fade" id="modalCrearPractica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Crear una practica</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="formCrearPractica" name="formCrearPractica" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info text-justify" role="alert">
                        Aquí los profesores en su clase pueden registrar las prácticas que vayan solicitando durante el curso.
                        Todos los campos con (*) son obligatorios.
                    </div>

                    <div class="form-group">
                        <label for="nombrePractica">Nombre de la práctica *</label>
                        <input type="text" class="form-control" id="nombrePractica" name="nombrePractica"  placeholder="Ej. Arrancador a tensión reducida" required="required">
                    </div>

                    <div class="form-group">
                        <label for="descripcionPractica">Descripción *</label>
                        <textarea class="form-control" id="descripcionPractica" name="descripcionPractica" placeholder="Agregar una breve explicación de lo que se debe realizar..." required="required"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="fechaLimitePractica">Fecha limíte de entrega *</label>
                        <input type="date" class="form-control" id="fechaLimitePractica" name="fechaLimitePractica" required="required">
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="claveAccesoClase" name="claveAccesoClase" disabled="disabled">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
                    <button type="submit" class="btn btn-primary">Crear <i class="fas fa-check-circle"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- El modal para calificar una practica -->
<!-- Agrego algo para que se carguen los cambios, solo de prueba -->
<div class="modal fade" id="modalCalificarPractica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Calificar práctica</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formCalificarPractica" name="formCalificarPractica" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info text-justify" role="alert">
                        En este apartado el profesor puede verificar los alumnos que han entregado su practica correspondiente y así calificarla.
                        Todos los campos con (*) son obligatorios.
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="calificarIdPractica" name="calificarIdPractica" disabled="disabled">
                    </div>

                    <div class="form-group">
                        <label for="calificarCodigoAlumnoPractica">Alumnos que han entregado *</label>
                        <select id="calificarCodigoAlumnoPractica" name="calificarCodigoAlumnoPractica" class="custom-select">
                            <option value="">Seleccionar...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="calificarEvaluacionPractica">Calificación *</label>
                        <input type="number" class="form-control" id="calificarEvaluacionPractica" name="calificarEvaluacionPractica"  placeholder="Ej. Arrancador a tensión reducida" required="required">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
                    <button type="submit" class="btn btn-primary">Guardar <i class="fas fa-save"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- El modal para editar una practica -->
<div class="modal fade" id="modalEditarPractica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Editar datos de la práctica</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formEditarPractica" name="formEditarPractica" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info text-justify" role="alert">
                        El profesor puede editar los datos de una práctica en cualquier momento.
                        Todos los campos con (*) son obligatorios.
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="editarIdPractica" name="editarIdPractica" disabled="disabled">
                    </div>

                    <div class="form-group">
                        <label for="editarNombrePractica">Nombre de la práctica *</label>
                        <input type="text" class="form-control" id="editarNombrePractica" name="editarNombrePractica"  placeholder="Ej. Arrancador a tensión reducida" required="required">
                    </div>

                    <div class="form-group">
                        <label for="editarDescripcionPractica">Descripción *</label>
                        <textarea class="form-control" id="editarDescripcionPractica" name="editarDescripcionPractica" placeholder="Agregar una breve explicación de lo que se debe realizar..." required="required"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="editarFechaLimitePractica">Fecha limíte de entrega *</label>
                        <input type="date" class="form-control" id="editarFechaLimitePractica" name="editarFechaLimitePractica" required="required">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
                    <button type="submit" class="btn btn-primary">Guardar <i class="fas fa-save"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- El modal unir a un alumno a una clase -->
<div class="modal fade" id="modalUnirseClase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Unirse a una clase</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="formUnirseClase" name="formUnirseClase" method="POST">
                <div id="mensajeUnirseClase"></div>
                <div class="modal-body">
                    <div class="alert alert-info text-justify" role="alert">
                        Pídele la clave de acceso de la clase a tu profesor e introdúcela aquí.
                        Todos los campos con (*) son obligatorios.
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="unirseClaveAccesoClase" name="unirseClaveAccesoClase" disabled="disabled">
                    </div>

                    <div class="form-group">
                        <label for="unirseClaveAcceso">Clave de acceso *</label>
                        <input type="text" class="form-control" id="unirseClaveAcceso" name="unirseClaveAcceso"  placeholder="Ej. 3qoxi0NApW" required="required">
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="codigoAlumnoUnirse" name="codigoAlumnoUnirse" value="<?php echo $codigo; ?>" disabled="disabled">
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
                    <button type="submit" class="btn btn-primary">Unirse <i class="fas fa-sign-in-alt"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>
