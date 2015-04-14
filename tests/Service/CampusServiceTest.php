<?php

use Service\CampusService;
use Model\Campus;

class CampusServiceTest extends \PHPUnit_Framework_TestCase {
	
	/**
	 * @covers \Service\CampusService::equals
	*/
	public function testEqualsMethodBetween2SameCampusCityAndArea() {
		$campus1 = new Campus("Montpellier", "Herault");
		$campus2 = clone $campus1;
		$this->assertTrue(CampusService::equals($campus1, $campus2));
	}

	/**
	 * @covers \Service\CampusService::equals
	*/
	public function testEqualsMethodBetween2SameCampusWithDifferentCapacity() {
		$campus1 = new Campus("Montpellier", "Herault", 12);
		$campus2 = new Campus("Montpellier", "Herault", 11);
		$this->assertTrue(CampusService::equals($campus1, $campus2));
	}

	/**
	 * @covers \Service\CampusService::equals
	*/
	public function testEqualsMethodBetween2CampusWithDifferentCity() {
		$campus1 = new Campus("Montpellier", "Herault");
		$campus2 = new Campus("Saint Jean de Vedas", "Herault");
		$this->assertFalse(CampusService::equals($campus1, $campus2));
	}

	/**
	 * @covers \Service\CampusService::equals
	*/
	public function testEqualsMethodBetween2CampusWithDifferentArea() {
		$campus1 = new Campus("Montpellier", "Herault");
		$campus2 = new Campus("Montpellier", "Var");
		$this->assertFalse(CampusService::equals($campus1, $campus2));
	}
}