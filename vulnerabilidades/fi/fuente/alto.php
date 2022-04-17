<?php

// La página que deseamos mostrar
$file = $_GET[ 'page' ];

// Validación de entrada
if( !fnmatch( "file*", $file ) && $file != "include.php" ) {
	// ¡Esta no es la página que queremos!
	echo "ERROR: ¡Archivo no encontrado!";
	exit;
}

?>
