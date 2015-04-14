<?php
namespace Model;

class ExternalTeacher extends Teacher {

  public function __construct($firstname, $lastname, $salary, $id = self::UNREGISTERED) {
    parent::__construct($firstname, $lastname, $salary, $id);
  }
}
