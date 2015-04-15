<?php

namespace Model;

use Exception\PersonException;


abstract class Person implements \JsonSerializable {

  const UNREGISTERED = 0;

  public $id;
  public $firstname;
  public $lastname;

  public function __construct($firstname, $lastname, $id = self::UNREGISTERED) {
    if (is_null($firstname) || is_null($lastname)) {
      throw new \Exception\PersonException("firstname and lastname are mandatory");
    }

    $this->firstname = $firstname;
    $this->lastname = $lastname;
    if (!is_null($id)) {
      $this->setId($id);
    }

  }

  public function setId($id) {
    if (is_int($id)) {
      $this->id = $id;
    } 
    else {
      throw new \Exception\PersonException("id is not an integer");
    }
    
  }

  public function jsonSerialize() {
    return array(
      'type' => (new \ReflectionClass($this))->getShortName(), 
      'datas' => array(
        'id' => $this->id, 
        'firstname' => $this->firstname, 
        'lastname' => $this->lastname
      )
    );
  }
}
