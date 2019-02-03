<?php
class Videosbd {
    //Esta clase recoge conexion a BD y funciones estaticas para trabajar con ella.
    const IP = "127.0.0.1";
    const USUARIO = "videos";
    const CLAVE = "videos";
    const BD = "videos";
    
    public static function conectar(&$canal) {
        $canal = new mysqli(self::IP,self::USUARIO,self::CLAVE,self::BD);
        if ($canal->connect_errno) {
            die("Error fatal");
        }
        $canal->set_charset("utf8");
        return true;
    }
    
    /*Comprueba si el dni y clave coinciden. En caso afirmativo devuelve 
    un objeto con los datos del usuario, en caso contrario devuelve NULL.*/
    public static function validarUsuario($dni, $clave) {
        //Se conecta a la BBDD
        $canal = "";
        self::conectar($canal);
        
        $consulta = $canal->prepare("select clave, nombre from usuarios where dni = ?");
        if (!$consulta) {
            return null;
            exit;
        }
        
        $consulta->bind_param("s", $pdni);
        $pdni = $dni;
        $consulta->execute();
        $consulta->bind_result($cclave, $cnombre);
        $consulta->store_result();
        
        //Si la consulta no devuelve filas, devuelve null.
        if ($consulta->num_rows!=1) {
            $canal->close();
            return null;
            exit;
        }
        
        //Almacena la clave y el nombre del usuario
        while ($consulta->fetch()) {
            $clavebd = $cclave;
            $nombre = $cnombre;
        }
        
        //Compara la contraseña dada con la encriptada de la BBDD
        if (password_verify($clave, $clavebd)) {
            //Primero obtiene los perfiles del usuario
            $consulta = $canal->prepare("select codigo_perfil from perfil_usuario where dni = ?");
            if (!$consulta) {
                return null;
                exit;
            }
            $consulta->bind_param("s", $pdni);
            $pdni = $dni;
            $consulta->execute();
            $consulta->bind_result($ccodigo_perfil);
            $consulta->store_result();
            
            if ($consulta->num_rows == 0) {
                $canal->close();
                return null;
                exit;
            }
            
            $codigosPerfiles = [];
            while ($consulta->fetch()) {
                array_push($codigosPerfiles, $ccodigo_perfil);
            }
            //Ahora crea el objeto usuario
            require_once("../../www/videostreaming/clases/Usuario.class.php");
            $usuario = new Usuario($dni, $nombre, $codigosPerfiles);
            
            //Cierra el canal
            $canal->close();
            
            //Devuelve el objeto usuario
            return $usuario;
        } else {
            //Cierra el canal
            $canal->close();
            return null;
            exit;
        }  
    }
    
    /*Saca un array de objetos Video que pertenecen al usuario ordenados alfabeticamente*/
    public static function getVideosAlfabeticamente($codigosPerfil) {
        $canal = "";
        self::conectar($canal);
        
        require_once("../../www/videostreaming/clases/Video.class.php");
        $videos = [];
        //Recorre los codigos de perfil y muestra las peliculas que le correspondan a cada uno
        foreach ($codigosPerfil as $codPerfil) {
            $consulta = $canal->prepare("select codigo, titulo, cartel, descargable, sinopsis, video from videos where codigo_perfil = ?");
            
            if (!$consulta) {
                return null;
                exit;
            }
            
            $consulta->bind_param("s", $pCodPerfil);
            $pCodPerfil = $codPerfil;
            $consulta->execute();
            $consulta->bind_result($ccodigo, $ctitulo, $ccartel, $cdescargable, $csinopsis, $cvideo);
            $consulta->store_result();
            
            //Crea los objetos Video y los va metiendo en un array
            while ($consulta->fetch()) {
                $video = new Video($ccodigo, $ctitulo, $ccartel, $cdescargable, $codPerfil, $csinopsis, $cvideo);
                array_push($videos, $video);
            }
        }
        //Cierra el canal
        $canal->close();
        //Ordena el array alfabeticamente por titulo de objeto video
        usort($videos, array('Funciones', 'cmp'));
        //Devuelve el array ya ordenado
        return $videos;
    }
    
    //Devuelve un array en el que cada clave es la tematica y su valor es un array de objetos Video
    public static function getVideosTematica($codigosPerfil) {
        $canal = "";
        self::conectar($canal);
        
        //Recoge el nombre y descripcion de cada tematica
        $consulta = $canal->prepare("SELECT codigo, descripcion FROM tematica");
        
        if (!$consulta) {
            return null;
            exit;
        }
        
        $consulta->execute();
        $consulta->bind_result($ccodigo, $cdescripcion);
        $consulta->store_result();
        
        //Si no devuelve filas, devuelve NULL.
        if ($consulta->num_rows == 0) {
            return null;
            exit;
        }
        
        $videos = [];
        
        while ($consulta->fetch()) { 
            $videosPorTematica = [];
            //Devuelve un array de videos que pertenezcan a dicha tematica
            $videosPorTematica = self::videosDeTematica($ccodigo, $codigosPerfil, $canal);
            //Si lo que ha devuelto no esta vacio, lo añade al array final
            if (!empty($videosPorTematica)) {
                $videos[$cdescripcion] = $videosPorTematica;
            }  
        }
        
        //Cierra el canal
        $canal->close();
        
        return $videos;
    }
    
    //Devuelve un array con los objetos video de esa tematica que pueda ver el usuario
    public static function videosDeTematica($codTematica, $codigosPerfil, &$canal) {
        //Recorre el array de codigos
        foreach ($codigosPerfil as $codigoPerfil) {
            $consulta = $canal->prepare("SELECT v.codigo, v.titulo, v.cartel, v.descargable, v.sinopsis, v.video FROM videos v, asociado a WHERE v.codigo = a.codigo_video and v.codigo_perfil = ? and a.codigo_tematica = ?");

            if (!$consulta) {
                return null;
                exit;
            }

            $consulta->bind_param("ss", $pCodPerfil, $pCodTematica);
            $pCodPerfil = $codigoPerfil;
            $pCodTematica = $codTematica;
            $consulta->execute();
            $consulta->bind_result($ccodigo, $ctitulo, $ccartel, $cdescargable, $csinopsis, $cvideo);
            $consulta->store_result();
            
            //Crea el objeto video y lo mete en el array
            $videosTematica = [];
            require_once("../../www/videostreaming/clases/Video.class.php");
            while ($consulta->fetch()) {
                $video = new Video($ccodigo, $ctitulo, $ccartel, $cdescargable, $codigoPerfil, $csinopsis, $cvideo);
                array_push($videosTematica, $video);
            }
        }
        if (!empty($videosTematica)) {
            return $videosTematica;
        } else {
            return null;
        }
    }
}
?>