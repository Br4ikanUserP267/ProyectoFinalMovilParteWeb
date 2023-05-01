<?php

require("../models/Usuario.php");
require("../controllers/usuariocontroller.php");

$usuario = new Usuario($_POST['usuario'], $_POST['password']);
$controladorLogin = new ControladorLogin();
$resultado = $controladorLogin->consultarRegistro($usuario);

if (!$resultado) {
    die('Error en la consulta SQL: ' . $controladorLogin->getConexion()->error);
}

if ($resultado->num_rows == 0) {
    echo 'El usuario no existe';
} else {
    $fila = $resultado->fetch_assoc();
    $tipo = $fila['tipousuario'];
    if ($_POST['password'] == $fila['contrasena']) {
        switch ($tipo) {
            case 'a':
                header('Location: ../views/administrador/menu.php');
                break;
            case 'b':
                header('Location: ../views/usuario_b/menu.php');
                break;
            case 'e':
                header('Location: ../views/usuario_e/menu.php');
                break;
            default:
                echo 'Tipo de usuario no válido';
                break;
        }
    } else {
        echo 'Contraseña incorrecta';
    }
}

?>