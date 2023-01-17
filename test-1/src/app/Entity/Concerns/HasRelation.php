<?php

namespace App\Entity\Concerns;

use App\Entity\Person;
use App\Relations;

trait HasRelation
{
	/**
	 * @param \App\Entity\Person $person
	 * @return void
	 */
	public function addRelation(Person $person)
	{
		Relations::add($this, $person);
	}

	/**
	 * @param \App\Entity\Person $person
	 * @return boolean
	 */
	public function hasRelation(Person $person): bool
	{
		return Relations::has($this, $person);
	}
}
