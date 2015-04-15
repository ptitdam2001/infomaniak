<?php
namespace Model;

use \Exception\TeacherException;

abstract class Teacher extends Person {

  public $salary;

  public function __construct($firstname, $lastname, $salary, $id = self::UNREGISTERED) {
    parent::__construct($firstname, $lastname, $id);
    $this->setSalary($salary);
  }

  public function setSalary($salary) {
  	if (is_int($salary)) {
      $this->salary = $salary;
    } 
    else {
      throw new \Exception\TeacherException("Salary must be an integer");
    } 
  }

  public function jsonSerialize() {
    return array(
      'type' => (new \ReflectionClass($this))->getShortName(), 
      'datas' => array(
        'id' => $this->id, 
        'firstname' => $this->firstname, 
        'lastname' => $this->lastname,
        'salary' => $this->salary
      )
    );
  }
}
