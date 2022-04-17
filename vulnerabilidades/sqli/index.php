<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'SQL Injection' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'sqli';
$page[ 'help_button' ]   = 'sqli';


pvwaDatabaseConnect();

$method            = 'GET';
$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'bajo':
		$vulnerabilityFile = 'bajo.php';
		break;
	case 'medio':
		$vulnerabilityFile = 'medio.php';
		$method = 'POST';
		break;
	case 'alto':
		$vulnerabilityFile = 'alto.php';
		break;
	default:
		$vulnerabilityFile = 'bajo.php';
		break;
}

require_once PVWA_WEB_PAGE_TO_ROOT . "vulnerabilidades/sqli/fuente/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>SQL Injection</h1>

	<div class=\"vulnerable_code_area\">";
if( $vulnerabilityFile == 'alto.php' ) {
	$page[ 'body' ] .= "Hacer clic <a href=\"#\" onclick=\"javascript:popUp('nueva-sesion.php');return false;\">aquí para cambiar tu ID</a>.";
}
else {
	$page[ 'body' ] .= "
		<form action=\"#\" method=\"{$method}\">
			<p>
				ID Cliente:";
	if( $vulnerabilityFile == 'medio.php' ) {
		$page[ 'body' ] .= "\n				<select name=\"id\">";

		for( $i = 1; $i < $number_of_rows + 1 ; $i++ ) { $page[ 'body' ] .= "<option value=\"{$i}\">{$i}</option>"; }
		$page[ 'body' ] .= "</select>";
	}
	else
		$page[ 'body' ] .= "\n				<input type=\"text\" size=\"15\" name=\"id\">";

	$page[ 'body' ] .= "\n				<input type=\"submit\" name=\"Submit\" value=\"Enviar\">
			</p>\n";


	$page[ 'body' ] .= "
		</form>";
}
$page[ 'body' ] .= "
		{$html}
	</div>

	
</div>\n";

pvwaHtmlEcho( $page );

?>
