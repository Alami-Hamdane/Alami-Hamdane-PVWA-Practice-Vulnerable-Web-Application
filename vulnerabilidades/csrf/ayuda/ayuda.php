<div class="body_padded">
	<h1>Ayuda - Cross Site Request Forgery (CSRF)</h1>

	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
		<h3>Info</h3>
		<p>CSRF es un ataque que obliga a un usuario final a ejecutar acciones no deseadas en una aplicación web en la que está 	autenticado actualmente.Con un poco de ayuda de ingeniería social (como enviar un enlace por correo electrónico/chat), un atacante puede obligar a los usuarios de una aplicación web a ejecutar acciones de elección del atacante.</p>

		<p>La explotación exitosa de CSRF puede comprometer los datos y la operación del usuario final en el caso de un usuario normal. Si el usuario final objetivo es la cuenta de administrador, esto puede comprometer toda la aplicación web.</p>

		<p>Este ataque también puede llamarse "XSRF", similar a "Cross Site Scripting (XSS)", y a menudo se usan juntos..</p>

		<br /><hr /><br />

		<h3>Objetivo</h3>
		<p>Tu tarea es hacer que el usuario actual cambie su propia contraseña, sin que se entere de sus acciones, usando un ataque CSRF.
		</p>

		<br /><hr /><br />

		<h3>Nivel bajo</h3>
		<p>No existen medidas para protegerse contra este ataque. Esto significa que se puede crear un enlace para lograr una determinada acción (en este caso, cambiar la contraseña de los usuarios actuales).Luego, con un poco de ingeniería social básica, haga que el objetivo haga clic en el enlace (o simplemente visite una página determinada) para desencadenar la acción.</p>
		<pre>Revelación:: <span class="spoiler">?password_new=password&password_conf=password&Change=Change</span>.</pre>

		<br />

		<h3>Nivel medio</h3>
		<p>Para el desafío de nivel medio, hay una verificación para ver de dónde vino la última página solicitada. El desarrollador cree que si coincide con el dominio actual, debe provenir de la aplicación web para que sea confiable.</p>
		<p>Puede ser necesario vincular múltiples vulnerabilidades para explotar este vector, como XSS reflectante.</p>

		<br />

		<h3>Nivel alto</h3>
		<p>En el nivel alto, el desarrollador ha agregado un "token contra la falsificación de solicitud entre sitios (CSRF)". Para eludir este método de protección, se requerirá otra vulnerabilidad.</p>
		<pre>Revelación: <span class="spoiler">e.g. Javascript se ejecuta en el lado del cliente, en el navegador</span>.</pre>

		

		<p>Aquí hay una solicitud de muestra:</p>
		<pre><code><span class="spoiler">POST /vulnerabilidades/csrf/ HTTP/1.1
		Host: pvwa.test
		Content-Length: 51
		Content-Type: application/json
		Cookie: PHPSESSID=0hr9ikmo07thlcvjv3u3pkfeni; security=high
		user-token: 026d0caed93471b507ed460ebddbd096

		{"password_new":"a","password_conf":"a","Change":1}</span></pre></code>

		<br />

		
	</div></td>
	</tr>
	</table>

	</div>

	<br />

	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/csrf' ); ?></p>
</div>
