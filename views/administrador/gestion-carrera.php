
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Gestion de estudiantes</title>
</head>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Gestioncarrera</title>
  </head>
  <body>
    <div class="container">

        <form method="post" >
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary" id="submit-btn">Guardar</button>
              <button type="reset" class="btn btn-danger">Cancelar</button>

        </form>
        <script>
          document.querySelector('button.btn-danger').addEventListener('click', function() {
            document.querySelector('form').reset();
          });
        </script>

        <script>
              // Get form data and send a POST request to the PHP script
              $(document).ready(function() {
                $("#submit-btn").click(function() {
                  var titulo = $("#titulo").val();
                  var descripcion = $("#descripcion").val();
                  
                  $.ajax({
                    type: "POST",
                    url: "http://localhost/proyectoFinal/api/carreras.php",
                    data: {titulo: titulo, descripcion: descripcion},
                    dataType: "json",
                    success: function(response) {
                      console.log(response);
                      // Handle successful response
                    },
                    error: function(xhr, status, error) {
                      console.log(xhr.responseText);
                      // Handle error response
                    }
                  });
                });
              });




        </script>
       <!-- Tablas   -->












</body>
</html>



      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>