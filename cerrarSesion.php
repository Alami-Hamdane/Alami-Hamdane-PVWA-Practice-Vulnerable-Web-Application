<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'phpids' ) );

if( !pvwaIsLoggedIn() ) {	// El usuario no debe estar en esta página.
    
	pvwaRedirect( 'acceso.php' );
}

pvwaLogout();
pvwaMessagePush( "Has cerrado la  sesión" );
pvwaRedirect( 'acceso.php' );

?>
