<?php

use Model\Campus;
use Model\Student;

class CampusTest extends \PHPUnit_Framework_TestCase {

	const SMALL_CAPACITY = 2;

	/**
	* @covers \Model\Campus::__construct
	* @expectedException \Exception\CampusException
	*/
	public function testObjectCreationHasMandatoriesParameters() {
		new Campus(null, "Languedoc Roussillon");
		new Campus("Avenue Albert Einstein, 34000 Montpellier", null);
	}

	/**
	 * @covers \Model\Campus::__construct
	 * @expectedException \Exception\CampusException
	 */
	public function testObjectCreationMustHaveStringParameters() {
		new Campus(1, "Languedoc Roussillon");
		new Campus("Avenue Albert Einstein, 34000 Montpellier", 11);
	}

	/**
	 * @covers \Model\Campus::__construct
	 * @expectedException \Exception\CampusException
	 */
	public function testObjectCreationMustHaveIntegerCapacity() {
		new Campus("Avenue Albert Einstein, 34000 Montpellier", "Languedoc Roussillon", "11");
	}

	/**
	 * @covers \Model\Campus::__construct
	 */
	public function testObjectCreationWithUnlimitedCapacity() {
		$campus = new Campus("Avenue Albert Einstein, 34000 Montpellier", "Languedoc Roussillon");
		$this->assertInstanceOf(Campus::class, $campus);
		$this->assertEquals(Campus::UNLIMITED, $campus->capacity);
		return $campus;
	}

	/**
	 * @covers \Model\Campus::__construct
	 */
	public function testObjectCreationWithLimitedCapacity() {
		$campus = new Campus("Avenue Albert Einstein, 34000 Montpellier", "Languedoc Roussillon", self::SMALL_CAPACITY);
		$this->assertInstanceOf(Campus::class, $campus);
		$this->assertEquals(self::SMALL_CAPACITY, $campus->capacity);
		return $campus;
	}

	/**
	 * @covers \Model\Campus::isFull
	 * @depends testObjectCreationWithUnlimitedCapacity
	 */
	public function testIsFullAfterCreationWithAnUnlimitedCapacity(Campus $campus) {
		$this->assertFalse($campus->isFull());
	}

	/**
	 * @covers \Model\Campus::isFull
	 * @depends testObjectCreationWithLimitedCapacity
	 */
	public function testIsFullAfterCreationWithALimitedCapacityGreaterThan1(Campus $campus) {
		$this->assertFalse($campus->isFull());
	}

	/**
	 * @covers \Model\Campus::__construct
	 * @covers \Model\Student::__construct
	 * @covers \Model\Campus::isFull
	 * @uses \Model\Student
	 */
	public function testIsFullWhenCampusIsReallyFull() {
		$campus = new Campus("Avenue Albert Einstein, 34000 Montpellier", "Languedoc Roussillon", 1);
		$campus->addStudent(new Student("Damien", "Suhard"));
		$this->assertTrue($campus->isFull());
	}

	/**
	 * @covers \Model\Campus::addStudent
	 * @covers \Model\Student::__construct
	 * @uses \Model\Student
	 * @depends testObjectCreationWithUnlimitedCapacity
	 */
	public function testAddStudentMethod(Campus $campus) {
		$campus->addStudent(new Student("Damien", "Suhard"));
	}

	/**
	 * @covers \Model\Campus::__construct
	 * @covers \Model\Campus::addStudent
	 * @covers \Model\Student::__construct
	 * @uses \Model\Student
	 * @expectedException \Exception\FullCampusException
	 */
	public function testAddStudentMethodThrowAFullCampusException() {
		$campus = new Campus("one city", "one area", 1);
		$campus->addStudent(new Student("Dam", "Dam"));
		$campus->addStudent(new Student("Dam1", "Dam1"));
	}


}