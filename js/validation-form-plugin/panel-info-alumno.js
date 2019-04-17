
$(document).ready(function(){
  $('#listgroup22').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">Entra a la primera</button>");
  $('#btn22').click(function() {
    comment = $('#comment').val();
    //$('#listgroup22').append("<li class='list-group-item'>"+comment+"</li>");
    $('#listgroup22').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">---Morbi leo risus</button>");
  });
});

document.addEventListener('DOMContentLoaded', function () {
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
});

$(document).ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-lista-alumnos.php",
    success: function(response)
    {
      //$('#listgroup22').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">Estra al cargar base de datos ---</button>");
      $('#listgroup22').append(response);
      $('#listaAlumnos').append(response);
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

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

$('#graficas-informativas-alumno').ready(function(){
  $('#btn22').click(function() {
    comment = $('#comment').val();
    //$('#listgroup22').append("<li class='list-group-item'>"+comment+"</li>");
    $('#listgroup22').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">---Morbi leo risus</button>");
  });
});

function cargarGraficaDePractica(idpractica, nombrePractica, codigoAlumno) {
  $.ajax({
    type: "POST",
    url: "utileria/materia/cargar-info-grafica-graficacion.php",
    //type: "POST",
    //dataType: "HTML",
    //data: "claveAcceso=" + $("#info-alumno-claveAcceso").val()
    //+ "&claveUsuario=" + $("#info-alumno-codigo-alumno").val(),
    success: function(response)
    {
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
          data: [100]
        }, {
          name: 'Mínimo',
          data: [20]
        }, {
          name: 'Máximo',
          data: [100]
        }, {
          name: 'Promedio',
          data: [59]
        }, {
          name: 'Media',
          data: [45]
        }, {
          name: "Moda",
          data: [30]
        }]
      });
      $('#info-alumno-lista-practicas').append("<button type=\"button\" class=\"list-group-item list-group-item-action\">"+response+"</button>");
      myChart.reflow();

    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });


  //redireccionarPagina("index.php");
}
