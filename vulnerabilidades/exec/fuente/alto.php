<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Obtener entrada
	$target = trim($_REQUEST[ 'ip' ]);

// Establecer lista negra
	$substitutions = array(
		'&'  => '',
		';'  => '',
		'| ' => '',
		'-'  => '',
		'$'  => '',
		'('  => '',
		')'  => '',
		'`'  => '',
		'||' => '',
	);

	// Eliminar cualquiera de los caracteres de la matriz (lista negra).
	$target = str_replace( array_keys( $substitutions ), $substitutions, $target );

	// Determinar el sistema operativo y ejecutar el comando ping.
	if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
		// Windows
		$cmd = shell_exec( 'ping  ' . $target );
	}
	else {
		// Linnix
		$cmd = shell_exec( 'ping  -c 4 ' . $target );
	}

	// Comentarios para el usuario final
	$html .= "<pre>{$cmd}</pre>";
}

?>
