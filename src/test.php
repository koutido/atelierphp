<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Page de test</title>

<body>
<?php
//$doc_root=$_SERVER["DOCUMENT_ROOT"];
//echo $doc_root;

//echo date("j/n/Y", mktime(0,0,0,date("n"), date("j")-15, date("Y")));

//$date_butoir=mktime(0,0,0,9, 26, 2002);
/*ici vous avez le timestamp de la date butoir qui est
 le 26 septembre 2002*/
//$jours_difference=(round(($date_butoir-time())/(60*60*24)));
//echo $jours_difference;
/* echo "Année en cours en quatre chiffres: " .date("Y");
echo "<br/>";
echo "Année en cours en deux chiffres: " .date("y");
echo "<br/>";
echo "Mois en cours avec zéro: " .date("m");
echo "<br/>";
echo "Mois en cours sans zéro: " .date("n");
echo "<br/>";
echo "Jour du mois avec zéro: " .date("d");
echo "<br/>";
$jour=date("w");
switch ($jour){
	case 0:
		echo "Aujourd'hui on est le Dimanche";
		break;
	case 1:
		echo "Aujourd'hui on est le Lundi";
		break;
	case 2:
		echo "Aujourd'hui on est le Mardi";
		break;
	case 3:
		echo "Aujourd'hui on est le Mercredi";
		break;
	case 4:
		echo "Aujourd'hui on est le Jeudi";
		break;
	case 5:
		echo "Aujourd'hui on est le Vendredi";
		break;
	default:
		echo "Aujourd'hui on est le Samedi";
		break;
}
echo "<br/>";

echo "Date complète d'aujourd'hui: " .date("d/m/Y");
echo "<br/>";
echo "Le fuseau horaire de cet ordinateur: ".date("T"); echo "<br/>";
echo "La différence avec l'heure de Greenwich en heure est: ".date("O"); echo "<br/>";
echo "Il est ".date("H:i");echo "<br/>";
*/

/////////////Test de calendrier////////////////
//echo date("w", mktime(0,0,0,date("n"), 1, date("Y")));
//echo $_SERVER['SCRIPT_NAME'];
/* 
$start1 = mktime(14, 00, 00, 05, 08, 2013);
$end1 = mktime(16, 30, 00, 05, 08, 2013);
$start2 = mktime(17, 00, 00, 05, 08, 2013);
$end2 = mktime(18, 00, 00, 05, 08, 2013);
//$start3 = mktime(12, 00, 00, 05, 08, 2013);
//$end3 = mktime(14, 00, 00, 05, 08, 2013);
echo "start time 1: ". $start1; echo "<br/>";
echo "end   time 1 : ". $end1; echo "<br/>";

echo "start time 2: ". $start2; echo "<br/>";
echo "end   time 2 : ". $end2; echo "<br/>";

//echo "start time 3: ". $t5; echo "<br/>";
//echo "end   time 3 : ". $t6; echo "<br/>";
if ($start2>=$end2) {
	echo "Merci de vérifier vos horaires";
}
elseif ($star2<$end2){
	if ($start2<$start1){
		if($end2<=$start1){
			echo "Booking ok";
		}
		else echo "Occupé";
	}
	if ($start2==$start1){ 
		echo "Occupé";
	}
	if($start2>$start1){
		if($start2>=$end1){
			echo "Booking ok";
		}
		else echo "Occupé";
	}
}
*/
/*
$start1 = mktime(7, 00, 00, 11, 05, 2013);
$start2 = mktime(8, 30, 00, 11, 05, 2013);
echo $start1;
echo "<br/>";
echo $start2;
echo "<br/>";
*/
include "commun/connexion.inc.php";

function minute_convert($hour, $minute){
	$res = ($hour*60 + $minute);
	return $res;
}
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

$start_date=6;
$start_month=7;
$start_year=2013;

$start_hour=1;
$start_minute=30;

$end_date=6;
$end_month=7;
$end_year=2013;

$end_hour=3;
$end_minute=30;

$salle = 2;
$free_day_after= free_day_after($salle, $start_date, $start_month, $start_year, $start_hour, $start_minute, 
		$end_date, $end_month, $end_year, $end_hour, $end_minute);
$free_same_day= free_same_day($salle, $start_date, $start_month, $start_year, $start_hour, $start_minute,
		$end_date, $end_month, $end_year, $end_hour, $end_minute);
if($free_day_after){
	echo "La salle $salle est libre";
	echo "<br/>";
}
else{
	echo "La salle $salle est occupée";
	echo "<br/>";
}

$all_room = array();
//array_push($all_room, 'same');
//echo count($all_room);
//echo "<br/>";

for($i=1;$i<5;$i++){
	array_push($all_room,$i);
}
/*
foreach ($all_room as $i){
	echo $i;
	echo "<br/>";
}*/
array_unshift($all_room, 'same');
echo $all_room[0];

for($i=1;$i<5;$i++){
	echo $all_room[$i];
	echo "<br/>";
}



//$salle=1;
/*
$req="SELECT room_number FROM booking WHERE start_date=$start_date AND start_month=$start_month
AND start_year=$start_year AND end_date=$end_date AND end_month=$end_month AND end_year=$end_year";

$exec=@mysql_query($req,$id_link);

$res=@mysql_fetch_array($exec);
$taille=count($res['room_number']);
$vide=empty($res['room_number']);
//echo "La taille du tableau: $taille";
echo "<br/>";

//if($taille!=0){
if(!$vide){
	echo "Résultat trouvé";
	echo "<br/>";	
}
else {
	echo "Rien n'est trouvé";
	echo "<br/>";
}

mysql_close($id_link);
*/
/*
$free=free($salle, $start_date, $start_month, $start_year, $start_hour, $start_minute, 
		$end_date, $end_month, $end_year, $end_hour, $end_minute);
if ($free){
	echo "La salle $salle est libre";
	echo "<br/>";
}
else { echo "La salle $salle est occupée "; }
echo "<br/>";
*/
/*

$room_tab_found = room_free($start_date, $start_month, $start_year, $start_hour, $start_minute, 
					$end_date, $end_month, $end_year, $end_hour, $end_minute);
//aucune salle n'est réservée à ce jour là
if(empty($room_tab_found['room_number'])){
	echo "Toutes les salles sont libres à ce créneau";
	echo "<br/>";
}
else{
	while($res=@mysql_fetch_array($exec)){
		$room_number=$res['room_number'];
		//echo "indice du tableau:". $i;
	
		//echo $room_number;
		//echo "<br/>";
		$free=free($room_number, $start_date, $start_month, $start_year, $start_hour, $start_minute,
				$end_date, $end_month, $end_year, $end_hour, $end_minute);
		if ($free){
			echo "La salle $room_number est libre pour ce créneau";
			echo "<br/>";
			array_push($room_tab,$room_number);
			//$i++;
		}
	}
}

/*

echo "<br/>";
//print_r($room_tab);
$size=count($room_tab);
echo "Taille du tableau:".$size;
echo "<br/>";

if ($size==0){
	echo "Aucune salle n'est dispo pour ce créneau";
	echo "<br/>";
}
/*
else {
	echo "Voici la liste des salles libre pour ce créneau:";
	//for($i=0;$i<$size;$i++){
	//while ($parcour=$room_tab){
	foreach ($room_tab as $i){
		echo "<br/>";
		echo "Salle $i";
		
	}
}*/
/*

else{
	
	$tab_unique = array_unique($room_tab);
	echo "Taille du nouveau tableau: ".count($tab_unique);
	echo "<br/>";
	echo "Voici la liste des salles libre pour ce créneau:";
	foreach ($tab_unique as $i){
		echo "<br/>";
		echo "Salle $i";
	} 
}

*/
	

?>


</body>
</html>