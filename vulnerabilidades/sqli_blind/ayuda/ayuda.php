<div class="body_padded">
	<h1>Ayuda - SQL Injection (Blind)</h1>

	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
		<h3>Info</h3>
		<p>Cuando un atacante ejecuta ataques de inyección SQL, a veces el servidor responde con mensajes de error del servidor de la base de datos quejándose de que la sintaxis de la consulta SQL es incorrecta.La inyección ciega de SQL es idéntica a la inyección SQL normal, excepto que cuando un atacante intenta explotar una aplicación, en lugar de obtener un mensaje de error útil,
		en su lugar, obtienen una página genérica especificada por el desarrollador. Esto hace que explotar un posible ataque de inyección SQL sea más difícil pero no imposible.
		Un atacante aún puede robar datos haciendo una serie de preguntas de verdadero y falso a través de declaraciones SQL y monitoreando cómo responde la aplicación web.(entrada válida devuelta o conjunto de encabezado 404).</p>

		<p>El método de inyección "basado en el tiempo" se usa a menudo cuando no hay comentarios visibles sobre cómo la página difiere en su respuesta (por lo tanto, es un ataque ciego).
		Esto significa que el atacante esperará para ver cuánto tarda la página en responder. Si tarda más de lo normal, su consulta fue exitosa.</p>

		<br /><hr /><br />

		<h3>Objetivo</h3>
		<p>Encuentre la versión del software de la base de datos SQL a través de un ataque SQL ciego.</p>

		<br /><hr /><br />

		<h3>Nivel bajo</h3>
		<p>La consulta SQL utiliza datos RAW controlados directamente por el atacante. Todo lo que necesitan hacer es escapar de la consulta y luego pueden para ejecutar cualquier consulta SQL que deseen.</p>
		<pre>Spoiler: <span class="spoiler">?id=1' AND sleep 5&Submit=Submit</span>.</pre>

		<br />

		<h3>Nivel Medio</h3>
		<p>El nivel medio utiliza una forma de protección de inyección SQL, con la función de
			"<?php echo pvwaExternalLinkUrlGet( 'https://secure.php.net/manual/en/function.mysql-real-escape-string.php', 'mysql_real_escape_string()' ); ?>".
			Sin embargo, debido a que la consulta SQL no tiene comillas alrededor del parámetro, esto no protegerá por completo la modificación de la consulta.</p>

		<p>El cuadro de texto se reemplazó con una lista desplegable predefinida y usa POST para enviar el formulario.</p>
		<pre>Spoiler: <span class="spoiler">?id=1 AND sleep 3&Submit=Submit</span>.</pre>

		<br />

		<h3>Nivel alto</h3>
		<p>Esto es muy similar al nivel bajo, sin embargo, esta vez el atacante ingresa el valor de una manera diferente.
		Los valores de entrada se establecen en una página diferente, en lugar de una solicitud GET.</p>
		<pre>Spoiler: <span class="spoiler">ID: 1' AND sleep 10&Submit=Submit</span>.
			 Spoiler: <span class="spoiler">Should be able to cut out the middle man.</span>.</pre>

		<br />

		
	</div></td>
	</tr>
	</table>

	</div>

	<br />

	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/Blind_SQL_Injection' ); ?></p>
</div>
