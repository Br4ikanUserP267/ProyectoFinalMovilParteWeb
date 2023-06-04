<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Editoriales</title>
</head>
<body>
    <div class="container">
        <h2>Listado de Editoriales</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Direcciones</th>
                </tr>
            </thead>
            <tbody id="editorialesTableBody"></tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cargar las editoriales al cargar la página
            cargarEditoriales();

            function cargarEditoriales() {
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/editoriales.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var editoriales = data;
                        var tableBody = $('#editorialesTableBody');
                        tableBody.empty();

                        // Recorrer cada editorial y agregar una fila a la tabla
                        $.each(editoriales, function(index, editorial) {
                            var row = $('<tr>');
                            $('<td>').text(editorial.id).appendTo(row);
                            $('<td>').text(editorial.nombre).appendTo(row);

                            var direcciones = $('<ul>');
                            $.each(editorial.direcciones, function(index, direccion) {
                                $('<li>').text(direccion.direccion + ', ' + direccion.ciudad).appendTo(direcciones);
                            });
                            $('<td>').append(direcciones).appendTo(row);

                            row.appendTo(tableBody);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error al cargar las editoriales');
                    }
                });
            }
        });
    </script>
</body>
</html>
