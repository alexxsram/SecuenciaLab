// ***************************************** Para el login de la página
var mensajeLogin = $("#mensajeLogin");
mensajeLogin.hide();
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
        mensajeLogin.html(html);
        mensajeLogin.slideDown(400);
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
var mensajeNuevoUsuario = $("#mensajeNuevoUsuario");
mensajeNuevoUsuario.hide();
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
        mensajeNuevoUsuario.html(html);
        mensajeNuevoUsuario.slideDown(500);
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
var mensajeRestablecerContrasena = $("#mensajeRestablecerContrasena");
mensajeRestablecerContrasena.hide();
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
        mensajeRestablecerContrasena.html(html);
        mensajeRestablecerContrasena.slideDown(500);
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
//NOTA: FALTA MANDAR LA CLAVE DEL USUAURIO
var mensajeCrearMateria = $("#mensajeCrearMateria");
mensajeCrearMateria.hide();
$('#modalCrearClase').on('show.bs.modal', function (event) {
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
      cicloEscolar: {
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
      cicloEscolar: {
        required: "Seleccione un ciclo escolar valido"
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: "utileria/sesion/crear-materia.php",
        type: "POST",
        dataType: "HTML",
        data: "nombreClase=" + $("#nombreClase").val() 
        + "&nrcClasae=" + $("#nrcClase").val()
        + "&seccionClase=" + $("#seccionClase").val() 
        + "&materiaClase=" + $("#materiaClase").val() 
        + "&aulaClase=" + $("#aulaClase").val()
        + "anoClase=" + $("#anoClase").val() 
        + "&cicloEscolarClase=" + $("#cicloEscolarClase").val()
      }).done(function(echo) {
        if(echo == "success") {
          limpiarFormulario("#formCrearMateria");
          redireccionarPagina("index.php");
        }
        else {
          var html = "<div class='alert alert-danger' role='alert'>";
          html += echo;
          html += "</div>";
          mensajeLogin.html(html);
          mensajeLogin.slideDown(500);
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

// Funciones auxiliares en caso de necesitarla en el futuro, luego revisar como funcionaba
function limpiarFormulario(idFormulario) {
  $(idFormulario)[0].reset();
}

function redireccionarPagina(ruta) {
  setTimeout(window.location = ruta, 5000);
}

/*function ejecutarAjax(metodo, ruta, archivoPHP, datos, idEtiqueta) {
$.ajax({
type: metodo,
url: ruta + archivoPHP,
dataType: "HTML",
data: datos,
success: function(response) {
$(idEtiqueta).html(response).fadeIn();
}
});
}*/
