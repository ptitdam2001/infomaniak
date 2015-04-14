<?php
namespace Model;

class InternalTeacher extends Teacher {

  const SALARY = 500;

  public function __construct($firstname, $lastname, $id = self::UNREGISTERED) {
    parent::__construct($firstname, $lastname, self::SALARY, $id);
  }
}
