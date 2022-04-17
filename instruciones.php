<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'Instructions' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'instructions';


$docs = array(
	
	'readme'         => array( 'type' => 'markdown', 'legend' => '', 'file' => 'README.md' ),
	
);


$selectedDocId = isset( $_GET[ 'doc' ] ) ? $_GET[ 'doc' ] : '';
if( !array_key_exists( $selectedDocId, $docs ) ) {
	$selectedDocId = 'readme';
}
$readFile = $docs[ $selectedDocId ][ 'file' ];

$instructions = file_get_contents( PVWA_WEB_PAGE_TO_ROOT.$readFile );

function urlReplace( $matches ) {
	return pvwaExternalLinkUrlGet( $matches[1] );
}

// Hacer enlaces y ofuscar el referente...
$instructions = preg_replace_callback(
	'/((http|https|ftp):\/\/([[:alnum:]|.|\/|?|=]+))/',
	'urlReplace',
	$instructions
);

$instructions = nl2br( $instructions );


$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Instruciones</h1>

	{$docMenuHtml}

	<span class=\"fixed\">
		{$instructions}
	</span>
</div>";

pvwaHtmlEcho( $page );

?>
