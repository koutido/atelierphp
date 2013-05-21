<?php

include_once "commun/fonctions.inc.php";
include_once "commun/connexion.inc.php";

session_register("fois");
if (!isset($_SERVER["PHP_AUTH_USER"])) {
	header('WWW-Authenticate: Basic realm="Club des Bons Vivants"');
	header('HTTP/1.0 401 Unauthorized');
	$auth=1;
	include "inscription_p1.php";
	echo "L'utilisateur n'existe pas!";
	exit;
}
elseif (isset($_SERVER["PHP_AUTH_USER"])) {
	echo "L'utilisateur existe bien dans la base!";
	$fois++;
	$nom_usage=$_SERVER['PHP_AUTH_USER'];
	$mot_passe=$_SERVER['PHP_AUTH_PW'];
	$sql = "SELECT * FROM membres WHERE nom_usage=$nom_usage
	and mot_passe=$mot_passe";
	$resultat=mysql_query($sql,$id_link);
	$nombre = @mysql_num_rows($resultat);
	if (!$nombre || $nombre<1) {
		if ($fois==3){
		$auth=3;
		include "inscription_p1.php";
		exit;
		}
		header('WWW-Authenticate: Basic realm="Club des Bons Vivants"');
		header('HTTP/1.0 401 Unauthorized');
		$auth=3;
		include "inscription_p1.php";
		exit;
	}
}

?>