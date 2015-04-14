<?php
namespace Model;

use \Exception\CampusException;
use \Exception\FullCampusException;
use \Model\Student;
use \Model\Teacher;
use \Service\StudentService;
use \Service\TeacherService;


class Campus implements \JsonSerializable {

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

  public function addStudent(Student $student) {
    if (!$this->isFull()) {
      //defines his Id into the campus
      //$s->setId(count($this->_students));

      $this->_students[] = $student;
    } 
    else {
      throw new FullCampusException($this);
    }
  }

  public function removeStudent(Student $student) {
    $counter = 0;
    foreach ($this->_students as $idx => $current) {
      if ($current == $student) {
        unset($this->_students[$idx]);
        $counter++;
      }
    }
    return $counter > 0 ? true : false;
  }

  public function getStudents() {
    //sort by ID
    return $this->_students;
  }

  public function addTeacher(Teacher $teacher) {
    $this->_teachers[] = $teacher;
  }

  public function removeTeacher(Teacher $teacher) {
    $counter = 0;
    foreach ($this->_teachers as $idx => $current) {
      if ($current == $teacher) {
        unset($this->_students[$idx]);
        $counter++;
      }
    }
    return $counter > 0 ? true : false;
  }

  public function getTeachers() {
    return $this->_teachers;
  }

  public function isFull() {
    return ($this->capacity !== self::UNLIMITED && count($this->_students) === $this->capacity) ? true : false;
  }

  public function jsonSerialize() {
    return array(
      'type' => get_class($this), 
      'datas' => array(
        'id' => $this->id, 
        'city' => $this->city, 
        'area' => $this->area,
        'capacity' => $this->capacity,
        'students' => $this->_students,
        'teachers' => $this->_teachers
      )
    );
  }
}
