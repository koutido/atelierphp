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
</head>
<body>
Pour vous inscrire dans le club, nous avons besoin de quelques
renseignements. Préparez un nom d'usage pour le club et un mot de
passe de plus de 8 caractères dont vous vous souviendrez facilement.
<form action="inscription_p2.php" method="post" name="page_1">
<table cellspacing="2" cellpadding="2" border="0"> 
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
	<td>Votre pays</td>
	<td>
	<?php
	echo '<select name="pays">';
	echo '<option value="" select></option>';
	echo '<option value="FRA">France</option>';
	echo '<option value="ESP">Espagne</option>';
	echo '<option value="VNA">VietNam</option>';
	$sql="SELECT * FROM pays ORDER BY ordre DESC, nom ASC";
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

