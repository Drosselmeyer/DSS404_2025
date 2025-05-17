$(document).ready(function () {
    // Cargar usuarios al cargar la página
    cargarUsuarios();

    // Agregar usuario
    $('#formAgregar').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'http://localhost/DSS404_2025/Semana16/php/agregar_usuario.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                cargarUsuarios();
                $('#modalAgregar').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario agregado',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        limpiarFormulario($('#formAgregar'));
    });

    // Editar usuario
    $(document).on('click', '.editarUsuario', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'http://localhost/DSS404_2025/Semana16/php/obtener_usuarios.php',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                var usuario = JSON.parse(response);
                $('#idEditar').val(usuario.id);
                $('#nombreEditar').val(usuario.nombre);
                $('#emailEditar').val(usuario.email);
                $('#modalEditar').modal('show');
            }
        });
    });

    $('#formEditar').submit(function (e) {
        e.preventDefault();
        var id = $('#idEditar').val();
        $.ajax({
            url: 'http://localhost/DSS404_2025/Semana16/php/editar_usuario.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                cargarUsuarios();
                $('#modalEditar').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario actualizado',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        limpiarFormulario($('#formEditar'));
    });

    // Eliminar usuario
    $(document).on('click', '.eliminarUsuario', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'http://localhost/DSS404_2025/Semana16/php/eliminar_usuario.php',
                    type: 'POST',
                    data: { id: id },
                    success: function (response) {
                        cargarUsuarios();
                        Swal.fire({
                            icon: 'success',
                            title: 'Usuario eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        });
    });

    // Función para cargar usuarios mediante AJAX
    function cargarUsuarios() {
        $.ajax({
            url: 'http://localhost/DSS404_2025/Semana16/php/obtener_usuarios.php',
            type: 'GET',
            success: function (response) {
                var usuarios = JSON.parse(response);
                var listaHTML = '<ul class="list-group">';
                usuarios.forEach(function (usuario) {
                    listaHTML += '<li class="list-group-item">' + usuario.id + ' - ' + usuario.nombre + '-' + usuario.email +
                        '<button type="button" class="btn btn-sm btn-primary editarUsuario ml-2" data-id="' + usuario.id + '">Editar</button>' +
                        '<button type="button" class="btn btn-sm btn-danger eliminarUsuario ml-2" data-id="' + usuario.id + '">Eliminar</button></li>';
                });
                listaHTML += '</ul>';
                $('#usuarios-lista').html(listaHTML);
            }
        });
    }

    // Función para limpiar un formulario
    function limpiarFormulario(formulario) {
        formulario.find('input[type=text], input[type=email]').val('');
    }
});
