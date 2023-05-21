<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Gestion de editoriales</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
  <div class="container">
    <h2>Formulario de Tabla y Direcciones</h2>
    <form id="formulario">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" id="correo" placeholder="Ingrese el correo" required>
        </div>
        <div class="form-group">
            <label for="numerocontacto">Número de contacto:</label>
            <input type="text" class="form-control" id="numerocontacto" placeholder="Ingrese el número de contacto" required>
        </div>
        <h4>Direcciones:</h4>
        <div id="direcciones-container">
            <div class="direccion">
                <div class="form-group">
                    <label for="pais1">País de la dirección</label>
                    <input type="text" class="form-control" name="pais[]" placeholder="Ingrese el país de la dirección" required>
                </div>
                <div class="form-group">
                    <label for="ciudad1">Ciudad de la dirección</label>
                    <input type="text" class="form-control" name="ciudad[]" placeholder="Ingrese la ciudad de la dirección" required>
                </div>
                <div class="form-group">
                    <label for="direccion1">Dirección completa </label>
                    <input type="text" class="form-control" name="direccion[]" placeholder="Ingrese la dirección completa" required>
                </div>
                <div class="form-group">
                    <label for="departamento1">Departamento de la dirección</label>
                    <input type="text" class="form-control" name="departamento[]" placeholder="Ingrese el departamento de la dirección" required>
                </div>
                <hr>
            </div>
        </div>
        <button type="button" class="btn btn-primary" onclick="agregarDireccion()">Agregar Dirección</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
      <script>

function agregarDireccion() {
    var container = document.getElementById("direcciones-container");
    var direccionCount = container.getElementsByClassName("direccion").length;

    var newDireccion = document.createElement("div");
    newDireccion.classList.add("direccion");

    var html = `
          <div class="form-group">
              <label for="pais${direccionCount}">País de la dirección ${direccionCount}:</label>
              <input type="text" class="form-control" name="pais[]" placeholder="Ingrese el país de la dirección">
          </div>
          <div class="form-group">
              <label for="ciudad${direccionCount}">Ciudad de la dirección ${direccionCount}:</label>
              <input type="text" class="form-control" name="ciudad[]" placeholder="Ingrese la ciudad de la dirección">
          </div>
          <div class="form-group">
              <label for="direccion${direccionCount}">Dirección completa ${direccionCount}:</label>
              <input type="text" class="form-control" name="direccion[]" placeholder="Ingrese la dirección completa">
          </div>
          <div class="form-group">
              <label for="departamento${direccionCount}">Departamento de la dirección ${direccionCount}:</label>
              <input type="text" class="form-control" name="departamento[]" placeholder="Ingrese el departamento de la dirección">
          </div>
      `;

      newDireccion.innerHTML = html;
      container.appendChild(newDireccion);
  }

      </script>

      <script>
       $(document).ready(function() {
        $('#formulario').submit(function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            // Obtener los datos del formulario
            var nombre = $('#nombre').val();
            var correo = $('#correo').val();
            var numerocontacto = $('#numerocontacto').val();

            var direcciones = [];
            $('.direccion').each(function() {
              var pais = $(this).find('input[name="pais[]"]').val();
              var ciudad = $(this).find('input[name="ciudad[]"]').val();
              var direccion = $(this).find('input[name="direccion[]"]').val();
              var departamento = $(this).find('input[name="departamento[]"]').val();


                var direccionObj = {
                    pais: pais,
                    ciudad: ciudad,
                    direccion: direccion,
                    departamento: departamento
                };

                direcciones.push(direccionObj);
            });

            var formData = {
                nombre: nombre,
                correo: correo,
                numerocontacto: numerocontacto,
                direcciones: direcciones
            };

            $.ajax({
                url: 'http://localhost/proyectoFinal/api/editoriales.php',
                type: 'POST',
                data: JSON.stringify(formData), // Convertir los datos a formato JSON
                contentType: 'application/json', // Especificar el tipo de contenido como JSON
                dataType: 'json', // Especificar el tipo de datos esperado en la respuesta
                success: function(response) {
                    // El formulario se ha enviado correctamente
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Hubo un error al enviar el formulario
                    console.error(xhr.responseText);
                }
            });
        });
    });

      </script>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>