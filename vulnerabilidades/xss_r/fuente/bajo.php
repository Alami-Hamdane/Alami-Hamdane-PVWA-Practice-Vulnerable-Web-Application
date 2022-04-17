<?php

// ¿Hay alguna entrada?
if( array_key_exists( "name", $_GET ) && $_GET[ 'name' ] != NULL ) {
	// Comentarios para el usuario final
	$html .= '<pre>Has elegido ver  ' . $_GET[ 'name' ] . '</pre>';
}

?>
