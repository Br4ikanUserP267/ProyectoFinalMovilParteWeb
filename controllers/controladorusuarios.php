<?php

        require_once('../components/conexion.php');

        class ControladorUsuarios {
            private $db;

            public function __construct() {
                $this->db = new Conexion();
            }

            public function obtenerUsuarios() {
                $sql = "SELECT * FROM usuarios";
                $result = $this->db->query($sql);
                $usuarios = array();
                while ($row = $result->fetch_assoc()) {
                    $usuarios[] = $row;
                }
                header('Content-Type: application/json');
                echo json_encode($usuarios);
            }

            public function obtenerUsuario($id) {
                $sql = "SELECT * FROM usuarios WHERE id = $id";
                $result = $this->db->query($sql);
                $usuario = $result->fetch_assoc();
                header('Content-Type: application/json');
                echo json_encode($usuario);
            }

            public function crearUsuario() {
                $data = json_decode(file_get_contents('php://input'), true);
                $nombre = $data['nombre'];
                $correo = $data['correo'];
                $password = $data['password'];
                $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES ('$nombre', '$correo', '$password')";
                $result = $this->db->query($sql);
                if ($result) {
                    header('Content-Type: application/json');
                    echo json_encode(array('mensaje' => 'Usuario creado con éxito'));
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('mensaje' => 'Error al crear usuario'));
                }
            }

            public function actualizarUsuario($id) {
                $data = json_decode(file_get_contents('php://input'), true);
                $nombre = $data['nombre'];
                $correo = $data['correo'];
                $password = $data['password'];
                $sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo', password='$password' WHERE id = $id";
                $result = $this->db->query($sql);
                if ($result) {
                    header('Content-Type: application/json');
                    echo json_encode(array('mensaje' => 'Usuario actualizado con éxito'));
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('mensaje' => 'Error al actualizar usuario'));
                }
            }

            public function eliminarUsuario($id) {
                $sql = "DELETE FROM usuarios WHERE id = $id";
                $result = $this->db->query($sql);
                if ($result) {
                    header('Content-Type: application/json');
                    echo json_encode(array('mensaje' => 'Usuario eliminado con éxito'));
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('mensaje' => 'Error al eliminar usuario'));
                }
            }


            public function inicioSesion($username, $password) {
                $sql = "SELECT * FROM usuarios WHERE correo = '$username' AND password = '$password'";
                $result = $this->db->query($sql);
                $usuario = $result->fetch_assoc();
                if ($usuario) {
                    header('Content-Type: application/json');
                    echo json_encode($usuario);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('mensaje' => 'Usuario o contraseña incorrectos'));
                }
            }
        }


?>