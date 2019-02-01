<?php
class Cripto {
	
	public static function encripta($clave, $mensaje){
		/*creamos un identificador con metodo de  encriptado 
			cast-128 y el modo de cifrado ecb (muy básico) */
		$identificador = mcrypt_module_open('cast-128', '', 'ecb', '');
		/* longitud de un posible vector para cript/descrip */
		$longitud=mcrypt_enc_get_iv_size($identificador);
		/* crea el vector con valores aleatorios de soporte para la encriptación*/
		$vector = mcrypt_create_iv ($longitud, MCRYPT_RAND);
		/* Operaciones necesarias para llevar a cabo la encr/des */
		mcrypt_generic_init($identificador, $clave, $vector);
		/* encripta!!!!!!! (por fin) */
		$cifrado = mcrypt_generic($identificador, $mensaje);
		/* limpia la memoria y cierra el cifrado */
		mcrypt_generic_deinit($identificador);
		mcrypt_module_close($identificador);
		/* es necesario convertirlo a base64 puede haber carateres extraños */
		return base64_encode($cifrado);
	}
	 
	public static function desencripta($clave, $mensajeCifrado){
		$texto=base64_decode($mensajeCifrado);
		$identificador = mcrypt_module_open('cast-128', '', 'ecb', '');
		$longitud=mcrypt_enc_get_iv_size($identificador);
		$vector = mcrypt_create_iv ($longitud, MCRYPT_RAND);
		mcrypt_generic_init($identificador, $clave, $vector);
		/* esto es lo único que cambia */
		$mensajeDescifrado = mdecrypt_generic($identificador, $texto); 
		/* ahora igual */
		mcrypt_generic_deinit($identificador);
		mcrypt_module_close($identificador);
		return $mensajeDescifrado;
	}
     
    
    
}
?>