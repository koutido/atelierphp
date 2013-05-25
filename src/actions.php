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
<body>

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

if(isset($reserve)){
	//génération du codepin
	$alphabet = "123456789";
	$nbcar = 4; 
	$i = 0;
	$codepin = "";
	//initialisation du hasard avec le moment en microsecondes.
	srand((double)microtime()*1000000);
	while ($i<$nbcar) {
		$valcar = rand(0, strlen($alphabet));
		$codepin .= substr($alphabet,$valcar,1);
		$i++;
	}	
	echo "Voici le codepin: ".$codepin .'<br>' ;
	echo "voici le commentaire: ".$comment;
	add_info($comment,$codepin);
	//booking($email, $room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute, 
	//	$end_date, $end_month, $end_year, $end_hour, $end_minute);
}

if(isset($modifier)){
	echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
	echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
	echo '<br>'.'<br>';
	echo "A faire";
}

if(isset($delete)){
	echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
	echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
	echo '<br>'.'<br>';
	echo "La réservation $clef à supprimer plus tard";
	//delete($clef);
}


?>










</body>
</html>