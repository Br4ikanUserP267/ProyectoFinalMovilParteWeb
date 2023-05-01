<?php 

class Usuario {
  public $usuario;
  public $contrasena;

  public function __construct($numeroIdentificacion, $contrasena) {
    $this->numeroIdentificacion = $numeroIdentificacion;
    $this->contrasena = $contrasena;
  }
}

?>
