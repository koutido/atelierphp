<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Room booked successfully</title>

</head>

<body>
<?php
include "commun/connexion.inc.php";

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

function booking($email, $room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute,
	$end_date, $end_month, $end_year, $end_hour, $end_minute)
{
	include "commun/connexion.inc.php";
	$sql="INSERT INTO booking (email, room_number, start_date, start_month, start_year, start_hour, 
	start_minute, end_date, end_month, end_year, end_hour, end_minute)
	VALUES ('$email', $room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute,
	$end_date, $end_month, $end_year, $end_hour, $end_minute)";
	@mysql_query($sql,$id_link);	
	
	echo "Votre salle virtuelle a bien été réservée!";
	echo "<br/>";
	echo "<br/>";
	echo '<a href="http://atelierphp.com/booking.php">Effectuer une nouvelle réservation</a>';
}
function message_occupied(){
	echo "Cette ressource est occupée";
	echo "<br/>";
	echo "La liste des salles disponible sera affichée ici";
	echo "<br/>";
	echo "<br/>";
	echo '<a href="http://atelierphp.com/booking.php">Retourner à la page de réservation</a>';
}
//cette fonction retourne la liste des salles réservées et les horaires à une date donnée
function booked_by_date($start_date, $start_month, $start_year, $end_date, $end_month, $end_year){
	include "commun/connexion.inc.php";
	$req="SELECT room_number,start_hour,start_minute,end_hour,end_minutes 
	WHERE start_date=$start_date AND start_month=$start_month AND start_year=$start_year 
	AND end_date=$end_date AND end_month=$end_month AND end_year=$end_year";
	$exec=@mysql_query($req,$id_link);
	$res=@mysql_fetch_array($exec);
	return $res;
}
//cette fonction returne true si la salle est dispo avec les horaires donnés
//et returne false si non
function free($room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute,
	$end_date, $end_month, $end_year, $end_hour, $end_minute){
	include "commun/connexion.inc.php";
	$req="SELECT room_number,start_hour,start_minute,end_hour,end_minute
	FROM booking WHERE start_date=$start_date AND start_month=$start_month AND start_year=$start_year 
	AND end_date=$end_date AND end_month=$end_month AND end_year=$end_year";
	$exec=@mysql_query($req,$id_link);
	//compteur pour salle libre
	$count_free=0;
	//compteur pour salle réservée
	$count_occupied=0;
	//nombre de fois que une salle donnée est réservée dans un jour
	$occurrence=0;

	while($res=@mysql_fetch_array($exec)){
		//un créneau du jour a été réservé pour cette salle
		if($res['room_number']==$room_number){
			$occurrence++;
			$start_hour_reserv=$res['start_hour'];
			$start_minute_reserv=$res['start_minute'];
			$end_hour_reserv=$res['end_hour'];
			$end_minute_reserv=$res['end_minute'];
			//calcul en minute des horaires
			$t_start_reserv=(60*$start_hour_reserv + $start_minute_reserv);
			$t_end_reserv=(60*$end_hour_reserv + $end_minute_reserv);
			$t_start_ask=(60*$start_hour + $start_minute);
			$t_end_ask=(60*$end_hour + $end_minute);
			//heure de début demandée est avant celle réservée
			if($t_start_ask<$t_start_reserv){
				//heure fin demandé est inférieure ou égale à celle de début réservée
				//donc la salle est dispo
				if($t_end_ask<=$t_start_reserv){
					$count_free++;
					//echo "t_end ask <= t_start reservé"."<br/>";
				}
				else $count_occupied++;
			}
			//heure de début demandée est égale ou suppérieure celle réservée
			else {
				//heure de début demandée est la même que celle réservée
				if($t_start_ask==$t_start_reserv){
					$count_occupied++;
				}
				//heure de début demandée est après celle réservée
				else {
					//heure de début demandée est égale ou après celle de fin réservée
					//salle est libre
					if($t_start_ask>=$t_end_reserv){
						$count_free++;
						//echo "t_start ask >= t_end reservé"."<br/>";
					}
					else $count_occupied++;
				}
			}
		}
	
	}
	//aucun créneau n'est trouvé pour la salle donnée
	//la salle concernée est libre toute la journée
	if($occurrence==0){
		return true;
	}
	else{
		//la salle n'est jamais réservée au créneau donné
		if($count_occupied==0){
			return true;
		}
		//un créneau réservé est trouvé
		else{
			return false;
		}
	}	
}
//retourner une liste des salles dispo à un créneau donné
function room_free($start_date, $start_month, $start_year, $start_hour, $start_minute,
	$end_date, $end_month, $end_year, $end_hour, $end_minute){
	include "commun/connexion.inc.php";	

	$req="SELECT room_number FROM booking WHERE start_date=$start_date AND start_month=$start_month
	AND start_year=$start_year AND end_date=$end_date AND end_month=$end_month AND end_year=$end_year";
	
	$exec=@mysql_query($req,$id_link);	
	//tableau des numéros de salles par défaut
	$all_room = array();
	for($i=1;$i<5;$i++){
		array_push($all_room,$i);
	}	
	$room_tab_diff = array();
	$room_tab_found = array();
	$room_number;
	//récupérer les numéros de salles pour stocker dans
	//le tableau clé numérique $room_tab_found
	while($res=@mysql_fetch_array($exec)){
		array_push($room_tab_found,$res['room_number']);
	}
	//enlever les doublons
	//ce tableau a la clé 'room_number'
	$tab_unique= array_unique($room_tab_found);
	//le tableau de différence
	$room_tab_diff = array_diff($all_room, $tab_unique);
	//chercher les salles libres
	foreach ($tab_unique as $i){
		$free=free($i, $start_date, $start_month, $start_year, $start_hour, $start_minute,
				$end_date, $end_month, $end_year, $end_hour, $end_minute);
		//si la salle est libre pour ce créneau, on l'ajoute dans le tableau différence
		if ($free){
			array_push($room_tab_diff,$i);
		}
	}
	sort($room_tab_diff);
	return $room_tab_diff;
}
	
/////// Ici on suppose que toutes réservations ne dépassent pas 1 jour //////////////////

if(free($room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute, 
		$end_date, $end_month, $end_year, $end_hour, $end_minute)){
	booking($email, $room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute,
	$end_date, $end_month, $end_year, $end_hour, $end_minute);
}
else {
	echo "La salle $room_number n'est pas disponible à ce créneau";
	echo "<br/>";
	$room_tab=room_free($start_date, $start_month, $start_year, $start_hour, $start_minute, 
		$end_date, $end_month, $end_year, $end_hour, $end_minute);
	$taille=count($room_tab);
	if (count($room_tab)==0){
		echo "Aucune salle n'est disponible à ce créneau";
		echo "<br/>";
		echo '<a href="http://atelierphp.com/booking.php">Retourner à la page de réservation</a>';
	}
	else {
		echo "Voici les salles disponible à ce créneau:";
		foreach ($room_tab as $i){
			echo "<br/>";
			echo "Salle $i";
		}
		echo "<br/>";
		echo '<a href="http://atelierphp.com/booking.php">Retourner à la page de réservation</a>';
	}
}


?>

</body>
</html>