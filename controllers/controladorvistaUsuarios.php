<?php 
    
  require("../components/conexion.php");

  class ControladorvistaUsuarios extends ConectarMySQL {

    public function consultardatos(){
  
      $sql = "select * from usuarios";
      $sentence = $this->getConexion()->prepare($sql);
      $sentence->execute();
      $result = $sentence->get_result();
      return $result;

    }
  }
?>
