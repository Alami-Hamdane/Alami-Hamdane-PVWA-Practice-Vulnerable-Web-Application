<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );
pvwaDatabaseConnect();
$login_state = "";

if( isset( $_POST[ 'Login' ] ) ) {

	$user = $_POST[ 'username' ];
	$user = stripslashes( $user );
	$user = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $user);

	$pass = $_POST[ 'password' ];
	$pass = stripslashes( $pass );
	$pass = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $pass);
	$pass = md5( $pass );

	$query  = "SELECT * FROM `users` WHERE user='$user' AND password='$pass';";
	$result = @mysqli_query($GLOBALS["___mysqli_ston"], $query) or die( '<pre>'.  mysqli_connect_error() . '.<br />Try <a href="configuracion.php">installing again</a>.</pre>' );
	if( $result && mysqli_num_rows( $result ) == 1 ) {    // Inicio de sesión con exito...
		$login_state = "<h3 class=\"Inicio de sesión con exito\">Contraseña válida para '{$user}'</h3>";
	}else{
		// Inicio de sesión fallido
		$login_state = "<h3 class=\"Inicio de sesión fallido\">Contraseña incorrecta para '{$user}'</h3>";
	}

}
$messagesHtml = messagesPopAllToHtml();
$page = pvwaPageNewGrab();

$page[ 'title' ] .= "prueba de credenciales";
$page[ 'body' ] .= "
		<div class=\"body_padded\">
			<h1>Preuba de Credenciales</h1>
			<h2>Vulnerabilidad/CSRF</h2>
			<div id=\"code\">
				<form action=\"" . PVWA_WEB_PAGE_TO_ROOT . "vulnerabilidades/csrf/prueba_credenciales.php\" method=\"post\">
					<fieldset>
						" . $login_state . "
						<label for=\"user\">Usuario</label><br /> <input type=\"text\" class=\"loginInput\" size=\"20\" name=\"username\"><br />
						<label for=\"pass\">Contraseña</label><br /> <input type=\"password\" class=\"loginInput\" AUTOCOMPLETE=\"off\" size=\"20\" name=\"password\"><br />
						<p class=\"submit\"><input type=\"submit\" value=\"Acceso\" name=\"Login\"></p>
					</fieldset>
				</form>
				{$messagesHtml}
			</div>
		</div>\n";

pvwaSourceHtmlEcho( $page );

?>
