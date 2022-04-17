<?php

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerabilidad: File Inclusion</h1>
	<div class=\"vulnerable_code_area\">
		<h3>Fichero 3</h3>
		<hr />
		Bienvenido de nuevo <em>" . pvwaCurrentUser() . "</em><br />
		Su dirección IP es: <em>{$_SERVER[ 'REMOTE_ADDR' ]}</em><br />";
if( array_key_exists( 'HTTP_X_FORWARDED_FOR', $_SERVER )) {
	$page[ 'body' ] .= "reenviado para: <em>" . $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
	$page[ 'body' ] .= "</em><br />";
}
		$page[ 'body' ] .= "Su dirección de agente de usuario es: <em>{$_SERVER[ 'HTTP_USER_AGENT' ]}</em><br />";
if( array_key_exists( 'HTTP_REFERER', $_SERVER )) {
		$page[ 'body' ] .= "vienes de: <em>{$_SERVER[ 'HTTP_REFERER' ]}</em><br />";
}
		$page[ 'body' ] .= "estoy alojado en: <em>{$_SERVER[ 'HTTP_HOST' ]}</em><br /><br />
		[<em><a href=\"?page=include.php\">volver</a></em>]
	</div>

	
</div>\n";

?>
