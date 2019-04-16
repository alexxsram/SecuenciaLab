<?php
include('../operaciones/conexion.php');

try {
  //$claveAcceso = $_POST['claveAcceso'];
  //$claveUsuario = $_POST['claveUsuario'];
  echo "Highcharts.chart('container', {
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
      data: [1520]
    }]
  });";
} catch(Exception $exec) {
  die('Error en la base de datos: ' . $exec->getMessage());
}
?>
