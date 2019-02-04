<?php
    class Video {
        private $codigo;
        private $titulo;
        private $cartel;
        private $descargable;
        private $codigoPerfil;
        private $sinopsis;
        private $video;
        
        public function __construct ($codigo, $titulo, $cartel, $descargable, $codigoPerfil, $sinopsis, $video) {
            $this->codigo = $codigo;
            $this->titulo = $titulo;
            $this->cartel = "recursos/carteles/".$cartel;
            $this->descargable = $descargable;
            $this->codigoPerfil = $codigoPerfil;
            $this->sinopsis = $sinopsis;
            $this->video = "../../videos/".$video;
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