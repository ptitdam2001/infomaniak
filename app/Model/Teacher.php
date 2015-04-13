<?php
namespace Model;

use \Exception\TeacherException;

abstract class Teacher extends Person {
  
  public $salary;

  public function __construct($firstname, $lastname, $salary) {
    parent::__construct($firstname, $lastname);
    $this->setSalary($salary);
  }

  public function setSalary($salary) {
  	if (is_int($salary)) {
		$this->salary = $salary;
  	} else {
  		throw new \Exception\TeacherException("Salary must be an integer");
  	}
  	
  }

}
