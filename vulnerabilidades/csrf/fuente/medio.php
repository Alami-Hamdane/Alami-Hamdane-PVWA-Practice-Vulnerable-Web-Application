<?php

if( isset( $_GET[ 'Change' ] ) ) {
	// Verifica para ver de dónde vino la solicitud
	if( stripos( $_SERVER[ 'HTTP_REFERER' ] ,$_SERVER[ 'SERVER_NAME' ]) !== false ) {
		// Get input
		$pass_new  = $_GET[ 'password_new' ];
		$pass_conf = $_GET[ 'password_conf' ];

	// ¿Coinciden las contraseñas?
		if( $pass_new == $pass_conf ) {
			
			$pass_new = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $pass_new ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
			$pass_new = md5( $pass_new );

			// Actualizar la base de datos
			$insert = "UPDATE `usuarios` SET password = '$pass_new' WHERE user = '" . pvwaCurrentUser() . "';";
			$result = mysqli_query($GLOBALS["___mysqli_ston"],  $insert ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );

			// Comentarios para el usuario
			$html .= "<pre>Contraseña cambiada.</pre>";
		}
		else {
			// Comentarios para el usuario
			$html .= "<pre>Las contraseñas no coinciden.</pre>";
		}
	}
	else {
		// No proviene de una fuente confiable
		$html .= "<pre>Esa solicitud no parecía correcta.</pre>";
	}

	((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}

?>
