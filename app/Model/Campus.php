<?php
namespace Model;

class Campus {

  const UNLIMITED = 0;

  public $id;
  public $city;
  public $area;
  public $capacity;

  private $_students = array();

  public function __construct($city, $area, $capacity = self::UNLIMITED) {
    $this->city = $city;
    $this->area = $area;
    $this->capacity = $capacity;
  }

  public function addStudent(Model\Student $s) {
    if (!$this->isFull()) {
      $this->_students[] = $s;
    }
  }

  public function removeStudent(Model\Student $s) {

  }

  public function getStudents() {


      //sort by ID
  }

  public function addTeacher(Model\Teacher $t) {

  }

  public function removeTeacher(Model\Teacher $t) {

  }

  public function getTeachers() {

  }

  public function isFull() {
    if (count($this->_students) === $this->capacity) {
      return true;
    }
    return false;
  }
}
