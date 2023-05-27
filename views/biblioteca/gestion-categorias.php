<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    
    <title>Gestion de categorias</title>
</head>
<body>
    <h1>Gestion de categorias</h1>
    <form id="crear-categoria-form">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
    <script>

        $(document).ready(function () {
            $('#crear-categoria-form').submit(function (event) {
                event.preventDefault(); // Evita el envío del formulario por defecto

                // Obtén el valor del campo de nombre
                var nombre = $('#nombre').val();

                // Crea un objeto con los datos a enviar en la solicitud POST
                var data = {
                    nombre: nombre
                };

                // Realiza la solicitud POST utilizando AJAX
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/categorias.php',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (response) {
                        // La solicitud fue exitosa
                        console.log(response);
                        alert('Categoría creada exitosamente');
                        $('#crear-categoria-form')[0].reset();

                    },
                    error: function (xhr, status, error) {
                        // Ocurrió un error durante la solicitud
                        console.error(xhr.responseText);
                        alert('Error al crear la categoría');
                    }
                });
            });
        });
    </script>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>