<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Gestion de Temas</title>
</head>
<body>
    <h1>Gestion de temas</h1>
   <form id="crear-tema-form">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <select id="categoria-select" class="form-select" required>
                <option value="">Seleccione una categoría</option>
                <!-- Opciones generadas dinámicamente desde la API -->
            </select>
            

</div>
<br>

        <button type="submit" class="btn btn-primary">Crear</button>
     <br>
    
    </form>
   
        <script>
            $(document).ready(function() {
    // Realizar solicitud GET a la API para obtener las categorías
            $.ajax({
                url: 'http://localhost/proyectoFinal/api/categorias.php',
                type: 'GET',
                success: function(response) {
                    // Manejar la respuesta de la API y agregar opciones al elemento select
                    var categorias = JSON.parse(response);
                    var select = $('#categoria-select');
                    
                    categorias.forEach(function(categoria) {
                        var option = $('<option>');
                        option.val(categoria.id);
                        option.text(categoria.nombre);
                        select.append(option);
                    });
                },
                error: function() {
                    console.log('Error al obtener las categorías');
                }
            });
        });

        </script>
        <script>
            $(document).ready(function() {
    $('#crear-tema-form').submit(function(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto

        // Obtén el valor del campo de nombre
        var nombre = $('#nombre').val();
        // Obtén el valor del campo de categoría
        var categoriaId = $('#categoria-select').val();

        // Crea un objeto con los datos a enviar en la solicitud POST
        var data = {
            nombre: nombre,
            Categorias_id: categoriaId
        };

        // Realiza la solicitud POST utilizando AJAX
        $.ajax({
            url: 'http://localhost/proyectoFinal/api/temas.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                // La solicitud fue exitosa
                console.log(response);
                alert('Tema creado exitosamente');
                $('#crear-tema-form')[0].reset();
            },
            error: function(xhr, status, error) {
                // Ocurrió un error durante la solicitud
                console.error(xhr.responseText);
                alert('Error al crear el tema');
                    }
                });
            });
        });

        </script>
<div class="container">
        <h2>Listado Categorias</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
             
                </tr>
            </thead>
            <tbody id="inscripcionesTableBody">
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Cargar todas las inscripciones al cargar la página
            cargarInscripciones();

            function cargarInscripciones() {
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/categorias.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var temas = data;
                        var tableBody = $('#inscripcionesTableBody');
                        tableBody.empty();

                        // Recorrer cada inscripción y agregar una fila a la tabla
                        $.each(temas, function(index, tema) {
                            var row = '<tr>' +
                                '<td>' + tema.id + '</td>' +
                                '<td>' + tema.nombre + '</td>' +
                           
                               
                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                });
            }

        
        

        });
        
    </script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>