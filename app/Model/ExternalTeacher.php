<?php
namespace Model;

class ExternalTeacher extends Teacher {

  public function __construct($firstname, $lastname, $salary) {
    parent::__construct($firstname, $lastname, $salary);
  }
}
