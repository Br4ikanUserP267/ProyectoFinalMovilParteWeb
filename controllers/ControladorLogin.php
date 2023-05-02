<?php 
    
  require("../components/conexion.php");
  require("interfazcontrolador.php");

  class ControladorLogin extends ConectarMySQL implements InterfazControlador {
    private $tabla = "usuarios";
  
    public function consultarRegistro($objeto) {
      $sql = "SELECT * FROM ".$this->tabla." WHERE numeroIdentificacion = ?";
      $sentencia = $this->getConexion()->prepare($sql);
      $sentencia->bind_param("i",$objeto->numeroIdentificacion);
      $sentencia->execute();
      $resultado = $sentencia->get_result();
      return $resultado;
    }
  
    public function consultarConteo() {
      $sql = "SELECT COUNT(*) AS conteo FROM ".$this->tabla;
      return $this->getConexion()->query($sql);
    }

  }
  
?>
