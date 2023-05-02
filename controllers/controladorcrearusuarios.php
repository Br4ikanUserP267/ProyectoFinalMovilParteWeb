
<?php

require("../components/conexion.php");
require("interfazcontrolador.php");
class ControladorCrearUsuarios extends ConectarMySQL implements InterfazControlador {
    private $tabla = "usuarios";
    private $numeroIdentificacion;
    private $contrasena;
    private $tipoUsuario;

    // funcion para verificar la existencia de un usuario 
    public function consultarRegistro($objeto) {
        $sql = "SELECT * FROM ".$this->tabla." WHERE numeroIdentificacion = ?";
        $sentencia = $this->getConexion()->prepare($sql);
        $sentencia->bind_param("i",$objeto->numeroIdentificacion);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        return $resultado;
    }
    


    //Funcion para guardar usuario
    public function guardar() {
        $sql = "INSERT INTO ".$this->tabla." (numeroIdentificacion, contrasena, tipoUsuario) VALUES (?, ?, ?)";
        $sentencia = $this->getConexion()->prepare($sql);
        $sentencia->bind_param("iss", $this->numeroIdentificacion, $this->contrasena, $this->tipoUsuario);
        try {
            $resultado = $sentencia->execute();
            return $resultado;
        } catch (Exception $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return false;
        }
    }


    

    // setters para los atributos de la clase
    public function setNumeroIdentificacion($numeroIdentificacion) {
        $this->numeroIdentificacion = $numeroIdentificacion;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }
}

?>