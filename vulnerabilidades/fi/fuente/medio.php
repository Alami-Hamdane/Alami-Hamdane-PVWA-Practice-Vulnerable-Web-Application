<?php

/// La página que deseamos mostrar
$file = $_GET[ 'page' ];

// Validación de entrada
$file = str_replace( array( "http://", "https://" ), "", $file );
$file = str_replace( array( "../", "..\"" ), "", $file );

?>
