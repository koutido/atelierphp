<?php

/**
 *
* Classe Robot qui permet de simuler le comportement d'un robot.
* @author nvergnes
* @version 1.0
*
*/
class Robot {
	/**
	 *
	 * Age du robot
	 * @var integer
	 * @access private
	 */
	var $age;

	/**
	 *
	 * Nom du robot
	 * @var string
	 * @access private
	 */
	var $nom;

	/**
	 *
	 * Constructeur
	 * @param integer $age L'âge du robot
	 * @param string $nom Le nom du robot
	 */
	function Robot( $age, $nom ) {
		$this->age = $age;
		$this->nom = $nom;
	}

	/**
	 *
	 * Méthode pour faire parler le robot.
	 */
	function parle() {
		echo "Bonjour, je m'appelle $this->nom. J'ai déjà $this->age ans ! </br>";
	}
	}

	// construction de 2 robots
	$robot1 = new Robot(10, 'R2-D2');
$robot2 = new Robot(15, 'C-3PO');

// à vous les robots, parlez !
	$robot1->parle();
	$robot2->parle();

?>