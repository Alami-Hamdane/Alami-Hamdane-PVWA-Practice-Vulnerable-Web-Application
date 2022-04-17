<?php

define( 'PVWA_WEB_PAGE_TO_ROOT', '' );
require_once PVWA_WEB_PAGE_TO_ROOT . 'pvwa/includes/pvwaPage.inc.php';

pvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = pvwaPageNewGrab();
$page[ 'title' ]   = 'Bienvenidos' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'home';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Practice Vulnerable Web Application!</h1>
	<p>Practice Vulnerable Web Application (PVWA) es una aplicación web PHP/MySQL vulnerable. Su objetivo principal es practicar las vulnerabilidades de las aplicaciones  web y así permitir  a  los desarrolladores web comprender mejor los procesos de protección de las aplicaciones web.</p>
	<p>El objetivo de PVWA es practicar algunas de las vulnerabilidades web más comunes, con varios niveles de dificultad, con una interfaz sencilla y directa.</p>
	<hr />
	<br />

	<h2>Instrucciones generales</h2>
	<p>Depende del usuario cómo se interactua con PVWA. Ya sea practicando en cada módulo en un nivel fijo, o seleccionando cualquier módulo y practicando para alcanzar el nivel más alto. No hay un objeto fijo para completar un módulo; sin embargo, los usuarios deben sentir que han explotado con éxito el sistema de la mejor manera posible mediante el uso de esa vulnerabilidad en particular.</p>
	
	<hr />
	<br />

	<hr />
	<br />

	<h2>Más recursos de formación</h2>
	<p>PVWA tiene como objetivo cubrir las vulnerabilidades más comunes que se encuentran en las aplicaciones web actuales. Sin embargo, hay muchos otros problemas con las aplicaciones web. Si desea explorar cualquier vector de ataque adicional o quiere desafíos más difíciles, puede considerar los siguientes otros proyectos:</p>
	<ul>
		<li>" . pvwaExternalLinkUrlGet( 'https://www.owasp.org/index.php/OWASP_Broken_Web_Applications_Project', 'OWASP Broken Web 	  Applications Project') . "</li>
	</ul>
	<hr />
	<br />
</div>";

pvwaHtmlEcho( $page );

?>
