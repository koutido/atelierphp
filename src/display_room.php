<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Room displaying</title>

</head>

<body>
<br><br/>
<form name="display_room" action="recherche.php" method="post" >

<?php
include "commun/connexion.inc.php";
include "commun/fonctions.inc.php";
//bouton pour afficher toutes les réservations
$all=$_POST['all'];
//bouton pour recherche par date
$date=$_POST['date'];
//bouton pour recherche par adresse mail
$adresse=$_POST['adresse'];
//bouton pour recherche par code pin
$code=$_POST['code'];

$jour=$_POST['jour'];
$mois=$_POST['mois'];
$an=$_POST['an'];

$email2=$_POST['email2'];




//afficher toutes les réservation en les triant par le mois
if(isset($all)) {
	$req="SELECT * FROM booking ORDER BY start_month";
	$exec=@mysql_query($req,$id_link);
	$cle;
	if(mysql_num_rows($exec)){
		echo "Liste des salles réservées".'<br/>';
		echo "<br/>";
		while($res=@mysql_fetch_array($exec)){
			$val = $res['room_number'];
			$cle=$res['clef'];
			echo '<input type="radio" id="delete" name="for_delete" value=',$cle,'>Salle ',$val;
			echo " de ".$res['start_hour'].'h'.$res['start_minute']." le ".$res['start_date'].'/'.$res['start_month'].'/'.$res['start_year'];
			echo " à ".$res['end_hour'].'h'.$res['end_minute']." le ".$res['end_date'].'/'.$res['end_month'].'/'.$res['end_year'];
			echo "  <=====>  Demandeur: ".$res['email'].'<br/>';
				
			//echo "Salle ". $res['room_number'].'<br>';
		}
		echo "<br/>";
		echo'<input name="modify" type="submit" value="Modifier"> &nbsp';
		echo'<input name="delete" type="submit" value="Supprimer">';
	}
	//le cas o`u rien n'est trouvé
	else{
		echo "Il devrait avoir un problème de la base de données!".'<br/>'.'<br/>';
		echo '<a href="http://atelierphp.com/reservation.php">Revenir à la page de réservation</a>';
	}
}

//rechercher les salles réservées par date
if(isset($date)){
	//cette requete retourne les salles réservées et les horaires
	$req="SELECT * FROM booking
	WHERE start_date=$jour AND start_month=$mois AND start_year=$an ORDER BY start_hour";

	$exec=@mysql_query($req,$id_link);
	$cle;
	//$res=@mysql_fetch_array($exec);

	//$room_list=room_booked($start_date, $start_month, $start_year, $end_date, $end_month, $end_year);
	//$taille=count($room_list);
	//quand la requête nous renvoie qqch
	if(mysql_num_rows($exec)){
		echo "Liste des salles réservées au ";
		echo "<font color=\"#0005F6\">$jour/$mois/$an</font>";
		//echo '<div style="color:#160095;">'.$jour.'/'.$mois.'/'.$an.'</div>';
		echo '<br>'.'<br>';
		while($res=@mysql_fetch_array($exec)){
			$val = $res['room_number'];
			$cle=$res['clef'];
			echo '<input type="radio" id="delete" name="for_delete" value=',$cle,'>Salle ',$val;
			echo " de ".$res['start_hour'].'h'.$res['start_minute'].' à '.$res['end_hour'].'h'.$res['end_minute'];
			echo "  <=====>  Demandeur: ".$res['email'].'<br/>';
				
			//echo "Salle ". $res['room_number'].'<br>';
		}
		echo "<br/>";
		echo'<input name="modify" type="submit" value="Modifier"> &nbsp';
		echo'<input name="delete" type="submit" value="Supprimer">';
	}
	//le cas o`u rien n'est trouvé
	else{
		echo "Il n'y a pas de salle réservée pour ce jour".'<br/>'.'<br/>';
		echo '<a href="http://atelierphp.com/reservation.php">Revenir à la page de réservation</a>';
	}
}
//recherche des salles réservées par adresse email 
if(isset($adresse)){
	$req="SELECT * FROM booking WHERE email='$email' ORDER BY start_month ";
	$exec=@mysql_query($req,$id_link);
	$cle;
	//quand la requête nous renvoie qqch
	if(mysql_num_rows($exec)){
		echo "Liste des salles réservées par l'utilisateur: ";
		"<font color=\"#0005F6\">$jour/$mois/$an</font>";
		echo "<font color=\"#0005F6\">$email</font>";
		echo "<br/>".'<br>';
		while($res=@mysql_fetch_array($exec)){
			$val = $res['room_number'];
			$cle=$res['clef'];
			echo '<input type="radio" id="delete" name="for_delete" value=',$val,'>Salle ',$val;
			echo " de ".$res['start_hour'].'h'.$res['start_minute']." le ".$res['start_date'].'/'.$res['start_month'].'/'.$res['start_year'];
			echo " à ".$res['end_hour'].'h'.$res['end_minute']." le ".$res['end_date'].'/'.$res['end_month'].'/'.$res['end_year'];
			echo '<br/>';
				
			//echo "Salle ". $res['room_number'].'<br>';
		}
		echo "<br/>";
		echo'<input name="modify" type="submit" value="Modifier"> &nbsp';
		echo'<input name="delete" type="submit" value="Supprimer">';
	}
	//le cas o`u rien n'est trouvé
	else{
		echo "Il n'y a pas de salle réservée par l'utilisateur $email".'<br/>'.'<br/>';
		echo '<a href="http://atelierphp.com/reservation.php">Revenir à la page de réservation</a>';
	}
}

?>




</body>
</html>