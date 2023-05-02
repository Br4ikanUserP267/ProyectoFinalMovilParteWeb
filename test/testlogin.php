<?php


require("../models/Usuario.php");
require("../controllers/ControladorLogin.php");

$controladorLogin = new ControladorLogin();
$resultadoConteo = $controladorLogin->consultarConteo(); // Agregar esta línea
echo "Número de registros en la base de datos: " . $resultadoConteo->fetch_assoc()['conteo'] . "<br>"; // Agregar esta línea

$usuario = new Usuario(intval($_POST['usuario']), $_POST['password']);

$resultado = $controladorLogin->consultarRegistro($usuario);



if ($resultado->num_rows == 0) {

    echo '<script>alert("Error al ingresar"); window.location.href = "../views/index.php";</script>';


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
        echo '<script>alert("Error al ingresar"); window.location.href = "../views/index.php";</script>';

    }
}

?>