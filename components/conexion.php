<?php 

  class ConectarMySQL {

    private $conexion;

    function __construct(){
      require("../settings/configuraciones.php");
      $this->conexion = mysqli_connect($servidor, $usuario, $contraseña, $basedatos, $puerto);
    }

    function getConexion() {
      return $this->conexion;
    }
  }
?>