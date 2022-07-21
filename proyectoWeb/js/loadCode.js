$(document).ready(function() {
    $.ajax({
            type: 'POST',
            url: './src/loadCode.php'
        })
        .done(function(code) {
            $('#codvivienda').html(code)
        })
        .fail(function() {
            alert('Hubo un error al cargar el codvivienda')
        })

    $('#codvivienda').on('change', function() {
        var id = $('#codvivienda').val()
        $.ajax({
            type: 'POST',
            url: './src/loadDireccion.php',
            data: { 'id': id }
        })

        .done(function(id) {
                $('#direccion').html(id)
            })
            .fail(function() {
                alert('Hubo un error al cargar la direccion')
            })


    })
    $('#codvivienda').on('change', function() {
        var id = $('#codvivienda').val()
        $.ajax({
                type: 'POST',
                url: './src/loadMz.php',
                data: { 'id': id }
            })
            .done(function(id) {
                $('#mz').html(id)
            })
            .fail(function() {
                alert('Hubo un error al cargar la mz')

            })

    })
    $('#codvivienda').on('change', function() {
        var id = $('#codvivienda').val()
        $.ajax({
                type: 'POST',
                url: './src/loadFecha.php',
                data: { 'id': id }
            })
            .done(function(id) {
                $('#fecha').html(id)
            })
            .fail(function() {
                alert('Hubo un error al cargar la fecha')

            })

    })
    $('#codvivienda').on('change', function() {
        var id = $('#codvivienda').val()
        $.ajax({
                type: 'POST',
                url: './src/loadVilla.php',
                data: { 'id': id }
            })
            .done(function(id) {
                $('#villa').html(id)
            })
            .fail(function() {
                alert('Hubo un error al cargar la villa')

            })

    })


})