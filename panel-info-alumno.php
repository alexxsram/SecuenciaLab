<!DOCTYPE html>
<html lang="es">
<head>
  <title>Usando highcharts </title>
  <meta charset="utf-8" />
  <?php include('utileria/encabezados/encabezado-js.php'); ?>
  <?php include('utileria/encabezados/encabezado-css.php'); ?>
</head>
<body>
  <button class="btn btn-outline-primary" type="button" data-target="#modalEvaluarClase">
    evaluar materia <i class="fas fa-edit"></i>
  </button>
  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEvaluarClase"> <i class="fas fa-users"></i> Unirse a una clase</a>

  <!-- El modal para editar una practica -->
  <div class="modal fade" id="modalEvaluarClase" name="modalEvaluarClase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Evaluar clase</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formEvaluarClase" name="formEvaluarClase" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info text-justify" role="alert">
                        En está sección se realiza la evalución de la clase.
                        Estos datos son de suma importancia para mejorar la calidad del curso y del aprendisaje obtenido.
                    </div>

                    <div class="form-group">
                        <label for="editarNombrePractica">Calidad del contenido</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalCalidadCont" name="evalCalidadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editarNombrePractica">Claridad del contenido</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalClaridadCont" name="evalClaridadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editarNombrePractica">Cantidad del contenido</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalCantidadCont" name="evalCantidadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editarNombrePractica">Calidad del material de apoyo</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalCalidadMatApoyo" name="evalCalidadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editarNombrePractica">Claridad del material de apoyo</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalClaridadMatApoyo" name="evalClaridadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editarNombrePractica">Cantidad del material de apoyo</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalCantidadMatApoyo" name="evalCantidadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editarNombrePractica">Ayuda en el aprendizaje del simulador de control secuencial</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalSimulador" name="evalClaridadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editarNombrePractica">Facilidad de utilización simulador de control secuencial</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalFacilidadSimulador" name="evalCantidadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editarNombrePractica">¿Cuanto aprendió?</label>
                        <div class="form-group">
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="evalAprendizaje" name="evalCantidadCont">
                        <!--<span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
                        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>-->
                        </div>
                    </div>
                    <!--<div class="container">
                        <h1>Bootstap Slider Sample Project</h1>
                        <p>This is a sample project for bootstrap slider</p>
                        <input id="ex13" name="ex13" type="text"/>
                        <script>
                        // With JQuery
                          $("#ex13").slider({
                            ticks: [0, 20, 40, 60, 80, 100],
                            ticks_labels: ['Nada claro', 'Poco claro', 'Claro', 'Muy claro', 'Clarisimo',"sepa"],
                            ticks_snap_bounds: 1,
                            orientation: 'horizontal',
                            value: 20,
                            handle: 'triangle'
                          });
                        </script>
                    </div>-->
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fas fa-times-circle"></i> </button>
                    <button type="submit" class="btn btn-primary">Finalizar <i class="fas fa-save"></i> </button>
                </div>
            </form>
        </div>
    </div>
  </div>

</body>
</html>
