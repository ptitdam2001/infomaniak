<?php
namespace Model;

class Student extends Person {

	const UNREGISTERED = 0;

	public function __construct($firstname, $lastname, $id = self::UNREGISTERED) {
		parent::__construct($firstname, $lastname);
		$this->setId($id);
	}
}
