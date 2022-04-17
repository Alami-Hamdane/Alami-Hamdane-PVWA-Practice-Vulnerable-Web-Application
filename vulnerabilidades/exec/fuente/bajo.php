<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Obtener entrada
	$target = $_REQUEST[ 'ip' ];

	// Determinar el sistema operativo y ejecutar el comando ping.
	if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
		// Windows
		$cmd = shell_exec( 'ping  ' . $target );
	}
	else {
		// Linux
		$cmd = shell_exec( 'ping  -c 4 ' . $target );
	}

	// Comentarios para el usuario final
	$html .= "<pre>{$cmd}</pre>";
}

?>
