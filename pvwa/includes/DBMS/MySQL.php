<?php

/*

Este archivo contiene todo el código para configurar la base de datos MySQL inicial. (configuración.php)

*/

if( !defined( 'PVWA_WEB_PAGE_TO_ROOT' ) ) {
	define( 'PVWA_WEB_PAGE_TO_ROOT', '../../../' );
}

if( !@($GLOBALS["___mysqli_ston"] = mysqli_connect( $_PVWA[ 'db_server' ],  $_PVWA[ 'db_user' ],  $_PVWA[ 'db_password' ], "", $_PVWA[ 'db_port' ] )) ) {
	pvwaMessagePush( "No se pudo conectar con la base de datos.<br/>Por favor revise el archivo de configuración.
		<br/>Database Error #" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "." );
	
	if ($_PVWA[ 'db_user' ] == "root") {
		pvwaMessagePush( 'El usuario de su base de datos es root, si está utilizando MariaDB, esto no funcionará, lea el archivo README.md.' );
	}
	pvwaPageReload();
}

// Crear base de datos
$drop_db = "DROP DATABASE IF EXISTS {$_PVWA[ 'db_database' ]};";
if( !@mysqli_query($GLOBALS["___mysqli_ston"],  $drop_db ) ) {
	pvwaMessagePush( "No se pudo eliminar la base de datos existente<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	pvwaPageReload();
}

$create_db = "CREATE DATABASE {$_PVWA[ 'db_database' ]};";
if( !@mysqli_query($GLOBALS["___mysqli_ston"],  $create_db ) ) {
	pvwaMessagePush( "No se pudo crear la base de datos<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	pvwaPageReload();
}
pvwaMessagePush( "Se ha creado la base de datos." );







// Crear tabla 'clientes'
if( !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $_PVWA[ 'db_database' ])) ) {
	pvwaMessagePush( 'No se pudo conectar a la base de datos.' );
	pvwaPageReload();
}

$create_tb = "CREATE TABLE clientes (cliente_id int(6),first_name varchar(15),last_name varchar(15),account bigint(20),card bigint(20),cvv int(4),date_card int(6),PRIMARY KEY (cliente_id));";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb ) ) {
	pvwaMessagePush( "No se pudo crear la tabla 'clientes'<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	pvwaPageReload();
}
pvwaMessagePush( " Se ha creado la tabla 'clientes'." );


// Insertar datos en la tabla clientes

$insert = "INSERT INTO clientes VALUES
	('1','Alami','Hamdan','777333574152541','5411474125872474','123','1123'),
	('2','Javier','Martinez','999777674192541','4511974115879474','456','1222'),
	('3','Angela','Rodriguez','111888374152541','3211874135878474','789','1025'),
	('4','Pablo','Ramirez','666333174142541','6511674155873474','712','1223'),
	('5','Juan','Torres','555777874122541','8511574175872474','345','1125');";
	
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $insert ) ) {
	pvwaMessagePush( "No se pudieron insertar datos en la tabla de 'clientes'<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	pvwaPageReload();
}
    pvwaMessagePush( "Datos insertados en la tabla 'clientes'." );



// Crear tabla 'usuarios'
if( !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $_PVWA[ 'db_database' ])) ) {
	pvwaMessagePush( 'No se pudo conectar a la base de datos.' );
	pvwaPageReload();
}

$create_tb = "CREATE TABLE usuarios (user_id int(6),first_name varchar(15),last_name varchar(15), user varchar(15), password varchar(32),last_login TIMESTAMP, failed_login INT(3), PRIMARY KEY (user_id));";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb ) ) {
	pvwaMessagePush( "No se pudo crear la tabla 'usuarios'<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	pvwaPageReload();
}
pvwaMessagePush( " Se ha creado la tabla 'usuarios'." );


// Insertar datos en la tabla usuarios

$insert = "INSERT INTO usuarios VALUES
	('1','Root','Root','root',MD5('toor'), NOW(), '0'),
	('2','System','System','system',MD5('abc123'), NOW(), '0'),
	('3','Developer','Developer','developer',MD5('123abc'), NOW(), '0'),
	('4','User','User','user',MD5('def456'), NOW(), '0');";
	
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $insert ) ) {
	pvwaMessagePush( "No se pudieron insertar datos en la tabla de 'usuarios'<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	pvwaPageReload();
}
    pvwaMessagePush( "Datos insertados en la tabla 'usuarios'." );





// Crear tabla registro
$create_tb_registro = "CREATE TABLE registro (comment_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, comment varchar(300), PRIMARY KEY (comment_id));";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb_registro ) ) {
	pvwaMessagePush( "No se pudo crear la tabla 'registro'<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	pvwaPageReload();
}
pvwaMessagePush( "Se ha creado la tabla'registro'." );


// Insertar datos en 'registro'
$insert = "INSERT INTO registro VALUES ('1','Este es un comentario de prueba.');";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $insert ) ) {
	pvwaMessagePush( "No se pudieron insertar datos en la tabla 'registro'<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	pvwaPageReload();
}
pvwaMessagePush( "Datos insertados en la tabla 'registro'." );




// fichero.bak para una lista de directorios vuln
$conf = PVWA_WEB_PAGE_TO_ROOT . 'config/config.inc.php';
$bakconf = PVWA_WEB_PAGE_TO_ROOT . 'config/config.inc.php.bak';
if (file_exists($conf)) {
	// En caso de algun error.
	@copy($conf, $bakconf);
}

pvwaMessagePush( "Archivo de recuperación /config/config.inc.php.bak creado automáticamente" );

// Done
pvwaMessagePush( "<em>Instalación con exito</em>!" );

if( !pvwaIsLoggedIn())
	pvwaMessagePush( "Por favor <a href='acceso.php'>inicia sesión</a>.<script>setTimeout(function(){window.location.href='acceso.php'},5000);</script>" );
pvwaPageReload();

?>
