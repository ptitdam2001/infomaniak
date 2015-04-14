<?php

use Service\StudentService;
use Model\Student;

class StudentServiceTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @covers \Service\StudentService::equals
	*/
	public function testEqualsMethodBetween2SameStudentsId() {
		$student1 = new Student("Damien", "Suhard", 1);
		$student2 = clone $student1;
		$this->assertTrue(StudentService::equals($student1, $student2));
	}

	/**
	 * @covers \Service\StudentService::equals
	*/
	public function testEqualsMethodBetween2SameStudentsIdAndDifferentName() {
		$student1 = new Student("Damien", "Suhard", 1);
		$student2 = new Student("Paul", "Dupont", 1);
		$this->assertTrue(StudentService::equals($student1, $student2));
	}

	/**
	 * @covers \Service\StudentService::equals
	*/
	public function testEqualsMethodWithAnUnregisteredStudent() {
		$student1 = new Student("Damien", "Suhard");
		$student2 = clone $student1;
		$student2->setId(1);
		$this->assertFalse(StudentService::equals($student1, $student2));
		$this->assertFalse(StudentService::equals($student2, $student1));
	}

	/**
	 * @covers \Service\StudentService::equals
	*/
	public function testEqualsMethodBetween2UnregisteredStudentsWithDifferentName() {
		$student1 = new Student("Damien", "Suhard");
		$student2 = new Student("Paul", "Dupont");
		$this->assertFalse(StudentService::equals($student1, $student2));
	}

	/**
	 * @covers \Service\StudentService::equals
	*/
	public function testEqualsMethodBetween2UnregisteredStudentsWithSameName() {
		$student1 = new Student("Damien", "Suhard");
		$student2 = new Student("Damien", "Suhard");
		$this->assertTrue(StudentService::equals($student1, $student2));
	}

	/**
	 * @covers \Service\StudentService::sortById
	 * @uses \Model\Student
	 */
	public function testSortByIdMethod() {
		$students = array(
			new Student("fake1", "fakename1", 3),
			new Student("fake2", "fakename2", 4),
			new Student("fake3", "fakename3", 2),
			new Student("fake4", "fakename4")
		);

		$goodresult = array(
			new Student("fake4", "fakename4"),
			new Student("fake3", "fakename3", 2),
			new Student("fake1", "fakename1", 3),
			new Student("fake2", "fakename2", 4)
		);

		$sorted = StudentService::sortById($students);

		$this->assertFalse($students == $sorted);
		$this->assertTrue($goodresult == $sorted);
	}

	/**
	 * @covers \Service\StudentService::sortById
	 * @uses \Model\Student
	 */
	public function testSortByIdMethodWith2UnregisteredStudents() {
		$students = array(
			new Student("fake1", "fakename1", 3),
			new Student("fake2", "fakename2", 4),
			new Student("fake0", "fakename0"),
			new Student("fake3", "fakename3", 2),
			new Student("fake4", "fakename4")
		);

		$goodresult = array(
			new Student("fake4", "fakename4"),
			new Student("fake0", "fakename0"),
			new Student("fake3", "fakename3", 2),
			new Student("fake1", "fakename1", 3),
			new Student("fake2", "fakename2", 4)
		);

		$sorted = StudentService::sortById($students);

		$this->assertFalse($students == $sorted);
		$this->assertTrue($goodresult == $sorted);
	}
}