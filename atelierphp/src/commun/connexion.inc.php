<?php

$dbname = 'atelierphp';
$hostname = 'localhost';
$username = 'atelierphp';
$password = 'atelierphp';
if (!$id_link = mysql_connect($hostname, $username, $password)) {
	echo 'Connexion impossible à mysql';
	exit;
}
if (!mysql_select_db($dbname, $id_link )) {
	echo 'Sélection de base de données impossible';
	exit;
} 
	
?>