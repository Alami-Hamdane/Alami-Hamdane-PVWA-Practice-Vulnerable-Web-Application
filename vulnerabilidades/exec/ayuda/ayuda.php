<div class="body_padded">
	<h1>Ayuda - Command Injection</h1>

	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
		<h3>Info</h3>
		<p>El propósito del ataque de inyección de comandos es inyectar y ejecutar comandos especificados por el atacante en la aplicación vulnerable. En una situación como esta, la aplicación, que ejecuta comandos del sistema no deseados, es como un pseudo shell del sistema, y el atacante puede usarla como cualquier usuario autorizado del sistema. Sin embargo, los comandos se ejecutan con los mismos privilegios y entorno que tiene el servicio web..</p>

		<p>Los ataques de inyección de comandos son posibles en la mayoría de los casos debido a la falta de validación correcta de los datos de entrada, que pueden ser manipulados por el atacante.(formularios, cookies, encabezados HTTP, etc.).</p>

		<p>La sintaxis y los comandos pueden diferir entre los sistemas operativos (SO), como Linux y Windows, según las acciones deseadas.
		</p>

		<p>Este ataque también puede denominarse "Ejecución remota de comandos (RCE)".</p>

		<br /><hr /><br />

		<h3>Objetivo</h3>
		<p>De forma remota, averigüe el usuario del servicio web en el sistema operativo, así como el nombre de host de las máquinas a través de RCE.</p>

		<br /><hr /><br />

		<h3>Nivel bajo</h3>
		<p>Esto permite la entrada directa en una de las <u>muchas funciones de PHP</u> que ejecutarán comandos en el sistema operativo. Es posible escapar del comando diseñado y ejecutó acciones no intencionales.</p>
		<p>Esto se puede hacer agregando a la solicitud, "una vez que el comando se haya ejecutado correctamente, ejecute este comando".
		<pre>Spoiler: <span class="spoiler">To add a command "&&"</span>. Example: <span class="spoiler">127.0.0.1 && dir</span>.</pre>

		<br />

		<h3>Nivel medio</h3>
		<p>El desarrollador leyó algunos de los problemas con la inyección de comandos y colocó varios parches de patrones para filtrar la entrada. Sin embargo, esto no es suficiente.</p>
		<p>Se pueden usar varias sintaxis de otros sistemas para salir del comando deseado.</p>
		<pre>Spoiler: <span class="spoiler">e.g. background the ping command</span>.</pre>

		<br />

		<h3>Nivel alto</h3>
		<p>En el nivel alto, el desarrollador vuelve a la mesa de dibujo y agrega aún más patrones para que coincidan. Pero incluso esto no es suficiente.</p>
		<p>El desarrollador cometió un pequeño error tipográfico con los filtros y cree que cierto comando de PHP los salvará de este error.</p>
		<pre>Spoiler: <span class="spoiler"><?php echo pvwaExternalLinkUrlGet( 'https://secure.php.net/manual/en/function.trim.php', 'trim()' ); ?>
			elimina todos los espacios iniciales y finales, ¿verdad?</span>.</pre>

		<br />

		
	</div></td>
	</tr>
	</table>

	</div>

	<br />

	<p>Reference: <?php echo pvwaExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/Command_Injection' ); ?></p>
</div>
