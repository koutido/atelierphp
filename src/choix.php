<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Search mode</title>
<script LANG="JavaScript">
<!--
function submitMe(obj){
 	if(obj.value == "Accueil"){
		document.getElementById('choix').action ="index.php";		
	}	
	document.getElementById('choix').submit();
}

function verif_date(){
	if (document.Choix.jour.value.length<1){
		alert("Veuillez choisir la date");
		document.Choix.jour.focus();
		return false;
	}
	if (document.forms[0].mois.value.length<1){
		alert("Veuillez choisir le mois");
		document.forms[0].mois.focus();
		return false;
	}
	if (document.forms[0].an.value.length<1){
		alert("Veuillez choisir l'année");
		document.forms[0].an.focus();
		return false;
	}	
	return true;
}
function verif_champs_email(){
	if (document.forms[0].email2.value.length<5){
		alert("Veuillez entrer l'adresse mail du demandeur");
		document.forms[0].email2.focus();
		return false;
	}
	return true;
}

function verif_format_email(){
	var c=document.forms[0].email2.value;
	var test="" + c;
	for(var k = 0; k < test.length;k++){
		var d = test.substring(k,k+1);
		if(d == "@"){
			return true;
		}
	}
	alert("L'adresse email du demandeur n'est pas valide. Merci de vérifier");
	document.forms[0].email2.focus();
	return false;
}
function verif_email(){
	if(verif_champs_email()==true && verif_format_email()==true){
		return true;
	}
	return false;
}
function verif_pin(){
	if (document.Choix.pin.value.length<1){
		alert("Veuillez entrer le code pin");
		document.Choix.pin.focus();
		return false;
	}
	return true;
}

function verif_creator(){
	if (document.Choix.creator.value.length<1){
		alert("Veuillez sélectionner un créateur");
		document.Choix.creator.focus();
		return false;
	}
	return true;
}

</script>
</head>

<body bgcolor="CCE1FB">

<form name="Choix" id="choix" method="post" action="recherche.php">

<input type="button" name="accueil" value="Accueil" onclick="submitMe(this)">

<p align="center">Affichage des réservations</p>

<table>
	<tr>
		<td><input type="submit" name="all" value="Afficher toutes les réservations"></td>
	</tr>	
</table>

<br> <br>
<table> 
<tr>
	<td>Recherche par date</td>
	<td>&nbsp; &nbsp;</td>
	<td>
	<?php
	echo '<select name="jour">';
	echo '<option value="" selected></option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	echo '<option value="3">3</option>';
	echo '<option value="4">4</option>';
	echo '<option value="5">5</option>';
	echo '<option value="6">6</option>';
	echo '<option value="7">7</option>';
	echo '<option value="8">8</option>';
	echo '<option value="9">9</option>';
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '<option value="13">13</option>';
	echo '<option value="14">14</option>';
	echo '<option value="15">15</option>';
	echo '<option value="16">16</option>';
	echo '<option value="17">17</option>';
	echo '<option value="18">18</option>';
	echo '<option value="19">19</option>';
	echo '<option value="20">20</option>';
	echo '<option value="21">21</option>';
	echo '<option value="22">22</option>';
	echo '<option value="23">23</option>';
	echo '<option value="24">24</option>';
	echo '<option value="25">25</option>';
	echo '<option value="26">26</option>';
	echo '<option value="27">27</option>';
	echo '<option value="28">28</option>';
	echo '<option value="29">29</option>';
	echo '<option value="30">30</option>';	
	echo '<option value="31">31</option>';
	echo '</select>';
	?>
	</td>
	
	<td>
	<?php
	echo '<select name="mois">';
	echo '<option value="" selected></option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	echo '<option value="3">3</option>';
	echo '<option value="4">4</option>';
	echo '<option value="5">5</option>';
	echo '<option value="6">6</option>';
	echo '<option value="7">7</option>';
	echo '<option value="8">8</option>';
	echo '<option value="9">9</option>';
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	?>
	</td>
	
	<td>
	<?php
	echo '<select name="an">';
	echo '<option value="2013" selected>2013</option>';
	echo '<option value="2014">2014</option>';
	echo '<option value="2015">2015</option>';
	echo '</select>';
	?>
	</td>
	<td>&nbsp; &nbsp; &nbsp;</td>
	<td><input type="submit" name="date" value="Valider" onclick="return verif_date()"></td>
</tr>
</table>

<br> <br>
<table>
	<tr>
		<td>Recherche par email</td>
		<td>&nbsp; &nbsp;</td>
		<td><input type="email" name="email2"></td>
		<td>&nbsp; &nbsp; &nbsp;</td>
		<td><input type="submit" name="adresse" value="Valider" onclick="return verif_email()"></td>
	</tr>
</table>

<br> <br>
<table>
	<tr>
		<td>Recherche par code PIN</td>
		<td>&nbsp; &nbsp;</td>
		<td><input type="number" name="pin"></td>
		<td>&nbsp; &nbsp; &nbsp;</td>
		<td><input type="submit" name="code" value="Valider" onclick="return verif_pin()"></td>
	</tr>
</table>

<br> <br>
<table>
	<tr>
		<td>Recherche par créateur</td>
		<td>&nbsp; &nbsp;</td>
		<td>
			<select name="creator">
			<option value="" selected></option>
			<option value="Magali">Magali</option>
			<option value="Fazeela">Fazeela</option>
			<option value="Fawaz">Fawaz</option>
			<option value="Nyez">Nyez</option>
			<option value="Ufuk">Ufuk</option>
			<option value="Fouad">Fouad</option>
			<option value="Khuong">Khuong</option>
			</select>
		</td>
		<td>&nbsp; &nbsp; &nbsp;</td>
		<td><input type="submit" name="choix_creator" value="Valider" onclick="return verif_creator()"></td>
	</tr>
</table>

</html>
