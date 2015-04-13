<?php

namespace Model;

abstract class Person {
  public $id;
  public $firstname;
  public $lastname;

  public function __construct($firstname, $lastname) {
    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }

  public function setId($id) {
    $this->id = $id;
  }
}
