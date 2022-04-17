<?php

if( isset( $_REQUEST[ 'Submit' ] ) ) {
	// Obtener entrada
	$id = $_REQUEST[ 'id' ];

	// Verificar base de datos
	$query  = "SELECT first_name,account  FROM clientes WHERE cliente_id = '$id';";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );

	// Obtener resultados
	while( $row = mysqli_fetch_assoc( $result ) ) {
		// Obtener valores
		$first = $row["first_name"];
		//$last  = $row["last_name"];
		$account  = $row["account"];
	
		// Resultados 

		$html .= "<pre>ID Cliente: {$id}<br />Nombre: {$first}<br />Número Cuenta: {$account}</pre>";
		
	}

	mysqli_close($GLOBALS["___mysqli_ston"]);
}

?>


