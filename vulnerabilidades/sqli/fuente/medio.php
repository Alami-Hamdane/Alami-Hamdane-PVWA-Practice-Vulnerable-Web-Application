<?php

if( isset( $_POST[ 'Submit' ] ) ) {
	// Obtener entrada
	$id = $_POST[ 'id' ];

	$id = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $id);

	$query  = "SELECT first_name, last_name,account FROM clientes WHERE cliente_id = $id;";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $query) or die( '<pre>' . mysqli_error($GLOBALS["___mysqli_ston"]) . '</pre>' );

	// Obtener resultados
	while( $row = mysqli_fetch_assoc( $result ) ) {
		//Mostrar valores
		$first = $row["first_name"];
		$last  = $row["last_name"];
		$account  = $row["account"];

		// Resultados 
		$html .= "<pre>ID Cliente: {$id}<br />Nombre: {$first}<br />Apellido: {$last}<br />Número Cuenta: {$account}</pre>";
	}

}

// Esto se usa más adelante en la página index.php
// Configurándolo aquí para que podamos cerrar la conexión de la base de datos aquí como en el resto de los scripts de origen
$query  = "SELECT COUNT(*) FROM clientes;";
$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );
$number_of_rows = mysqli_fetch_row( $result )[0];

mysqli_close($GLOBALS["___mysqli_ston"]);
?>
