<?php

if( isset( $_POST[ 'Upload' ] ) ) {
	// Where are we going to be writing to?
	$target_path  = PVWA_WEB_PAGE_TO_ROOT . "hackeable/subidas/";
	$target_path .= basename( $_FILES[ 'uploaded' ][ 'name' ] );

	// Informacion del archivo
	$uploaded_name = $_FILES[ 'uploaded' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'uploaded' ][ 'size' ];
	$uploaded_tmp  = $_FILES[ 'uploaded' ][ 'tmp_name' ];

	// ¿Es una imagen?
	if( ( strtolower( $uploaded_ext ) == "jpg" || strtolower( $uploaded_ext ) == "jpeg" || strtolower( $uploaded_ext ) == "png" ) &&
		( $uploaded_size < 100000 ) &&
		getimagesize( $uploaded_tmp ) ) {

		// ¿Podemos mover el archivo a la carpeta de carga?
		if( !move_uploaded_file( $uploaded_tmp, $target_path ) ) {
			// No
			$html .= '<pre>Tu imagen no fue subida.</pre>';
		}
		else {
			// Si!
			$html .= "<pre>{$target_path} ¡subida con éxito!</pre>";
		}
	}
	else {
		// Invalid file
		$html .= '<pre>Tu imagen no ha sido cargada. Solo podemos aceptar imágenes JPEG o PNG.</pre>';
	}
}

?>
