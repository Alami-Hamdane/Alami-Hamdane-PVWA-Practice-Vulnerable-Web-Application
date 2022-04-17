<div class="body_padded">
	<h1>Ayuda - SQL Injection</h1>

	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
		<h3>Info</h3>
		<p>Un ataque de inyección SQL consiste en la inserción o "inyección" de una consulta SQL a través de los datos de entrada del cliente a la aplicación.Un exploit de inyección SQL exitoso puede leer datos confidenciales de la base de datos, modificar datos de la base de datos (insertar/actualizar/eliminar), ejecutar operaciones de administración en la base de datos(como apagar el DBMS), recuperar el contenido de un archivo dado presente en el sistema de archivos DBMS (load_file) y, en algunos casos, emitir comandos al sistema operativo.</p>

		<p>Los ataques de inyección SQL son un tipo de ataque de inyección, en el que los comandos SQL se inyectan en la entrada del plano de datos para efectuar la ejecución de comandos SQL predefinidos.</p>

		<p>Este ataque también puede llamarse "SQLi".</p>

		<br /><hr /><br />

		<h3>Objetivo</h3>
		<p>Hay 5 clientes en la base de datos, con id's del 1 al 5. Tu misión... robar sus numeros de tarjetas y su CVV a través de SQLi.</p><br />
		<p>En el nivel alto Hay que robar las contraseñas de los 4 usuarios almacenados en la base de datos, con id's del 1 al 4..</p><br />


		<br /><hr /><br />

		<h3>Nivel bajo</h3>
		<p>La consulta SQL utiliza una entrada RAW que el atacante controla directamente. Todo lo que necesitan hacer es escapar de la consulta y luego pueden para ejecutar cualquier consulta SQL que deseen.</p>
		<pre>Spoiler: <span class="spoiler">?id=a' UNION SELECT "text1","text2";-- -&Submit=Submit</span>.</pre>

		<br />

		<h3>Nivel medio</h3>
		<p>El nivel medio utiliza una forma de protección de inyección SQL, con la función de
			"<?php echo pvwaExternalLinkUrlGet( 'https://secure.php.net/manual/en/function.mysql-real-escape-string.php', 'mysql_real_escape_string()' ); ?>".
			Sin embargo, debido a que la consulta SQL no tiene comillas alrededor del parámetro, esto no protegerá completamente la consulta para que no se modifique.</p>

		<p>El cuadro de texto se reemplazó con una lista desplegable predefinida y usa POST para enviar el formulario.</p>
		<pre>Spoiler: <span class="spoiler">?id=a UNION SELECT 1,2;-- -&Submit=Submit</span>.</pre>

		<br />

		<h3>Nivel alto</h3>
		<p>Esto es muy similar al nivel bajo, sin embargo, esta vez el atacante ingresa el valor de una manera diferente.Los valores de entrada se transfieren a la consulta vulnerable a través de variables de sesión utilizando otra página, en lugar de una solicitud GET directa.</p>
		<pre>Spoiler: <span class="spoiler">ID: a' UNION SELECT "text1","text2";-- -&Submit=Submit</span>.</pre>

		<br />

		
	</div></td>
	</tr>
	</table>

	</div>

	<br />

	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://www.owasp.org/index.php/SQL_Injection' ); ?></p>
</div>
