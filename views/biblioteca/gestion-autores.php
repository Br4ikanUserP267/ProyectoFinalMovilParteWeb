<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <title>Gestion de autores</title>
</head>
<body>
   
    <div class="container">
      <h1>Crear Autor</h1>
      <form id="crearAutorForm" enctype="multipart/form-data">
          <div class="form-group">
              <label for="nombres">Nombres:</label>
              <input type="text" class="form-control" id="nombres" name="nombres" required>
          </div>
          <div class="form-group">
              <label for="apellidos">Apellidos:</label>
              <input type="text" class="form-control" id="apellidos" name="apellidos" required>
          </div>
          <div class="form-group">
              <label for="biografia">Biografía:</label>
              <textarea class="form-control" id="biografia" name="biografia" rows="3" required></textarea>
          </div>
          <div class="form-group">
              <label for="foto">Foto:</label>
              <input type="file" class="form-control-file" id="foto" name="foto" required>
          </div>
        <br>
          <button type="submit" class="btn btn-primary">Crear Autor</button>
          <button type="reset" class="btn btn-danger">Cancelar</button>
      </form>
  </div>
  <script>
    document.querySelector('button.btn-danger').addEventListener('click', function() {
      document.querySelector('crearAutorForm').reset();
    });
  </script>
  <script>
    $(document).ready(function() {
        // Escuchar el evento de envío del formulario
        $('#crearAutorForm').submit(function(event) {
            event.preventDefault(); // Evitar el envío por defecto

            // Obtener los datos del formulario
            var formData = new FormData(this);

            // Enviar la solicitud AJAX
            $.ajax({
                url: 'http://localhost/proyectoFinal/api/autores.php', // Reemplaza "tu_archivo.php" con el nombre de tu archivo PHP
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Manejar la respuesta exitosa
                    alert('Autor creado exitosamente');
                    // Puedes redirigir a otra página o realizar otras acciones aquí
                },
                error: function(xhr, status, error) {
                    // Manejar errores
                    console.log(error);
                    alert('Hubo un error al crear el autor');
                }
            });
        });
    });
</script>
    <script>



    </script>



      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>