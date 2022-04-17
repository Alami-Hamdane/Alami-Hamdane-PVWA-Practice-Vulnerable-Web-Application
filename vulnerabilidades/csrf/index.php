<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'Cross Site Request Forgery (CSRF)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'csrf';
$page[ 'help_button' ]   = 'csrf';

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

require_once PVWA_WEB_PAGE_TO_ROOT . "vulnerabilidades/csrf/fuente/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Cross Site Request Forgery (CSRF)</h1>

	<div class=\"vulnerable_code_area\">
		<h3>Cambia tu contraseña de administrador:</h3>
		<br /> 
		
		<form action=\"#\" method=\"GET\">";

//if( $vulnerabilityFile == 'impossible.php' ) {
//	$page[ 'body' ] .= "
//			Current password:<br />
//			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_current\"><br />";
//  }

$page[ 'body' ] .= "
			Nueva contraseña:<br />
			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_new\"><br />
			Confirma la nueva contraseña:<br />
			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_conf\"><br />
			<br />
			<input type=\"submit\" value=\"Cambiar\" name=\"Change\">\n";


$page[ 'body' ] .= "
		</form>
		{$html}
	</div>


	

</div>\n";

pvwaHtmlEcho( $page );

?>
