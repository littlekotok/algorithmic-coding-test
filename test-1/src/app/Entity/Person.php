<?php

namespace App\Entity;

use App\Entity\Concerns\HasRelation;

class Person
{
	use HasRelation;

	/**
	 * @var string
	 */
	public $gender;

	/**
	 * @var string
	 */
	public $first_name;
}
