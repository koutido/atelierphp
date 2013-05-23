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

$valider1=$_POST['valider1'];
$valider2=$_POST['valider2'];
$valider3=$_POST['valider3'];



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
if(isset($valider1)){
	
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
		echo "<br/>";
		//'<input name="email" value=$email >';
		echo'<input name="reserve" type="submit" value="Réserver">';	
	}
	else{
		echo "Aucune salle n'est disponible à ce créneau";
		echo "<br/>";
		echo '<a href="http://atelierphp.com/reservation.php">Retourner à la page de réservation</a>';
		//echo '<a href="http://109.190.51.176/page1.php">Retourner à la page de recherche</a>';
	}
}


?>



</form>
</body>
</html>
