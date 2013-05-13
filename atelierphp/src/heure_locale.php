<?php
function affiche_jour($moment){
	$jour=date("w", $moment);
	$les_jours=array('dimanche', 'lundi', 'mardi', 'mercredi',
			'jeudi', 'vendredi', 'samedi');
			$jour=$les_jours[$jour];
return $jour;
}

function affiche_mois ($moment){
	$mois=date("n", $moment);//le mois sans 0 devant
	$les_mois=array('', 'janvier', 'février', 'mars',
			'avril', 'mai', 'juin', 'juillet',
			'août', 'septembre', 'octobre',
			'novembre', 'décembre');
			$mois=$les_mois[$mois];
return $mois;
}

function affiche_date_locale($moment){
	$decalage_hiver=1;
	if (!$moment){
		$temps=time();
	}
	else {
		$temps=$moment;
	}
	
	$jourdesemaine=gmdate("w", mktime(1,0,0, 3,31,gmdate("Y")));
	//variable pour connaître le jour de semaine du 31 mars
	$limite_inf=mktime(1,0,0, 3,31-$jourdesemaine,gmdate("Y"));
	/*variable pour trouver le dernier dimanche de mars pour l'année
	 courante*/
	$jourdesemaine=gmdate("w", mktime(1,0,0, 10,31,gmdate("Y")));
	/*variable pour connaître le jour de semaine du 31 octobre*/
	$limite_sup=mktime(1,0,0, 10,31-$jourdesemaine,gmdate("Y"));
	
	/*variable pour trouver le dernier dimanche d'octobre pour l'année
	 courante*/
	if ($temps>$limite_inf && $temps<$limite_sup){
		$decalage=$decalage_hiver+1;
	}
	else {
		$decalage=$decalage_hiver;
	}
	$moment=mktime(gmdate("G")+$decalage,gmdate("i"),gmdate("s"),
			gmdate("n"),gmdate("j"),gmdate("Y"));
	
	$ladate=affiche_jour($moment) ." ".date("j", $moment)." ".
			affiche_mois($moment) ." ". date("Y", $moment);
	/*la date inclut le mois en français grâce à l'appel de
	 la fonction.*/
	$heure = date("G",$moment);
	$minute = date("i", $moment);
	$seconde = date("s", $moment);
	$ladate.="<BR>";
	$ladate.="$heure";
	$ladate.="h";
	$ladate.="$minute";
	$ladate.="m";
	$ladate.="$seconde";
	return $ladate;
}

echo @affiche_date_locale();
/*Vous faites précéder la fonction du @ pour éviter le
 message d'erreur si vous n'envoyez pas de paramètre*/
?>	