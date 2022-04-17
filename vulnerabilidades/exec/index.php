<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'Command Injection' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'exec';
$page[ 'help_button' ]   = 'exec';


pvwaDatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'bajo':
		$vulnerabilityFile = 'bajo.php';
		break;
	case 'medio':
		$vulnerabilityFile = 'medio.php';
		break;
	case 'alto':
		$vulnerabilityFile = 'alto.php';
		break;
	default:
		$vulnerabilityFile = 'bajo.php';
		break;
}

require_once PVWA_WEB_PAGE_TO_ROOT . "vulnerabilidades/exec/fuente/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Command Injection</h1>

	<div class=\"vulnerable_code_area\">
		<h2>Hacer ping a un dispositivo</h2>

		<form name=\"ping\" action=\"#\" method=\"post\">
			<p>
				Introduzca una dirección IP:
				<input type=\"text\" name=\"ip\" size=\"30\">
				<input type=\"submit\" name=\"Submit\" value=\"Enviar\">
			</p>\n";



$page[ 'body' ] .= "
		</form>
		{$html}
	</div>

	
</div>\n";

pvwaHtmlEcho( $page );

?>
