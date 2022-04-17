<?php

// Comprueba si las funciones de PHP correctas están habilitadas
$WarningHtml = '';
if( !ini_get( 'allow_url_include' ) ) {
	$WarningHtml .= "<div class=\"advertencia\">La función PHP <em>permitir_incluir_URL</em> no está habilitada.</div>";
}
if( !ini_get( 'allow_url_fopen' ) ) {
	$WarningHtml .= "<div class=\"advertencia\">La función PHP <em>permitir_URL_abierta</em> no está habilitada.</div>";
}


$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerabilidad: File Inclusion</h1>

	{$WarningHtml}

	<div class=\"vulnerable_code_area\">
		[<em><a href=\"?page=fichero1.php\">fichero1.php</a></em>] - [<em><a href=\"?page=fichero2.php\">fichero2.php</a></em>] - [<em><a href=\"?page=fichero3.php\">fichero3.php</a></em>]
	</div>

	
</div>\n";

?>
