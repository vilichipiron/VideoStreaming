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
        
        public static function cmp($a, $b) {
            return strcmp($a->titulo, $b->titulo);
        }
        
        public static function crearLink($codigo) {
            require_once("Cripto.class.php");
            /*Genera un link aleatorio para el video*/
            $link_random = bin2hex(openssl_random_pseudo_bytes(32));
            
            /*Lo guarda en una variable de sesion para tener 
            una referencia segura (dentro de las limitaciones de usar sesion)
            con la que comparar*/
            $_SESSION['refLink'] = $link_random;
            
            /*Lo encripta y lo devuelve como link del video*/
            $cripto = new Cripto();
            $link_random = $cripto->encripta($link_random);
            
            return $link_random;
        }
    }
?>