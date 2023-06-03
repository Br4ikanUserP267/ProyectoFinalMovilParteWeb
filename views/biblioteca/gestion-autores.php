<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de autores</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
</head>
<body>
    <h1>Gestión de autores</h1>
    
    <!-- Formulario para crear un nuevo autor -->
    <form id="crearAutor" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" class="form-control" id="nombres" name="nombres" required>
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" class="form-control-file" id="foto" name="foto" required>
        </div>
        <div class="form-group">
            <label for="biografia">Biografía:</label>
            <input type="text" class="form-control" id="biografia" name="biografia" required>
        </div>
        <div class="form-group">
            <label for="fechanacimiento">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Crear Autor</button>
        <button type="button" class="btn btn-secondary" id="cancelarBtn">Cancelar</button>
    </form>

    <!-- Tabla para mostrar los autores -->
    <table id="autoresTabla" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Biografía</th>
                <th>Foto</th>
                <th>Fecha Nacimiento</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar envío del formulario mediante AJAX
            $('#crearAutor').submit(function(e) {
                e.preventDefault();

                var form = $(this)[0];
                var formData = new FormData(form);
                var fotoInput = $('#foto')[0];
                formData.append('nombres', $('#nombres').val());
                formData.append('apellidos', $('#apellidos').val());
                formData.append('biografia', $('#biografia').val());
                formData.append('fechanacimiento', $('#fechanacimiento').val());
        
                formData.append('foto', fotoInput.files[0]);
          
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/autores.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);

                        // Actualizar la tabla de autores
                        getAutores();
                        // Restablecer el formulario
                        form.reset();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Obtener los autores y mostrarlos en la tabla
            function getAutores() {
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/autores.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Limpiar la tabla
                        $('#autoresTabla tbody').empty();

                        // Agregar los autores a la tabla
                        $.each(response, function(index, autor) {
                            var row = $('<tr>');
                            row.append($('<td>').text(autor.id));
                            row.append($('<td>').text(autor.nombres));
                            row.append($('<td>').text(autor.apellidos));
                            row.append($('<td>').text(autor.biografia));
                            var imagen = $('<img>').attr('src', 'http://localhost/proyectoFinal/api/' + autor.foto).attr('alt', 'Foto').css('width', '100px');
                            row.append($('<td>').append(imagen));
                            row.append($('<td>').text(autor.fechanacimiento));
                            
                            $('#autoresTabla tbody').append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Obtener los autores al cargar la página
            getAutores();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
