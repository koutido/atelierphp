<?php
include "commun/connexion.inc.php";

/*///////////////////DATE SOUS LA FORME AAAAMMJJ///////////////////*/
$moment=date ("Ymd", mktime (0,0,0,date("m"),date("d"),date("Y")));
$nom_usage=$_POST['nom_usage'];
$mot_passe=$_POST['mot_passe'];
$question=$_POST['question'];
$reponse= strtolower($_POST['reponse']);
//$email=$_POST['email'];
//$email="SELECT email FROM membres WHERE nom_usage='$nom_usage'";
//echo "récapitulatif: date=$moment, nick=$nom_usage, mdp=$mot_passe, question=$question, réponse=$reponse, email=$email";

//$res1="SELECT MAX(clef) FROM membres";

//$query="SELECT * FROM membres ORDER BY clef DESC LIMIT 1";
//$query=="SELECT MAX(clef) FROM membres";
//$res=mysql_query($query,$id_link) or die(mysql_error());
//$id1=mysql_insert_id($res2);

//$id1=mysql_insert_id($id_link);

//$req2="SELECT MAX(clef) FROM membres";
//$res2=@mysql_query($req2,$id_link);
//$id2=(int)@mysql_query($req2,$id_link);
//$query="LAST_INSERT_ID()";
//$sql="UPDATE membres SET nom_usage='Thi' WHERE clef='SELECT MAX(clef) FROM membres' ";
//SELECT clef FROM membres WHERE clef=(SELECT MAX(clef) FROM membres);
//UPDATE membres SET nom_usage='Thi' ORDER BY clef DESC LIMIT 1;
//echo "dernier id: id=$res";

$sql="SELECT clef FROM membres WHERE nom_usage='$nom_usage'";
$resultat=@mysql_query($sql,$id_link);
$nombre=mysql_num_rows ($resultat);
if ($nombre >0){
	$auth=2;
	include "inscription_p2.php";
	exit;
}

$sql="UPDATE membres SET nom_usage='$nom_usage', mot_passe='$mot_passe', date_inscription='$moment', question='$question', reponse='$reponse' ORDER BY clef DESC LIMIT 1"; 
//$sql="INSERT INTO membres (nom_usage, mot_passe, date_inscription, question, reponse) VALUES ('$nom_usage', '$mot_passe', '$moment', '$question', '$reponse')";
@mysql_query($sql,$id_link);
//nettoyage
$hier=date ("Ymd", mktime (0,0,0,date("m"),date("d")-1,date("Y")));
$sql="DELETE FROM membres WHERE nom_usage='' AND date_misajour<$hier";
@mysql_query($sql,$id_link);
//récupérer l'adresse mail de l'utilisateur
$query="SELECT email from membres order by clef desc limit 1";
$exec=@mysql_query($query,$id_link);
$res=@mysql_fetch_array($exec);
$email=$res['email'];
//mail de bienvenue
$contenu="Bienvenue $prenom,\nVous faites désormais partie du club
des Bons Vivants. Votre nom d'usage dans le Club est $nom_usage et
votre mot de passe $mot_passe. Conservez-le afin d'avoir accès au
Club.\nCordialement\nle Webmestre, François Rabelais.\n";

$entete="From: \"le club des Bon Vivants\"
<contact@bons-vivants.org>\n";
//l'envoi de mail
mail ("$email","BIENVENUE AU CLUB","$contenu",$entete);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Inscription</title>
</head>
<body>
Merci de votre inscription et bienvenue dans le Club des Bons
Vivants. Nous venons de vous envoyer un courriel de confirmation
avec votre nom d'usage et votre mot de passe.
<CENTER><i>Le webmestre</i></CENTER>
</body>
</html>