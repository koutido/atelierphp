<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Room booked successfully</title>

</head>

<body>

<?php
include "commun/connexion.inc.php";
include "commun/fonctions.inc.php";

echo '<form method="POST">';

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


//on récupère la liste des salles libres au créneau cherché
$room_list = room_free($start_date, $start_month, $start_year, $start_hour, $start_minute, 
						$end_date, $end_month, $end_year, $end_hour, $end_minute);
$taille=count($room_list);

//la liste résultante contient au moins une salle libre
if($taille>1){
	//la salle souhaitée est dans le tableau, on la réserve
	if(in_array($room_number, $room_list)){
		booking($email, $room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute,
		$end_date, $end_month, $end_year, $end_hour, $end_minute);		
	}
	else{
		echo "La salle $room_number n'est pas disponible à ce créneau";
		echo "<br/>";
		echo "Voici la liste des salles libres à ce créneau:";
		echo "<br/>";
		echo "Salle ";

		echo '<select name="room_number2">';
		echo '<option value="" selected></option>';
		for($i=1;$i<$taille;$i++){
			//on n'affiche pas la salle $room_number car elle est occupée
			if($room_list[$i]!=$room_number){
				$val=$room_list[$i];
				//on ajoute les autres salles dispo dans la liste de sélection				
				echo '<option value="',$val,'">',$val,'</option>';				
			}						
		}
		echo '</select>'; echo '&nbsp'.'&nbsp'.'&nbsp'.'&nbsp';
		
		echo '<input type="submit" name="valider" value="Réserver" >';	
		//$valider=$_POST['valider'];
		$room = $_POST['room_number2'];

		if(isset($_POST['valider'])){	
			$room_number=$room;
		}
		echo "Salle: $room".'<br/>';
		echo "email: $email".'<br/>';
		echo "start date: $start_date".'<br/>';
		echo "start month: $start_month".'<br/>';
		echo "start year: $start_year".'<br/>';
		
		
		
		
		
		
		echo "<br/>";
		echo '<a href="http://109.190.51.176/booking.php">Retourner à la page de réservation</a>';
	}	
}
else{
	echo "Aucune salle n'est disponible à ce créneau";
	echo "<br/>";
	//echo '<a href="http://atelierphp.com/booking.php">Retourner à la page de réservation</a>';
	echo '<a href="http://109.190.51.176/booking.php">Retourner à la page de réservation</a>';
}
echo '</form>';

?>

</body>
</html>