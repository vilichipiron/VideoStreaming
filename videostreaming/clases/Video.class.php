<?php
    class Video {
        private $codigo;
        private $titulo;
        private $cartel;
        private $descargable;
        private $sinopsis;
        private $video;
        private $vista;
        
        public function __construct ($codigo, $titulo, $cartel, $descargable, $sinopsis, $video, $vista) {
            $this->codigo = $codigo;
            $this->titulo = $titulo;
            $this->cartel = "recursos/carteles/".$cartel;
            $this->descargable = $descargable;
            $this->sinopsis = $sinopsis;
            $this->video = "../../videos/".$video;
            $this->vista = $vista;
        }
        
        public function __get($atributo) {
            if (isset($this->$atributo)) {
                return $this->$atributo;
            } else {
                return null;
            }
        }  
        
        public function setVistaSi() {
            $this->vista = "S";
        }
    }
?>