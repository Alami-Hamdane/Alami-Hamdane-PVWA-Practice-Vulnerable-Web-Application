<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '../' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ] = 'Ayuda' . $page[ 'title_separator' ].$page[ 'title' ];

$id       = $_GET[ 'id' ];
$security = $_GET[ 'security' ];

	ob_start();
	eval( '?>' . file_get_contents( PVWA_WEB_PAGE_TO_ROOT . "vulnerabilidades/{$id}/ayuda/ayuda.php" ) . '<?php ' );
	$help = ob_get_contents();
	ob_end_clean();

$page[ 'body' ] .= "
<div class=\"body_padded\">
	{$help}
</div>\n";

pvwaHelpHtmlEcho( $page );

?>
