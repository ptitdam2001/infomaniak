<?php

use Model\Student;


class StudentTest extends \PHPUnit_Framework_TestCase {

  /**
   * @covers \Model\Student::__construct
   * @expectedException \Exception\PersonException
   */
  public function testObjectCreationHasMandatoriesParameters() {
    new Student(null, "Suhard");
    new Student("Damien", null);
    new Student();
  }

  /**
   * @covers \Model\Student::__construct
   */
  public function testObjectCreation() {
    
    $student = new Student("Damien", "Suhard");
    
    $this->assertInstanceOf(Student::class, $student);
    $this->assertEquals("Damien", $student->firstname);
    $this->assertEquals("Suhard", $student->lastname);
    
    return $student;
  }


  /**
   * @covers \Model\Student::setId
   * @depends testObjectCreation
   * @param Student $student
   */
  public function testSetIdWhenItsAnInteger(Student $student) {
    
    $student->setId(12);

    $this->assertEquals(12, $student->id);
    $this->assertTrue(is_int($student->id));

    return $student;
  }

  /**
   * @covers \Model\Student::setId
   * @depends testObjectCreation
   * @expectedException \Exception\PersonException
   * @param Student $student
   */
  public function testSetIdWhenItsNotAnInteger(Student $student) {
    $student->setId("12");
  }
}
