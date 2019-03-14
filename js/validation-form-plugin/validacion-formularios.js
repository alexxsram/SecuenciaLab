// ***************************************** Para el login de la página
var mensajeLogin = $("#mensajeLogin");

mensajeLogin.hide();
    $("#formLogin").validate({
        rules: {
            claveUsuario: {
                required: true
            },
            passwordUsuario: {
                required: true
            }
        },
        messages: {
            claveUsuario: {
                required: "Ingresa tu número de usuario"
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