<?php
namespace Model;

class InternalTeacher extends Teacher {

  const SALARY = 500;

  public function __construct($firstname, $lastname) {
    parent::__construct($firstname, $lastname, self::SALARY);
  }
}
