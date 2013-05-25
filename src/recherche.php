<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Room checking</title>
<script LANG="JavaScript">
<!--
function verif_valider2(){
	var val=document.getElementsByName("for_delete");
	var i=0;
	var res=false;
	for(i=0;i<val.length;i++){
		if (val.item(i).checked){
			res=true;
		}
		else{
			res=false;
		}
	}
	if(res){
		return true;
	}
	alert("Veuillez choisir la salle à supprimer");
	return false;
}

function verif_page2(){
	if (verif_valider2()==true){
		return true;
	}
	return false;
}


</script>
</head>

<body>

<br><br/>
<form name="recherche" action="actions.php" method="post" >

<?php
session_start();
include "commun/connexion.inc.php";
include "commun/fonctions.inc.php";

$email=$_POST['email'];
//$room_number=$_POST['room_number'];
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

$recherche=$_POST['recherche'];

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

//$clef=$_POST['for_delete'];

//ces variables peuvent être portées vers les autres pages

$_SESSION['email']=$_POST['email'];
//$_SESSION['room_number']=$_POST['room_number'];
$_SESSION['start_date']=$_POST['start_date'];
$_SESSION['start_month']=$_POST['start_month'];
$_SESSION['start_year']=$_POST['start_year'];
$_SESSION['start_hour']=$_POST['start_hour'];
$_SESSION['start_minute']=$_POST['start_minute'];
$_SESSION['end_date']=$_POST['end_date'];
$_SESSION['end_month']=$_POST['end_month'];
$_SESSION['end_year']=$_POST['end_year'];
$_SESSION['end_hour']=$_POST['end_hour'];
$_SESSION['end_minute']=$_POST['end_minute'];
//session_destroy();


//rechercher les salles libres
if(isset($recherche)){
	
	//on récupère la liste des salles libres au créneau cherché
	$room_list = room_free($start_date, $start_month, $start_year, $start_hour, $start_minute, 
						$end_date, $end_month, $end_year, $end_hour, $end_minute);
	$taille=count($room_list);

	//echo "Taille du tableau: $taille";

	//la liste résultante contient au moins une salle libre
	if($taille>1){
		echo "Voici les salles libres à ce créneau".'<br/>';
		for($i=1;$i<$taille;$i++){
			//on n'affiche pas la salle $room_number car elle est occupée
			$val=$room_list[$i];
			echo '<input type="radio" name="room_selected" value=',$val,'>Salle ',$val,'<br/>';
		}
		echo "<br>";
		echo "Commentaires".'<br>';
		echo '<textarea cols="40" rows="10" name="Comment">'.'</textarea>';
		//echo "<br>"."<br>";
		//'<input name="email" value=$email >';
		echo '&nbsp&nbsp&nbsp';
		echo'<input name="reserve" type="submit" value="Réserver">';
		//echo '<input name="Comment" type="text" size="60" width="130px" >';
		//echo '<input name="Comment" type="text" size="30" style="padding:30px" >';
		
	}
	else{
		echo "Aucune salle n'est disponible à ce créneau";
		echo "<br/>";
		echo '<a href="http://atelierphp.com/reservation.php">Retourner à la page de réservation</a>';
		//echo '<a href="http://109.190.51.176/page1.php">Retourner à la page de recherche</a>';
	}
}

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
	$req="SELECT * FROM booking WHERE email='$email2' ORDER BY start_month ";
	$exec=@mysql_query($req,$id_link);
	$cle;
	//quand la requête nous renvoie qqch
	if(mysql_num_rows($exec)){
		echo "Liste des salles réservées par l'utilisateur: ";
		"<font color=\"#0005F6\">$jour/$mois/$an</font>";
		echo "<font color=\"#0005F6\">$email2</font>";
		echo "<br/>".'<br>';
		while($res=@mysql_fetch_array($exec)){
			$val = $res['room_number'];
			$cle=$res['clef'];
			echo '<input type="radio" id="delete" name="for_delete" value=',$cle,'>Salle ',$val;
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
		echo "Il n'y a pas de salle réservée pour cet utilisateur $email2".'<br/>'.'<br/>';
		echo '<a href="http://atelierphp.com/reservation.php">Revenir à la page de réservation</a>';
	}
}


?>



</form>
</body>
</html>
