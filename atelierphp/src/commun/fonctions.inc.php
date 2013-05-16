<?php
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
	//echo '<a href="http://atelierphp.com/booking.php">Effectuer une nouvelle réservation</a>';
	echo '<a href="http://109.190.51.176/booking.php">Effectuer une nouvelle réservation</a>';
}

function message_occupied(){
	echo "Cette ressource est occupée";
	echo "<br/>";
	echo "La liste des salles disponible sera affichée ici";
	echo "<br/>";
	echo "<br/>";
	//echo '<a href="http://atelierphp.com/booking.php">Retourner à la page de réservation</a>';
	echo '<a href="http://109.190.51.176/booking.php">Retourner à la page de réservation</a>';
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
//cette fonction calcule le nombre total des minutes réservées
function minute_convert($hour, $minute){
	$res = ($hour*60 + $minute);
	return $res;
}
//cette fonction vérifie si une salle est libre ou non quand la réservation est faite dans un seul jour
function free_same_day($room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute,
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
			$t_start_reserv=minute_convert($start_hour_reserv, $start_minute_reserv);
			$t_end_reserv=minute_convert($end_hour_reserv, $end_minute_reserv);
			$t_start_ask=minute_convert($start_hour, $start_minute);
			$t_end_ask=minute_convert($end_hour, $end_minute);
			//heure de début demandée est avant celle réservée
			if($t_start_ask<$t_start_reserv){
				//heure fin demandé est inférieure à celle de début réservée
				//la salle est occupée
				if($t_end_ask>$t_start_reserv){
					$count_occupied++;
				}
			}
			//heure de début demandée est égale ou suppérieure celle réservée
			else {
				//heure de début demandée est la même que celle réservée
				if($t_start_ask==$t_start_reserv){
					$count_occupied++;
				}
				//heure de début demandée est après celle réservée
				else {
					//heure de début demandée est inférieure celle de fin réservée
					//la salle est occupée
					if($t_start_ask<$t_end_reserv){
						$count_occupied++;

					}
				}
			}
		}
	}
}
//cette fonction vérifie si une salle est libre ou non quand la réservation dépasse au jour suivant
function free_day_after($room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute,
		$end_date, $end_month, $end_year, $end_hour, $end_minute){
	include "commun/connexion.inc.php";
	$req="SELECT room_number,end_hour,end_minute
	FROM booking WHERE end_date=$start_date AND start_month=$start_month AND start_year=$start_year
	AND end_month=$end_month AND end_year=$end_year";
	$exec=@mysql_query($req,$id_link);
	//compteur pour salle réservée
	$count_occupied=0;
	//nombre de fois que une salle donnée est réservée dans un jour
	$occurrence=0;
	while($res=@mysql_fetch_array($exec)){
		//un créneau du jour a été réservé pour cette salle
		if($res['room_number']==$room_number){
			$occurrence++;
			$end_hour_reserv=$res['end_hour'];
			$end_minute_reserv=$res['end_minute'];
			//calcul en minute des horaires
			$t_end_reserv=minute_convert($end_hour_reserv, $end_minute_reserv);
			$t_start_ask=minute_convert($start_hour, $start_minute);
			$t_end_ask=minute_convert($end_hour, $end_minute);

			if($t_start_ask<$t_end_reserv){
				$count_occupied++;
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
//le premier élément est un code qui indique si la salle est réservée en 1 ou 2 jour
//"same" = en 1 jour, "after"= en 2 jours
function room_free($start_date, $start_month, $start_year, $start_hour, $start_minute,
		$end_date, $end_month, $end_year, $end_hour, $end_minute){
	include "commun/connexion.inc.php";
	//requete quand la réservation est dans le même jour
	$req_same="SELECT room_number FROM booking WHERE start_date=$start_date AND start_month=$start_month
	AND start_year=$start_year AND end_date=$end_date AND end_month=$end_month AND end_year=$end_year";
	//requete quand la réservation dépasse au jour suivant
	$req_after="SELECT room_number FROM booking WHERE end_date=$start_date AND start_month=$start_month
	AND start_year=$start_year AND end_month=$end_month AND end_year=$end_year";
	$exec_same=@mysql_query($req_same,$id_link);
	$exec_after=@mysql_query($req_after,$id_link);
	//tableau des numéros de salles par défaut
	$all_room = array();
	for($i=1;$i<5;$i++){
		array_push($all_room,$i);
	}
	$room_tab_diff = array();
	$room_tab_found = array();
	$room_number;
	//le cas même jour
	if($start_date==$end_date && $start_month==$end_month && $start_year==$end_year){
		//récupérer les numéros de salles pour stocker dans
		//le tableau clé numérique $room_tab_found
		while($res=@mysql_fetch_array($exec_same)){
			array_push($room_tab_found,$res['room_number']);
		}
		//enlever les doublons
		//ce tableau a la clé 'room_number'
		$tab_unique= array_unique($room_tab_found);
		//le tableau de différence contient les numéros de salles qui sont jamais réservées
		$room_tab_diff = array_diff($all_room, $tab_unique);
		//chercher les salles libres
		foreach ($tab_unique as $i){
			$free=free_same_day($i, $start_date, $start_month, $start_year, $start_hour, $start_minute,
					$end_date, $end_month, $end_year, $end_hour, $end_minute);
			//si la salle est libre pour ce créneau, on l'ajoute dans le tableau différence
			if ($free){
				array_push($room_tab_diff,$i);
			}
		}
		sort($room_tab_diff);
		//on rajoute le code 'same' dans la première case
		array_unshift($room_tab_diff, 'same');
		return $room_tab_diff;
	}
	//le cas du dépassement au jour suivant
	else{
		//récupérer les numéros de salles pour stocker dans
		//le tableau clé numérique $room_tab_found
		while($res=@mysql_fetch_array($exec_after)){
			array_push($room_tab_found,$res['room_number']);
		}
		//enlever les doublons
		//ce tableau a la clé 'room_number'
		$tab_unique= array_unique($room_tab_found);
		//le tableau de différence
		$room_tab_diff = array_diff($all_room, $tab_unique);
		//chercher les salles libres
		foreach ($tab_unique as $i){
			$free=free_day_after($i, $start_date, $start_month, $start_year, $start_hour, $start_minute,
					$end_date, $end_month, $end_year, $end_hour, $end_minute);
			//si la salle est libre pour ce créneau, on l'ajoute dans le tableau différence
			if ($free){
				array_push($room_tab_diff,$i);
			}
		}
		sort($room_tab_diff);
		//on rajoute le code 'after' dans la première case
		array_unshift($room_tab_diff, 'after');
		return $room_tab_diff;
	}

}

function global_session($var){
	if(!array_key_exists($var,$_SESSION))
		$_SESSION[$var]='';
	$GLOBALS[$var]=&$_SESSION[$var];
}
?>