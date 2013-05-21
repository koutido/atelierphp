<?php 
include "commun/connexion.inc.php";
if ($auth==1){
	echo "<p><font color=\"#FF0000\"> Vous êtes déjà membre et vous avez peut-être <a href=\"oubli.php\">oublié votre mot de passe</a>.</font></p>";
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Inscription</title>
<script LANG="JavaScript">
<!--
var unique=0;
//ici la variable est déclarée avec ou sans le mot var 
function envoi() {
	if (unique == 0){
		unique++;
		return true;
	}
	else {
		alert("Envoi en cours...!");
		return false;
	}
}
function verif_champs(){
	if (document.forms[0].prenom.value.length<1){
		alert("Veuillez ajouter votre prénom, Merci");
		document.forms[0].prenom.focus();
		return false;
	}
	if (document.forms[0].email.value.length<5){
		alert("Veuillez ajouter votre email, Merci");
		document.forms[0].email.focus();
		return false;
	}
	if (document.forms[0].ville.value.length<1){
		alert("Veuillez ajouter votre ville, Merci");
		document.forms[0].ville.focus();
		return false;
	}
	if (document.forms[0].code_postal.value.length<1){
		alert("Veuillez ajouter votre code postal, Merci");
		document.forms[0].code_postal.focus();
		return false;
	}
	index_pays=document.forms[0].pays.selectedIndex;
	lepays= document.forms[0].pays.options[index_pays].value;
	if (lepays==0){
		alert("Veuillez définir votre pays, Merci");
		return false;
	}
	
	return true;
}

function verif_email (){
	var c=document.forms[0].email.value;
	var test="" + c;
	for(var k = 0; k < test.length;k++){
		var d = test.substring(k,k+1);
		if(d == "@"){
			return true;
		}
	}
	alert("Votre E-mail n'est pas valide, Merci");
	document.forms[0].email.focus();
	return false;
}
function verif_formulaire(){
	if (verif_champs()==true && verif_email()==true && envoi()==true){
		return true;
	}
	return false;
	if (document.forms[0].mot_passe.value.length<8){
		alert("Veuillez ajouter votre mot de passe de plus de 7 caractères, Merci");
		document.forms[0].mot_passe.focus();
		return false;
	}
	if (document.forms[0].mot_passe.value!= document.forms[0].mot_passebis.value){
		alert("Vos mots de passe ne coïncident pas, veuillez les taper à nouveau, Merci");
		document.forms[0].mot_passe.focus();
		return false;
	}		
}

</script>
</head>
<body>
Pour vous inscrire dans le club, nous avons besoin de quelques
renseignements. Préparez un nom d'usage pour le club et un mot de
passe de plus de 8 caractères dont vous vous souviendrez facilement.
<form action="inscription_p2.php" method="post" onSubmit="return verif_formulaire()">
<table> 

<tr>
	<td>Votre prénom :</td>
	<td><input type="text" name="prenom"></td>
</tr>

<tr>
	<td>Votre adresse email</td>
	<td><input type="text" name="email"></td>
</tr>

<tr>
	<td>Votre code postal</td>
	<td><input type="text" name="code_postal"></td>
</tr>

<tr>
	<td>La ville où vous vivez</td>
	<td><input type="text" name="ville"></td>
</tr>

<tr>
	<td>Votre nationalité (<i>Vous pouvez sélectionner plusieurs pays en appuyant sur 
	la touche "ctrl" tout en cliquant sur la sélection</i>) </td>
	<td> 
	<?php
	echo '<select multiple name="pays">';
	echo '<option value="" selected></option>';
	echo '<option value="FRA">France</option>';
	echo '<option value="ESP">Espagne</option>';
	echo '<option value="VNA">VietNam</option>';
	echo '<option value="THA">Thailande</option>';
	$sql="SELECT * FROM pays";
	//première requête
	$resultat=@mysql_query($sql,$id_link);
	while ($rang=mysql_fetch_array($resultat)){
		$code=$rang['code'];
		$nom=$rang['nom'];
		echo "<option value=\"$code\">$nom</option>";
	}
	echo '</select>';
	?>
	</td>
</tr>



<tr>
	<td></td>
	<td><input type="submit" value="Je m'inscris"></td>
</tr>

</table>
</form>
</body>
</html>

