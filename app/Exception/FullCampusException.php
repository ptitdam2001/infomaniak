<?php
namespace Exception;

use \Model\Campus;

class FullCampusException extends CampusException {
	private $_campus;
	
	public function __construct(Campus $campus) {
		$this->_campus = $campus;
		$this->message = "the campus {$campus->city} - {$campus->area} is full";
	}
}