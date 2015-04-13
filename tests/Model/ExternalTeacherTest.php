<?php

use Model\ExternalTeacher;


class ExternalTeacherTest extends \PHPUnit_Framework_TestCase {

  /**
   * @covers \Model\ExternalTeacher::__construct
   * @expectedException \Exception\PersonException
   */
  public function testObjectCreationHasMandatoriesParameters() {
    new ExternalTeacher(null, "Suhard", 100);
    new ExternalTeacher("Damien", null, 100);
    new ExternalTeacher(null, null, null);
  }

  /**
   * @covers \Model\ExternalTeacher::__construct
   * @expectedException \Exception\TeacherException
   */
  public function testSalaryMustBeAnInteger() {
    new ExternalTeacher("Damien", "Suhard", "100");
  }

  /**
   * @covers \Model\ExternalTeacher::__construct
   */
  public function testObjectCreation() {
    
    $teacher = new ExternalTeacher("Damien", "Suhard", 1000);
    
    $this->assertInstanceOf(ExternalTeacher::class, $teacher);
    $this->assertEquals("Damien", $teacher->firstname);
    $this->assertEquals("Suhard", $teacher->lastname);
    $this->assertEquals(1000, $teacher->salary);
    
    return $teacher;
  }

  /**
   * @covers \Model\ExternalTeacher::setId
   * @depends testObjectCreation
   * @param ExternalTeacher $teacher
   */
  public function testSetIdWhenItsAnInteger(ExternalTeacher $teacher) {
    
    $teacher->setId(12);

    $this->assertEquals(12, $teacher->id);
    $this->assertTrue(is_int($teacher->id));

    return $teacher;
  }

  /**
   * @covers \Model\ExternalTeacher::setId
   * @depends testObjectCreation
   * @expectedException \Exception\PersonException
   * @param ExternalTeacher $teacher
   */
  public function testSetIdWhenItsNotAnInteger(ExternalTeacher $teacher) {
    $teacher->setId("12");
  }
}
