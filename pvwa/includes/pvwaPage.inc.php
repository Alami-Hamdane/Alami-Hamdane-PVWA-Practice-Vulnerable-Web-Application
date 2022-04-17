<?php

if( !defined( 'PVWA_WEB_PAGE_TO_ROOT' ) ) {
	die( 'Error en el sistema PVWA: WEB_PAGE_TO_ROOT indefinido' );
	exit;
}

session_start(); // Crea una vulnerabilidad de 'Divulgación de ruta completa'.

if (!file_exists(PVWA_WEB_PAGE_TO_ROOT . 'config/config.inc.php')) {
	die ("Error del sistema PVWA: no se encontró el archivo de configuración. Copie config/config.inc.php.dist a config/config.inc.php y configure su entorno.");
}

 //Include configs
 require_once PVWA_WEB_PAGE_TO_ROOT . 'config/config.inc.php';


// Declare the $html variable
if( !isset( $html ) ) {
	$html = "";
}

// Niveles de seguridad válidos
$security_levels = array('bajo', 'medio', 'alto');
if( !isset( $_COOKIE[ 'security' ] ) || !in_array( $_COOKIE[ 'security' ], $security_levels ) ) {
	// Set security cookie to impossible if no cookie exists
	if( in_array( $_PVWA[ 'default_security_level' ], $security_levels) ) {
		pvwaSecurityLevelSet( $_PVWA[ 'default_security_level' ] );
	}
	else {
		pvwaSecurityLevelSet( 'bajo' );
	}

	
}

// PVWA version
function pvwaVersionGet() {
	return '1.00 *Version de Desarrollo*';
}

// Fecha de lanzamiento de PVWA
function pvwaReleaseDateGet() {
	return '2022-03-15';
}


// Iniciar funciones de sesión --

function &pvwaSessionGrab() {
	if( !isset( $_SESSION[ 'pvwa' ] ) ) {
		$_SESSION[ 'pvwa' ] = array();
	}
	return $_SESSION[ 'pvwa' ];
}


function pvwaPageStartup( $pActions ) {
	if( in_array( 'authenticated', $pActions ) ) {
		if( !pvwaIsLoggedIn()) {
			pvwaRedirect( PVWA_WEB_PAGE_TO_ROOT . 'acceso.php' );
		}
	}
	
}




function pvwaLogin( $pUsername ) {
	$pvwaSession =& pvwaSessionGrab();
	$pvwaSession[ 'username' ] = $pUsername;
}


function pvwaIsLoggedIn() {
	$pvwaSession =& pvwaSessionGrab();
	return isset( $pvwaSession[ 'username' ] );
}


function pvwaLogout() {
	$pvwaSession =& pvwaSessionGrab();
	unset( $pvwaSession[ 'username' ] );
}


function pvwaPageReload() {
	pvwaRedirect( $_SERVER[ 'PHP_SELF' ] );
}

function pvwaCurrentUser() {
	$pvwaSession =& pvwaSessionGrab();
	return ( isset( $pvwaSession[ 'username' ]) ? $pvwaSession[ 'username' ] : '') ;
}

// -- FIN (funciones de sesión)

function &pvwaPageNewGrab() {
	$returnArray = array(
		'title'           => 'Practice Vulnerable Web Application (PVWA) v' . pvwaVersionGet() . '',
		'title_separator' => ' :: ',
		'body'            => '',
		'page_id'         => '',
		'help_button'     => '',
		
	);
	return $returnArray;
}


function pvwaSecurityLevelGet() {
	return isset( $_COOKIE[ 'security' ] ) ? $_COOKIE[ 'security' ] : 'alto';
}


function pvwaSecurityLevelSet( $pSecurityLevel ) {
	if( $pSecurityLevel == 'alto' ) {
		$httponly = true;
	}
	else {
		$httponly = false;
	}
	setcookie( session_name(), session_id(), null, '/', null, null, $httponly );
	setcookie( 'security', $pSecurityLevel, NULL, NULL, NULL, NULL, $httponly );
}

// Iniciar funciones de mensaje --

function pvwaMessagePush( $pMessage ) {
	$pvwaSession =& pvwaSessionGrab();
	if( !isset( $pvwaSession[ 'messages' ] ) ) {
		$pvwaSession[ 'messages' ] = array();
	}
	$pvwaSession[ 'messages' ][] = $pMessage;
}


function pvwaMessagePop() {
	$pvwaSession =& pvwaSessionGrab();
	if( !isset( $pvwaSession[ 'messages' ] ) || count( $pvwaSession[ 'messages' ] ) == 0 ) {
		return false;
	}
	return array_shift( $pvwaSession[ 'messages' ] );
}


function messagesPopAllToHtml() {
	$messagesHtml = '';
	while( $message = pvwaMessagePop() ) {   
		$messagesHtml .= "<div class=\"message\">{$message}</div>";
	}

	return $messagesHtml;
}

// --FIN (funciones de mensaje)

function pvwaHtmlEcho( $pPage ) {
	$menuBlocks = array();

	$menuBlocks[ 'home' ] = array();
	if( pvwaIsLoggedIn() ) {
		$menuBlocks[ 'home' ][] = array( 'id' => 'home', 'name' => 'Inicio', 'url' => '.' );
		$menuBlocks[ 'home' ][] = array( 'id' => 'instructions', 'name' => 'Instruciones', 'url' => 'instruciones.php' );
		$menuBlocks[ 'home' ][] = array( 'id' => 'setup', 'name' => 'Configurar / Restablecer base de datos', 'url' => 'configuracion.php' );
	}
	else {
		$menuBlocks[ 'home' ][] = array( 'id' => 'setup', 'name' => 'configuracion PVWA', 'url' => 'configuracion.php' );
		$menuBlocks[ 'home' ][] = array( 'id' => 'instructions', 'name' => 'Instruciones', 'url' => 'instruciones.php' );
	}

	if( pvwaIsLoggedIn() ) {
		$menuBlocks[ 'vulnerabilidades' ] = array();
		
		$menuBlocks[ 'vulnerabilidades' ][] = array( 'id' => 'sqli', 'name' => 'SQL Injection', 'url' => 'vulnerabilidades/sqli/' );
		$menuBlocks[ 'vulnerabilidades' ][] = array( 'id' => 'sqli_blind', 'name' => 'SQL Injection (Blind)', 'url' => 'vulnerabilidades/sqli_blind/' );
		$menuBlocks[ 'vulnerabilidades' ][] = array( 'id' => 'exec', 'name' => 'Command Injection', 'url' => 'vulnerabilidades/exec/' );
		$menuBlocks[ 'vulnerabilidades' ][] = array( 'id' => 'fi', 'name' => 'File Inclusion', 'url' => 'vulnerabilidades/fi/.?page=include.php' );
		$menuBlocks[ 'vulnerabilidades' ][] = array( 'id' => 'upload', 'name' => 'File Upload', 'url' => 'vulnerabilidades/upload/' );
		$menuBlocks[ 'vulnerabilidades' ][] = array( 'id' => 'xss_r', 'name' => 'XSS (Reflected)', 'url' => 'vulnerabilidades/xss_r/' );
		$menuBlocks[ 'vulnerabilidades' ][] = array( 'id' => 'xss_s', 'name' => 'XSS (Stored)', 'url' => 'vulnerabilidades/xss_s/' );
		$menuBlocks[ 'vulnerabilidades' ][] = array( 'id' => 'csrf', 'name' => 'CSRF', 'url' => 'vulnerabilidades/csrf/' );
		
	}

	$menuBlocks[ 'meta' ] = array();
	if( pvwaIsLoggedIn() ) {
		$menuBlocks[ 'meta' ][] = array( 'id' => 'security', 'name' => 'Nivel Seguridad', 'url' => 'seguridad.php' );
		
	}
	     
	if( pvwaIsLoggedIn() ) {
		$menuBlocks[ 'cerrarSesion' ] = array();
		$menuBlocks[ 'cerrarSesion' ][] = array( 'id' => 'cerrarSesion', 'name' => 'Cerrar sesión', 'url' => 'cerrarSesion.php' );
	}

	$menuHtml = '';

	foreach( $menuBlocks as $menuBlock ) {
		$menuBlockHtml = '';
		foreach( $menuBlock as $menuItem ) {
			$selectedClass = ( $menuItem[ 'id' ] == $pPage[ 'page_id' ] ) ? 'selected' : '';
			$fixedUrl = PVWA_WEB_PAGE_TO_ROOT.$menuItem[ 'url' ];
			$menuBlockHtml .= "<li onclick=\"window.location='{$fixedUrl}'\" class=\"{$selectedClass}\"><a href=\"{$fixedUrl}\">{$menuItem[ 'name' ]}</a></li>\n";
		}
		$menuHtml .= "<ul class=\"menuBlocks\">{$menuBlockHtml}</ul>";
	}

	// Obtener cookie de seguridad --
	$securityLevelHtml = '';
	switch( pvwaSecurityLevelGet() ) {
		case 'bajo':
			$securityLevelHtml = 'bajo';
			break;
		case 'medio':
			$securityLevelHtml = 'medio';
			break;
		case 'alto':
			$securityLevelHtml = 'alto';
			break;
		default:
			$securityLevelHtml = 'bajo';
			break;
	}
	// -- FIN (cookie de seguridad)

	
	$userInfoHtml = '<em>Username:</em> ' . ( pvwaCurrentUser() );
	
	$messagesHtml = messagesPopAllToHtml();
	if( $messagesHtml ) {
		$messagesHtml = "<div class=\"body_padded\">{$messagesHtml}</div>";
	}
 
	$systemInfoHtml = "";
	if( pvwaIsLoggedIn() )
		$systemInfoHtml = "<div align=\"left\">{$userInfoHtml}<br /><em>Security Level:</em> {$securityLevelHtml}<br /></div>";

	if( $pPage[ 'help_button' ] ) {
		$systemInfoHtml = pvwaButtonHelpHtmlGet( $pPage[ 'help_button' ] ) . " $systemInfoHtml";
	}

	// Enviar encabezados + código HTML principal
	Header( 'Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );     // TODO- proper XHTML headers...
	Header( 'Expires: Tue, 23 Jun 2009 12:00:00 GMT' );    // Date in the past

	echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage[ 'title' ]}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . PVWA_WEB_PAGE_TO_ROOT . "pvwa/css/main.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . PVWA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

		<script type=\"text/javascript\" src=\"" . PVWA_WEB_PAGE_TO_ROOT . "pvwa/js/pvwaPage.js\"></script>

	</head>

	<body class=\"home\">
		<div id=\"container\">

			<div id=\"header\">

				<img src=\"" . PVWA_WEB_PAGE_TO_ROOT . "pvwa/images/logo.png\" alt=\"Practice Vulnerable Web Application\" />

			</div>

			<div id=\"main_menu\">

				<div id=\"main_menu_padded\">
				{$menuHtml}
				</div>

			</div>

			<div id=\"main_body\">

				{$pPage[ 'body' ]}
				<br /><br />
				{$messagesHtml}

			</div>

			<div class=\"clear\">
			</div>

			<div id=\"system_info\">
		    	{$systemInfoHtml} 
			</div>
			
			<div id=\"footer\">

				<p>Practice Vulnerable Web Application (PVWA) v" . pvwaVersionGet() . "</p>
				
			</div>

		</div>

	</body>

</html>";
}


function pvwaHelpHtmlEcho( $pPage ) {
	// Enviar encabezados
	Header( 'Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );     // TODO- proper XHTML headers...
	Header( 'Expires: Tue, 23 Jun 2009 12:00:00 GMT' );    // Date in the past

	echo "

<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">


	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage[ 'title' ]}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . PVWA_WEB_PAGE_TO_ROOT . "pvwa/css/ayuda.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . PVWA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

	</head>

	<body>

	<div id=\"container\">

			{$pPage[ 'body' ]}

		</div>

	</body>

</html>";
}


function pvwaSourceHtmlEcho( $pPage ) {
	// Enviar encabezados
	Header( 'Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );     // TODO- proper XHTML headers...
	Header( 'Expires: Tue, 23 Jun 2009 12:00:00 GMT' );    // Date in the past

	echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage[ 'title' ]}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . PVWA_WEB_PAGE_TO_ROOT . "pvwa/css/source.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . PVWA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

	</head>


</body>

		<div id=\"container\">

			{$pPage[ 'body' ]}

		</div>

	</body>

</html>";
}

// Para ser usado en todos los enlaces externos --
function pvwaExternalLinkUrlGet( $pLink,$text=null ) {
	if(is_null( $text )) {
		return '<a href="' . $pLink . '" target="_blank">' . $pLink . '</a>';
	}
	else {
		return '<a href="' . $pLink . '" target="_blank">' . $text . '</a>';
	}
}
// -- FIN (enlaces externos)

function pvwaButtonHelpHtmlGet( $pId ) {
	$security = pvwaSecurityLevelGet();
	return "<input type=\"button\" value=\"Ver Ayuda\" class=\"popup_button\" onClick=\"javascript:popUp( '" . PVWA_WEB_PAGE_TO_ROOT . "vulnerabilidades/ver_ayuda.php?id={$pId}&security={$security}' )\">";
}




// Gestión de base de datos --

if( $DBMS == 'MySQL' ) {
	$DBMS = htmlspecialchars(strip_tags( $DBMS ));
	$DBMS_errorFunc = 'mysqli_error()';
}

else {
	$DBMS = "Ninguna Base de datos selecionada.";
	$DBMS_errorFunc = '';
}


function pvwaDatabaseConnect() {
	global $_PVWA;
	global $DBMS;
	global $db;
	
	if( $DBMS == 'MySQL' ) {
		if( !@($GLOBALS["___mysqli_ston"] = mysqli_connect( $_PVWA[ 'db_server' ],  $_PVWA[ 'db_user' ],  $_PVWA[ 'db_password' ], "", $_PVWA[ 'db_port' ] ))
		|| !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $_PVWA[ 'db_database' ])) ) {
			
			pvwaLogout();
			//pvwaMessagePush( 'No se puede conectar con la base de datos.<br />' . $DBMS_errorFunc );
			pvwaRedirect( PVWA_WEB_PAGE_TO_ROOT . 'configuracion.php' );
		}
		// Declaraciones preparadas de MySQL PDO (para niveles imposibles)
		$db = new PDO('mysql:host=' . $_PVWA[ 'db_server' ].';dbname=' . $_PVWA[ 'db_database' ].';charset=utf8', $_PVWA[ 'db_user' ], $_PVWA[ 'db_password' ]);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	
	else {
		die ( "Desconocida {$DBMS} seleccionada." );
	}
}

// -- FIN (Gestión de la base de datos)


function pvwaRedirect( $pLocation ) {
	session_commit();
	header( "Location: {$pLocation}" );
	exit;
}

// XSS Stored registro function --
function pvwaregistro() {
	$query  = "SELECT comment FROM registro";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query );

	$registro = '';

	while( $row = mysqli_fetch_row( $result ) ) {
		if( PvwaSecurityLevelGet() == 'imposible' ) {
			$comment = htmlspecialchars( $row[0] );
		}
		else {
			$comment = $row[0];
		}

		$registro .= "<div id=\"registro_commentarios\"><br />" . "Comentario: {$comment}<br /></div>\n";
	}
	return $registro;
}
// -- END (XSS Stored registro)


// Token functions --
function checkToken( $user_token, $session_token, $returnURL ) {  # Validate the given (CSRF) token
	if( $user_token !== $session_token || !isset( $session_token ) ) {
		pvwaMessagePush( 'el token CSRF es incorrecto' );
		pvwaRedirect( $returnURL );
	}
}

function generateSessionToken() {  # Generate a brand new (CSRF) token
	if( isset( $_SESSION[ 'session_token' ] ) ) {
		destroySessionToken();
	}
	$_SESSION[ 'session_token' ] = md5( uniqid() );
}

function destroySessionToken() { # Destruye cualquier sesión con el nombre 'session_token'
	unset( $_SESSION[ 'session_token' ] );
}

function tokenField() {  # Devuelve un campo para el token (CSRF)
	return "<input type='hidden' name='user_token' value='{$_SESSION[ 'session_token' ]}' />";
}
// --FIN (funciones de token)


// Funciones de configuración --
$PHPUploadPath    = realpath( getcwd() . DIRECTORY_SEPARATOR . PVWA_WEB_PAGE_TO_ROOT . "hackeable" . DIRECTORY_SEPARATOR . "subidas" ) . DIRECTORY_SEPARATOR;



$phpDisplayErrors = 'PHP function display_errors: <em>' . ( ini_get( 'display_errors' ) ? 'Enabled</em> <i>(Easy Mode!)</i>' : 'Disabled</em>' );                                                  // Verbose error messages (e.g. full path disclosure)
$phpSafeMode      = 'PHP function safe_mode: <span class="' . ( ini_get( 'safe_mode' ) ? 'failure">Enabled' : 'success">Disabled' ) . '</span>';                                                   // DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
$phpMagicQuotes   = 'PHP function magic_quotes_gpc: <span class="' . ( ini_get( 'magic_quotes_gpc' ) ? 'failure">Enabled' : 'success">Disabled' ) . '</span>';                                     // DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
$phpURLInclude    = 'PHP function allow_url_include: <span class="' . ( ini_get( 'allow_url_include' ) ? 'success">Enabled' : 'failure">Disabled' ) . '</span>';                                   // RFI
$phpURLFopen      = 'PHP function allow_url_fopen: <span class="' . ( ini_get( 'allow_url_fopen' ) ? 'success">Enabled' : 'failure">Disabled' ) . '</span>';                                       // RFI
$phpGD            = 'PHP module gd: <span class="' . ( ( extension_loaded( 'gd' ) && function_exists( 'gd_info' ) ) ? 'success">Installed' : 'failure">Missing - Only an issue if you want to play with captchas' ) . '</span>';                    // File Upload
$phpMySQL         = 'PHP module mysql: <span class="' . ( ( extension_loaded( 'mysqli' ) && function_exists( 'mysqli_query' ) ) ? 'success">Installed' : 'failure">Missing' ) . '</span>';                // Core PVWA
$phpPDO           = 'PHP module pdo_mysql: <span class="' . ( extension_loaded( 'pdo_mysql' ) ? 'success">Installed' : 'failure">Missing' ) . '</span>';                // SQLi

$PVWAUploadsWrite = '[User: ' . get_current_user() . '] Writable folder ' . $PHPUploadPath . ': <span class="' . ( is_writable( $PHPUploadPath ) ? 'success">Yes' : 'failure">No' ) . '</span>';                                     // File Upload


$PVWAOS           = 'Operating system: <em>' . ( strtoupper( substr (PHP_OS, 0, 3)) === 'WIN' ? 'Windows' : '*nix' ) . '</em>';
$SERVER_NAME      = 'Web Server SERVER_NAME: <em>' . $_SERVER[ 'SERVER_NAME' ] . '</em>';                                                                                                          // CSRF

$MYSQL_USER       = 'Database username: <em>' . $_PVWA[ 'db_user' ] . '</em>';
$MYSQL_PASS       = 'Database password: <em>' . ( ($_PVWA[ 'db_password' ] != "" ) ? '******' : '*blank*' ) . '</em>';
$MYSQL_DB         = 'Database database: <em>' . $_PVWA[ 'db_database' ] . '</em>';
$MYSQL_SERVER     = 'Database host: <em>' . $_PVWA[ 'db_server' ] . '</em>';
$MYSQL_PORT       = 'Database port: <em>' . $_PVWA[ 'db_port' ] . '</em>';
// -- END (Setup Functions)

?>
