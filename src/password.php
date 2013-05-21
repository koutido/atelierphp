<?php
$alphabet = "abcdefghjkmnopqrstuvwxyz";
$alphabet .= "ABCDEFGHJKLMNOPQRSTUVWXYZ";
$alphabet .= "123456789";
$alphabet .= "*/!.;+&";
/* vous remarquerez que certains éléments ont été omis pour
 ne pas créer d’ambiguïtés comme le chiffre 0 ou la
minuscule l ou la majuscule I */
$nbcar = 8; $i = 0;$motdepasse = "";
// taille du mot de passe 11 caractères et initialisation
srand((double)microtime()*1000000);
/* initialisation du hasard avec le moment en microsecondes.
 Vous avez remarqué que le type a été forcé sinon nous aurions
un entier qui serait égal à 0. La microseconde a une
précision à 1/1 000 000. Ici vous plantez une graine qui est
différente de 999999 autres graines possibles*/
while ($i<$nbcar) {
	$valcar = rand(0, strlen($alphabet));
	$motdepasse .= substr($alphabet,$valcar,1);
	$i++;
}
/*boucle pour générer les 11 caractères du mot de passe
 par concaténation*/

echo $motdepasse
?>