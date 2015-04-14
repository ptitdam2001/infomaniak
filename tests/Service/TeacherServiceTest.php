<?php

use Service\TeacherService;
use Model\Teacher;
use Model\InternalTeacher;
use Model\ExternalTeacher;

class TeacherServiceTest extends \PHPUnit_Framework_TestCase {
	
	/**
	 * @covers \Service\TeacherService::equals
	*/
	public function testEqualsMethodBetween2SameInternalTeacherId() {
		$teacher1 = new InternalTeacher("Damien", "Suhard", 1);
		$teacher2 = clone $teacher1;
		$this->assertTrue(TeacherService::equals($teacher1, $teacher2));
	}

	/**
	 * @covers \Service\StudentService::equals
	*/
	public function testEqualsMethodBetween2SameInternalTeacherIdAndDifferentName() {
		$teacher1 = new InternalTeacher("Damien", "Suhard", 1);
		$teacher2 = new InternalTeacher("Paul", "Dupont", 1);
		$this->assertTrue(TeacherService::equals($teacher1, $teacher2));
	}

	/**
	 * @covers \Service\TeacherService::equals
	*/
	public function testEqualsMethodBetween2DifferentTypeOfTeacherWithSameId() {
		$teacher1 = new InternalTeacher("Damien", "Suhard", 1);
		$teacher2 = new ExternalTeacher("Damien", "Suhard", 150, 1);
		$this->assertFalse(TeacherService::equals($teacher1, $teacher2));
	}
}