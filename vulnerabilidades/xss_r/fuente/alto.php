<?php

// ¿Hay alguna entrada?
if( array_key_exists( "name", $_GET ) && $_GET[ 'name' ] != NULL ) {
	// Obtener entrada
	$name = preg_replace( '/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t/i', '', $_GET[ 'name' ] );

	// Comentarios para el usuario final
	$html .= "<pre>Has elegido ver  ${name}</pre>";
}

?>
