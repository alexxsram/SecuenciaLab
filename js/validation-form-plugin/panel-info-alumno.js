/*document.addEventListener('DOMContentLoaded', function () {
var myChart = Highcharts.chart('container', {
chart: {
type: 'column'
},
title: {
text: 'Practica #1: TRatmiento de un motor '
},
xAxis: {
categories: ['Categorias']
},
yAxis: {
title: {
text: 'Puntuación'
}
},
credits: false,
series: [{
name: 'Alumno',
data: [95]
}, {
name: 'Mínimo',
data: [60]
}, {
name: 'Máximo',
data: [100]
}, {
name: 'Promedio',
data: [87]
}, {
name: 'Media',
data: [77]
}, {
name: 'Moda',
data: [85]
}]
});
});*/
//$('#listgroup22').append("<li class=\"list-group-item active disabled\"////////////////////Lista----- de alumnos</li>");
//$('#listgroup22').html("<li class=\"list-group-item active disabled\">*******************ñññññññññññññññññLista de alumnos con el de html chido</li>").fadeIn();
//$('#listgroup666').append("<li class=\"list-group-item active disabled\">*******************Lista de alumnos con el de html</li>");
//$('#listgroup666').html("<li class=\"list-group-item active disabled\">*******************Lista de alumnos con el de html</li>").fadeIn();
//$('ul').html("<li class=\"list-group-item active disabled\">+++++++++++++++++++Lista de alumnos con el de html</li>").fadeIn();
//Prueba de función. Luego la elimino Cristian
/*$(document).ready(function(){
$('#listgroup22').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">-Entra a la primera</button>");
$('#listaAlumnos-lista').append("<li class=\"list-group-item active disabled\">Lista de alumnos</li>");
$('#listaAlumnos-lista').html("<li class=\"list-group-item active disabled\">Lista de alumnos</li>---").fadeIn();
$('#btn22').click(function() {
comment = $('#comment').val();
//$('#listgroup22').append("<li class='list-group-item'>"+comment+"</li>");
$('#listgroup22').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">---Morbi leo risus</button>");
});
});*/

$('#listgroup22').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-lista-alumnos.php",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val(),
    success: function(response)
    {
      $('#listgroup22').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">Esto lo acabo de modificar Estra al cargar base de datos ---</button>");
      $('#listgroup22').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

//Función para cargar la lista de alumnos sin tener que utilizar php directamente en el html
$(document).ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-lista-alumnos.php",
    dataType: "HTML",
    data: "claveAcceso=" + $("#ingresar-materia-claveAcceso").val(),
    success: function(response)
    {
      //$('#listgroup22').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">Estra al cargar base de datos ---</button>");
      //$('#listgroup22').append(response);
      //$('#listaAlumnos').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

//Función para cargar la información de la clase
$('#graficas-informativas-alumno').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-info-grafica-clase.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&claveUsuario=" + $("#info-alumno-codigo-alumno").val(),
    success: function(response)
    {
      $('#info-alumno-cuerpo-tarjeta-datos-clase').html(response).fadeIn();
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

//Función para cargar la información del alumno
$('#graficas-informativas-alumno').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-info-grafica-alumno.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&claveUsuario=" + $("#info-alumno-codigo-alumno").val(),
    success: function(response)
    {
      $('#info-alumno-cuerpo-tarjeta-datos-alumno').html(response).fadeIn();
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

//Función para cargar la lista de prácticas
$('#graficas-informativas-alumno').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-info-grafica-practicas.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&claveUsuario=" + $("#info-alumno-codigo-alumno").val(),
    success: function(response)
    {
      $('#info-alumno-lista-practicas').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

//Variables de opciones apra la prácticas.
var optionsPracticaIndividual = {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Título por defecto'
  },
  credits: false,
  xAxis: {
    type: 'category',
    categories: ['Categorias']
  },
  yAxis: {
    title: {
      text: 'Puntuación'
    }
  },
};

//Función para crear las series para las graficas
function crearSeriesCaliPrac(json) {
  var series = [];
  json.forEach(function(serie) {
    console.log(serie);
    series.push({
      name: serie.categoria,
      data: [
        ["Categorias", serie["calificacion"]]
      ]
    });
  });
  return series;
}

//Función para cargar las descripciones de las prácticas
function cargarDescripcionPractica(idPractica, nombrePractica, codigoAlumno) {
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-info-grafica-descripcion.php",
    type: "POST",
    async: true,
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&claveUsuario=" + $("#info-alumno-codigo-alumno").val()
    + "&idPractica=" + idPractica
    + "&nombrePractica=" + nombrePractica
    + "&codigoAlumno=" + codigoAlumno,
    success: function(response)
    {
      $('#info-alumno-descripcion-practica').html(response).fadeIn();
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
}

//Función para cargar las gráficas de las prácticas
function cargarGraficaDePractica(idPractica, nombrePractica, codigoAlumno) {
  //$('#container').hide();
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-info-grafica-graficacion.php",
    type: "POST",
    async: true,
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&claveUsuario=" + $("#info-alumno-codigo-alumno").val()
    + "&idPractica=" + idPractica
    + "&nombrePractica=" + nombrePractica
    + "&codigoAlumno=" + codigoAlumno,
    success: function(data)
    {
      if(idPractica == -1){
        $('#info-alumno-descripcion-practica').html("En la siguiente sección gráfica se muestra una comparativa de todas las prácticas hasta el momento.").fadeIn();
        //$('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\"> Entra a todas las prácticas</button>");
        optionsPracticaIndividual.title.text = "Todas las prácticas";
        //$('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">"+data+"</button>");
        optionsPracticaIndividual.series=crearSeriesCaliPrac(jQuery.parseJSON( data ));
        $('#container').highcharts(optionsPracticaIndividual);
      }else if(idPractica == -2){
        //$('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\"> Entra a promedio prácticas</button>");
        $('#info-alumno-descripcion-practica').html("En la siguiente sección gráfica se muestra una comparativa entre el promedio del alumno y los datos de promedio del resto de la clase.").fadeIn();
        optionsPracticaIndividual.title.text = "Alumno vs. Grupo";
        optionsPracticaIndividual.series=crearSeriesCaliPrac(jQuery.parseJSON( data ));
        $('#container').highcharts(optionsPracticaIndividual);
        //$('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">"+data+"</button>");
      }else{
        cargarDescripcionPractica(idPractica, nombrePractica, codigoAlumno);
        optionsPracticaIndividual.title.text = nombrePractica;
        optionsPracticaIndividual.series=crearSeriesCaliPrac(jQuery.parseJSON( data ));
        //Highcharts.Chart('#container', optionsPracticaIndividual);
        $('#container').highcharts(optionsPracticaIndividual);
        /*$('#container').highcharts({
        chart: {
        type: 'column'
      },
      xAxis: {
      type: 'category'
    },
    series: optionsPracticaIndividual.series
  });*/
  //$('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">"+data+"</button>");
}
},
error: function(response) {
  bootbox.alert("Error: " + response);
}
});
}

$('#info-evaluacion-calificacion-clase').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "calificacionClaseDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-calificacion-clase').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-difu-simulador').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "dificulSimuDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-difu-simulador').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-apoyo-aprendizaje').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "apoyoSimuDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-apoyo-aprendizaje').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-calidad-apoyo').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "CalMatApoDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-calidad-apoyo').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-claridad-apoyo').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "ClarMatApoDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-claridad-apoyo').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-cantidad-apoyo').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "CantMatApoDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-cantidad-apoyo').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-calidad-contenido').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "CalContDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-calidad-contenido').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-claridad-contenido').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "ClarContDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-claridad-contenido').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-cantidad-contenido').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "CantContDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-cantidad-contenido').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-nivel-aprendizaje').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-datos-difusos.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "nivelAprendizajeDifuso",
    success: function(response)
    {
      $('#info-evaluacion-cuerpo-tarjeta-nivel-aprendizaje').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#info-evaluacion-encuesta-no-contestada').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/logica-difusa/cargar-encuestas-no-contestadas.php",
    type: "POST",
    dataType: "HTML",
    data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    + "&tipoDatosDifuso=" + "nivelAprendizajeDifuso",
    success: function(echo)
    {
      var numeroLetras = echo.length;
      if(numeroLetras!=0){
        $('#info-evaluacion-encuesta-no-contestada').show(echo);
        $('#info-alumno-cuerpo-tarjeta-encuesta-no-contestada').show();
        $('#info-evaluacion-encuesta-no-contestada').append(echo);
      }else{
        //bootbox.alert("--Entra al else: " + echo + numeroLetras);
      }
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

/*$(document).ready(function () {
Dropzone.autoDiscover = true;
$("#myAwesomeDropzone").dropzone({
url: "hn_SimpeFileUploader.ashx",
addRemoveLinks: true,
success: function (file, response) {
var imgName = response;
file.previewElement.classList.add("dz-success");
console.log("Successfully uploaded :" + imgName);
},
error: function (file, response) {
file.previewElement.classList.add("dz-error");
}
});
});*/

/*
function readURL(input) {

if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function(e) {
$('#blah').attr('src', e.target.result);
}

reader.readAsDataURL(input.files[0]);
}
}

$("#imgInp").change(function() {
readURL(this);
});

var loadFile = function(event) {
//redireccionarPagina("index.php");
var output = document.getElementById('output');
output.src = URL.createObjectURL(event.target.files[0]);
};

var loadFile = function(event) {
var reader = new FileReader();
reader.onload = function(){
var output = document.getElementById('output');
output.src = reader.result;
};
reader.readAsDataURL(event.target.files[0]);
};
*/
