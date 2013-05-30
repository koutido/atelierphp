<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Room booked</title>
</head>
<script LANG="JavaScript">
<!--
function submitMe(obj){
 	if(obj.value == "Accueil"){
		document.getElementById('actions').action ="index.php";
	}
 	if(obj.value == "Reservation"){
		document.getElementById('actions').action ="reservation.php";
	}
	
	document.getElementById('actions').submit();
}

</script>
<form name="Actions" id="actions" method="post" action="" >
<body bgcolor="CCE1FB">

<?php
session_start();
include "commun/connexion.inc.php";
include "commun/fonctions.inc.php";

$email=$_SESSION['email'];
$start_date=$_SESSION['start_date'];
$start_month=$_SESSION['start_month'];
$start_year=$_SESSION['start_year'];
$start_hour=$_SESSION['start_hour'];
$start_minute=$_SESSION['start_minute'];
$end_date=$_SESSION['end_date'];
$end_month=$_SESSION['end_month'];
$end_year=$_SESSION['end_year'];
$end_hour=$_SESSION['end_hour'];
$end_minute=$_SESSION['end_minute'];

$room_number=$_POST['room_selected'];

$reserve=$_POST['reserve'];
$delete=$_POST['delete'];
$modifier=$_POST['modify'];
$clef=$_POST['for_delete'];

$comment=$_POST['Comment'];
$creator=$_POST['creator'];

if(isset($reserve)){	
	//génération du codepin
	$alphabet = "123456789";
	$nbcar = 4; 
	$i = 0;
	$codepin = "";
	//id = le dernier clef de la table booking + 1
	//id permet de récupérer la réservation faite dans la table booking
	$req="SELECT MAX(clef) FROM booking";
	$exec=@mysql_query($req,$id_link);
	$res=@mysql_fetch_array($exec);
	$id=$res['MAX(clef)']+1;
	//la référence pour l'accusé de réception
	$req="SELECT MAX(ref) FROM information";
	$exec=@mysql_query($req,$id_link);
	$res=@mysql_fetch_array($exec);
	$ref=$res['MAX(ref)']+1;
	//initialisation du hasard avec le moment en microsecondes.
	srand((double)microtime()*1000000);
	while ($i<$nbcar) {
		$valcar = rand(1, strlen($alphabet));
		$codepin .= substr($alphabet,$valcar,1);
		$i++;
	}	
	//echo "Voici le codepin: ".$codepin .'<br>' ;
	//echo "Réservation créée par: ".$creator .'<br>' ;
	//echo "voici le commentaire: ".$comment;
	//ajout des infos
	add_info($id,$creator,$ref,$codepin,$comment);
	//ajout de réservation
	booking($email, $room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute, 
		$end_date, $end_month, $end_year, $end_hour, $end_minute);
	
	echo 'Votre salle '.$room_number.' a été réservée avec succès'.'<br>';
	echo 'Créée par '.$creator.'<br>';
	echo 'Code pin '.$codepin.'<br>';
	echo 'Accusé de réception à mettre ici avec son numéro '.$ref.'<br>';
	echo 'Les informations de connexion à mettre ici';
	echo '<br>'.'<br>';
	echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
	echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
	
	
}

if(isset($modifier)){
	echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
	echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
	echo '<br>'.'<br>';
	echo "A faire plus tard si nécessaire";
}

if(isset($delete)){
	echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
	echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
	echo '<br>'.'<br>';
	echo 'La suppression de la réservation '.$clef.' a été désactivée temporairement';
	//delete($clef);
}


?>










</body>
</html>