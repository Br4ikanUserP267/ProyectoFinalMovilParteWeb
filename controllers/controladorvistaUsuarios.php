<?php 
    
  require("../components/conexion.php");
  require("interfazcontrolador.php");

  class ControladorVistaUsuarios extends ConectarMySQL {

    public function consultardatos(){
  
      $sql = "SELECT * FROM usuarios";
      $sentence = $this->getConexion()->prepare($sql);
      $sentence->execute();
      $result = $sentence->get_result();
      return $result;

    }
  }
?>