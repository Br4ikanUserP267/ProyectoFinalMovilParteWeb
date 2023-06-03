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
                <label for="Autores_id">ID del Autor</label>
                <input type="text" class="form-control" id="Autores_id" name="Autores_id">
            </div>
            <div class="form-group">
                <label for="Libros_id">ID del Libro</label>
                <input type="text" class="form-control" id="Libros_id" name="Libros_id">
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="text" class="form-control" id="fecha" name="fecha">
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>

    <!-- Incluir jQuery y el archivo JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Manejar el envío del formulario utilizando AJAX
            $('#relacionForm').submit(function(event) {
                event.preventDefault(); // Evitar el envío normal del formulario

                // Obtener los valores de los campos de entrada
                var Autores_id = $('#Autores_id').val();
                var Libros_id = $('#Libros_id').val();
                var fecha = $('#fecha').val();

                // Realizar la solicitud AJAX
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/libroshaslibros.php',
                    type: 'POST',
                    data: {
                        Autores_id: Autores_id,
                        Libros_id: Libros_id,
                        fecha: fecha
                    },
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        // Puedes actualizar la interfaz de usuario aquí si es necesario
                        alert('Relación agregada exitosamente');
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores de la solicitud AJAX
                        console.log(xhr.responseText);
                        alert('Error al agregar la relación');
                    }
                });
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            // Llenar el select de autores
            $.ajax({
                url: 'http://localhost/proyectoFinal/api/autores.php',
                method: 'GET',
                success: function(response) {
                    var autores = JSON.parse(response);
                    var selectAutores = $('#Autores_id');
                    $.each(autores, function(index, autor) {
                        selectAutores.append($('<option>', {
                            value: autor.id,
                            text: autor.nombre
                        }));
                    });
                }
            });

            // Llenar el select de libros
            $.ajax({
                url: 'http://localhost/proyectoFinal/api/libros.php',
                method: 'GET',
                success: function(response) {
                    var libros = JSON.parse(response);
                    var selectLibros = $('#Libros_id');
                    $.each(libros, function(index, libro) {
                        selectLibros.append($('<option>', {
                            value: libro.id,
                            text: libro.titulo
                        }));
                    });
                }
            });
        });
    </script>
</body>
</html>
