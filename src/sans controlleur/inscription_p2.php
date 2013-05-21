<?php
include "commun/connexion.inc.php";

$prenom=$_POST['prenom'];
$code_postal=$_POST['code_postal'];
$ville =$_POST['ville'];
$email=$_POST['email'];
$pays=$_POST['pays'];

$sql="select clef from membres where email='$email'";
$resultat=@mysql_query($sql,$id_link);
$nombre=mysql_num_rows($resultat);
echo "Le nombre d'adresse mail existante: $nombre";
if ($nombre >0){	
	$auth=1;
	include "inscription_p1.php";
	exit;
}

$sql="INSERT INTO membres (prenom, code_postal, ville, pays, email, nom_usage, mot_passe, question, reponse) VALUES ('$prenom', '$code_postal', '$ville', '$pays', '$email', '','','','')";
@mysql_query($sql,$id_link);


if ($auth==2){
	echo "<p><font color=\"#FF0000\">Votre nom d'usage existe déjà dans
la base de données. Soit vous êtes déjà membre et vous avez
<a href=\"oubli.php\">oublié votre mot de passe</a>. Soit il s'agit
d'une simple coïncidence, dans lequel cas, entrez un nouveau nom
d'usage...</font></p>";
}

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Inscription</title>	
</head>
<body>
Veuillez maintenant choisir le nom d'usage que vous porterez dans le club et le mot de passe pour y accéder. Vous pourrez ainsi
rencontrer d'autres membres et modifier votre profil, voire le supprimer éventuellement.
<form action="traitement_id.php" method="post" name="page_2">
<table cellspacing="2" cellpadding="2" border="0">
<tr>
	<td>Votre nom d'usage</td>
	<td><input type="text" name="nom_usage"></td>
</tr>

<tr>
	<td>Votre mot de passe</td>
	<td><input type="password" name="mot_passe"></td>
</tr>

<tr>
	<td>Retapez votre mot de passe</td>
	<td><input type="password" name="mot_passebis"></td>
</tr>

<tr>
	<td>Votre question secrète en cas d'oubli</td>
	<td><input type="text" name="question" value="Quel est le nom de jeune fille de votre mère ?" size="50"></td>
</tr>

<tr>
	<td>Votre réponse</td>
	<td><input type="text" name="reponse"></td>
</tr>

<tr>
	<td></td>
	<td><input type="submit" value="Je valide"></td>
</tr>

</table>
</form>
</body>
</html>