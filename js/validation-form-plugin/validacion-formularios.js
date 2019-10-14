//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& Funciones que validan los formularios
// ***************************************** Para dar de alta un usuario
$("#formNuevoUsuario").validate({
  rules: {
    claveUsuario: {
      required: true,
      minlength: 8,
      maxlength: 10
    },
    nombrePilaUsuario: {
      required: true,
      minlength: 0,
      maxlength: 100
    },
    apellidoPaternoUsuario: {
      required: true,
      minlength: 0,
      maxlength: 100
    },
    apellidoMaternoUsuario: {
      required: true,
      minlength: 0,
      maxlength: 100
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
      minlength: jQuery.validator.format("La longitud de su código debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su código debe ser de {0} caracteres")
    },
    nombrePilaUsuario: {
      required: "Ingrese su nombre",
      minlength: jQuery.validator.format("La longitud de su nombre debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su nombre debe ser de {0} caracteres")
    },
    apellidoPaternoUsuario: {
      required: "Ingrese su apellido paterno",
      minlength: jQuery.validator.format("La longitud de su apellido paterno debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su apellido paterno debe ser de {0} caracteres")
    },
    apellidoMaternoUsuario: {
      required: "Ingrese su apellido materno",
      minlength: jQuery.validator.format("La longitud de su apellido materno debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su apellido materno debe ser de {0} caracteres")
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

// ***************************************** Para el login de la página
$("#formLogin").validate({
  rules: {
    claveUsuario: {
      required: true,
      minlength: 8,
      maxlength: 10
    },
    passwordUsuario: {
      required: true
    }
  },
  messages: {
    claveUsuario: {
      required: "Ingresa tu número de usuario",
      minlength: jQuery.validator.format("La longitud de su código debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su código debe ser de {0} caracteres")
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
        redireccionarPagina("index-clase.php");
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
    }
  },
  messages: {
    claveUsuario: {
      required: "Ingresa tu número de usuario",
      minlength: jQuery.validator.format("La longitud de su código debe ser de {0} caracteres"),
      maxlength: jQuery.validator.format("La longitud de su código debe ser de {0} caracteres")
    },
    respuestaSeguridad: {
      required: "Ingresa la respuesta de la pregunta de seguridad"
    }
  },
  submitHandler: function(form) {
    $.ajax({
      url: "utileria/sesion/restablecer-contrasena-sesion.php",
      type: "POST",
      dataType: "HTML",
      data: "claveUsuario=" + $("#claveUsuario").val() + "&respuestaSeguridad=" + $("#respuestaSeguridad").val()
    }).done(function(echo) {
      if(echo != "") {
        bootbox.alert({
          message: echo,
          callback: function () {
            limpiarFormulario("#formRestablecerContrasena");
            redireccionarPagina("index.php");
          }
        });
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

// ***************************************** Para cambiar la contraseña de un usuario
$("#modalCambiarPassword").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var claveUsuario = button.data("codigo");

  modal.find("#formCambiarPassword #claveUsuario").val(claveUsuario);

  $("#formCambiarPassword").validate({
    rules: {
      passwordUsuarioActual: {
        required: true,
        minlength: 8,
        maxlength: 45
      },
      nuevaPasswordUsuario: {
        required: true,
        minlength: 8,
        maxlength: 45
      },
      confirmarNuevaPasswordUsuario: {
        required: true,
        minlength: 8,
        maxlength: 45,
        equalTo: "#nuevaPasswordUsuario"
      }
    },
    messages: {
      passwordUsuarioActual: {
        required: "Ingresa la contraseña actual",
        minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
        maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres")
      },
      nuevaPasswordUsuario: {
        required: "Ingresa la nueva contraseña",
        minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
        maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres")
      },
      confirmarNuevaPasswordUsuario: {
        required: "Ingresa otra vez la nueva contraseña",
        minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
        maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres"),
        equalTo: "La contraseña debe ser igual a la que acaba de ingresar"
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "utileria/sesion/cambiar-contrasena.php",
        type: "POST",
        dataType: "HTML",
        data: "nuevoPasswordUsuario=" + $("#nuevaPasswordUsuario").val()
        + "&actualPasswordUsuario=" + $("#passwordUsuarioActual").val()
        + "&claveUsuario=" + $("#claveUsuario").val()
      }).done(function(echo) {
        if(echo == "success") {
          bootbox.alert({
            message: "Contraseña actualizada correctamente.",
            callback: function() {
              limpiarFormulario("#formCambiarPassword");
              redireccionarPagina("index-clase.php");
            }
          });
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

function llenarCamposNombreUsuario(claveUsuario, modal) {
  $.ajax({
    type: "POST",
    url: "utileria/sesion/obtener-nombre.php",
    dataType: "HTML",
    data: "claveUsuario=" + claveUsuario,
    success: function(data) {
      var json = jQuery.parseJSON(data);
      modal.find("#formCambiarNombre #nombrePilaUsuarioCambiar").val(json["nombrePila"]);
      modal.find("#formCambiarNombre #apellidoPaternoUsuarioCambiar").val(json["apellidoPaterno"]);
      modal.find("#formCambiarNombre #apellidoMaternoUsuarioCambiar").val(json["apellidoMaterno"]);
    },
    error: function(data) {
    }
  });
}

$("#modalCambiarNombre").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var claveUsuario = button.data("codigo");

  modal.find("#formCambiarNombre #claveUsuario").val(claveUsuario);

  llenarCamposNombreUsuario(claveUsuario, modal);

  $("#formCambiarNombre").validate({
    rules: {
      nombrePilaUsuarioCambiar: {
        required: true,
        minlength: 0,
        maxlength: 100
      },
      apellidoPaternoUsuarioCambiar: {
        required: true,
        minlength: 0,
        maxlength: 100
      },
      apellidoMaternoUsuarioCambiar: {
        required: true,
        minlength: 0,
        maxlength: 100
      }
    },
    messages: {
      nombrePilaUsuarioCambiar: {
        required: "Ingrese su nombre",
        minlength: jQuery.validator.format("La longitud de su nombre debe ser de {0} caracteres"),
        maxlength: jQuery.validator.format("La longitud de su nombre debe ser de {0} caracteres")
      },
      apellidoPaternoUsuarioCambiar: {
        required: "Ingrese su apellido paterno",
        minlength: jQuery.validator.format("La longitud de su apellido paterno debe ser de {0} caracteres"),
        maxlength: jQuery.validator.format("La longitud de su apellido paterno debe ser de {0} caracteres")
      },
      apellidoMaternoUsuarioCambiar: {
        required: "Ingrese su apellido materno",
        minlength: jQuery.validator.format("La longitud de su apellido materno debe ser de {0} caracteres"),
        maxlength: jQuery.validator.format("La longitud de su apellido materno debe ser de {0} caracteres")
      },
    },
    submitHandler: function(form) {
      $.ajax({
        url: "utileria/sesion/cambiar-nombre.php",
        type: "POST",
        dataType: "HTML",
        data: "nomprePila=" + $("#nombrePilaUsuarioCambiar").val()
        + "&apellidoPaterno=" + $("#apellidoPaternoUsuarioCambiar").val()
        + "&apellidoMaterno=" + $("#apellidoMaternoUsuarioCambiar").val()
        + "&claveUsuario=" + claveUsuario
      }).done(function(echo) {
        if(echo == "success") {
          bootbox.alert({
            message: "Nombre actualizado correctamente.",
            callback: function() {
              limpiarFormulario("#formCambiarNombre");
              redireccionarPagina("index-clase.php");
            }
          });
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


// ***************************************** Para el creación de clase
$("#modalCrearClase").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var codigoProfesor = button.data("codigoprofesor");

  insercionPorAjax("POST", "utileria/materia/selector-cicloEscolar.php", "#cicloEscolarClase");

  modal.find("#formCrearMateria #codigoProfesorClase").val(codigoProfesor);

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
      anioClase: {
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
        maxlength: jQuery.validator.format("La clase debe tener máximo {0} caracteres")
      },
      seccionClase: {
        required: "Ingresa el número de sección",
        minlength: jQuery.validator.format("La sección debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La sección debe tener máximo {0} caracteres")
      },
      nrcClase: {
        required: "Ingresa el nrc de la materia"
      },
      materiaClase: {
        required: "Ingresa el nombre de la materia",
        minlength: jQuery.validator.format("La materia debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La materia debe tener máximo {0} caracteres")
      },
      aulaClase: {
        required: "Ingresa el aula",
        minlength: jQuery.validator.format("La aula debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La aula debe tener máximo {0} caracteres")
      },
      anioClase: {
        required: "Ingresa el año. Debe ser igual o mayor al año actual",
        date: "Ingresa la fecha correctamente"
      },
      cicloEscolarClase: {
        required: "Seleccione un ciclo escolar válido"
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
        + "&anioClase=" + $("#anioClase").val()
        + "&cicloEscolarClase=" + $("#cicloEscolarClase").val()
        + "&codigoProfesorClase=" + $("#codigoProfesorClase").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formCrearMateria");
          redireccionarPagina("index-clase.php");
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
  var codigoProfesor = button.data("codigoprofesor");

  modal.find("#formEditarMateria #editarClaveAccesoClase").val(claveAcceso);
  modal.find("#formEditarMateria #editarNombreClase").val(nombreClase);
  modal.find("#formEditarMateria #editarNrcClase").val(nrc);
  modal.find("#formEditarMateria #editarSeccionClase").val(claveSeccion);
  modal.find("#formEditarMateria #editarMateriaClase").val(nombreMateria);
  modal.find("#formEditarMateria #editarAulaClase").val(aula);
  modal.find("#formEditarMateria #editarAnoClase").val(fecha);
  insercionPorAjax("POST", "utileria/materia/selector-cicloEscolar.php", "#editarCicloEscolarClase");
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
      editarMateriaClase: {
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
        maxlength: jQuery.validator.format("La clase debe tener máximo {0} caracteres")
      },
      editarSeccionClase: {
        required: "Ingresa el número de sección",
        minlength: jQuery.validator.format("La sección debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La sección debe tener máximo {0} caracteres")
      },
      editarNrcClase: {
        required: "Ingresa el nrc de la materia"
      },
      editarMateriaClase: {
        required: "Ingresa el nombre de la materia",
        minlength: jQuery.validator.format("La materia debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La materia debe tener máximo {0} caracteres")
      },
      editarAulaClase: {
        required: "Ingresa el aula",
        minlength: jQuery.validator.format("La aula debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La aula debe tener máximo {0} caracteres")
      },
      editarAnoClase: {
        required: "Ingresa el año. Debe ser igual o mayor al año actual",
        date: "Ingresa la fecha correctamente"
      },
      editarCicloEscolarClase: {
        required: "Seleccione un ciclo escolar válido"
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
          redireccionarPagina("index-clase.php");
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

// ***************************************** Para el acceso a una clase
$("#modalAccesoClase").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var claveAcceso = button.data("claveacceso");

  insercionPorAjax("GET", "utileria/materia/cargar-lista-alumnos-acceso.php?claveAccesoClase=" + claveAcceso, "#selectAccesoAlumno");

  modal.find("#formAccesoClase #claveAccesoClase").val(claveAcceso);

  $("#formAccesoClase").validate({
    rules: {
      selectAccesoAlumno: {
        required: true
      }
    },
    messages: {
      selectAccesoAlumno: {
        required: "Campo obligatorio"
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "utileria/materia/crear-acceso-clase.php",
        type: "POST",
        dataType: "HTML",
        data: "claveAccesoClase=" + $("#formAccesoClase #claveAccesoClase").val()
        + "&selectAccesoAlumno=" + $("#selectAccesoAlumno").val()
      }).done(function(echo) {
        if(echo == "success") {
          bootbox.alert({
            message: "Acceso otorgado al alumno correctamente!",
            callback: function () {
              limpiarFormulario("#formAccesoClase");
              cerrarModal("#modalAccesoClase", "hide");
              redireccionarPagina("index-clase.php");
            }
          });
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

// ***************************************** Para la creación de anuncios
$("#modalCrearAnuncio").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var codigoProfesor = button.data("codigoprofesor");
  var claveAcceso = button.data("claveacceso");

  modal.find("#formCrearAnuncio #codigoProfesor").val(codigoProfesor);
  modal.find("#formCrearAnuncio #claveAccesoClase").val(claveAcceso);

  $("#formCrearAnuncio").validate({
    rules: {
      tituloAnuncio: {
        required: true
      },
      contenidoAnuncio: {
        required: true
      }
    },
    messages: {
      tituloAnuncio: {
        required: "Ingresa el título del anuncio"
      },
      contenidoAnuncio: {
        required: "Ingresa un contenido o descripción al anuncio"
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "../../utileria/materia/crear-anuncio.php",
        type: "POST",
        dataType: "HTML",
        data: "tituloAnuncio=" + $("#tituloAnuncio").val()
        + "&contenidoAnuncio=" + $("#contenidoAnuncio").val()
        + "&codigoProfesor=" + $("#codigoProfesor").val()
        + "&claveAccesoClase=" + $("#formCrearAnuncio #claveAccesoClase").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formCrearAnuncio");
          cerrarModal("#modalCrearAnuncio", "hide");
          redireccionarPagina("../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
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

// ***************************************** Para la creación de anuncios
$("#modalEditarAnuncio").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var idAnuncio = button.data("idanuncio");
  var titulo = button.data("titulo");
  var contenido = button.data("contenido");
  var fechaPublicacion = button.data("fechapublicacion");
  var claveAcceso = button.data("claveacceso");

  modal.find("#formEditarAnuncio #editarIdAnuncio").val(idAnuncio);
  modal.find("#formEditarAnuncio #editarTituloAnuncio").val(titulo);
  modal.find("#formEditarAnuncio #editarContenidoAnuncio").val(contenido);
  modal.find("#formEditarAnuncio #editarFechaCreacionAnuncio").val(fechaPublicacion);

  $("#formEditarAnuncio").validate({
    rules: {
      editarTituloAnuncio: {
        required: true
      },
      editarContenidoAnuncio: {
        required: true
      },
      editarFechaCreacionAnuncio: {
        required: true,
        date: true
      }
    },
    messages: {
      editarTituloAnuncio: {
        required: "Ingresa el nuevo título del anuncio"
      },
      editarContenidoAnuncio: {
        required: "Ingresa un contenido o descripción nuevo al anuncio"
      },
      editarFechaCreacionAnuncio: {
        required: "Ingresa la nueva fecha de creación",
        date: ""
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "../../utileria/materia/editar-anuncio.php",
        type: "POST",
        dataType: "HTML",
        data: "idAnuncio=" + $("#editarIdAnuncio").val()
        + "&tituloAnuncio=" + $("#editarTituloAnuncio").val()
        + "&contenidoAnuncio=" + $("#editarContenidoAnuncio").val()
        + "&fechaCreacionAnuncio=" + $("#editarFechaCreacionAnuncio").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formEditarAnuncio");
          cerrarModal("#modalEditarAnuncio", "hide");
          redireccionarPagina("../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
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

// ***************************************** Para la realizar un comentario
$("#formComentarAnuncio").validate({
  rules: {
    comentario: {
      required: true
    }
  },
  messages: {
    comentario: {
      required: "Ingrese un comentario en caso de ser necesario."
    }
  },
  submitHandler: function(form) {
    $.ajax({
      url: "../../utileria/materia/crear-comentario.php",
      type: "POST",
      dataType: "HTML",
      data: "idAnuncio=" + $("#comentarioIdAnuncio").val()
      + "&nombre=" + $("#comentarioNombre").val()
      + "&comentario=" + $("#comentario").val()
    }).done(function(echo) {
      if(echo == "success") {
        limpiarFormulario("#formComentarAnuncio");
        redireccionarPagina("../materia/index-materia.php?claveAccesoClase=" + btoa($("#formComentarAnuncio #claveAccesoClase").val()));
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

// ***************************************** Para el creación de la práctica
$("#modalCrearPractica").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var claveAcceso = button.data("claveacceso");

  modal.find("#formCrearPractica #claveAccesoClase").val(claveAcceso);

  $("#formCrearPractica").validate({
    rules: {
      nombrePractica: {
        required: true,
        minlength: 1,
        maxlength: 100
      },
      descripcionPractica: {
        required: true,
        minlength: 1,
        maxlength: 2000
      },
      fechaLimitePractica: {
        required: true,
        date: true
      }
    },
    messages: {
      nombrePractica: {
        required: "Ingresar el nombre de la práctica",
        minlength: jQuery.validator.format("El nombre de la práctica debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("El nombre de la práctica debe tener máximo {0} caracteres")
      },
      descripcionPractica: {
        required: "Ingresar la descripción",
        minlength: jQuery.validator.format("La descripción de la práctica debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La descripción de la práctica debe tener máximo {0} caracteres")
      },
      fechaLimitePractica: {
        required: "Ingresar una fecha límite"
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "../../utileria/practica/crear-practica.php",
        type: "POST",
        dataType: "HTML",
        data: "nombrePractica=" + $("#nombrePractica").val()
        + "&descripcionPractica=" + $("#descripcionPractica").val()
        + "&fechaLimitePractica=" + $("#fechaLimitePractica").val()
        + "&claveAccesoClase=" + $("#formCrearPractica #claveAccesoClase").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formCrearPractica");
          cerrarModal("#modalCrearPractica", "hide");
          redireccionarPagina("../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
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

// ***************************************** Para la edición de la práctica
$("#modalEditarPractica").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var idPractica = button.data("idpractica");
  var nombre = button.data("nombre");
  var descripcion = button.data("descripcion");
  var fechaLimite = button.data("fechalimite");
  var claveAcceso = button.data("claveacceso");
  var evaluacionDifusa = button.data("difusa");

  modal.find("#formEditarPractica #editarIdPractica").val(idPractica);
  modal.find("#formEditarPractica #editarNombrePractica").val(nombre);
  modal.find("#formEditarPractica #editarDescripcionPractica").val(descripcion);
  modal.find("#formEditarPractica #editarFechaLimitePractica").val(fechaLimite);
  $("#editarNombrePractica").prop("disabled", evaluacionDifusa);
  $("#editarDescripcionPractica").prop("disabled", evaluacionDifusa);

  $("#formEditarPractica").validate({
    rules: {
      editarNombrePractica: {
        required: true,
        minlength: 1,
        maxlength: 100
      },
      editarDescripcionPractica: {
        required: true,
        minlength: 1,
        maxlength: 2000
      },
      editarFechaLimitePractica: {
        required: true,
        date: true
      }
    },
    messages: {
      editarNombrePractica: {
        required: "Ingresar el nombre de la práctica",
        minlength: jQuery.validator.format("El nombre de la práctica debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("El nombre de la práctica debe tener máximo {0} caracteres")
      },
      editarDescripcionPractica: {
        required: "Ingresar la descripción",
        minlength: jQuery.validator.format("La descripción de la práctica debe tener mínimo {0} caracteres"),
        maxlength: jQuery.validator.format("La descripción de la práctica debe tener máximo {0} caracteres")
      },
      editarFechaLimitePractica: {
        required: "Ingresar una fecha límite",
        date: ""
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "../../utileria/practica/editar-practica.php",
        type: "POST",
        dataType: "HTML",
        data: "idPractica=" + $("#editarIdPractica").val()
        + "&nombrePractica=" + $("#editarNombrePractica").val()
        + "&descripcionPractica=" + $("#editarDescripcionPractica").val()
        + "&fechaLimitePractica=" + $("#editarFechaLimitePractica").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formEditarPractica");
          cerrarModal("#modalEditarPractica", "hide");
          redireccionarPagina("../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
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

// ***************************************** Para calificar una practica
$("#formCalificarPractica").validate({
  rules: {
    calificacion: {
      required: true,
      number: true,
      minlength: 1,
      maxlength: 3
    }
  },
  messages: {
    calificacion: {
      required: "Ingresar la calificación de la práctica.",
      number: "Solo se admiten números. Ingrese un número entre 0 y 100.",
      minlength: jQuery.validator.format("La calificación mínima es 0."),
      maxlength: jQuery.validator.format("La calificación máxima es 100.")
    }
  },
  submitHandler: function(form) {
    $.ajax({
      url: "../../utileria/practica/calificar-practica.php",
      type: "POST",
      dataType: "HTML",
      data: "calificacion=" + $("#calificacion").val()
      + "&idCuestionario=" + $("#idCuestionario").val()
    }).done(function(echo) {
      bootbox.alert(echo);
      if(echo == "success") {
        redireccionarPagina("../practica/calificar-entrega.php?criterioCalificar=" + btoa($("#criterioCalificar").val()));
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

// ***************************************** Para unir estudiante a una clase
$("#modalUnirseClase").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var codigoAlumno = button.data("codigoalumno");

  modal.find("#formUnirseClase #codigoAlumnoUnirse").val(codigoAlumno);

  $("#formUnirseClase").validate({
    rules: {
      unirseClaveAcceso: {
        required: true,
        minlength: 10,
        maxlength: 10
      }
    },
    messages: {
      unirseClaveAcceso: {
        required: "Ingresa la clave de acceso",
        minlength: jQuery.validator.format("La clave de acceso debe tener {0} caracteres"),
        maxlength: jQuery.validator.format("La clave de acceso debe tener {0} caracteres")
      }
    },
    submitHandler: function(form) {
      bootbox.confirm({
        title: "Matricular a la clase",
        message: "Está a punto de matricularse a esta clase, ¿Está seguro?",
        buttons: {
          cancel: {
            label: "<i class='fa fa-times'></i> Cancelar"
          },
          confirm: {
            label: "<i class='fa fa-check'></i> Aceptar"
          }
        },
        callback: function (result) {
          if(result == true) {
            $.ajax({
              url: "utileria/materia/unirse-clase.php",
              type: "POST",
              dataType: "HTML",
              data: "claveClase=" + $("#unirseClaveAcceso").val()
              + "&codigoAlumno=" + $("#codigoAlumnoUnirse").val()
            }).done(function(echo) {
              if(echo == "success") {
                limpiarFormulario("#formUnirseClase");
                redireccionarPagina("index-clase.php");
              }
              else {
                var html = "<div class='alert alert-danger' role='alert'>";
                html += echo;
                html += "</div>";
                bootbox.alert(html);
              }
            });
          }
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

function llenarPregunta1PreviaCuestionario(codigoAlumno, idPractica, claveAcceso, visualizar) {
  $.ajax({
    type: "POST",
    url: "../../utileria/materia/formularioEntregarPractica/cargar-respuesta-pregunta1-previa.php",
    dataType: "HTML",
    data: "codigoAlumno=" + codigoAlumno
    + "&idPractica=" + idPractica
    + "&claveAcceso=" + claveAcceso,
    success: function(data) {
      $("#respuestaPregunta1").text("");
      $("#respuestaPregunta1").append(data);
    },
    error: function(data) {
    }
  });
}

function llenarPregunta2PreviaCuestionario(codigoAlumno, idPractica, claveAcceso, visualizar) {
  $.ajax({
    type: "POST",
    url: "../../utileria/materia/formularioEntregarPractica/cargar-respuesta-pregunta2-previa.php",
    dataType: "HTML",
    data: "codigoAlumno=" + codigoAlumno
    + "&idPractica=" + idPractica
    + "&claveAcceso=" + claveAcceso,
    success: function(data) {
      $("#respuestaPregunta2").text("");
      $("#respuestaPregunta2").append(data);
    },
    error: function(data) {
    }
  });
}

function llenarPregunta3PreviaCuestionario(codigoAlumno, idPractica, claveAcceso, visualizar) {
  $.ajax({
    type: "POST",
    url: "../../utileria/materia/formularioEntregarPractica/cargar-respuesta-pregunta3-previa.php",
    dataType: "HTML",
    data: "codigoAlumno=" + codigoAlumno
    + "&idPractica=" + idPractica
    + "&claveAcceso=" + claveAcceso,
    success: function(data) {
      $("#respuestaPregunta3").text("");
      $("#respuestaPregunta3").append(data);
    },
    error: function(data) {
    }
  });
}

function llenarConclusionPreviaCuestionario(codigoAlumno, idPractica, claveAcceso, visualizar) {
  $.ajax({
    type: "POST",
    url: "../../utileria/materia/formularioEntregarPractica/cargar-conclusion-previa.php",
    dataType: "HTML",
    data: "codigoAlumno=" + codigoAlumno
    + "&idPractica=" + idPractica
    + "&claveAcceso=" + claveAcceso,
    success: function(data)
    {
      var numeroLetras = data.length;
      if(numeroLetras!=0){
        $("#conclusion").text("");
        $("#conclusion").append(data);
        if(!visualizar) {
          $("#sumit-entregar-practica").html("Modificar <i class=\"fas fa-check-circle\"></i>").fadeIn();
          $("#alerta-modificacion-entrega").html("Usted está modificando una práctica que ya entrego. Puede modificar sus respuestas, no obstante, deberá subir su diagrama secuencial nuevamente.").fadeIn();
          $("#sumit-entregar-practica").show();
          $("#diagramaControlAnterior").show();
        }
      }else{
        $("#alerta-modificacion-entrega").html(" ").fadeIn();
        $("#alerta-modificacion-entrega").hide();
      }
    },
    error: function(data) {
      //bootbox.alert("Error: " + data);
    }
  });
}

$("#diagramaControlAnterior").click(function() {
  descargarDiagramaSecuencialAnterior(codigoAlumnoModificarPrac, idPracticaModificarPrac, claveAccesoModificarPrac);
});

function descargarDiagramaSecuencialAnterior(codigoAlumno, idPractica, claveAcceso) {
  $.ajax({
    type: "POST",
    url: "../../utileria/materia/formularioEntregarPractica/ruta-y-nombre-archivo-anterior.php",
    async: true,
    dataType: "HTML",
    data: "codigoAlumno=" + codigoAlumno
    + "&idPractica=" + idPractica
    + "&claveAcceso=" + claveAcceso,
    success: function(data)
    {
      var json = jQuery.parseJSON(data);
      descargarArchivo(json.ruta, json.nombreOriginal);
    },
    error: function(data) {
      bootbox.alert("Error: " + data);
    }
  });
}

$("#modalEntregaPractica").on("hidden.bs.modal", function(event){
  var button = $(event.relatedTarget);
  var modal = $(this);
  //modal.find("#conclusion").text("ENTRO AQUI");
  $(this).find("form")[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
  $(this).find("#formEntregaPractica")[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
  $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
});

var codigoAlumnoModificarPrac;
var idPracticaModificarPrac;
var claveAccesoModificarPrac;

// ***************************************** Para entregar una practica ESTE FALTA DE REVISAR BIEN PARA QUE FUNCIONE CON FILES
$("#modalEntregaPractica").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var idPractica = button.data("idpractica");
  var nombre = button.data("nombre");
  var descripcion = button.data("descripcion");
  var fechaLimite = button.data("fechalimite");
  var codigoAlumno = button.data("codigoalumno");
  var claveAcceso = button.data("claveacceso");
  var visualizar = button.data("visualizar");

  codigoAlumnoModificarPrac = codigoAlumno;
  idPracticaModificarPrac = idPractica;
  claveAccesoModificarPrac = claveAcceso;

  modal.find("#titulo").text(nombre);
  modal.find("#descripcion").text(descripcion);
  modal.find("#fechaLimite").text("Fecha límite de entrega: " + fechaLimite);
  modal.find("#formEntregaPractica #idPractica").val(idPractica);
  modal.find("#formEntregaPractica #codigoAlumno").val(codigoAlumno);

  $("#nombreArchivo").val("");
  $("#nombreArchivo").val(null);
  $("#respuestaPregunta1").prop("disabled", visualizar);
  $("#respuestaPregunta2").prop("disabled", visualizar);
  $("#respuestaPregunta3").prop("disabled", visualizar);
  $("#conclusion").prop("disabled", visualizar);
  $("#nombreArchivo").prop("disabled", visualizar);
  $("#sumit-entregar-practica").prop("disabled", visualizar);

  if(visualizar) {
    $("#diagramaControlAnterior").prop("disabled", !visualizar);
    $("#sumit-entregar-practica").html("Guardar <i class=\"fas fa-check-circle\"></i>").fadeIn();
    $("#alerta-modificacion-entrega").html(" ").fadeIn();
    $("#alerta-modificacion-entrega").hide();
    $("#nombreArchivo").hide();
    $("#sumit-entregar-practica").hide();
    $("#diagramaControlAnterior").show();
    $("#div-subir-archivo-practica").hide();
    $("#divImagePreview").hide();
  } else {
    $("#alerta-modificacion-entrega").show();
    $("#nombreArchivo").show();
    $("#sumit-entregar-practica").show();
    $("#diagramaControlAnterior").hide();
    $("#div-subir-archivo-practica").show();
    $("#divImagePreview").show();
  }

  llenarPregunta1PreviaCuestionario(codigoAlumno, idPractica, claveAcceso, visualizar);
  llenarPregunta2PreviaCuestionario(codigoAlumno, idPractica, claveAcceso, visualizar);
  llenarPregunta3PreviaCuestionario(codigoAlumno, idPractica, claveAcceso, visualizar);
  llenarConclusionPreviaCuestionario(codigoAlumno, idPractica, claveAcceso, visualizar);

  $("#formEntregaPractica").validate({
    rules: {
      respuestaPregunta1: {
        required: true
      },
      respuestaPregunta2: {
        required: true
      },
      respuestaPregunta3: {
        required: true
      },
      conclusion: {
        required: true
      },
      rutaArchivo: {
        required: true,
        accept: "jpg, png, jpeg, gif"
      }
    },
    messages: {
      respuestaPregunta1: {
        required: "Llenar la respuesta a la pregunta #1"
      },
      respuestaPregunta2: {
        required: "Llenar la respuesta a la pregunta #2"
      },
      respuestaPregunta3: {
        required: "Llenar la respuesta a la pregunta #3"
      },
      conclusion: {
        required: "Llenar con alguna conclusión"
      },
      rutaArchivo: {
        required: "Seleccionar un archivo",
        accept: "Solo se admiten archivos con formato jpg/jpeg/png/gif/pdf"
      }
    },
    submitHandler: function(form) {
      var formData = new FormData(form);
      formData.append("idPractica", $("#idPractica").val());
      formData.append("codigoAlumno", $("#codigoAlumno").val());
      $.ajax({
        url: "../../utileria/practica/enviar-practica-cuestionario.php",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        dataType: "HTML",
        data: formData
      }).done(function(echo) {
        if(echo == "success") {
          bootbox.alert({
            message: "Actividad entregada correctamente!",
            callback: function () {
              limpiarFormulario("#formEntregaPractica");
              redireccionarPagina("../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
            }
          });
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

function cargarPagina(ruta) {
  var url = ruta;
  window.open(url, "_blank");
}

function cargarContenido(ruta, archivoPHP, datos) {
  var url = ruta + archivoPHP + "?" + datos;
  window.open(url, "_blank");
}

function muestraDetalle(ruta, archivoPHP, datos, idEtiqueta) {
  var url = ruta + archivoPHP + "?" + datos;
  $("#" + idEtiqueta).load(url);
}

function accionarConsulta(tipoMetodo, ruta, archivoPHP, tipoDato, datos, rutaRedireccionar) {
  $.ajax({
    type: tipoMetodo,
    url: ruta + archivoPHP,
    dataType: tipoDato,
    data: datos,
    success: function(echo) {
      if(echo == "success") {
        bootbox.alert({
          message: "¡Actualización efectuada correctamente!",
          callback: function () {
            redireccionarPagina(rutaRedireccionar);
          }
        });
      } else {
        bootbox.alert({
          message: echo,
          callback: function () {
            redireccionarPagina(rutaRedireccionar);
          }
        });
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      bootbox.alert("Error: " + xhr.responseText);
    }
  });
}

function accionarRespaldo(dato, rutaRedireccionar) {
  $.ajax({
    type: "POST",
    url: "backup.php",
    dataType: "HTML",
    data: dato,
    success: function(echo) {
      if(echo == "export success") {
        bootbox.alert({
          message: "Archivos de respaldo exportados correctamente",
          callback: function () {
            redireccionarPagina(rutaRedireccionar);
          }
        });
      } else if(echo == "import success") {
        bootbox.alert({
          message: "Archivos de respaldo importados correctamente",
          callback: function () {
            redireccionarPagina(rutaRedireccionar);
          }
        });
      } else {
        bootbox.alert({
          message: echo,
          callback: function () {
            redireccionarPagina(rutaRedireccionar);
          }
        });
      }
    },
    error: function(xhr, textStatus, errorThrown) {
      bootbox.alert("Error: " + xhr.responseText);
    }
  });
}

function confirmarAccion(valor, tipo) {
  var vectorValores = valor.split("-");
  if(tipo == "clase") { // Si elimino una clase
    var claveAcceso = vectorValores[0];
    var eliminadoPor = vectorValores[1];

    bootbox.confirm({
      title: "Eliminar clase",
      message: "¿Está seguro que desea eliminar la clase?",
      size: "small",
      backdrop: true,
      className: "swing animated",
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
          accionarConsulta("POST", "utileria/materia/", "eliminar-materia.php", "HTML", "claveAcceso=" + claveAcceso + "&eliminadoPor=" + eliminadoPor, "index-clase.php");
        }
      }
    });
  } else if(tipo == "anuncio") { // Si elimino un anuncio
    // var vectorValores = valor.split("-");
    var idAnuncio = vectorValores[0];
    var titulo = vectorValores[1];
    var claveAcceso = vectorValores[2];
    bootbox.confirm({
      title: "Eliminar el anuncio " + titulo,
      message: "¿Está seguro que desea eliminar el anuncio?",
      size: "small",
      backdrop: true,
      className: "swing animated",
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
      callback: function(result) {
        if(result == true) {
          accionarConsulta("POST", "../../utileria/materia/", "eliminar-anuncio.php", "HTML", "idAnuncio=" + idAnuncio, "../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
        }
      }
    });
  } else if(tipo == "comentario") { // Si elimino un comentario
    // var vectorValores = valor.split("-");
    var idComentario = vectorValores[0];
    var claveAcceso = vectorValores[1];
    title: "Eliminar comentario",
    bootbox.confirm({
      title: "Eliminar comentario",
      message: "¿Está seguro que desea eliminar el comentario?",
      size: "small",
      backdrop: true,
      className: "swing animated",
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
      callback: function(result) {
        if(result == true) {
          accionarConsulta("POST", "../../utileria/materia/", "eliminar-comentario.php", "HTML", "idComentario=" + idComentario, "../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
        }
      }
    });

  } else if(tipo == "practica") { // Si elimino una practica
    // var vectorValores = valor.split("-");
    var idPractica = vectorValores[0];
    var nombre = vectorValores[1];
    var claveAcceso = vectorValores[2];
    bootbox.confirm({
      title: "Eliminar practica " + nombre,
      message: "¿Está seguro que desea eliminar la práctica?",
      size: "small",
      backdrop: true,
      className: "swing animated",
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
          accionarConsulta("POST", "../../utileria/practica/", "eliminar-practica.php", "HTML", "idPractica=" + idPractica, "../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
        }
      }
    });
  } else if(tipo == "activarClase") {
    // var vectorValores = valor.split("-");
    var claveAcceso = vectorValores[0];
    bootbox.confirm({
      title: "Activar clase",
      message: "¿Estás seguro de reactivar la clase?",
      size: "small",
      backdrop: true,
      className: "swing animated",
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
          accionarConsulta("POST", "utileria/materia/", "activar-materia.php", "HTML", "claveAcceso=" + claveAcceso, "index-clase.php");
        }
      }
    });
  } else if(tipo == "abandonarClase") { // El alumno abandona una clase
    // var vectorValores = valor.split("-");
    var claveAcceso = vectorValores[0];
    var codigoAlumno = vectorValores[1];
    bootbox.confirm({
      title: "Abandonar clase",
      message: "¿Está seguro que desea abandonar la clase? TODOS sus trabajos serán eliminados de manera permanente.",
      size: "small",
      backdrop: true,
      className: "swing animated",
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
          accionarConsulta("POST", "utileria/materia/", "abandonar-materia.php", "HTML", "claveAcceso=" + claveAcceso + "&codigoAlumno=" + codigoAlumno, "index-clase.php");
        }
      }
    });
  }
}

function expandirClaveAcceso(claveAcceso) {
  bootbox.alert({
    title: "Clave de acceso de la clase",
    message: "<blockquote class='blockquote text-center'> <h1 class='display-1' id='titulo'>" +  claveAcceso + "</h1></blockquote>",
    size: "large",
    backdrop: true,
    className: "swing animated",
    callback: function (result) {
    }
  });
}

function cerrarModal(idEtiqueta, tipoAccion) {
  $(idEtiqueta).modal(tipoAccion);
}

// ESTA FUNCION SOLO TRABAJA CON MODALS, EN ALGUNAS TAL VEZ
function insercionPorAjax(metodo, ruta, idEtiqueta) {
  $.ajax({
    type: metodo,
    url: ruta,
    success: function(response) {
      $(idEtiqueta).html(response).fadeIn();
    },
    error: function(xhr, textStatus, errorThrown) {
      bootbox.alert("Error: " + xhr.responseText);
    }
  });
}

function descargarArchivo(rutaArchivo, nombreOriginal) {
  //bootbox.alert("Entra a descargar "  + rutaArchivo);
  //redireccionarPagina("index.php");
  var vectorValores = rutaArchivo.split("/");
  var nombreArchivo = vectorValores[4]; // ../../images/files/NombreAlumno/NombreArchivo
  //Usaremos un link para iniciar la descarga
  var save = document.createElement("a");
  save.href = rutaArchivo;
  save.target = "_blank";
  //Truco: así le damos el nombre al archivo
  // save.download = nombreArchivo || 'archivo.dat';
  save.download = nombreOriginal;
  var clicEvent = new MouseEvent("click", {
    "view": window,
    "bubbles": true,
    "cancelable": true
  });
  //Simulamos un clic del usuario no es necesario agregar el link al DOM.
  save.dispatchEvent(clicEvent);
  //Y liberamos recursos...
  (window.URL || window.webkitURL).revokeObjectURL(save.href);
}

// ***************************************** Para el creación de la evaluación de clase
$("#modalAsignarEvaluacionDifusa").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var claveAcceso = button.data("claveacceso");

  modal.find("#formAsignarEvaluacionDifusa #claveAccesoClaseEvaluacionDifusa").val(claveAcceso);
  $("#formAsignarEvaluacionDifusa").validate({
    rules: {
      fechaLimiteEvaluacionDifusa: {
        required: true,
        date: true
      }
    },
    messages: {
      fechaLimiteEvaluacionDifusa: {
        required: "Ingresar una fecha límite."
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "../../utileria/practica/crear-practica.php",
        type: "POST",
        dataType: "HTML",
        data: "nombrePractica=" +"Evaluación difusa de la clase"
        + "&descripcionPractica=" + "En este apartado el profesor puede asignar la evaluación de la clase. Esta actividad únicamente se puede asignar una vez en todo el curso. La presente evaluación sirve para que el docente reciba retroalimentación del contenido de la clase de parte de sus estudiantes."
        + "&fechaLimitePractica=" + $("#fechaLimiteEvaluacionDifusa").val()
        + "&claveAccesoClase=" + $("#claveAccesoClaseEvaluacionDifusa").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formCrearPractica");
          cerrarModal("#modalCrearPractica", "hide");
          redireccionarPagina("../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
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

function llenarEvaluacionDifusaAnterior(codigoAlumno, idPractica, claveAcceso, visualizar) {
  $.ajax({
    type: "POST",
    url: "../../utileria/materia/formularioEntregarPractica/cargar-evaluacion-difusa-previa.php",
    dataType: "HTML",
    data: "codigoAlumno=" + codigoAlumno
    + "&idPractica=" + idPractica
    + "&claveAcceso=" + claveAcceso,
    success: function(data)
    {
      var numeroLetras = data.length;
      if(numeroLetras!=0 ){
        var json = jQuery.parseJSON(data);
        if(json.CalContNitido!=-1){
          $("#evalCalidadCont").val(json.CalContNitido);
          $("#evalCalidadContAmountInput").val(json.CalContNitido);
          $("#evalClaridadCont").val(json.ClarContNitido);
          $("#evalClaridadContAmountInput").val(json.ClarContNitido);
          $("#evalCantidadCont").val(json.CantContNitido);
          $("#evalCantidadContAmountInput").val(json.CantContNitido);
          $("#evalCalidadMatApoyo").val(json.CalMatApoNitido);
          $("#evalCalidadMatApoyoAmountInput").val(json.CalMatApoNitido);
          $("#evalClaridadMatApoyo").val(json.ClarMatApoNitido);
          $("#evalClaridadMatApoyoAmountInput").val(json.ClarMatApoNitido);
          $("#evalCantidadMatApoyo").val(json.CantMatApoNitido);
          $("#evalCantidadMatApoyoAmountInput").val(json.CantMatApoNitido);
          $("#evalSimulador").val(json.apoyoSimuNitido);
          $("#evalSimuladorAmountInput").val(json.apoyoSimuNitido);
          $("#evalFacilidadSimulador").val(json.dificulSimuNitido);
          $("#evalFacilidadSimuladorAmountInput").val(json.dificulSimuNitido);
          $("#evalAprendizaje").val(json.nivelAprendizajeNitido);
          $("#evalAprendizajeAmountInput").val(json.nivelAprendizajeNitido);
        }
      }
    },
    error: function(data) {
      //bootbox.alert("Error: " + data);
    }
  });
}

// ***************************************** Para abilitar la evaluación de los cursos por lógica difusa
$("#modalEvaluarClase").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var idPractica = button.data("idpractica");
  var nombre = button.data("nombre");
  var descripcion = button.data("descripcion");
  var fechaLimite = button.data("fechalimite");
  var codigoAlumno = button.data("codigoalumno");
  var claveAcceso = button.data("claveacceso");
  var visualizar = button.data("visualizar");
  $("#evalCalidadCont").val(50);
  $("#evalCalidadContAmountInput").val(50);
  $("#evalClaridadCont").val(50);
  $("#evalClaridadContAmountInput").val(50);
  $("#evalCantidadCont").val(50);
  $("#evalCantidadContAmountInput").val(50);
  $("#evalCalidadMatApoyo").val(50);
  $("#evalCalidadMatApoyoAmountInput").val(50);
  $("#evalClaridadMatApoyo").val(50);
  $("#evalClaridadMatApoyoAmountInput").val(50);
  $("#evalCantidadMatApoyo").val(50);
  $("#evalCantidadMatApoyoAmountInput").val(50);
  $("#evalSimulador").val(50);
  $("#evalSimuladorAmountInput").val(50);
  $("#evalFacilidadSimulador").val(50);
  $("#evalFacilidadSimuladorAmountInput").val(50);
  $("#evalAprendizaje").val(50);
  $("#evalAprendizajeAmountInput").val(50);
  llenarEvaluacionDifusaAnterior(codigoAlumno, idPractica, claveAcceso, visualizar);
  $("#btn-evaluar-evalaucion-difusa").prop("disabled", visualizar);
  $("#evalCalidadCont").prop("disabled", visualizar);
  $("#evalCalidadContAmountInput").prop("disabled", visualizar);
  $("#evalClaridadCont").prop("disabled", visualizar);
  $("#evalClaridadContAmountInput").prop("disabled", visualizar);
  $("#evalCantidadCont").prop("disabled", visualizar);
  $("#evalCantidadContAmountInput").prop("disabled", visualizar);
  $("#evalCalidadMatApoyo").prop("disabled", visualizar);
  $("#evalCalidadMatApoyoAmountInput").prop("disabled", visualizar);
  $("#evalClaridadMatApoyo").prop("disabled", visualizar);
  $("#evalClaridadMatApoyoAmountInput").prop("disabled", visualizar);
  $("#evalCantidadMatApoyo").prop("disabled", visualizar);
  $("#evalCantidadMatApoyoAmountInput").prop("disabled", visualizar);
  $("#evalSimulador").prop("disabled", visualizar);
  $("#evalSimuladorAmountInput").prop("disabled", visualizar);
  $("#evalFacilidadSimulador").prop("disabled", visualizar);
  $("#evalFacilidadSimuladorAmountInput").prop("disabled", visualizar);
  $("#evalAprendizaje").prop("disabled", visualizar);
  $("#evalAprendizajeAmountInput").prop("disabled", visualizar);
  if(visualizar) {
    $("#btn-evaluar-evalaucion-difusa").hide();
  } else {
    $("#btn-evaluar-evalaucion-difusa").show();
  }
  $("#formEvaluarClase").validate({
    rules: {
      evalCalidadCont: {
        required: true
      },
      evalClaridadCont: {
        required: true
      },
      evalCantidadCont: {
        required: true
      },
      evalCalidadMatApoyo: {
        required: true
      },
      evalClaridadMatApoyo: {
        required: true
      },
      evalCantidadMatApoyo: {
        required: true
      },
      evalSimulador: {
        required: true
      },
      evalFacilidadSimulador: {
        required: true
      },
      evalAprendizaje: {
        required: true
      },
      evalAprendizajeAmountInput: {
        required: true
      }
    },
    messages: {
      evalCalidadCont: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      },
      evalClaridadCont: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      },
      evalCantidadCont: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      },
      evalCalidadMatApoyo: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      },
      evalClaridadMatApoyo: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      },
      evalCantidadMatApoyo: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      },
      evalSimulador: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      },
      evalFacilidadSimulador: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      },
      evalAprendizaje: {
        required: "Seleccione el valor que más se ajuste a su perspectiva."
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "../../utileria/logica-difusa/Agregar-calificacion-clase.php",
        type: "POST",
        dataType: "HTML",
        data:"idPractica=" + idPractica
        + "&codigoAlumno=" + codigoAlumno
        + "&claveAcceso=" + claveAcceso
        + "&evalCalidadCont=" + $("#evalCalidadCont").val()
        + "&evalClaridadCont=" + $("#evalClaridadCont").val()
        + "&evalCantidadCont=" + $("#evalCantidadCont").val()
        + "&evalCalidadMatApoyo=" + $("#evalCalidadMatApoyo").val()
        + "&evalClaridadMatApoyo=" + $("#evalClaridadMatApoyo").val()
        + "&evalCantidadMatApoyo=" + $("#evalCantidadMatApoyo").val()
        + "&evalSimulador=" + $("#evalSimulador").val()
        + "&evalFacilidadSimulador=" + $("#evalFacilidadSimulador").val()
        + "&evalAprendizaje=" + $("#evalAprendizaje").val()
      }).done(function(echo) {
        bootbox.alert("ech: " + echo);
        if(echo == "success") {
          bootbox.alert({
            message: "La evaluación de la materia se ha realizado correctamente.",
            callback: function() {
              limpiarFormulario("#formEvaluarClase");
              $("modalEvaluarClase").modal("hide")
              redireccionarPagina("../materia/index-materia.php?claveAccesoClase=" + btoa(claveAcceso));
            }
          });
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
