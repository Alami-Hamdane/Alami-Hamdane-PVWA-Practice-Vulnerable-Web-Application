<?php

if( isset( $_GET[ 'Submit' ] ) ) {
	// Obtener entrada
	$id = $_GET[ 'id' ];

	// Verificar base de datos
	$getid  = "SELECT first_name, last_name,account  FROM clientes WHERE cliente_id = '$id';";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $getid ); //  para suprimir errores de mysql

	// Obtener resultados

$num = @mysqli_num_rows( $result );  // El caracter '@' suprime errores
	

	if( $num > 0 ) {
		// Comentarios para el usuario final
		$html .= '<pre>El ID del cliente existe en la base de datos.</pre>';
	}
	else {
		// ¡No se encontró al usuario, por lo que no se encontró la página!
		header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );

		// Comentarios para el usuario final
		$html .= '<pre>El ID del cliente No existe en la base de datos.</pre>';
	}

	((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}

?>