<?php 
    
  require("../components/conexion.php");
  require("interfazcontrolador.php");

  class ControladorLogin extends ConectarMySQL implements InterfazControlador {

    private $tabla = "usuarios";
     
    public function consultarRegistro($objeto){

      $sql = "SELECT contrasena FROM ".$this->tabla." WHERE numeroIdentificacion = ?";
      $sentencia = $this->getConexion()->prepare($sql);
      $sentencia->bind_param("i",$objeto->numeroIdentificacion);
      $sentencia->execute();
      $resultado = $sentencia->get_result();
      return $resultado;

    }
  }
?>
