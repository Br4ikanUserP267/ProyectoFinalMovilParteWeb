<?php
require '../../../../controllers/controladorusuarios.php'; // incluir el archivo usuarios.php

// Llamar a la función listarUsuarios
$controlador = new ControladorUsuarios();
$controlador->obtenerUsuarios();


?>


<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['correo']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>