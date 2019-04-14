//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& Funciones que validan los formularios
// ***************************************** Para dar de alta un usuario
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
    }
  },
  messages: {
    evalCalidadCont: {
      required: "Ingresa este campo es requerido."
    },
    evalClaridadCont: {
      required: "Ingresa este campo es requerido."
    },
    evalCantidadCont: {
      required: "Ingresa este campo es requerido."
    },
    evalCalidadMatApoyo: {
      required: "Ingresa este campo es requerido."
    },
    evalClaridadMatApoyo: {
      required: "Ingresa este campo es requerido."
    },
    evalCantidadMatApoyo: {
      required: "Ingresa este campo es requerido."
    },
    evalSimulador: {
      required: "Ingresa este campo es requerido."
    },
    evalFacilidadSimulador: {
      required: "Ingresa este campo es requerido."
    },
    evalAprendizaje: {
      required: "Ingresa este campo es requerido."
    }
  },
  submitHandler: function(form) {
    $.ajax({
      url: "utileria/logica-difusa/Agregar-calificacion-clase.php",
      type: "POST",
      dataType: "HTML",
      data: "evalCalidadCont=" + $("#evalCalidadCont").val()
      + "&evalClaridadCont=" + $("#evalClaridadCont").val()
      + "&evalCantidadCont=" + $("#evalCantidadCont").val()
      + "&evalCalidadMatApoyo=" + $("#evalCalidadMatApoyo").val()
      + "&evalClaridadMatApoyo=" + $("#evalClaridadMatApoyo").val()
      + "&evalCantidadMatApoyo=" + $("#evalCantidadMatApoyo").val()
      + "&evalSimulador=" + $("#evalSimulador").val()
      + "&evalFacilidadSimulador=" + $("#evalFacilidadSimulador").val()
      + "&evalAprendizaje=" + $("#evalAprendizaje").val()
    }).done(function(echo) {
      if(echo == "success") {
        limpiarFormulario("#formEvaluarClase");
        redireccionarPagina("panel-info-alumno.php");
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

// ***************************************** Para cambiar la contraseña de un usuario
$("#modalCambiarPassword").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

  var claveUsuario = button.data("codigo");

  modal.find("#formCambiarPassword #claveUsuario").val(claveUsuario);

  $("#formCambiarPassword").validate({
    rules: {
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
      nuevaPasswordUsuario: {
        required: "Ingresa la contraseña",
        minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
        maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres")
      },
      confirmarNuevaPasswordUsuario: {
        required: "Ingresa la contraseña",
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
        data: "passwordUsuario=" + $("#nuevaPasswordUsuario").val()
        + "&claveUsuario=" + $("#claveUsuario").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formCambiarPassword");
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
          cargarContenido('contenidoClase', 'utileria/materia/', 'ingresar-materia.php', 'claveAccesoClase=' + claveAcceso);
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

  modal.find("#formEditarPractica #editarIdPractica").val(idPractica);
  modal.find("#formEditarPractica #editarNombrePractica").val(nombre);
  modal.find("#formEditarPractica #editarDescripcionPractica").val(descripcion);
  modal.find("#formEditarPractica #editarFechaLimitePractica").val(fechaLimite);

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
        url: "utileria/practica/editar-practica.php",
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
          cargarContenido('contenidoClase', 'utileria/materia/', 'ingresar-materia.php', 'claveAccesoClase=' + claveAcceso);
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

// ***************************************** Para unir estudiante a una clase
$("#modalUnirseClase").on("show.bs.modal", function (event) {
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
      $.ajax({
        url: "utileria/materia/unirse-clase.php",
        type: "POST",
        dataType: "HTML",
        data: "claveClase=" + $("#unirseClaveAcceso").val()
        + "&codigoAlumno=" + $("#codigoAlumnoUnirse").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formUnirseClase");
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
    success: function(echo) {
      if(echo =="success"){
      bootbox.alert({
        message: "Registro eliminado correctamente!",
        callback: function () {
          redireccionarPagina(rutaRedireccionar);
        }
      });
    }else{
      bootbox.alert({
        message: echo,
        callback: function () {
          redireccionarPagina(rutaRedireccionar);
        }
      });
    }
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
}

function accionarEliminacionContenido(tipoMetodo, ruta, archivoPHP, tipoDato, datos, idEtiqueta, rutaRecargar, archivoPHP, datos) { //esta función sirve para eliminar todo lo relacionado a una clase como practicas, alumnos y/o calificaciones de alumnos
  $.ajax({
    type: tipoMetodo,
    url: ruta + archivoPHP,
    dataType: tipoDato,
    data: datos,
    success: function(response) {
      bootbox.alert({
        message: "Registro eliminado correctamente!",
        callback: function () {
          cargarContenido(idEtiqueta, rutaRecargar, archivoPHP, datos);
        }
      });
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
}

function confirmarEliminar(valor, tipo) {
  if(tipo == "clase") { //Si elimino una clase
    var claveAcceso = valor;
    bootbox.confirm({
      title: "Eliminar clase",
      message: "¿Está seguro que desea eliminar la clase?",
      size: 'small',
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
          accionarEliminacion("POST", "utileria/materia/", "eliminar-materia.php", "HTML", "claveAcceso=" + claveAcceso, "index.php");
        }
      }
    });
  } else if(tipo == "practica") { //Si elimino una practica
    var vectorValores = valor.split("-");
    var idPractica = vectorValores[0];
    var claveAcceso = vectorValores[1];
    bootbox.confirm({
      title: "Eliminar practica #" + idPractica,
      message: "¿Está seguro que desea eliminar la práctica?",
      size: 'small',
      backdrop: true,
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
          accionarEliminacionContenido("POST", "utileria/practica/", "eliminar-practica.php", "HTML", "idPractica=" + idPractica, "contenidoClase", "utileria/materia/", "ingresar-materia.php", "claveAccesoClase=" + claveAcceso);
        }
      }
    });
  }
}

function expandirClaveAcceso(claveAcceso) {
  bootbox.alert({
    title: "Clave de acceso de la clase",
    message: '<blockquote class="blockquote text-center"> <h1 class="display-1" id="titulo">' +  claveAcceso + '</h1></blockquote>',
    size: 'large',
    backdrop: true,
    className: "swing animated",
    callback: function (result) {
    }
  });
}

function cerrarModal(idEtiqueta, tipoAccion) {
  $(idEtiqueta).modal(tipoAccion);
}

$('#formNuevoUsuario').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/sesion/selector-seguridad.php",
    success: function(response)
    {
      $('#preguntaSeguridad').html(response).fadeIn();
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#modalCrearClase').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/materia/selector-cicloEscolar.php",
    success: function(response)
    {
      $('#cicloEscolarClase').html(response).fadeIn();
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});

$('#modalCrearClase').ready(function() {
  $.ajax({
    type: "POST",
    url: "utileria/materia/selector-cicloEscolar.php",
    success: function(response)
    {
      $('#editarCicloEscolarClase').html(response).fadeIn();
    },
    error: function(response) {
      bootbox.alert("Error: " + response);
    }
  });
});
