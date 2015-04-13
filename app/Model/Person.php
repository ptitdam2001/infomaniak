<?php

namespace Model;

use Exception\PersonException;


abstract class Person {
  public $id;
  public $firstname;
  public $lastname;

  public function __construct($firstname, $lastname) {
    if (is_null($firstname) || is_null($lastname)) {
      throw new \Exception\PersonException("firstname and lastname are mandatory");
    }

    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }

  public function setId($id) {
    if (is_int($id)) {
      $this->id = $id;
    } else {
      throw new \Exception\PersonException("id is not an integer");
    }
    
  }
}
