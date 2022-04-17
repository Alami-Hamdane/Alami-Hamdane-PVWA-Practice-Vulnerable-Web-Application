<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

//pvwaPageStartup( array( 'phpids' ) );

pvwaDatabaseConnect();

if( isset( $_POST[ 'Login' ] ) ) {
	// Anti-CSRF
	if (array_key_exists ("session_token", $_SESSION)) {
		$session_token = $_SESSION[ 'session_token' ];
	} else {
		$session_token = "";
	}

	checkToken( $_REQUEST[ 'user_token' ], $session_token, 'acceso.php' );

	$user = $_POST[ 'username' ];
	$user = stripslashes( $user );
	$user = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $user ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));

	$pass = $_POST[ 'password' ];
	$pass = stripslashes( $pass );
	$pass = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $pass ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
	$pass = md5( $pass );

	$query = ("SELECT table_schema, table_name, create_time
				FROM information_schema.tables
				WHERE table_schema='{$_PVWA['db_database']}' AND table_name='usuarios'
				LIMIT 1");
	$result = @mysqli_query($GLOBALS["___mysqli_ston"],  $query );
	if( mysqli_num_rows( $result ) != 1 ) {
		pvwaMessagePush( "Primera vez que usa PVWA.<br />Necesita ejecutar 'configuracion.php'." );
		pvwaRedirect( PVWA_WEB_PAGE_TO_ROOT . 'configuracion.php' );
	}

	$query  = "SELECT * FROM `usuarios` WHERE user='$user' AND password='$pass';";
	$result = @mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '.<br />
		Try <a href="configuracion.php">installing again</a>.</pre>' );
	if( $result && mysqli_num_rows( $result ) == 1 ) {    // Inicio de sesión correcto...
		pvwaMessagePush( "Has iniciado sesión como '{$user}'" );
		pvwaLogin( $user );
		pvwaRedirect( PVWA_WEB_PAGE_TO_ROOT . 'index.php' );
	}

	// Login failed
	pvwaMessagePush( 'Error de inicio de sesion' );
	pvwaRedirect( 'acceso.php' );
}

$messagesHtml = messagesPopAllToHtml();

Header( 'Cache-Control: no-cache, must-revalidate');    // HTTP/1.1
Header( 'Content-Type: text/html;charset=utf-8' );      // TODO- proper XHTML headers...
Header( 'Expires: Tue, 23 Jun 2009 12:00:00 GMT' );     // Date in the past

// Anti-CSRF
generateSessionToken();

echo "<!DOCTYPE html>

<html lang=\"en-GB\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>Login :: Practice Vulnerable Web Application (PVWA) v" . pvwaVersionGet() . "</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . PVWA_WEB_PAGE_TO_ROOT . "pvwa/css/acceso.css\" />

	</head>

	<body>

	<div id=\"wrapper\">

	<div id=\"header\">

	<br />

	<p><img src=\"" .PVWA_WEB_PAGE_TO_ROOT . "pvwa/images/login_logo.png\" /></p>

	<br />

	</div> <!--<div id=\"header\">-->

	<div id=\"content\">

	<form action=\"acceso.php\" method=\"post\">

	<fieldset>

			<label for=\"user\">Usuario</label> <input type=\"text\" class=\"loginInput\" size=\"20\" name=\"username\"><br />


			<label for=\"pass\">Contraseña</label> <input type=\"password\" class=\"loginInput\" AUTOCOMPLETE=\"off\" size=\"20\" name=\"password\"><br />

			<br />

			<p class=\"submit\"><input type=\"submit\" value=\"Acceso\" name=\"Login\"></p>

	</fieldset>

	" . tokenField() . "

	</form>

	<br />

	{$messagesHtml}

	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />

	</div > <!--<div id=\"content\">-->

	<div id=\"footer\">

	<p>  Practice Vulnerable Web Application (PVWA) </p>

	</div> <!--<div id=\"footer\"> -->

	</div> <!--<div id=\"wrapper\"> -->

	</body>

</html>";

?>
