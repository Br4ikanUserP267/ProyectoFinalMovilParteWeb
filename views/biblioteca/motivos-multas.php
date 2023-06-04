<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Gestión de motivos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
  <div class="container mt-5">
    <h1>Rellenar tabla de motivos</h1>
    <form method="post" id="formMotivos">
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>
            <input type="text" class="form-control" id="motivo" name="motivo" required>
        </div>
        <button type="submit" class="btn btn-primary" id="btnCrearTabla">Crear tabla</button>
        <button type="button" class="btn btn-danger" id="btnLimpiar">Limpiar</button>
    </form>
  </div>

  <div class="container">
    <h2>Motivos Registrados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Motivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="motivosTableBody">
        </tbody>
    </table>
  </div>

  <script>
    function limpiarCampos() {
      document.getElementById("motivo").value = "";
    }

    document.getElementById("btnLimpiar").addEventListener("click", limpiarCampos);

    $(document).ready(function() {
      // Cargar todos los motivos al cargar la página
      cargarMotivos();

      function cargarMotivos() {
        $.ajax({
          url: 'http://localhost/proyectoFinal/api/motivos.php',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            var motivos = data;
            var tableBody = $('#motivosTableBody');
            tableBody.empty();

            // Recorrer cada motivo y agregar una fila a la tabla
            $.each(motivos, function(index, motivo) {
              var row = '<tr>' +
                  '<td>' + motivo.descripcion + '</td>' +
                  '<td>' +
                  '<button class="btn btn-danger" onclick="borrarMotivo(' + motivo.id + ')">Eliminar</button>' +
                  '</td>' +
                  '</tr>';
              tableBody.append(row);
            });
          }
        });
      }

      $('#formMotivos').submit(function(event) {
        // Prevenir el comportamiento predeterminado del formulario
        event.preventDefault();

        // Obtener el valor del campo de motivo
        var motivo = $('#motivo').val();
  
        // Enviar los datos a la API con AJAX
        $.ajax({
    url: 'http://localhost/proyectoFinal/api/motivos.php',
    type: 'POST',
    data: {
      descripcion: motivo
    },
    success: function(response) {
      // Si la petición fue exitosa, mostrar un mensaje de éxito
      alert(response.message);

      limpiarCampos();

      // Recargar la tabla de motivos
      cargarMotivos();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // Si la petición falló, mostrar un mensaje de error
      alert('Error al guardar los datos en la base de datos');
    }
        });
      });
    });

    function borrarMotivo(id) {
      if (confirm("¿Estás seguro de que deseas eliminar este motivo?")) {
        $.ajax({
          url: 'http://localhost/proyectoFinal/api/motivos.php?id=' + id,
          type: 'DELETE',
          success: function(response) {
            alert(response.message);
            cargarMotivos(); // Actualizar la tabla de motivos
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error al eliminar el motivo');
          }
        });
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
