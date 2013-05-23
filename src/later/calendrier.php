<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Calendrier</title>

<body>
<?php
$path=$_SERVER['PHP_SELF'];
echo "Choisir un mois";
echo "<form action=$path method=\"post\">";
echo '<select name="instant" size="1">';

$date_inf= mktime(0,0,0,date("n")-6, date("j"), date("Y"));
$date_sup= mktime(0,0,0,date("n")+12, date("j"), date("Y"));

$mois_franc=array('', 'janvier', 'février', 'mars', 'avril', 'mai',
		'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre',
		'décembre');
echo "Début de la boucle for";
for($variable_mois=-6,$variable_tableau=date("n",$date_inf); $variable_mois<=12; $variable_mois++,$variable_tableau++){
	if ($variable_tableau==13){
		$variable_tableau=1;
	}
	$chronos=mktime(0,0,0,date("n")+$variable_mois, date("j"), date("Y"));
	echo "<option value=\"$chronos\"";
	if (!$variable_mois) {
		echo ' SELECTED';
	}
	$mois_courant=$mois_franc["$variable_tableau"];
	$an_courant=date("Y", $chronos);
	echo ">$mois_courant ${an_courant}</option>";
}

echo "Fin de la boucle for";

if (!$instant){
	echo $instant;
	$instant=mktime(0,0,0,date("n"), date("j"), date("Y"));
}
echo $instant;
$mois=date("n","$instant");
$mois_en_franc=$mois_franc["$mois"];
$annee =date("Y","$instant");
$taille_calendrier="40%";


echo "<table width=$taille_calendrier><TR><TD COLSPAN=\"7\">
$mois $annee</TD</TR>";
echo "<TR><TD>lundi</TD> <TD>mardi</TD> <TD>mercredi</TD> <TD>jeudi</TD> 
	<TD>vendredi</TD> <TD>samedi</TD> <TD>dimanche</TD></TR>";

for ($jours=0,$cellules=1;$cellules<36; $cellules++){
	$jour_semaine=$cellules%7;
	if ($jour_semaine==1){
		echo "<TR>";
	}
	/////////la ligne commence le lundi//////////////
	if (date("j")==$jours && date("n")==$mois && date("Y")==$annee){
		echo "<TD align=\"center\" bgcolor=\#FFFF66\">";
	}
	/*cette condition s'interroge si ce jour est aujourd'hui et
		dans ce cas la case est colorée*/
	else {
		echo "<TD align=\"center\">";
	}
	if ($cellules<8 && $jour_semaine==date("w", mktime(0,0,0,$mois, 1,$annee))){
		$jours=1;
	}
	//cette condition initialise la variable jours//////////////
	if ($jours>0 && $jours<=date("t",$instant)){
		echo $jours;
	}
	else {
		echo "&nbsp;";
	}
	
	echo "</TD>";
	if ($jour_semaine==0){
		echo "</TR>";
	}
	/////le dimanche finit la ligne/////////////
	if ($jours>0){
		$jours++;
	}
	if (date("t",$instant)==$jours && $jour_semaine==0){
		break;
	}
	/*nous prévoyons le cas où un mois de février de 28 jours commence
	 un lundi. Le break évite d'afficher une ligne de case vides*/
}
echo "<table>";
echo "Fin";

?>

</body>
</html>