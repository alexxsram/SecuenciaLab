// ***************************************** Para el login de la página
var mensajeLogin = $("#mensajeLogin");
mensajeLogin.hide();
$("#formLogin").validate({
  rules: {
    claveUsuario: {
      required: true,
      minlength: 9,
      maxlength: 9
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
        window.location = "index.php";
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

// ***************************************** Para el creación de clase
//NOTA: FALTA MANDAR LA CLAVE DEL USUAURIO
var mensajeCrearMateria = $("#mensajeCrearMateria");
mensajeCrearMateria.hide();
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
      minlength: 4,
      maxlength: 4,
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
      date: "Ingrese un año valido en formato yyyy",
      required: "Ingresa el año. Debe ser igual o mayor al año actual",
      minlength: jQuery.validator.format("La año debe tener mínimo {0} caracteres. En formato yyyy."),
      maxlength: jQuery.validator.format("La año debe tener mínimo {0} caracteres.  En formato yyyy.")
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
      data: "nombreClase=" + $("#nombreClase").val() + "&seccionClase=" + $("#seccionClase").val() + "&materiaClase=" + $("#materiaClase").val() + "&aulaClase=" + $("#aulaClase").val()
    }).done(function(echo) {
      if(echo == "success") {
        window.location = "index.php";
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

// ***************************************** Para restablecer contraseña de usuario
var mensajeRestablecerContrasena = $("#mensajeRestablecerContrasena");
mensajeRestablecerContrasena.hide();
$("#formRestarblecerContrasena").validate({
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
    confirNuevoPassword: {
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
    confirNuevoPassword: {
      required: "Ingresa la contraseña",
      equalTo: "La contraseña debe ser igual a la que acaba de ingresar",
      minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
      maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres")
    }
  },
  submitHandler: function(form) {
    $.ajax({
      url: "utileria/sesion/restablecer-contrasena-sesion.php",
      type: "POST",
      dataType: "HTML",
      data: "claveUsuario=" + $("#claveUsuario").val() + "&respuestaSeguridad=" + $("#respuestaSeguridad").val() + "&nuevoPasswordUsuario=" + $("#nuevoPasswordUsuario").val() + "&confirNuevoPassword=" + $("#confirNuevoPassword").val()
    }).done(function(echo) {
      if(echo == "success") {
        window.location = "login.php";
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
    password: {
      required: true,
      minlength: 8,
      maxlength: 45
    },
    confirPassword: {
      required: true,
      minlength: 8,
      maxlength: 45,
      equalTo: "#password"
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
    password: {
      required: "Ingresa la contraseña",
      minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
      maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres")
    },
    confirPassword: {
      required: "Ingresa la contraseña",
      equalTo: "La contraseña debe ser igual a la que acaba de ingresar",
      minlength: jQuery.validator.format("La contraseña debe tener una longitud como mínimo de {0} caracteres"),
      maxlength: jQuery.validator.format("La contraseña debe tener una longitud como máximo de  {0} caracteres")
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
      + "&respuestaSeguridad=" + $("#respuestaSeguridad").val()
      + "&nuevoPasswordUsuario=" + $("#nuevoPasswordUsuario").val()
      + "&confirNuevoPassword=" + $("#confirNuevoPassword").val()
    }).done(function(echo) {
      if(echo == "success") {
        window.location = "login.php";
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



// Función auxiliar en caso de necesitarla en el futuro, luego revisar como funcionaba
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
