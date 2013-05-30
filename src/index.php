<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Accueil</title>
<script LANG="JavaScript">
<!--
function submitMe(obj){
 	if(obj.value == "Effectuer une réservation"){
		document.getElementById('accueil').action ="reservation.php";
	}
	if(obj.value == "Rechercher une réservation"){
		document.getElementById('accueil').action ="choix.php";
	}
	if(obj.value == "Salles à modérer pour aujourd'hui"){
		document.getElementById('accueil').action ="moderation.php";
	}
	
	document.getElementById('accueil').submit();
}

</script>
</head>

<body bgcolor="CCE1FB">
<p><center><h3>Bienvenue à la conciergerie</h3></center></p>

<br> <br> <br> <br>

<form name="Accueil" id="accueil" method="post" action="" >
<table> 
	<tr>
		<td><input type="button" name="ok1" value="Effectuer une réservation" onclick="submitMe(this)"> &nbsp; &nbsp; &nbsp;</td>
		<td><input type="button" name="ok2" value="Rechercher une réservation" onclick="submitMe(this)"> &nbsp; &nbsp; &nbsp;</td>
		<!--
		<td><input type="button" name="ok3" value="Salles à modérer pour aujourd'hui" onclick="submitMe(this)"></td>
		-->	
			
	</tr>

</table>

<p align="center"><font color="#F91C00">La liste des salles à modérer sera affichée ici</font></p>

<?php
?>

</form>
</body>
</html>