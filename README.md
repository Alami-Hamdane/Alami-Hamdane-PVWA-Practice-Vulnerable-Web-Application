# Instalación
Asegúrese de que su archivo config/config.inc.php exista. Tener solo un config.inc.php.dist no será suficiente y tendrá que editarlo para adaptarlo a su entorno y cambiarle el nombre a config.inc.php. 

# Windows + XAMPP
La forma más sencilla de instalar PVWA es descargar e instalar XAMPP,es una distribución Apache muy fácil de instalar para Linux, Solaris, Windows y Mac OS X. El paquete incluye el servidor web Apache, MySQL, PHP, Perl, un servidor FTP y phpMyAdmin.XAMPP se puede descargar desde:
<https://www.apachefriends.org/en/xampp.html>
Simplemente descomprima pvwa.zip, coloque los archivos descomprimidos en la carpeta htdocs (C:\xampp\htdocs\PVWA), luego dirija su navegador a:`http://127.0.0.1/PVWA/configuracion.php`

# Base de datos
Para configurar la base de datos, simplemente haga clic en el botón `Configurar PVWA` en el menú principal, luego haga clic en el botón `Crear / Restablecer base de datos`. Esto creará / restablecerá la base de datos con los datos.Si recibe un error al intentar crear su base de datos, asegúrese de que las credenciales de su base de datos sean correctas dentro de `./config/config.inc.php`.Las variables están configuradas de la siguiente manera por defecto:
$_PVWA[ 'db_server'] = '127.0.0.1';
$_PVWA[ 'db_port'] = '3306';
$_PVWA[ 'db_user' ] = 'root';
$_PVWA[ 'db_password' ] = '';
$_PVWA[ 'db_database' ] = 'pvwa';

En Kali, Si está utilizando MariaDB en lugar de MySQL (MariaDB es la opción predeterminada en Kali), entonces no puede usar el usuario raíz de la base de datos, debe crear un nuevo usuario de la base de datos. Para hacer esto, conéctese a la base de datos como usuario raíz y luego use los siguientes comandos:

mysql> create database pvwa;
Query OK, 1 row affected (0.00 sec)

mysql> grant all on pvwa.* to pvwa@localhost identified by 'password';
Query OK, 0 rows affected, 1 warning (0.01 sec)

mysql> flush privileges;
Query OK, 0 rows affected (0.00 sec)


