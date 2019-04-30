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

$(document).ready(function() {
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
        $('#info-alumno-descripcion-practica').html("En la siguiente sección grafica se muestra una comparativa de todas las prácticas hasta el momento.").fadeIn();
        $('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\"> Entra a todas las practicas</button>");
      }else if(idPractica == -2){
        $('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\"> Entra a promedio prácticas</button>");
        $('#info-alumno-descripcion-practica').html("En la siguiente sección grafica se muestra una comparativa entre el promedio del alumno y los datos de promedio del resto de la clase.").fadeIn();
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
  $('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">"+data+"</button>");
}
},
error: function(response) {
  bootbox.alert("Error: " + response);
}
});


//redireccionarPagina("index.php");
}
