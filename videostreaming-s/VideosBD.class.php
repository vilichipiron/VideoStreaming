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
        //Devuelve el array de objetos Video
        return $videos;
    }
    
    /*Saca un array de claves, cada una con otro array de objetos video
    SELECT v.titulo from videos v, perfil_usuario p, asociado a where v.codigo_perfil = p.codigo_perfil and a.codigo_video = v.codigo and a.codigo_tematica = "T1" and p.dni = "11111111A"
    */ 
    public static function getVideosCategoria($codigosPerfil) {
        
    }
}
?>