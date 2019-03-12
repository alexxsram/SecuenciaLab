$("#formLogin").validate({
    rules: {
        claveUsuario: {
            required: true
        },
        passwordUsuario: {
            required: true,
            minlength: 10
        }
    },
    messages: {
        claveUsuario: {
            required: "Ingresa tu número de usuario"
        },
        passwordUsuario: {
            required: "Ingresa la contraseña",
            minlength: "La contraseña debe ser de 10 caracteres al menos"
        }
    },
    /*submitHandler: function(form) {
        $.ajax({
            url: "model/add_Actividad.php",
            type: "POST",
            dataType: "HTML",
            data: "nombre=" + $("#nombreAc").val() + "&fecha=" + $("#fechaAc").val() + "&fk_clase=" + $("#idClaseAc").val()
        }).done(function(echo) {
            //se cumple mostrando con echo un resultado
        });
    },*/
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
function ejecutarAjax(metodo, ruta, archivoPHP, datos, idEtiqueta) {
    $.ajax({
        type: metodo,
        url: ruta + archivoPHP,
        dataType: "HTML",
        data: datos,
        success: function(response) {
            $(idEtiqueta).html(response).fadeIn();
        }
    });
}