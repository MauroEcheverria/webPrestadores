<?php
  class sesion {
    function __construct() {
        $status = session_status();
        if($status == PHP_SESSION_NONE){
            //There is no active session
            session_start();
        }else
        if($status == PHP_SESSION_DISABLED){
            //Sessions are not available
        }else
        if($status == PHP_SESSION_ACTIVE){
            //Destroy current and start new one
            session_destroy();
            session_start();
        }
    }
    public function set($nombre, $valor) {
       $_SESSION [$nombre] = $valor;
    }
    public function get($nombre) {
       if (isset ( $_SESSION [$nombre] )) {
          return $_SESSION [$nombre];
       } else {
           return false;
       }
    }
    public function elimina_variable($nombre) {
        unset ( $_SESSION [$nombre] );
    }
    public function termina_sesion() {
        $_SESSION = array();
        session_destroy ();
    }
  }
?>