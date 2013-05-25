<?php
include "commun/fonctions.inc.php";

$email=$_POST['email'];
$room_number=$_POST['room_number'];
$start_date=$_POST['start_date'];
$start_month=$_POST['start_month'];
$start_year=$_POST['start_year'];
$start_hour=$_POST['start_hour'];
$start_minute=$_POST['start_minute'];
$end_date=$_POST['end_date'];
$end_month=$_POST['end_month'];
$end_year=$_POST['end_year'];
$end_hour=$_POST['end_hour'];
$end_minute=$_POST['end_minute'];

if(isset($_POST['valider'])){
	$room = $_POST['room_number2'];
	echo "Salle: $room".'<br/>';
	echo "email: $email".'<br/>';
	echo "start date: $start_date".'<br/>';
	echo "start month: $start_month".'<br/>';
	echo "start year: $start_year".'<br/>';
	booking($email, $room, $start_date, $start_month, $start_year, $start_hour, $start_minute,
	$end_date, $end_month, $end_year, $end_hour, $end_minute);
}
		



?>
