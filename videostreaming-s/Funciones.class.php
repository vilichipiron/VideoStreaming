<?php
    class Funciones {
        public static function inicioSesion() {
            session_name("SESION");
            session_cache_limiter('nocache');
            session_start();
        }
        
        public static function validado() {
            $validado = false;
            if (isset($_SESSION['usuario'])) {
                require_once("../../www/videostreaming/clases/Usuario.class.php");
                //Si esta la variable de sesion usuario deserealiza el objeto y comprueba si esta validado
                $usuario = unserialize($_SESSION['usuario']);
                if ($usuario->validado) {
                    $validado = true;
                }
            }
            return $validado;
        }
    }
?>