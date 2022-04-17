<?php

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerabilidad: File Inclusion</h1>
	<div class=\"vulnerable_code_area\">
		<h3>Fichero 2</h3>
		<hr />
		\"<em>Necesitaba una contraseña de ocho caracteres, así que elegí Ciberseguridad .</em>\" <br /><br />
		[<em><a href=\"?page=include.php\">volver</a></em>]	</div>

	
</div>\n";

?>
