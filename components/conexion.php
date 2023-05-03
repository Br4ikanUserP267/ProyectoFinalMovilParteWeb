<?php 

class ConectarMySQL {

    private $conexion;

    function __construct(){
        require("../settings/configuraciones.php");

        $this->conexion = new mysqli($servidor, $usuario, $contraseña, $basedatos, $puerto);

        if ($this->conexion->connect_error) {
            die("Falló la conexión a la base de datos: " . $this->conexion->connect_error);
        }
      }

    /**
     * Summary of ejecutarConsulta
     * @param mixed $sql
     * @return bool|mysqli_result
     * 
     */
    public function ejecutarConsulta($sql) {
        $result = $this->conexion->query($sql);
        if (!$result) {
            die("Error en la consulta: " . $this->conexion->error);
        }
        return $result;
    }

    function getConexion() {
        return $this->conexion;
    }

}
?>
