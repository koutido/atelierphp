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
function submitMe(obj){
 	if(obj.value == "Accueil"){
		document.getElementById('recherche').action ="index.php";
	}
 	if(obj.value == "Reservation"){
		document.getElementById('recherche').action ="reservation.php";
	}	
	document.getElementById('recherche').submit();
}


</script>
</head>

<body bgcolor="CCE1FB">

<form name="Recherche" id="recherche" action="actions.php" method="post" >

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
//bouton pour recherche par code pin
$choix_creator=$_POST['choix_creator'];
//bouton pour revenir à accueil
$accueil=$_POST['accueil'];
//le code pin
$code_pin=$_POST['pin'];
//le nom du créateur de réservation
$creator=$_POST['creator'];

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
/*
if(isset($accueil)){
	echo "accueil";
	//'<form action="index.php">';
	echo '<a href="index.php">bonjour</a>';
}
*/
?>

<?php 
//rechercher les salles libres
if(isset($recherche)){
	
	//on récupère la liste des salles libres au créneau cherché
	$room_list = room_free($start_date, $start_month, $start_year, $start_hour, $start_minute, 
						$end_date, $end_month, $end_year, $end_hour, $end_minute);
	$taille=count($room_list);

	//echo "Taille du tableau: $taille";

	//la liste résultante contient au moins une salle libre
	if($taille>1){
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo "Voici les salles libres à ce créneau".'<br/>';
		for($i=1;$i<$taille;$i++){
			//on n'affiche pas la salle $room_number car elle est occupée
			$val=$room_list[$i];
			echo '<input type="radio" name="room_selected" value=',$val,'>Salle ',$val,'<br/>';
		}
		echo '<br>';
		echo 'Créée par: '.'&nbsp';
		echo '<select name="creator">';
		echo '<option value="" selected></option>';
		echo '<option value="Magali">Magali</option>';
		echo '<option value="Fazeela">Fazeela</option>';
		echo '<option value="Fawaz">Fawaz</option>';
		echo '<option value="Nyez">Nyez</option>';
		echo '<option value="Ufuk">Ufuk</option>';
		echo '<option value="Fouad">Fouad</option>';
		echo '<option value="Khuong">Khuong</option>';
		echo '</select>';
		echo '<br><br>';
		echo 'Commentaires';
		echo '<br>';
		echo '<textarea cols="40" rows="10" name="Comment">'.'</textarea>';
		//echo "<br>"."<br>";
		//'<input name="email" value=$email >';
		echo '&nbsp&nbsp&nbsp';
		echo'<input name="reserve" type="submit" value="Réserver">';
		//echo '<input name="Comment" type="text" size="60" width="130px" >';
		//echo '<input name="Comment" type="text" size="30" style="padding:30px" >';
		
	}
	else{		
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo "Aucune salle n'est disponible à ce créneau";
		//echo "<br/>";
		//echo '<a href="http://atelierphp.com/reservation.php">Retourner à la page de réservation</a>';
		//echo '<a href="http://109.190.51.176/page1.php">Retourner à la page de recherche</a>';
	}
}
?>
<table border="1" width="1200">
<tbody>
<?php 
	//////////////afficher toutes les réservation en les triant par le mois
	if(isset($all)) {
		$req="SELECT * FROM booking ORDER BY start_month";
		$exec=@mysql_query($req,$id_link);
		$cle;
	if(mysql_num_rows($exec)){
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';		
		echo 'Cet affichage sera enlevé plus tard'.'<br><br>';
		echo "Liste des salles réservées".'<br/>';
		echo '<br><br>';
?>
	<tr>
		<td><p align="center"><b>Salle</b><p></td>
		<td><p align="center"><b>Créée par</b><p></td>
		<td><p align="center"><b>De</b><p></td>
		<td><p align="center"><b>A</b><p></td>
		<td><p align="center"><b>Demandeur</b><p></td>
		<td><p align="center"><b>Code pin</b><p></td>
		<td><p align="center"><b>Commentaire</b><p></td>
		<td><p align="center"><b>Action</b><p></td>
	</tr>
	
<?php 
	while($res=@mysql_fetch_array($exec)){
		$cle=$res['clef'];	
		$req2="SELECT * FROM information WHERE id=$cle";
		$exec2=@mysql_query($req2,$id_link);
		$res2=@mysql_fetch_array($exec2);
?>
	<tr>
		<td>
<?php
		//numéro de la salle 
		echo $res['room_number'];
?>
		</td>
	
		<td>
<?php 
		//le créateur
		echo $res2['creator'];
?>
		</td>
	
		<td>
<?php 
		//l'heure de début
		echo $res['start_hour'].'h'.$res['start_minute']." le ".$res['start_date'].'/'.$res['start_month'].'/'.$res['start_year'];
?>
		</td>
	
		<td>
<?php
		//l'heure de fin 
		echo $res['end_hour'].'h'.$res['end_minute']." le ".$res['end_date'].'/'.$res['end_month'].'/'.$res['end_year'];
?>
		</td>
	
		<td>
<?php 
		//le demandeur
		echo $res['email'];
?>
		</td>

		<td>
<?php
		//le code pin 	
		echo $res2['code_pin'];
?>
		</td>

		<td>
<?php 
		//le commentaire
		echo $res2['comment'];
?>
		</td>

		<td>
<?php 
		//les actions
		echo '<input type="radio" id="delete" name="for_delete" value=',$cle,'>';
		echo'<input name="delete" type="submit" value="Supprimer">';
?>
		</td>


<?php 
	}
?>
	</tr>
</tbody>
</table>

<?php 
	}
	//le cas o`u rien n'est trouvé
	else{
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo "Il devrait avoir un problème de la base de données!".'<br/>'.'<br/>';
	}
}
?>

<?php 
//////////////rechercher les salles réservées par date
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
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo "Liste des salles réservées au ";
		echo "<font color=\"#0005F6\">$jour/$mois/$an</font>";
		//echo '<div style="color:#160095;">'.$jour.'/'.$mois.'/'.$an.'</div>';
		echo '<br>'.'<br>';
?>
	<tr>
		<td><p align="center"><b>Salle</b><p></td>
		<td><p align="center"><b>Créée par</b><p></td>
		<td><p align="center"><b>Demandeur</b><p></td>
		<td><p align="center"><b>Code pin</b><p></td>
		<td><p align="center"><b>Commentaire</b><p></td>
		<td><p align="center"><b>Action</b><p></td>
	</tr>
<?php 
		while($res=@mysql_fetch_array($exec)){
			$val = $res['room_number'];
			$cle=$res['clef'];
			$req2="SELECT * FROM information WHERE id=$cle";
			$exec2=@mysql_query($req2,$id_link);
			$res2=@mysql_fetch_array($exec2);
?>

	<tr>
		<td>
<?php
		//numéro de la salle 
		echo $res['room_number'];
?>
		</td>
	
		<td>
<?php 
		//le créateur
		echo $res2['creator'];
?>
		</td>
	
		<td>
<?php 
		//le demandeur
		echo $res['email'];
?>
		</td>

		<td>
<?php
		//le code pin 	
		echo $res2['code_pin'];
?>
		</td>

		<td>
<?php 
		//le commentaire
		echo $res2['comment'];
?>
		</td>

		<td>
<?php 
		//les actions
		echo '<input type="radio" id="delete" name="for_delete" value=',$cle,'>';
		echo'<input name="delete" type="submit" value="Supprimer">';
?>
		</td>


<?php 
		}
?>
	</tr>
</tbody>
</table>

<?php
	} 
	//le cas o`u rien n'est trouvé
	else{
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo 'Il n\'y a pas de salle réservée à la date donnée';
		//echo '<a href="http://atelierphp.com/reservation.php">Revenir à la page de réservation</a>';
	}
}
?>

<?php 
//////////////recherche des salles réservées par adresse email
if(isset($adresse)){
	
	$req="SELECT * FROM booking WHERE email='$email2' ORDER BY start_month ";
	$exec=@mysql_query($req,$id_link);
	$cle;
	//quand la requête nous renvoie qqch
	if(mysql_num_rows($exec)){
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo "Liste des salles réservées pour l'utilisateur: ";
		"<font color=\"#0005F6\">$jour/$mois/$an</font>";
		echo "<font color=\"#0005F6\">$email2</font>";
		echo "<br/>".'<br>';
?>
	<tr>
		<td><p align="center"><b>Salle</b><p></td>
		<td><p align="center"><b>Créée par</b><p></td>
		<td><p align="center"><b>De</b><p></td>
		<td><p align="center"><b>A</b><p></td>
		<td><p align="center"><b>Code pin</b><p></td>
		<td><p align="center"><b>Commentaire</b><p></td>
		<td><p align="center"><b>Action</b><p></td>
	</tr>
<?php 
		while($res=@mysql_fetch_array($exec)){
			$val = $res['room_number'];
			$cle=$res['clef'];
			$req2="SELECT * FROM information WHERE id=$cle";
			$exec2=@mysql_query($req2,$id_link);
			$res2=@mysql_fetch_array($exec2);
?>

	<tr>
		<td>
<?php
		//numéro de la salle 
		echo $res['room_number'];
?>
		</td>
	
		<td>
<?php 
		//le créateur
		echo $res2['creator'];
?>
		</td>
	
		<td>
<?php 
		//l'heure de début
		echo $res['start_hour'].'h'.$res['start_minute']." le ".$res['start_date'].'/'.$res['start_month'].'/'.$res['start_year'];
?>
		</td>
	
		<td>
<?php
		//l'heure de fin 
		echo $res['end_hour'].'h'.$res['end_minute']." le ".$res['end_date'].'/'.$res['end_month'].'/'.$res['end_year'];
?>
		</td>

		<td>
<?php
		//le code pin 	
		echo $res2['code_pin'];
?>
		</td>

		<td>
<?php 
		//le commentaire
		echo $res2['comment'];
?>
		</td>

		<td>
<?php 
		//les actions
		echo '<input type="radio" id="delete" name="for_delete" value=',$cle,'>';
		echo'<input name="delete" type="submit" value="Supprimer">';
?>
		</td>


<?php 
	}
?>
	</tr>
</tbody>
</table>
<?php
	}
	//le cas o`u rien n'est trouvé
	else{
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo "Il n'y a pas de salle réservée pour l'utilisateur $email2";
		//echo '<a href="http://atelierphp.com/reservation.php">Revenir à la page de réservation</a>';
	}
}
?>

<?php 
///////////////recherche des salles réservées par code pin
if(isset($code)){
	
	$req = "SELECT * FROM booking WHERE clef IN (SELECT id FROM information WHERE code_pin=$code_pin) ORDER BY start_month";
	$exec=@mysql_query($req,$id_link);
	$cle;
	//quand la requête nous renvoie qqch
	if(mysql_num_rows($exec)){
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo 'Liste des salles réservées avec le code pin ';
		//"<font color=\"#0005F6\">$jour/$mois/$an</font>";
		echo "<font color=\"#0005F6\">$code_pin</font>";
		echo '<br><br>';
?>
	<tr>
		<td><p align="center"><b>Salle</b><p></td>
		<td><p align="center"><b>Créée par</b><p></td>
		<td><p align="center"><b>De</b><p></td>
		<td><p align="center"><b>A</b><p></td>
		<td><p align="center"><b>Demandeur</b><p></td>
		<td><p align="center"><b>Commentaire</b><p></td>
		<td><p align="center"><b>Action</b><p></td>
	</tr>
<?php 
		while($res=@mysql_fetch_array($exec)){
			$val = $res['room_number'];
			$cle=$res['clef'];
			$req2="SELECT * FROM information WHERE id=$cle";
			$exec2=@mysql_query($req2,$id_link);
			$res2=@mysql_fetch_array($exec2);
?>

	<tr>
		<td>
<?php
		//numéro de la salle 
		echo $res['room_number'];
?>
		</td>
	
		<td>
<?php 
		//le créateur
		echo $res2['creator'];
?>
		</td>
	
		<td>
<?php 
		//l'heure de début
		echo $res['start_hour'].'h'.$res['start_minute']." le ".$res['start_date'].'/'.$res['start_month'].'/'.$res['start_year'];
?>
		</td>
	
		<td>
<?php
		//l'heure de fin 
		echo $res['end_hour'].'h'.$res['end_minute']." le ".$res['end_date'].'/'.$res['end_month'].'/'.$res['end_year'];
?>
		</td>
	
		<td>
<?php 
		//le demandeur
		echo $res['email'];
?>
		</td>

		<td>
<?php 
		//le commentaire
		echo $res2['comment'];
?>
		</td>

		<td>
<?php 
		//les actions
		echo '<input type="radio" id="delete" name="for_delete" value=',$cle,'>';
		echo'<input name="delete" type="submit" value="Supprimer">';
?>
		</td>


<?php 
	}
?>
	</tr>
</tbody>
</table>
<?php 
	}
	//le cas o`u rien n'est trouvé
	else{
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo 'Il n\'y a pas de salle réservée avec le code pin '.$code_pin.'<br/>'.'<br/>';
		//echo '<a href="http://atelierphp.com/reservation.php">Revenir à la page de réservation</a>';
	}
}
?>

<?php 
//////////recherche des réservations par créateur
if(isset($choix_creator)){
	
	$req = "SELECT * FROM booking WHERE clef IN (SELECT id FROM information WHERE creator='$creator') ORDER BY start_month";
	$exec=@mysql_query($req,$id_link);
	$cle;
	//quand la requête nous renvoie qqch
	if(mysql_num_rows($exec)){
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo 'Liste des réservations créées par ';
		//"<font color=\"#0005F6\">$jour/$mois/$an</font>";
		echo "<font color=\"#0005F6\">$creator</font>";
		echo '<br><br>';
?>
	<tr>
		<td><p align="center"><b>Salle</b><p></td>
		<td><p align="center"><b>De</b><p></td>
		<td><p align="center"><b>A</b><p></td>
		<td><p align="center"><b>Demandeur</b><p></td>
		<td><p align="center"><b>Code pin</b><p></td>
		<td><p align="center"><b>Commentaire</b><p></td>
		<td><p align="center"><b>Action</b><p></td>
	</tr>
<?php 
		while($res=@mysql_fetch_array($exec)){
			$val = $res['room_number'];
			$cle=$res['clef'];
			$req2="SELECT * FROM information WHERE id=$cle";
			$exec2=@mysql_query($req2,$id_link);
			$res2=@mysql_fetch_array($exec2);
?>
	<tr>
		<td>
<?php
		//numéro de la salle 
		echo $res['room_number'];
?>
		</td>
	
		<td>
<?php 
		//l'heure de début
		echo $res['start_hour'].'h'.$res['start_minute']." le ".$res['start_date'].'/'.$res['start_month'].'/'.$res['start_year'];
?>
		</td>
	
		<td>
<?php
		//l'heure de fin 
		echo $res['end_hour'].'h'.$res['end_minute']." le ".$res['end_date'].'/'.$res['end_month'].'/'.$res['end_year'];
?>
		</td>
	
		<td>
<?php 
		//le demandeur
		echo $res['email'];
?>
		</td>

		<td>
<?php
		//le code pin 	
		echo $res2['code_pin'];
?>
		</td>

		<td>
<?php 
		//le commentaire
		echo $res2['comment'];
?>
		</td>

		<td>
<?php 
		//les actions
		echo '<input type="radio" id="delete" name="for_delete" value=',$cle,'>';
		echo'<input name="delete" type="submit" value="Supprimer">';
?>
		</td>

<?php 
	}
?>
	</tr>
</tbody>
</table>			
<?php 
	}
	//le cas o`u rien n'est trouvé
	else{
		echo '<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">&nbsp; &nbsp; &nbsp;';
		echo '<input type="button" name="reservation" value="Reservation" onclick="submitMe(this)">';
		echo '<br>'.'<br>';
		echo 'Il n\'y a pas de réservations créées par '.$creator.'<br/>'.'<br/>';
		//echo '<a href="http://atelierphp.com/reservation.php">Revenir à la page de réservation</a>';
	}
}
?>

</form>
</body>
</html>
