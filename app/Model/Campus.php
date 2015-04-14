<?php
namespace Model;

use \Exception\CampusException;
use \Exception\FullCampusException;
use \Model\Student;


class Campus {

  const UNLIMITED = 0;

  public $id;
  public $city;
  public $area;
  public $capacity;

  private $_students = array();

  private $_teachers = array();

  public function __construct($city, $area, $capacity = self::UNLIMITED) {
    if (is_null($city) || is_null($area)) {
      throw new CampusException("city and area must be not null");
    } 
    elseif (!is_string($city) || !is_string($area)) {
      throw new CampusException("city and area must be a String");
    } 
    elseif (!is_int($capacity)) { 
      throw new CampusException("capacity must be an number");
    } 
    else {
      $this->city = $city;
      $this->area = $area;
      $this->capacity = $capacity;
    }
  }

  public function addStudent(Student $s) {
    if (!$this->isFull()) {
      $this->_students[] = $s;
    } 
    else {
      throw new FullCampusException($this);
    }
  }

  public function removeStudent(Student $s) {

  }

  public function getStudents() {
    //sort by ID

    return $this->_students;
  }

  public function addTeacher(Model\Teacher $t) {

  }

  public function removeTeacher(Model\Teacher $t) {

  }

  public function getTeachers() {

  }

  public function isFull() {
    return ($this->capacity !== self::UNLIMITED && count($this->_students) === $this->capacity) ? true : false;
  }
}
