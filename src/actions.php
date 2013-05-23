<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Room booked</title>
</head>

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

if(isset($reserve)){
booking($email, $room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute, 
		$end_date, $end_month, $end_year, $end_hour, $end_minute);
}

if(isset($modifier)){
	echo "A faire";
}

if(isset($delete)){
	echo "La réservation $clef à supprimer plus tard";
	//delete($clef);
}


?>










</body>
</html>