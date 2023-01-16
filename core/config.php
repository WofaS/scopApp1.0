<?php


/**
 * app info
 */
define('APP_NAME', 'SampaCoP');
define('APP_DESC', 'Sampa English Assembly App');


 /**
 * database config
 */

if ($_SERVER['SERVER_NAME']=='localhost')
{
	// database config for local server
	define('DBHOST', 'localhost');
	define('DBNAME', 'mysampacop');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');

	//root path eg.localhost/
	define('ROOT', 'http://localhost/www/sampacop/public');
}else
{
	//database config for live server
	define('DBHOST', 'localhost');
	define('DBNAME', 'mysampacop');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');

	//root path eg.http://www.yourwebsite.com
	define('ROOT', 'http://192.168.1.120/www/sampacop/public');
}