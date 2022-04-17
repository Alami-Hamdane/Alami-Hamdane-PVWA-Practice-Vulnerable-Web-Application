<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( 'authenticated' );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'PVWA Seguridad' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'security';

$securityHtml = '';
if( isset( $_POST['seclev_submit'] ) ) {
	// Anti-CSRF
	checkToken( $_REQUEST[ 'user_token' ], $_SESSION[ 'session_token' ], 'seguridad.php' );

	$securityLevel = '';
	switch( $_POST[ 'security' ] ) {
		case 'bajo':
			$securityLevel = 'bajo';
			break;
		case 'medio':
			$securityLevel = 'medio';
			break;
		case 'alto':
			$securityLevel = 'alto';
			break;
		default:
			$securityLevel = 'bajo';
			break;
	}

	pvwaSecurityLevelSet( $securityLevel );
	pvwaMessagePush( "Nivel de seguridad establecido en {$securityLevel}" );
	pvwaPageReload();
}



$securityOptionsHtml = '';
$securityLevelHtml   = '';
foreach( array( 'bajo', 'medio', 'alto') as $securityLevel ) {
	$selected = '';
	if( $securityLevel == pvwaSecurityLevelGet() ) {
		$selected = ' selected="selected"';
		$securityLevelHtml = "<p>El nivel de seguridad es actualmente: <em>$securityLevel</em>.<p>";
	}
	$securityOptionsHtml .= "<option value=\"{$securityLevel}\"{$selected}>" . ucfirst($securityLevel) . "</option>";
}


// Anti-CSRF
generateSessionToken();

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Seguridad PVWA <img src=\"" . PVWA_WEB_PAGE_TO_ROOT . "pvwa/images/lock.png\" /></h1>
	<br />

	<h2>Nivel de seguridad</h2>

	{$securityHtml}

	<form action=\"#\" method=\"POST\">
		{$securityLevelHtml}
		<p>Puede establecer el nivel de seguridad en bajo, medio o alto. El nivel de seguridad cambia el nivel de vulnerabilidad de PVWA:</p>
		<ol>
			<li> Bajo - Este nivel de seguridad es completamente vulnerable y <em>no tiene ninguna medida de seguridad</em>. Su uso es ser un ejemplo de cómo las vulnerabilidades de las aplicaciones web se manifiestan a través de malas prácticas de codificación y servir como una plataforma para enseñar o aprender técnicas básicas de explotación..</li>
			<li> Medio - Esta configuración es principalmente para dar un ejemplo al usuario de <em>malas prácticas de seguridad</em>, donde el desarrollador ha intentado proteger una aplicación sin éxito. También actúa como un desafío para que los usuarios perfeccionen sus técnicas de explotación.</li>
			<li> Alto - Esta opción es una extensión de la dificultad media, con una mezcla de <em>malas prácticas más duras o alternativas</em> para intentar proteger el código. Es posible que la vulnerabilidad no permita el mismo grado de explotación, similar en varios concursos de Capture The Flags (CTF).</li>
			
		</ol>
		<select name=\"security\">
			{$securityOptionsHtml}
		</select>
		<input type=\"submit\" value=\"Enviar\" name=\"seclev_submit\">
		" . tokenField() . "
	</form>

	<br />
	<hr />



	
</div>";

pvwaHtmlEcho( $page );

?>
