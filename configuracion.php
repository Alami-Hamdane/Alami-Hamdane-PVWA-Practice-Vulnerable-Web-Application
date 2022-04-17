<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'Configuracion' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'configuracion';

if( isset( $_POST[ 'create_db' ] ) ) {
	// Anti-CSRF
	if (array_key_exists ("session_token", $_SESSION)) {
		$session_token = $_SESSION[ 'session_token' ];
	} else {
		$session_token = "";
	}
	
	checkToken( $_REQUEST[ 'user_token' ], $session_token, 'configuracion.php' );

	if( $DBMS == 'MySQL' ) {
		include_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/DBMS/MySQL.php';
	}
	
	else {
		pvwaMessagePush( 'ERROR: Se seleccionó una base de datos no válida. Revise la sintaxis del archivo de configuración.' );
		pvwaPageReload();
	}
}

// Anti-CSRF
generateSessionToken();


$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Configuración de la base de datos <img src=\"" . PVWA_WEB_PAGE_TO_ROOT . "pvwa/images/spanner.png\" /></h1>

	<p>Haga clic en el botón 'Crear / Restablecer base de datos' a continuación para crear o restablecer su base de datos.<br />
	Si obtiene un error, asegúrese de tener las credenciales de usuario correctas en: <em>" . realpath(  getcwd() . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php" ) . "</em>.  Las credenciales de administrador son (\"<em>root</em> // <em>toor</em>\")</p>
	
	<hr />
	

	<h2>Comprobación de configuración</h2>

	{$PVWAOS}<br />
	Backend database: <em>{$DBMS}</em><br />
	PHP version: <em>" . phpversion() . "</em>
	{$SERVER_NAME}<br />
	{$phpURLInclude}<br />
	{$phpURLFopen}<br />
	{$phpMySQL}<br />
		
	{$MYSQL_USER}<br />
	{$MYSQL_PASS}<br />
	{$MYSQL_DB}<br />
	{$MYSQL_SERVER}<br />
	{$MYSQL_PORT}<br />
	
	<i><span class=\"failure\">Estado en rojo</span>, indicar que habrá un problema al intentar completar algunos móduloss.</i><br />
	<br />
	
	<!-- Create db button -->
	<form action=\"#\" method=\"post\">
		<input name=\"create_db\" type=\"submit\" value=\"Crear / Restablecer Base de Datos\">
		" . tokenField() . "
	</form>
	<hr />
</div>";
pvwaHtmlEcho( $page );
?>