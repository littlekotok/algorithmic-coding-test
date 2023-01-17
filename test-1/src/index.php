<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Factory;
use App\Entity\Person;
use Illuminate\Support\Collection;

/**
 * Nombre de liens d'amitié affichés (20 max)
 * 
 * @var integer $lines
 */
$lines = (isset($_SERVER) && isset($_SERVER['argv']) && isset($_SERVER['argv'][1]) && ($value = $_SERVER['argv'][1]) && is_numeric($value)) ? ((int) $value) : 5;
$lines = min(20, $lines);

/**
 * Collection de personnes
 * Unicité des prénoms
 * La quantité correspond cas défavorable : tous les liens d'amitié : `<nom1> est ami(e) avec <nom2>` (2 personnes)
 */
$people = Factory::anybody($lines * 2);

/**
 * Création de la personne "moi"/"je"
 * Unicité du prénom avec le groupe $people
 */
$me = Factory::myself();

/**
 * La collection $friends regroupe les personnes qui possèdent au minimum un lien d'amitié avec une autre personne
 * Elle sera utilisé pour piocher aléatoirement une personne et tester son lien d'amitié avec "moi"
 */
$friends = new Collection();

while ($lines > 0) {

	/**
	 * Sélection aléatoire d'une personne
	 * 
	 * @var Person $someone
	 */
	$someone = $people->random();

	/**
	 * Choix aléatoire du lien d'amitié
	 * 
	 * [1] -> `je suis ami avec <nom2>`
	 * [2] -> `<nom1> est ami(e) avec moi`
	 * [3-5] -> `<nom1> est ami(e) avec <nom2>`
	 */
	switch (Factory::numberBetween(1, 5)) {

		case 1: // `je suis ami avec <nom2>`
			/**
			 * Uniquement si "je" n'est pas déjà ami avec $someone
			 */
			if (!$me->hasRelation($someone)) {

				/**
				 * Création du lien d'amitié entre "moi" et $someone
				 */
				$me->addRelation($someone);

				$friends->add($someone);

				echo "je suis ami avec {$someone->first_name}" . PHP_EOL;

				/**
				 * Décrémente le nombre de lignes
				 */
				$lines--;
			}
			break;

		case 2: // `<nom1> est ami(e) avec moi`
			/**
			 * Uniquement si $someone n'est pas déjà ami avec "moi"
			 */
			if (!$someone->hasRelation($me)) {

				/**
				 * Création du lien d'amitié entre $someone et "moi"
				 */
				$someone->addRelation($me);

				$friends->add($someone);

				echo "{$someone->first_name} est ami(e) avec moi" . PHP_EOL;

				/**
				 * Décrémente le nombre de lignes
				 */
				$lines--;
			}
			break;

		default: // `<nom1> est ami(e) avec <nom2>`
			/**
			 * La méthode shuffle mélange aléatoirement les personnes de la collection $people
			 * $another est une personne différente de $someone
			 * 
			 * @var Person $another
			 */
			$another = $people->shuffle()->first(function (Person $entity) use ($someone) {
				return ($entity->first_name != $someone->first_name);
			});

			/**
			 * Uniquement si $someone n'est pas déjà ami avec $another
			 */
			if (!$someone->hasRelation($another)) {

				/**
				 * Création du lien d'amitié entre $someone et $another
				 */
				$someone->addRelation($another);

				$friends->add($someone)->add($another);

				echo "{$someone->first_name} est ami(e) avec {$another->first_name}" . PHP_EOL;

				/**
				 * Décrémente le nombre de lignes
				 */
				$lines--;
			}
			break;
	}
}

echo '---' . PHP_EOL;

/**
 * Collection $friends correspond aux personnes ami(e)s
 * Unicité des personnes dans la collection
 * $someone : Sélection aléatoire d'une personne
 * 
 * @var Person $someone
 */
$someone = $friends->uniqueStrict('first_name')->random();

// echo "Je suis {$me->first_name}." . PHP_EOL;

echo "Est-ce que {$someone->first_name} est mon ami ?" . PHP_EOL;

echo ($me->hasRelation($someone) ? 'Oui' : 'Non') . PHP_EOL;
