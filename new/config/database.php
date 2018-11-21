<?PHP

//Variables
$db_host = 'localhost';
$db_user = 'root';
$db_port = '3306';
$db_pwd = 'Papenworsmetmelk1';
$db_name = 'cterblan_camagru';

//Set DSN
$dsn = 'mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name;

//Create PDO
$pdo = new PDO($dsn, $db_user, $db_pwd);

//ERROR CHECKING
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);