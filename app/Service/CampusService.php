<?php
namespace Service;

use \Model\Campus;

class CampusService {

  static public function equals(Campus $c1, Campus $c2) {
    return ($c1->city === $c2->city && $c1->area === $c2->area) ? true : false;
  }
}
