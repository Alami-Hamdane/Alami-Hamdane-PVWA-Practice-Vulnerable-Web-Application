<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Obtener entrada
	$id = $_POST[ 'id' ];
	$id = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $id ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));

	// Verificar base de datos
	$getid  = "SELECT first_name, last_name, account FROM clientes WHERE cliente_id = $id;";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $getid ); // Para suprimir errores de mysql

	// Obtener resultados
	$num = @mysqli_num_rows( $result ); // El caracter '@' suprime errores
	if( $num > 0 ) {
		// Feedback for end user
		$html .= '<pre>El ID del cliente existe en la base de datos.</pre>';
	}
	else {
		// Comentarios para el usuario final
		$html .= '<pre>El ID del cliente No existe en la base de datos.</pre>';
	}

	//mysql_cerrar();
}

?>