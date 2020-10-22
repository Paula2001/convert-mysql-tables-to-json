<?php
require_once 'FileManager.php';
require_once 'PdoConnection.php';
$root = $_SERVER['PWD'];
$handle = fopen ("php://stdin","r");
echo "Please enter your saving directory".PHP_EOL;
$directory = fgets($handle);
$directory = str_replace(array("\n", "\r"), '', $directory);
FileManager::createDirectory(trim($directory));

echo "Please enter your credentials separated by a comma : ip , database , user name ,password".PHP_EOL;
$credentials = fgets($handle);
$credentials = explode(',',$credentials);
$ip = trim($credentials[0]);
$database = trim($credentials[1]);
$username = trim($credentials[2]);
$password = trim($credentials[3]);
$pdoConnection = new PdoConnection($database,$ip,$password,$username);


$q = $pdoConnection->connection->query("SHOW tables");
$tables = array_column($q->fetchAll(PDO::FETCH_ASSOC),'Tables_in_'.$database);

foreach ($tables as $table){
    $table = trim($table);
    $q = $pdoConnection->connection->query("SELECT * from $table");
    $content = $q->fetchAll(PDO::FETCH_ASSOC);
    FileManager::createJsonFile("$root/$directory/$table",json_encode($content));
}

echo "We are done here !";
