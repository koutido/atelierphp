<?php
class deux_roues {
	var $couleur;
	var $taille='adulte';
	var $etat="est arrêté";
	function deux_roues ($couleur, $taille, $etat){
		$this-> couleur = $couleur;
		$this-> taille = $taille;
		$this-> etat = $etat;
	}
	function affiche (){
		echo "mon deux-roues ".$this->couleur." ". $this->etat. ". Il est
de taille " . $this->taille. " et de type " . $this->type. "
avec ".$this->nbreVitesses. " vitesses.";
	}
	function rouletil (){
		$this->etat;
		setlocale (LC_ALL, 'fr_FR');
		$moment=strftime ("%A %e %B %Y a %Hh%M");
		$this->moment=$moment;
		echo "Ce deux-roues ".$this->etat." $moment";
	}
}
?>