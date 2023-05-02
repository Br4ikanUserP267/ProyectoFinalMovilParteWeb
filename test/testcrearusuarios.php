<?php

require("../models/UsuarioCrear.php");
require("../controllers/controladorcrearusuarios.php");

$controladorCrearUsuarios = new ControladorCrearUsuarios();

$usuario = new UsuarioCrear(intval($_POST['numeroIdentificacion']), $_POST['contrasena'], $_POST['tipousuario']);

// verificar si el usuario ya existe

$resultado = $controladorCrearUsuarios->consultarRegistro($usuario);

if ($resultado->num_rows > 0) {
    echo '<script>alert("El usuario ya existe "); window.location.href = "../views/administrador/gestion-usuarios.php";</script>';
} else {
    $controladorCrearUsuarios->setNumeroIdentificacion($usuario->numeroIdentificacion);
    $controladorCrearUsuarios->setContrasena($usuario->contrasena);
    $controladorCrearUsuarios->setTipoUsuario($usuario->tipoUsuario);

    if ($controladorCrearUsuarios->guardar()) {
        echo "Usuario creado exitosamente";
    } else {
        echo "Error al crear el usuario";
    }
}
