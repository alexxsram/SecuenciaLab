//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& Funciones que validan los formularios
// ***************************************** Para el login de la página
$("#formLogin").validate({
  rules: {
    claveUsuario: {
      required: true,
      minlength: 9,
      maxlength: 10
    },
    passwordUsuario: {
      required: true
    }
  },
  messages: {
    claveUsuario: {
      required: "Ingresa tu número de usuario",
      minlength: jQuery.validator.format("La longitud de su codigo debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su codigo debe ser de {0} caracteres")
  },
    passwordUsuario: {
      required: "Ingresa la contraseña"
    }
  },
  submitHandler: function(form) {
    $.ajax({
      url: "utileria/sesion/inicio-sesion.php",
      type: "POST",
      dataType: "HTML",
      data: "claveUsuario=" + $("#claveUsuario").val() + "&passwordUsuario=" + $("#passwordUsuario").val()
    }).done(function(echo) {
      if(echo == "success") {
        limpiarFormulario("#formLogin");
        redireccionarPagina("index.php");
      }
      else {
        var html = "<div class='alert alert-danger' role='alert'>";
        html += echo;
        html += "</div>";
        bootbox.alert(html);
      }
    });
  },
  errorElement: "em",
  errorPlacement: function(error, element) {
    // Add the `help-block` class to the error element
    error.addClass("invalid-feedback");
    if(element.prop("type") === "checkbox") {
      // error.insertAfter(element.parent("label"));
      error.addClass("invalid-feedback");
    } else {
      error.insertAfter(element);
    }
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass("is-invalid").removeClass("is-valid");
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).addClass("is-valid").removeClass("is-invalid");
  }
});

// ***************************************** Para dar de alta un usuario
$("#formNuevoUsuario").validate({
  rules: {
    claveUsuario: {
      required: true,
      minlength: 9,
      maxlength: 10
    },
    nombrePilaUsuario: {
      required: true
    },
    apellidoPaternoUsuario: {
      required: true
    },
    apellidoMaternoUsuario: {
      required: true
    },
    emailUsuario: {
      required: true,
      email: true
    },
    preguntaSeguridad: {
      required: true
    },
    respuestaSeguridad: {
      required: true
    },
    passwordUsuario: {
      required: true,
      minlength: 8,
      maxlength: 45
    },
    confirmPasswordUsuario: {
      required: true,
      minlength: 8,
      maxlength: 45,
      equalTo: "#passwordUsuario"
    }
  },
  messages: {
    claveUsuario: {
      required: "Ingresa tu número de usuario",
      minlength: jQuery.validator.format("La longitud de su codigo debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su codigo debe ser de {0} caracteres")
    },
    nombrePilaUsuario: {
      required: "Ingrese su nombre"
    },
    apellidoPaternoUsuario: {
      required: "Ingrese su apellido paterno"
    },
    apellidoMaternoUsuario: {
      required: "Ingrese su apellido materno"
    },
    emailUsuario: {
      required: "Ingrese un correo electrónico, para poder comunicarnos con usted",
      email: "Tu correo electrónico debe tener el formato name@domain.com"
    },
    preguntaSeguridad: {
      required: "Seleccione una pregunta de seguridad"
    },
    respuestaSeguridad: {
      required: "Ingrese una respuesta a la pregunta de seguridad"
    },
    passwordUsuario: {
      required: "Ingresa la contraseña",
      minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
      maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres")
    },
    confirmPasswordUsuario: {
      required: "Ingresa la contraseña",
      minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
      maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres"),
      equalTo: "La contraseña debe ser igual a la que acaba de ingresar"
    }
  },
  submitHandler: function(form) {
    $.ajax({
      url: "utileria/sesion/registrar-usuario.php",
      type: "POST",
      dataType: "HTML",
      data: "claveUsuario=" + $("#claveUsuario").val()
      + "&nombrePilaUsuario=" + $("#nombrePilaUsuario").val()
      + "&apellidoPaternoUsuario=" + $("#apellidoPaternoUsuario").val()
      + "&apellidoMaternoUsuario=" + $("#apellidoMaternoUsuario").val()
      + "&emailUsuario=" + $("#emailUsuario").val()
      + "&preguntaSeguridad=" + $("#preguntaSeguridad").val()
      + "&respuestaSeguridad=" + $("#respuestaSeguridad").val()
      + "&passwordUsuario=" + $("#passwordUsuario").val()
      + "&confirmPasswordUsuario=" + $("#confirmPasswordUsuario").val()
    }).done(function(echo) {
      if(echo == "success") {
        limpiarFormulario("#formNuevoUsuario");
        redireccionarPagina("login.php");
      }
      else {
        var html = "<div class='alert alert-danger' role='alert'>";
        html += echo;
        html += "</div>";
        bootbox.alert(html);
      }
    });
  },
  errorElement: "em",
  errorPlacement: function(error, element) {
    // Add the `help-block` class to the error element
    error.addClass("invalid-feedback");
    if(element.prop("type") === "checkbox") {
      // error.insertAfter(element.parent("label"));
      error.addClass("invalid-feedback");
    } else {
      error.insertAfter(element);
    }
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass("is-invalid").removeClass("is-valid");
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).addClass("is-valid").removeClass("is-invalid");
  }
});

// ***************************************** Para restablecer contraseña de usuario
$("#formRestablecerContrasena").validate({
  rules: {
    claveUsuario: {
      required: true,
      minlength: 9,
      maxlength: 10
    },
    respuestaSeguridad: {
      required: true
    },
    nuevoPasswordUsuario: {
      required: true,
      minlength: 8,
      maxlength: 45
    },
    confirmNuevoPasswordUsuario: {
      required: true,
      minlength: 8,
      maxlength: 45,
      equalTo: "#nuevoPasswordUsuario"
    }
  },
  messages: {
    claveUsuario: {
      required: "Ingresa tu número de usuario",
      minlength: jQuery.validator.format("La longitud de su codigo debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su codigo debe ser de {0} caracteres")
    },
    respuestaSeguridad: {
      required: "Ingresa la contraseña"
    },
    nuevoPasswordUsuario: {
      required: "Ingresa la contraseña",
      minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
      maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres")
    },
    confirmNuevoPasswordUsuario: {
      required: "Ingresa la contraseña",
      minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
      maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres"),
      equalTo: "La contraseña debe ser igual a la que acaba de ingresar"
    }
  },
  submitHandler: function(form) {
    $.ajax({
      url: "utileria/sesion/restablecer-contrasena-sesion.php",
      type: "POST",
      dataType: "HTML",
      data: "claveUsuario=" + $("#claveUsuario").val() + "&respuestaSeguridad=" + $("#respuestaSeguridad").val() + "&nuevoPasswordUsuario=" + $("#nuevoPasswordUsuario").val() + "&confirmNuevoPasswordUsuario=" + $("#confirmNuevoPasswordUsuario").val()
    }).done(function(echo) {
      if(echo == "success") {
        limpiarFormulario("#formRestablecerContrasena");
        redireccionarPagina("login.php");
      }
      else {
        var html = "<div class='alert alert-danger' role='alert'>";
        html += echo;
        html += "</div>";
        bootbox.alert(html);
      }
    });
  },
  errorElement: "em",
  errorPlacement: function(error, element) {
    // Add the `help-block` class to the error element
    error.addClass("invalid-feedback");
    if(element.prop("type") === "checkbox") {
      // error.insertAfter(element.parent("label"));
      error.addClass("invalid-feedback");
    } else {
      error.insertAfter(element);
    }
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass("is-invalid").removeClass("is-valid");
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).addClass("is-valid").removeClass("is-invalid");
  }
});

// ***************************************** Para el creación de clase
$("#modalCrearClase").on("show.bs.modal", function (event) {
  $("#formCrearMateria").validate({
    rules: {
      nombreClase: {
        required: true,
        minlength: 4,
        maxlength: 80
      },
      seccionClase: {
        required: true,
        minlength: 2,
        maxlength: 5
      },
      nrcClase: {
        required: true
      },
      materiaClase: {
        required: true,
        minlength: 3,
        maxlength: 80
      },
      aulaClase: {
        required: true,
        minlength: 2,
        maxlength: 15
      },
      anoClase: {
        required: true,
        date: true
      },
      cicloEscolarClase: {
        required: true
      }
    },
    messages: {
      nombreClase: {
        required: "Ingresa el nombre de la clase",
        minlength: jQuery.validator.format("La clase debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La clase debe tener mínimo {0} caracteres")
      },
      seccionClase: {
        required: "Ingresa el número de sección",
        minlength: jQuery.validator.format("La sección debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La sección debe tener mínimo {0} caracteres")
      },
      nrcClase: {
        required: "Ingresa el nrc de la materia"
      },
      materiaClase: {
        required: "Ingresa el nombre de la materia",
        minlength: jQuery.validator.format("La materia debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La materia debe tener mínimo {0} caracteres")
      },
      aulaClase: {
        required: "Ingresa el aula",
        minlength: jQuery.validator.format("La aula debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La aula debe tener mínimo {0} caracteres")
      },
      anoClase: {
        required: "Ingresa el año. Debe ser igual o mayor al año actual",
        date: "Ingresa la fecha correctamente"      
      },
      cicloEscolarClase: {
        required: "Seleccione un ciclo escolar valido"
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "utileria/materia/crear-materia.php",
        type: "POST",
        dataType: "HTML",
        data: "nombreClase=" + $("#nombreClase").val() 
        + "&nrcClase=" + $("#nrcClase").val()
        + "&seccionClase=" + $("#seccionClase").val() 
        + "&materiaClase=" + $("#materiaClase").val() 
        + "&aulaClase=" + $("#aulaClase").val()
        + "&anoClase=" + $("#anoClase").val() 
        + "&cicloEscolarClase=" + $("#cicloEscolarClase").val()
        + "&codigoProfesorClase=" + $("#codigoProfesorClase").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formCrearMateria");
          redireccionarPagina("index.php");
        }
        else {
          var html = "<div class='alert alert-danger' role='alert'>";
          html += echo;
          html += "</div>";
          bootbox.alert(html);
        }
      });
    },
    errorElement: "em",
    errorPlacement: function(error, element) {
      // Add the `help-block` class to the error element
      error.addClass("invalid-feedback");
      if(element.prop("type") === "checkbox") {
        // error.insertAfter(element.parent("label"));
        error.addClass("invalid-feedback");
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).addClass("is-valid").removeClass("is-invalid");
    }
  });
});

// ***************************************** Para la edición de la clase
$("#modalEditarClase").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var claveAcceso = button.data("claveacceso");
  var nombreMateria = button.data("nombremateria");
  var nrc = button.data("nrc");
  var claveSeccion = button.data("claveseccion");
  var nombreClase = button.data("nombreclase");
  var aula = button.data("aula");
  var anio = button.data("anio");
  var f = new Date();
  var fecha, dia = f.getDate(), mes = f.getMonth() + 1;
  if(dia < 10) {
    dia = "0" + dia;
  }
  if(mes < 10) {
    mes = "0" + mes;
  }
  fecha = anio + "-" + mes + "-" + dia;
  var cicloEscolar = button.data("cicloescolar");
  if(cicloEscolar == "A") {
    cicloEscolar = "cicloA";
  } else if(cicloEscolar == "B") {
    cicloEscolar = "cicloB";
  } else if(cicloEscolar == "V") {
    cicloEscolar = "cicloV";
  }
  var codigoProfesor = button.data("codigoprofesor");

  modal.find("#formEditarMateria #editarClaveAccesoClase").val(claveAcceso);
  modal.find("#formEditarMateria #editarNombreClase").val(nombreMateria);
  modal.find("#formEditarMateria #editarNrcClase").val(nrc);
  modal.find("#formEditarMateria #editarSeccionClase").val(claveSeccion);
  modal.find("#formEditarMateria #editarMateriaClase").val(nombreClase);
  modal.find("#formEditarMateria #editarAulaClase").val(aula);
  modal.find("#formEditarMateria #editarAnoClase").val(fecha);
  modal.find("#formEditarMateria #editarCicloEscolarClase").val(cicloEscolar);
  modal.find("#formEditarMateria #editarCodigoProfesorClase").val(codigoProfesor);

  $("#formEditarMateria").validate({
    rules: {
      editarNombreClase: {
        required: true,
        minlength: 4,
        maxlength: 80
      },
      editarSeccionClase: {
        required: true,
        minlength: 2,
        maxlength: 5
      },
      editarNrcClase: {
        required: true
      },
      editarEateriaClase: {
        required: true,
        minlength: 3,
        maxlength: 80
      },
      editarAulaClase: {
        required: true,
        minlength: 2,
        maxlength: 15
      },
      editarAnoClase: {
        required: true,
        date: true
      },
      editarCicloEscolarClase: {
        required: true
      }
    },
    messages: {
      editarNombreClase: {
        required: "Ingresa el nombre de la clase",
        minlength: jQuery.validator.format("La clase debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La clase debe tener mínimo {0} caracteres")
      },
      editarSeccionClase: {
        required: "Ingresa el número de sección",
        minlength: jQuery.validator.format("La sección debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La sección debe tener mínimo {0} caracteres")
      },
      editarNrcClase: {
        required: "Ingresa el nrc de la materia"
      },
      editarMateriaClase: {
        required: "Ingresa el nombre de la materia",
        minlength: jQuery.validator.format("La materia debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La materia debe tener mínimo {0} caracteres")
      },
      editarAulaClase: {
        required: "Ingresa el aula",
        minlength: jQuery.validator.format("La aula debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La aula debe tener mínimo {0} caracteres")
      },
      editarAnoClase: {
        required: "Ingresa el año. Debe ser igual o mayor al año actual",
        date: "Ingresa la fecha correctamente"      
      },
      editarCicloEscolarClase: {
        required: "Seleccione un ciclo escolar valido"
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "utileria/materia/editar-materia.php",
        type: "POST",
        dataType: "HTML",
        data: "claveAccesoClase=" + $("#editarClaveAccesoClase").val()
        + "&nombreClase=" + $("#editarNombreClase").val() 
        + "&nrcClase=" + $("#editarNrcClase").val()
        + "&seccionClase=" + $("#editarSeccionClase").val() 
        + "&materiaClase=" + $("#editarMateriaClase").val() 
        + "&aulaClase=" + $("#editarAulaClase").val()
        + "&anoClase=" + $("#editarAnoClase").val() 
        + "&cicloEscolarClase=" + $("#editarCicloEscolarClase").val()
        + "&codigoProfesorClase=" + $("#editarCodigoProfesorClase").val()
      }).done(function(echo) {
        if(echo == "success") {
          redireccionarPagina("index.php");
        }
        else {
          var html = "<div class='alert alert-danger' role='alert'>";
          html += echo;
          html += "</div>";
          bootbox.alert(html);
        }
      });
    },
    errorElement: "em",
    errorPlacement: function(error, element) {
      // Add the `help-block` class to the error element
      error.addClass("invalid-feedback");
      if(element.prop("type") === "checkbox") {
        // error.insertAfter(element.parent("label"));
        error.addClass("invalid-feedback");
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).addClass("is-valid").removeClass("is-invalid");
    }
  });
});

// ***************************************** Para el creación de la práctica
$("#modalCrearPractica").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var claveAcceso = button.data("claveacceso");
  var nrc = button.data("nrc");

  modal.find("#formCrearPractica #claveAccesoClase").val(claveAcceso);

  $("#formCrearPractica").validate({
    rules: {
      nombrePractica: {
        required: true
      },
      descripcionPractica: {
        required: true
      },
      fechaLimitePractica: {
        required: true
      }
    },
    messages: {
      nombrePractica: {
        required: "Ingresar el nombre de la práctica"
      },
      descripcionPractica: {
        required: "Ingresar la descripción"
      },
      fechaLimitePractica: {
        required: "Ingresar una fecha límite"
      }
    }, 
    submitHandler: function(form) {
      $.ajax({
        url: "utileria/practica/crear-practica.php",
        type: "POST",
        dataType: "HTML",
        data: "nombrePractica=" + $("#nombrePractica").val()
        + "&descripcionPractica=" + $("#descripcionPractica").val() 
        + "&fechaLimitePractica=" + $("#fechaLimitePractica").val()
        + "&claveAccesoClase=" + $("#claveAccesoClase").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formCrearPractica");
          cerrarModal("#modalCrearPractica", "hide");
          cargarContenido('contenidoClase', 'utileria/materia/', 'ingresar-materia.php', 'nrcClase=' + nrc);
        }
        else {
          var html = "<div class='alert alert-danger' role='alert'>";
          html += echo;
          html += "</div>";
          bootbox.alert(html);
        }
      });
    },
    errorElement: "em",
    errorPlacement: function(error, element) {
      // Add the `help-block` class to the error element
      error.addClass("invalid-feedback");
      if(element.prop("type") === "checkbox") {
        // error.insertAfter(element.parent("label"));
        error.addClass("invalid-feedback");
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).addClass("is-valid").removeClass("is-invalid");
    }
  });
});

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& Funciones auxiliares en caso de necesitarlas en el futuro, luego revisar como funcionaba
function limpiarFormulario(idFormulario) {
  $(idFormulario)[0].reset();
}

function redireccionarPagina(ruta) {
  setTimeout(window.location = ruta, 5000);
}

function cargarContenido(idEtiqueta, ruta, archivoPHP, datos) {
  $("#" + idEtiqueta).load(ruta + archivoPHP + "?" + datos);
}

function accionarEliminacion(tipoMetodo, ruta, archivoPHP, tipoDato, datos, rutaRedireccionar) {
  $.ajax({
    type: tipoMetodo,
    url: ruta + archivoPHP,
    dataType: tipoDato,
    data: datos,
    success: function(response) {
      bootbox.alert({
        message: "Registro eliminado correctamente!",
        callback: function () {
          redireccionarPagina(rutaRedireccionar);
        }
      });
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
}

function confirmarEliminar(nrc) {
  bootbox.confirm({
    message: "Antes de continuar! ¿Desea eliminar la clase?",
    className: "bounceInLeft animated",
    buttons: {
        confirm: {
            label: "Si <i class='fas fa-check-circle'></i>",
            className: "btn-success"
        },
        cancel: {
            label: "No <i class='fas fa-times-circle'></i>",
            className: "btn-danger"
        }
    },
    callback: function (result) {
      if(result == true) {
        accionarEliminacion("POST", "utileria/materia/", "eliminar-materia.php", "HTML", "nrcClase=" + nrc, "index.php");
      }
    }
  });
}

function cerrarModal(idEtiqueta, tipoAccion) {
  $(idEtiqueta).modal(tipoAccion);
}
