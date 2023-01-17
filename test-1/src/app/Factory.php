<?php

namespace App;

use App\Entity\Person;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Collection;

/**
 * Factory Pattern
 * 
 * @method static integer numberBetween(integer $int1, integer $int2)
 */
class Factory
{
	public static $locale = 'fr_FR';
	/**
	 * Undocumented variable
	 *
	 * @var \Faker\Generator
	 */
	protected static $faker;

	/**
	 * @return Person
	 */
	public static function person(): Person
	{
		$rand = static::numberBetween(10, 20);

		$person = new Person;
		/**
		 * Sélection aléatoire du genre
		 */
		$person->gender = (0 == $rand % 2) ? 'male' : 'female';
		/**
		 * Unicité des prénoms pour toutes les personnes générées
		 */
		$person->first_name = static::faker()->unique()->firstName($person->gender);

		return $person;
	}

	/**
	 * @return \App\Entity\Person
	 */
	public static function myself(): Person
	{
		return static::person();
	}

	/**
	 * Retourne un collection de x personnes
	 * 
	 * @param integer $take
	 * @return \Illuminate\Support\Collection
	 */
	public static function anybody(int $take = 10)
	{
		$collection = new Collection();
		while ((--$take) > -1) {
			$collection->add(static::person());
		}
		return $collection;
	}

	/**
	 * @see https://fakerphp.github.io/
	 * @return \Faker\Generator
	 */
	public static function faker()
	{
		if (!static::$faker) {
			static::$faker = FakerFactory::create(static::$locale);
		}
		return static::$faker;
	}

	public static function __callStatic($name, $arguments)
	{
		return call_user_func_array(array(static::faker(), $name), $arguments);
	}
}
