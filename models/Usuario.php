<?php 

class Usuario {
  public $numeroIdentificacion;
  public $contrasena;

  public function __construct($numeroIdentificacion, $contrasena) {
    $this->numeroIdentificacion = $numeroIdentificacion;
    $this->contrasena = $contrasena;
  }
}

?>
