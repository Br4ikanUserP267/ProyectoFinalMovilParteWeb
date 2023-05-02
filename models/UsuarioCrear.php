<?php 

    class UsuarioCrear {
      public $numeroIdentificacion;
      public $contrasena;
      public $tipoUsuario;

      public function __construct($numeroIdentificacion, $contrasena, $tipoUsuario) {
        $this->numeroIdentificacion = $numeroIdentificacion;
        $this->contrasena = $contrasena;
        $this->tipoUsuario = $tipoUsuario;
      }
    }

?>
