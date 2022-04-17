<?php

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerabilidad: File Inclusion</h1>
	<div class=\"vulnerable_code_area\">
		<h3>Fichero 1</h3>
		<hr />
		Hola <em>" . pvwaCurrentUser() . "</em><br />
		Su dirección IP es: <em>{$_SERVER[ 'REMOTE_ADDR' ]}</em><br /><br />
		[<em><a href=\"?page=include.php\">volver</a></em>]
	</div>

	
</div>\n";

?>
