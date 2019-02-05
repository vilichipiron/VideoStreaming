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
        //Se conecta a la BBDD
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
        require_once("../../www/videostreaming/clases/Video.class.php");                
        //Se conecta a la BBDD
        $canal = "";
        self::conectar($canal);
        
        $tematicas = self::getTematicas($canal);   
                
        /*Este array almacena los videos ordenados por tematica. La clave es la 
        descripcion de cada tematica y el valor es un array con los videos que sean de esa tematica*/
        $videosTematica = [];
        
        //Prepara la consulta
        $consulta = $canal->prepare("SELECT v.codigo, v.titulo, v.cartel, v.descargable, v.sinopsis, v.video FROM videos v, asociado a WHERE v.codigo = a.codigo_video and v.codigo_perfil = ? and a.codigo_tematica = ? order by v.titulo");
        
        if (!$consulta) {
            return null;
            exit;
        }
        
        $consulta->bind_param("ss", $pCodPerfil, $pCodTematica);
        
        //Recorre todas las tematicas
        foreach ($tematicas as $codigoTematica => $descripcion) {
            $encontrado = false;
            //Por cada tematica recorre todos los perfiles del usuario
            $videosTematicaTemp = [];
            
            foreach ($codigosPerfil as $codigoPerfil) {
                //Prepara las variables para la consulta y la ejecuta
                $pCodPerfil = $codigoPerfil;
                $pCodTematica = $codigoTematica;

                $consulta->execute();
                $consulta->bind_result($ccodigo, $ctitulo, $ccartel, $cdescargable, $csinopsis, $cvideo);
                $consulta->store_result();        

                //Almacena en una variable si ha habido resultado o no
                if ($consulta->num_rows == 0) {
                    continue; //Sale de esta iteracion.
                } else {
                    $encontrado = true;
                }
                
                //Este array almacena los videos de una tematica en concreto
                while ($consulta->fetch()) {
                    $video = new Video($ccodigo, $ctitulo, $ccartel, $cdescargable, $codigoPerfil, $csinopsis, $cvideo);
                    array_push($videosTematicaTemp, $video);
                }
            }
            
            /*Una vez tiene el array con una tematica en concreto lo mete en el array definitivo. 
            La clave es la descripcion de la tematica y el valor es el array con la tematica en concreto*/
            if ($encontrado) {
                $videosTematica[$descripcion] = $videosTematicaTemp;
            }
        }
        return $videosTematica;
    }
    
    //Devuelve todas las tematicas existentes.
    public static function getTematicas(&$canal) {
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
        
        $tematicas = [];
        
        while ($consulta->fetch()) { 
            /*Mete en un array las tematicas. La clave es el codigo
            de la tematica y el valor la descripcion. */
            $tematicas[$ccodigo] = $cdescripcion;
        }
        
        return $tematicas;
    }
    
    //Inserta en la tabla visionado la pelicula
    public static function insertVisionada($dni, $codigoVideo) {
        //Se conecta a la BBDD
        $canal = "";
        self::conectar($canal);
        
        //Ejecuta la consulta
        $sql = "INSERT into VISIONADO (dni, codigo_video, fecha) values (?,?,NOW())";
        $consulta = $canal->prepare($sql);
        $consulta->bind_param("ss", $cdni, $ccodigo_video);
        $cdni = $dni;
        $ccodigo_video = $codigoVideo;
        $consulta->execute();
        
        //Devuelve si se ha insertado la fila correctamente. 
        if ($consulta->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>
