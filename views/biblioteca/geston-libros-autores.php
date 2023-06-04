<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Front-end con AJAX y Bootstrap</title>
    <!-- Incluir los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Agregar relación de autor y libro</h1>
        <form id="relacionForm">
            <div class="form-group">
                <label for="autores_id">ID del Autor</label>
                <select class="form-control" id="autores_id" name="autores_id">
                </select>
            </div>
            <div class="form-group">
                <label for="libros_id">ID del Libro</label>
                <select class="form-control" id="libros_id" name="libros_id">
                </select>           
            </div>
            <div class="form-group">
                <label for="fecha">Fecha escrito</label>
                <input type="date" class="form-control" id="fecha" name="fecha">
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>

        <table id="relacionesTable" class="table">
            <thead>
                <tr>
                    <th>ID Autor</th>
                    <th>ID Libro</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenarán dinámicamente los datos -->
            </tbody>
        </table>
    </div>

    <!-- Incluir jQuery y el archivo JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Llenar el select de autores
            $.ajax({
                url: 'http://localhost/proyectoFinal/api/autores.php',
                method: 'GET',
                success: function(response) {
                    var autores = JSON.parse(response);
                    var selectAutores = $('#autores_id');
                    $.each(autores, function(index, autor) {
                        selectAutores.append($('<option>', {
                            value: autor.id,
                            text: autor.nombres + ' ' + autor.apellidos
                        }));
                    });
                }
            });

            // Llenar el select de libros
            $.ajax({
                url: 'http://localhost/proyectoFinal/api/librosnombre.php',
                method: 'GET',
                success: function(response) {
                    var libros = JSON.parse(response);
                    var selectLibros = $('#libros_id');
                    $.each(libros, function(index, libro) {
                        selectLibros.append($('<option>', {
                            value: libro.id,
                            text: libro.nombre
                        }));
                    });
                }
            });

            // Manejar el envío del formulario utilizando AJAX
            $('#relacionForm').submit(function(event) {
                event.preventDefault(); // Evitar el envío normal del formulario

                // Obtener los valores de los campos de entrada
                var autores_id = $('#autores_id').val();
                var libros_id = $('#libros_id').val();
                var fecha = $('#fecha').val();
                let data = {
                    Autores_idAutores: autores_id,
                    Libros_id: libros_id,
                    fecha: fecha
                };
                var jsonData = JSON.stringify(data);

                // Realizar la solicitud AJAX
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/libroshasautores.php',
                    type: 'POST',
                    contentType: 'application/json',
                    data: jsonData,
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        // Puedes actualizar la interfaz de usuario aquí si es necesario
                        alert('Relación agregada exitosamente');
                        // Volver a cargar las relaciones después de agregar
                        listarRelaciones();
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores de la solicitud AJAX
                        console.log(xhr.responseText);
                        alert('Error al agregar la relación');
                    }
                });
            });

            // Llamar a la función listarRelaciones para llenar la tabla con los datos iniciales
            listarRelaciones();
        });

        function listarRelaciones() {
            $.ajax({
                url: 'http://localhost/proyectoFinal/api/libroshasautores.php',
                method: 'GET',
                success: function(response) {
                    var relaciones = JSON.parse(response);
                    var tabla = $('#relacionesTable tbody');
                    
                    // Limpiar la tabla antes de llenar los datos
                    tabla.empty();

                    // Llenar la tabla con los datos obtenidos
                    $.each(relaciones, function(index, relacion) {
                        var fila = $('<tr>').appendTo(tabla);
                        $('<td>').text(relacion.Autores_idAutores).appendTo(fila);
                        $('<td>').text(relacion.Libros_id).appendTo(fila);
                        $('<td>').text(relacion.fecha).appendTo(fila);

                        // Agregar el botón de eliminar en la última columna de la fila
                        var botonEliminar = $('<button>').text('Eliminar').addClass('btn btn-danger').appendTo($('<td>').appendTo(fila));
                        botonEliminar.click(function() {
                            eliminarRelacion(relacion.Autores_idAutores, relacion.Libros_id);

                        });
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Error al obtener las relaciones');
                }
            });
        }

        function eliminarRelacion(autorId, libroId) {
    // Realizar la solicitud AJAX para eliminar la relación
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/libroshasautores.php?Autores_id=' + autorId + '&Libros_id=' + libroId,
                    method: 'DELETE',
                    success: function(response) {
                        alert('Relación eliminada exitosamente');
                        // Volver a cargar las relaciones después de eliminar
                        listarRelaciones();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Error al eliminar la relación');
                    }
                });
            }


    </script>
</body>
</html>
