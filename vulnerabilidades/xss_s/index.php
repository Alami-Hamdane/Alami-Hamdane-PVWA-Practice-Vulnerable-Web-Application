<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'Stored Cross Site Scripting (XSS)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'xss_s';
$page[ 'help_button' ]   = 'xss_s';
$page[ 'source_button' ] = 'xss_s';

pvwaDatabaseConnect();

if (array_key_exists ("btnClear", $_POST)) {
	$query  = "TRUNCATE registro;";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );
}

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

require_once PVWA_WEB_PAGE_TO_ROOT . "vulnerabilidades/xss_s/fuente/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Stored Cross Site Scripting (XSS)</h1>

	<div class=\"vulnerable_code_area\">
		<form method=\"post\" name=\"guestform\" \">
			<table width=\"550\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\">
				
				<tr>
					<td width=\"100\">Comentario</td>
					<td><textarea name=\"mtxMessage\" cols=\"50\" rows=\"3\" maxlength=\"500\"></textarea></td>
				</tr>
				<tr>
					<td width=\"100\">&nbsp;</td>
					<td>
						<input name=\"btnSign\" type=\"submit\" value=\"Enviar comentario\" onclick=\"return validateregistroForm(this.form);\" />
						<input name=\"btnClear\" type=\"submit\" value=\"Borrar Comentario\" onClick=\"return confirmClearregistro();\" />
					</td>
				</tr>
			</table>\n";


$page[ 'body' ] .= "
		</form>
		{$html}
	</div>
	<br />

	" . pvwaregistro() . "
	<br />

</div>\n";

pvwaHtmlEcho( $page );

?>
