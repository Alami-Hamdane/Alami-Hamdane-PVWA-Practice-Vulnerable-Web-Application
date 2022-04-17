<?php

if( isset( $_COOKIE[ 'id' ] ) ) {
	// Get input
	$id = $_COOKIE[ 'id' ];

	// Verificar base de datos
	$getid  = "SELECT first_name, last_name FROM usuarios WHERE user_id = '$id' LIMIT 1;";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $getid ); // Eliminado para suprimir errores de mysql

	// // Obtener resultados
	$num = @mysqli_num_rows( $result ); // The '@' character suppresses errors
	if( $num > 0 ) {
		// Feedback for end user
		$html .= '<pre>El ID de usuario existe en la base de datos.</pre>';
	}
	else {
		// Podría dormir una cantidad aleatoria
		if( rand( 0, 5 ) == 3 ) {
			sleep( rand( 2, 4 ) );
		}

		// ¡No se encontró al usuario, por lo que no se encontró la página!
		header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );

		// Comentarios para el usuario final
		$html .= '<pre>El ID de usuario No existe en la base de datos.</pre>';
	}

	((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}

?>
