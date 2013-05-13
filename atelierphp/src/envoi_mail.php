<?php

$contenu="Bienvenue Guess,\nVous faites désormais partie du club
des Bons Vivants. Votre nom d'usage dans le Club est Bete et
votre mot de passe mdp. Conservez-le afin d'avoir accès au
Club.\nCordialement\nle Webmestre, Khuong DO.\n";

$entete="From: \"le club des Bon Vivants\"
<contact@bons-vivants.org>\n";
mail ("tienkhuong83@gmail.com","BIENVENUE AU CLUB","$contenu",$entete);


?>