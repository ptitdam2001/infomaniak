<?php

use Model\Campus;
use Model\Student;
use Model\InternalTeacher;
use Model\ExternalTeacher;

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
	 * @param Campus $campus
	 */
	public function testAddStudentMethod(Campus $campus) {
		$newStudent = new Student("Damien", "Suhard");
		$campus->addStudent($newStudent);
		return $newStudent;
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

	/**
	 * @covers \Model\Campus::removeStudent
	 * @uses \Model\Student
	 * @uses \Model\Campus
	 * @depends testObjectCreationWithUnlimitedCapacity
	 * @depends testAddStudentMethod
	 */
	public function testRemoveStudentWhoAlreadyExists(Campus $campus, Student $student) {
		$this->assertTrue($campus->removeStudent($student));
	}

	/**
	 * @covers \Model\Campus::removeStudent
	 * @uses \Model\Student
	 * @uses \Model\Campus
	 * @depends testObjectCreationWithUnlimitedCapacity
	 */
	public function testRemoveStudentWhoDoesntExists(Campus $campus) {
		$this->assertFalse($campus->removeStudent(new Student("fake", "remove")));
	}

	/**
	 * @covers \Model\Campus::getStudents
	 * @covers \Model\Campus::addStudent
	 * @uses \Model\Student
	 * @depends testObjectCreationWithUnlimitedCapacity
	 */
	public function testGetStudentsReturnsAnArrayOfStudents(Campus $campus) {
		$campus->addStudent(new Student("fake", "add"));
		$students = $campus->getStudents();
		$this->assertInternalType('array', $students);
		$this->assertGreaterThan(0, count($students));
		$this->assertEquals(1, count($students));
		$this->assertInstanceOf(Student::class, array_pop($students));
	}

	/**
	 * @covers \Model\Campus::addTeacher
	 * @covers \Model\Teacher::__construct
	 * @uses \Model\InternalTeacher
	 * @depends testObjectCreationWithUnlimitedCapacity
	 * @param Campus $campus
	 */
	public function testAddTeacherMethodWithAnInternalTeacher(Campus $campus) {
		$newTeacher = new InternalTeacher("Damien", "Suhard");
		$campus->addTeacher($newTeacher);
		return $newTeacher;
	}
	
	/**
	 * @covers \Model\Campus::addTeacher
	 * @covers \Model\Teacher::__construct
	 * @uses \Model\ExternalTeacher
	 * @depends testObjectCreationWithUnlimitedCapacity
	 * @param Campus $campus
	 */
	public function testAddTeacherMethodWithAnExternalTeacher(Campus $campus) {
		$newTeacher = new ExternalTeacher("Damien", "Suhard", 150);
		$campus->addTeacher($newTeacher);
		return $newTeacher;
	}

	/**
	 * @covers \Model\Campus::removeTeacher
	 * @uses \Model\InternalTeacher
	 * @uses \Model\Campus
	 * @depends testObjectCreationWithUnlimitedCapacity
	 * @depends testAddTeacherMethodWithAnInternalTeacher
	 */
	public function testRemoveTeacherWhoAlreadyExists(Campus $campus, InternalTeacher $teacher) {
		$this->assertTrue($campus->removeTeacher($teacher));
	}

	/**
	 * @covers \Model\Campus::removeStudent
	 * @uses \Model\Student
	 * @uses \Model\Campus
	 * @depends testObjectCreationWithUnlimitedCapacity
	 */
	// public function testRemoveStudentWhoDoesntExists(Campus $campus) {
	// 	$this->assertFalse($campus->removeStudent(new Student("fake", "remove")));
	// }

	/**
	 * @covers \Model\Campus::getStudents
	 * @covers \Model\Campus::addStudent
	 * @uses \Model\Student
	 * @depends testObjectCreationWithUnlimitedCapacity
	 */
	// public function testGetStudentsReturnsAnArray(Campus $campus) {
	// 	$campus->addStudent(new Student("fake", "add"));
	// 	$students = $campus->getStudents();
	// 	$this->assertInternalType('array', $students);
	// 	$this->assertGreaterThan(0, count($students));
	// 	$this->assertEquals(1, count($students));
	// 	$this->assertInstanceOf('Student', $students[0]);
	// }

}