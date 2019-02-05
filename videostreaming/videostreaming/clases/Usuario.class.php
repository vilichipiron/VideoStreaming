<?php
    class Usuario {
        private $dni;
        private $nombre;
        private $validado;
        private $codigosPerfiles;
        
        public function __construct($dni, $nombre, $codigosPerfiles) {
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->codigosPerfiles = $codigosPerfiles;
            $this->validado = true;
        }
        
        public function __get($atributo) {
            if (isset($this->$atributo)) {
                return $this->$atributo;
            } else {
                return null;
            }
        }
    }
?>