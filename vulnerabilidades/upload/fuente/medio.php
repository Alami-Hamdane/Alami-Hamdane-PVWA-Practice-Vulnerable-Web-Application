<?php

if( isset( $_POST[ 'Upload' ] ) ) {
	// Where are we going to be writing to?
	$target_path  = PVWA_WEB_PAGE_TO_ROOT . "hackeable/subidas/";
	$target_path .= basename( $_FILES[ 'uploaded' ][ 'name' ] );

	// Informacion del archivo
	$uploaded_name = $_FILES[ 'uploaded' ][ 'name' ];
	$uploaded_type = $_FILES[ 'uploaded' ][ 'type' ];
	$uploaded_size = $_FILES[ 'uploaded' ][ 'size' ];

	// ¿Es una imagen?
	if( ( $uploaded_type == "image/jpeg" || $uploaded_type == "image/png" ) &&
		( $uploaded_size < 100000 ) ) {

		// ¿Podemos mover el archivo a la carpeta de carga?
		if( !move_uploaded_file( $_FILES[ 'uploaded' ][ 'tmp_name' ], $target_path ) ) {
			// No
			$html .= '<pre>Tu imagen no ha sido subida.</pre>';
		}
		else {
			// Yes!
			$html .= "<pre>{$target_path} ¡Subida con éxito!</pre>";
		}
	}
	else {
		// Invalid file
		$html .= '<pre>Tu imagen no ha sido subida. Solo podemos aceptar imágenes JPEG o PNG.</pre>';
	}
}

?>
