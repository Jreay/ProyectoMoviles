const formDatos = document.getElementById("formDatos");
const usuario = document.getElementById("usuarios");
const codvivienda = document.getElementById("codvivienda");
const direccion = document.getElementById("direccion");
const mz = document.getElementById("mz");
const fecha = document.getElementById("fecha");
const villa = document.getElementById("villa");

$(document).ready(function() {
    $.ajax({
            type: 'POST',
            url: './src/loadUser.php'
        })
        .done(function(usuario) {
            $('#usuarios').html(usuario)
        })
        .fail(function() {
            alert('Hubo un error al cargar los usuarios')
        })

});
$(document).ready(function() {
    $("#image").on("change", function() {
        var uploadFoto = document.getElementById("image").value;
        var foto = document.getElementById("image").files;

        var contactAlert = document.getElementById('form_alert');

        if (uploadFoto != '') {
            var type = foto[0].type;
            if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                $('#image').val('');
                return false;
            } else {
                contactAlert.innerHTML = '';
            }
        }
    });
});

$('#newcode').click(function(e) {
    e.preventDefault();
    //$('#cancelar').css({ 'display': '' });
    $('#cancelar').slideDown();

    $('#codimage').slideDown();
})

$('#cancelar').click(function(e) {
    e.preventDefault();
    //$("#image").removeAttr('required');
    //$('#cancelar').css({ 'display': 'none' });
    $('#codimage').slideUp();
    // desactivar un div --->
    $('#codimage').attr('disabled', true);
})

let arregloDatos = [];
formDatos.onsubmit = (e) => {
    e.preventDefault();
    let objDatos = {
        usuario: usuario.value = ($('select[id="usuarios"] option:selected').text()),
        // descripcion: selectDescripcion.textContent,
        codvivienda: codvivienda.value = ($('select[id="codvivienda"] option:selected').text()),

        direccion: direccion.value = ($('select[id="direccion"] option:selected').text()),

        mz: mz.value = ($('select[id="mz"] option:selected').text()),
        fecha: fecha.value = ($('select[id="fecha"] option:selected').text()),
        villa: villa.value = ($('select[id="villa"] option:selected').text()),

    };
    //console.log(objDatos);
    arregloDatos.push(objDatos);
    let datos = { "data": arregloDatos };
    //console.log(datos)

    let json = JSON.stringify(datos);
    console.log(json);


    $.ajax({
        url: './src/guardar.php',
        type: 'POST',
        dataType: 'json',
        data: { "json": json },
        success: function(respuesta) {

            //console.log(respuesta, "ok");
        },
        error: function(mensaje) {
            if (mensaje) {
                //alert(mensaje)
                alert(mensaje.responseText)
            } else {
                alert(mensaje.responseText)

            }

            //console.log(resp.responseText, "error");
        }

    })

};