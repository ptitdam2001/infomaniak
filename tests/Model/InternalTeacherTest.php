<?php

use Model\InternalTeacher;


class InternalTeacherTest extends \PHPUnit_Framework_TestCase {

  /**
   * @covers \Model\InternalTeacher::__construct
   * @expectedException \Exception\PersonException
   */
  public function testObjectCreationHasMandatoriesParameters() {
    new InternalTeacher(null, "Suhard");
    new InternalTeacher("Damien", null);
    new InternalTeacher();
  }

  /**
   * @covers \Model\InternalTeacher::__construct
   */
  public function testObjectCreation() {
    
    $teacher = new InternalTeacher("Damien", "Suhard");
    
    $this->assertInstanceOf(InternalTeacher::class, $teacher);
    $this->assertEquals("Damien", $teacher->firstname);
    $this->assertEquals("Suhard", $teacher->lastname);
    $this->assertEquals(InternalTeacher::SALARY, $teacher->salary);
    
    return $teacher;
  }

  /**
   * @covers \Model\InternalTeacher::setId
   * @depends testObjectCreation
   * @param InternalTeacher $teacher
   */
  public function testSetIdWhenItsAnInteger(InternalTeacher $teacher) {
    
    $teacher->setId(12);

    $this->assertEquals(12, $teacher->id);
    $this->assertTrue(is_int($teacher->id));

    return $teacher;
  }

  /**
   * @covers \Model\InternalTeacher::setId
   * @depends testObjectCreation
   * @expectedException \Exception\PersonException
   * @param InternalTeacher $teacher
   */
  public function testSetIdWhenItsNotAnInteger(InternalTeacher $teacher) {
    $teacher->setId("12");
  }
}
