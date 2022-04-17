<div class="body_padded">
	<h1>Ayuda - Cross Site Scripting (Stored)</h1>

	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
		<h3>Info</h3>
		<p>Los ataques "Cross-Site Scripting (XSS)" son un tipo de problema de inyección, en el que se inyectan secuencias de comandos malintencionadas en sitios web que, de otro modo, serían benignos y de confianza.Los ataques XSS ocurren cuando un atacante usa una aplicación web para enviar código malicioso, generalmente en forma de un script del lado del navegador,a un usuario final diferente. Las fallas que permiten que estos ataques tengan éxito están bastante extendidas y ocurren en cualquier lugar donde una aplicación web utilice la entrada de un usuario en la salida,sin validarlo ni codificarlo.</p>

		<p>Un atacante puede usar XSS para enviar un script malicioso a un usuario desprevenido. El navegador del usuario final no tiene forma de saber que no se debe confiar en el script,y ejecutará el JavaScript. Debido a que cree que la secuencia de comandos proviene de una fuente confiable, la secuencia de comandos maliciosa puede acceder a cualquier cookie, token de sesión u otros información confidencial retenida por su navegador y utilizada con ese sitio. Estos scripts pueden incluso reescribir el contenido de la página HTML.</p>

		<p>El XSS se almacena en la base de datos. El XSS es permanente, hasta que se restablece la base de datos o se elimina manualmente la carga útil.</p>

		<br /><hr /><br />
		<h3>Objetivo</h3>
		<p>Redirige a todos a una página web de tu elección.</p>

		<br /><hr /><br />

		<h3>Nivel bajo</h3>
		<p>El nivel bajo no verificará la entrada solicitada antes de incluirla para usarla en el texto de salida.</p>
		<pre>Spoiler: <span class="spoiler">Nombre o campo de mensaje: &lt;script&gt;alert("XSS");&lt;/script&gt;</span>.</pre>

		<br />

		<h3>Nivel Medio</h3>
		<p>El desarrollador agregó algo de protección, sin embargo, no ha hecho todos los campos de la misma manera.</p>
		<pre>Spoiler: <span class="spoiler">campo de nombre: &lt;sCriPt&gt;alert("XSS");&lt;/sCriPt&gt;</span>.</pre>

		<br />

		<h3>Nivel alto</h3>
		<p>El desarrollador cree que ha deshabilitado todo el uso de secuencias de comandos al eliminar el patrón "&lt;s*c*r*i*p*t".</p>
		<pre>Spoiler: <span class="spoiler">Eventos HTML</span>.</pre>

		<br />
		
	</div></td>
	</tr>
	</table>

	</div>

	<br />

	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://www.owasp.org/index.php/Cross-site_Scripting_(XSS)' ); ?></p>
</div>
