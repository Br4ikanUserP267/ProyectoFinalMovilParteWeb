<!DOCTYPE html>
<html>
<head>
    <title>Prestamos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Prestamos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha Vencimiento</th>
                    <th>Prestado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="prestamosTableBody"></tbody>
        </table>
    </div>

    <script>
        // Load Prestamos data on page load
        $(document).ready(function() {
            loadPrestamos();
        });

        // Load Prestamos data using Ajax
        function loadPrestamos() {
            $.ajax({
                url: "http://localhost/proyectoFinal/api/prestamos.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var prestamos = response.prestamos;
                    var tableBody = $("#prestamosTableBody");
                    tableBody.empty();

                    $.each(prestamos, function(index, prestamo) {
                        var row = $("<tr>");
                        row.append($("<td>").text(prestamo.id));
                        row.append($("<td>").text(prestamo.nombre_libro));
                        row.append($("<td>").text(prestamo.fechaFinal));
                        var prestadoCell = $("<td>").text(prestamo.prestado ? "Si" : "No");
                        prestadoCell.click(function() {
                            callCambiarEstadoPrestamo(prestamo.id);
                        });
                        row.append(prestadoCell);
                        
                        row.append($("<td>").html("<button class='btn btn-danger btn-sm' onclick='deletePrestamo(" + prestamo.id + ")'>Eliminar</button>" +
                            "<button class='btn btn-warning btn-sm' onclick='multarPrestamo(" + prestamo.id + ")'>Multar</button>"));


                        tableBody.append(row);
                    });
                }
            });
        }

        // Edit Prestamo
        function callCambiarEstadoPrestamo(id) {
            var confirmEdit = confirm("¿Estás seguro de editar este préstamo?");

            if (confirmEdit) {
                $.ajax({
                    url: "http://localhost/proyectoFinal/api/cambiarestado.php",
                    type: "POST",
                    data: { prestamoId : id },
                    dataType: "json",
                    success: function(response) {
                        alert("Préstamo editado correctamente");
                        loadPrestamos();
                    }
                });
            }
        }

        // Delete Prestamo
        function deletePrestamo(id) {
            var confirmDelete = confirm("¿Estás seguro de eliminar este préstamo?");

            if (confirmDelete) {
                $.ajax({
                    url: "http://localhost/proyectoFinal/api/prestamos.php?id=" + id,
                    type: "DELETE",
                    dataType: "json",
                    success: function(response) {
                        alert("Préstamo eliminado correctamente");
                        loadPrestamos();
                    }
                });
            }
        }
        function multarPrestamo(id) {
            var tipoMulta = prompt("Ingrese el tipo de multa:");

            if (tipoMulta) {
                $.ajax({
                    url: "http://localhost/proyectoFinal/api/multar.php",
                    type: "POST",
                    data: JSON.stringify({
                        Prestamos_id: id,
                        motivos_multa: tipoMulta
                    }),
                    contentType: "application/json",
                    dataType: "json",
                    success: function(response) {
                        alert("Multa creada exitosamente");
                        loadPrestamos();
                    }
                });
            }
        }
    </script>
</body>
</html>
