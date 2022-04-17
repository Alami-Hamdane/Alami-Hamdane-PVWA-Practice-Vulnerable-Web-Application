<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ] = 'Entrada de cookie SQL Injection ciega' . $page[ 'title_separator' ].$page[ 'title' ];

if( isset( $_POST[ 'id' ] ) ) {
	setcookie( 'id', $_POST[ 'id' ]);
	$page[ 'body' ] .= "Cookie ID establecida!<br /><br /><br />";
	$page[ 'body' ] .= "<script>window.opener.location.reload(true);</script>";
}

$page[ 'body' ] .= "
<form action=\"#\" method=\"POST\">
	<input type=\"text\" size=\"15\" name=\"id\">
	<input type=\"submit\" name=\"Submit\" value=\"Enviar\">
</form>
<hr />
<br />

<button onclick=\"self.close();\">Cerrar</button>";

pvwaSourceHtmlEcho( $page );

?>


