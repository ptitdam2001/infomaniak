<?php
namespace Model;

abstract class Teacher extends Person {
  public $salary;

  public function __construct($firstname, $lastname, $salary) {
    parent::__construct($firstname, $lastname);
    $this->salary = $salary;
  }

}
