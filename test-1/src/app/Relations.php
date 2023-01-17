<?php

namespace App;

use App\Entity\Person;

class Relations
{
	/**
	 * [Person 1]
	 * 		* [Person 2]
	 * 		* [Person 3]
	 * [Person 2]
	 * 		* [Person 1]
	 * [Person 3]
	 * 		* [Person 1]
	 * 
	 * @var array
	 */
	protected static $rel = [];

	public static function add(Person $someone, Person $target)
	{
		/**
		 * Création des liens de $someone
		 */
		if (!isset(static::$rel[$someone->first_name])) {
			static::$rel[$someone->first_name] = [];
		}
		static::$rel[$someone->first_name][] = $target->first_name;

		/**
		 * Création des liens de $target
		 */
		if (!isset(static::$rel[$target->first_name])) {
			static::$rel[$target->first_name] = [];
		}
		static::$rel[$target->first_name][] = $someone->first_name;
	}

	/**
	 * @param Person $someone
	 * @param Person $target
	 * @return boolean
	 */
	public static function has(Person $someone, Person $target): bool
	{
		return static::recursive($someone->first_name, $target->first_name);
	}

	/**
	 * @param string $id
	 * @param string $target
	 * @param array $except
	 * @return boolean
	 */
	protected static function recursive($id, $target, array $except = []): bool
	{
		/**
		 * Premier test rapide
		 * Vérifie si la source $id possède des liens
		 */
		if (!isset(static::$rel[$id])) {
			return false;
		}

		/**
		 * Cas lien direct (réciproque)
		 * La source $id possède des liens
		 * On vérifie si la cible $target est présente dans les liens de la source $id
		 */
		if (in_array($target, static::$rel[$id], true)) {
			return true;
		}

		/**
		 * Cas lien indirect (transitif)
		 * Dernier traitement, plus lourd, plus long
		 * On oublie pas d'exclure les précédentes liaisons testées ;-)
		 */
		$diff = array_diff(static::$rel[$id], $except);

		if (!empty($diff)) {

			foreach ($diff as $_id) {
				/**
				 * Traitement itératif pour cahque liaison
				 * Excepté la source $id
				 */
				if (static::{__FUNCTION__}($_id, $target, array_merge($except, [$id]))) {
					return true;
				}
			}
		}

		return false;
	}
}
