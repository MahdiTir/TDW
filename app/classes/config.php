<?php 

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	/** database config **/
	define('DBNAME', 'association_elmountada');
	define('DBHOST', "127.0.0.1");
	define('DBPORT', 3308);
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	
	define('BASE_URL', 'http://localhost/association1/');

}else
{
	/** database config **/
	define('DBNAME', 'association_elmountada');
	define('DBHOST', "127.0.0.1");
    define('DBPORT', 3308);
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	
	define('BASE_URL', 'http://localhost/association1/');

}

define('APP_NAME', "El Mountada");
define('APP_DESC', "Application d'aide à la gestion d'une association caritatif");

/** true means show errors **/
define('DEBUG', true);
