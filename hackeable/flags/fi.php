<?php

if( !defined( 'PVWA_WEB_PAGE_TO_ROOT' ) ) {
	exit ("Buen intento ;-). ¡Utilice el archivo incluido la próxima vez!");
}

?>


<?php

echo "1.) Mi nombre es Sherlock Holmes. Es mi trabajo saber lo que otras personas no saben.\n\n<br /><br />\n";

$line3 = "2.) ¡Romeo, Romeo! ¿Por lo cual eres Romeo?";
$line3 = "--LINEA OCULTA ;)--";
echo $line3 . "\n\n<br /><br />\n";

$line4 = "3.)El mundo ya no está dirigido por armas, energía o dinero. Está dirigido por pequeños unos y ceros, pequeños bits de datos. Son solo electrones";
echo base64_decode( $line4 );

?>

