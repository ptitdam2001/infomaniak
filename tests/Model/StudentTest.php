<?php

use Model\Student;


class StudentTest extends \PHPUnit_Framework_TestCase {

  /**
   * @covers            \Model\Student::__construct
   */
  public function testWith2Argument()
  {
    $student = new Student("Damien", "Suhard");

    $student->setId(12);

    $this->assertEquals(12, $student->id);
    $this->assertEquals("Damien", $student->firstname);
    $this->assertEquals("Suhard", $student->lastname);

    return $student;
  }
}
