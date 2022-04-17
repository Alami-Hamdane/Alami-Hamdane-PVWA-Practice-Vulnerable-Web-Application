

<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'SQL Injection (Blind)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'sqli_blind';
$page[ 'help_button' ]   = 'sqli_blind';

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

require_once PVWA_WEB_PAGE_TO_ROOT . "vulnerabilidades/sqli_blind/fuente/{$vulnerabilityFile}";

// Está PHP function magic_quotee activada?
$WarningHtml = '';
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$WarningHtml .= "<div class=\"Advertencia\">La función PHP \"<em>Magic Quotes</em>\" está activada.</div>";
}
// Está PHP function safe_mode activada?
if( ini_get( 'safe_mode' ) == true ) {
	$WarningHtml .= "<div class=\"Advertencia\">La función PHP \"<em>Modo seguro</em>\" está activada.</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>SQL Injection (Blind)</h1>

	{$WarningHtml}

	<div class=\"vulnerable_code_area\">";
if( $vulnerabilityFile == 'alto.php' ) {
	$page[ 'body' ] .= "Hacer clic <a href=\"#\" onclick=\"javascript:popUp('cookie-input.php');return false;\">aquí para cambiar tu  ID</a>.";
}
else {
	$page[ 'body' ] .= "
		<form action=\"#\" method=\"{$method}\">
			<p>
				ID Cliente:";
	if( $vulnerabilityFile == 'medio.php' ) {
		$page[ 'body' ] .= "\n				<select name=\"id\">";
		$query  = "SELECT COUNT(*) FROM clientes;";
		$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );
		$num    = mysqli_fetch_row( $result )[0];
		$i      = 0;
		while( $i < $num ) { $i++; $page[ 'body' ] .= "<option value=\"{$i}\">{$i}</option>"; }
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