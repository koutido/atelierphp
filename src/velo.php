<?php

include "deux_roues_class.php";
$mondeux_roues=new deux_roues('vert', 'enfant', 'roule');
echo "Mon deux-roues est ".$mondeux_roues -> couleur;
echo "<br>";
echo $mondeux_roues -> rouletil();
echo "<br>";
echo $mondeux_roues ->affiche();

?>