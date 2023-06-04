<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Gestion de libros</title>
</head>
<body>
    <h1>Gestion de libros</h1>
    
<!-- Formulario para crear un nuevo libro -->
<form id="crearLibroForm" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="Editoriales_id">ID de la editorial:</label>
        <input type="number" class="form-control" id="Editoriales_id" name="Editoriales_id" required>
    </div>
    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <input type="file" class="form-control-file" id="imagen" name="imagen" required>
    </div>
    <div class="form-group">
        <label for="temas_id">ID del tema:</label>
        <input type="number" class="form-control" id="temas_id" name="temas_id" required>
    </div>
    <div class="form-group">
        <label for="valor">Valor:</label>
        <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
    </div>
    <div class="form-group">
        <label for="disponibilidad">Disponibilidad:</label>
        <input type="checkbox" class="form-check-input" id="disponibilidad" name="disponibilidad" value="1" checked>
    </div>
    <div class="form-group">
        <label for="numerounidades">Número de unidades:</label>
        <input type="number" class="form-control" id="numerounidades" name="numerounidades" required>
    </div>
    <div class="form-group">
        <label for="resumen">Resumen</label>
        <input type="text" class="form-control" id="resumen" name="resumen" required>
    </div>
    <button type="submit" class="btn btn-primary">Crear libro</button>
    <button type="button" class="btn btn-secondary" id="cancelarBtn">Cancelar</button>
</form>

<!-- Tabla para mostrar los libros -->
<table id="librosTabla" class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Editoriales ID</th>
            <th>Imagen</th>
            <th>Tema ID</th>
            <th>Valor</th>
            <th>Disponibilidad</th>
            <th>Número de unidades</th>           
            <th>Ubicación</th>
            
            <th>Resumen</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Manejar envío del formulario mediante AJAX
    $('#crearLibroForm').submit(function(e) {
        e.preventDefault();

        var form = $(this)[0];
        var formData = new FormData(form);

        $.ajax({
            url: 'http://localhost/proyectoFinal/api/libros.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                // Actualizar la tabla de libros
                getLibros();
                // Restablecer el formulario
                form.reset();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // Obtener y mostrar los libros al cargar la página
    getLibros();

    // Función para obtener los libros y actualizar la tabla
    function getLibros() {
    $.ajax({
        url: 'http://localhost/proyectoFinal/api/libros.php',
        type: 'GET',
        success: function(response) {
            var libros = JSON.parse(response);
            var tbody = $('#librosTabla tbody');
            tbody.empty();

            libros.forEach(function(libro) {
                var row = $('<tr>');
                row.append($('<td>').text(libro.id));
                row.append($('<td>').text(libro.nombre));
                row.append($('<td>').text(libro.Editoriales_id));
                var imagen = $('<img>').attr('src', 'http://localhost/proyectoFinal/api/' + libro.imagen).attr('alt', 'Imagen del libro').attr('width', '50');
                row.append($('<td>').append(imagen));
                row.append($('<td>').text(libro.temas_id));
                row.append($('<td>').text(libro.valor));
                var disponibilidad = (libro.disponibilidad == 1) ? 'Disponible' : 'No disponible';
                row.append($('<td>').text(disponibilidad));
                row.append($('<td>').text(libro.numerounidades));
                row.append($('<td>').text(libro.ubicacion));
                row.append($('<td>').text(libro.resumen));
                
                // Agregar botón de eliminar
                var eliminarBtn = $('<button>').text('Eliminar').addClass('btn btn-danger btn-sm eliminar-btn');
                eliminarBtn.data('id', libro.id); // Almacenar el ID del libro en el botón
                row.append($('<td>').append(eliminarBtn));
                
                tbody.append(row);
            });

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

    $(document).on('click', '.eliminar-btn', function() {
        var libroId = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/proyectoFinal/api/libros.php?id=' + libroId,
            type: 'DELETE',
            success: function(response) {
                console.log(response);
                // Actualizar la tabla de libros
                getLibros();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // Manejar clic en el botón de cancelar
    $('#cancelarBtn').click(function() {
        $('#crearLibroForm')[0].reset();
    });
});
</script>



    
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>