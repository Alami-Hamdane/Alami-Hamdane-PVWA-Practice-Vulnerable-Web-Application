<?php

if( isset( $_POST[ 'Upload' ] ) ) {
	// ¿Dónde vamos a estar escribiendo?
	$target_path  = PVWA_WEB_PAGE_TO_ROOT . "hackeable/subidas/";
	$target_path .= basename( $_FILES[ 'uploaded' ][ 'name' ] );

	// ¿Podemos mover el archivo a la carpeta de carga?
	if( !move_uploaded_file( $_FILES[ 'uploaded' ][ 'tmp_name' ], $target_path ) ) {
		// No
		$html .= '<pre>Tu imagen no fue subida.</pre>';
	}
	else {
		// Si!
		$html .= "<pre>{$target_path} ¡subida con éxito!</pre>";
	}
}

?>
