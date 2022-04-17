<div class="body_padded">
	<h1>Ayuda - File Upload</h1>

	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
		<h3>Info</h3>
		<p>Los archivos cargados representan un riesgo significativo para las aplicaciones web. El primer paso en muchos ataques es obtener algún código para el sistema que será atacado.Luego, el atacante solo necesita encontrar una manera de ejecutar el código. El uso de una carga de archivos ayuda al atacante a realizar el primer paso.</p>

		<p>Las consecuencias de la carga de archivos sin restricciones pueden variar, incluida la toma completa del sistema, un sistema de archivos sobrecargado, reenvío de ataques a sistemas back-end,y simple desfiguración. Depende de lo que haga la aplicación con el archivo cargado, incluido dónde se almacena.</p>

		<br /><hr /><br />

		<h3>Objetivo</h3>
		<p>Ejecute cualquier función PHP de su elección en el sistema de destino (como <?php echo pvwaExternalLinkUrlGet( 'https://secure.php.net/manual/en/function.phpinfo.php', 'phpinfo()' ); ?>
			or <?php echo pvwaExternalLinkUrlGet( 'https://secure.php.net/manual/en/function.system.php', 'system()' ); ?>) Gracias a esta vulnerabilidad de carga de archivos.</p>

		<br /><hr /><br />

		<h3>Nivel bajo</h3>
		<p>El nivel bajo no verificará el contenido del archivo que se carga de ninguna manera. Se basa únicamente en la confianza.</p>
		<pre>Spoiler: <span class="spoiler">Cargue cualquier archivo PHP válido con un comando</span>.</pre>

		<br />

		<h3>Nivel Medio</h3>
		<p>Al usar el nivel medio, verificará el tipo de archivo informado por el cliente cuando se carga.</p>
		<pre>Spoiler: <span class="spoiler">Vale la pena buscar cualquier restricción dentro de cualquier campo de formulario "oculto"</span>.</pre>

		<br />

		<h3>Nivel alto</h3>
		<p>Una vez que se haya recibido el archivo del cliente, el servidor intentará cambiar el tamaño de cualquier imagen que se haya incluido en la solicitud.</p>
		<pre>Spoiler: <span class="spoiler">necesita vincular otra vulnerabilidad, como la inclusión de archivos</span>.</pre>

		<br />

		
	</div></td>
	</tr>
	</table>

	</div>

	<br />

	<p>Referencia: <?php echo pvwaExternalLinkUrlGet( 'https://www.owasp.org/index.php/Unrestricted_File_Upload' ); ?></p>
</div>

