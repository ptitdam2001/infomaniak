<?php
namespace Service;

use \Model\Teacher;

class TeacherService {
	
	static public function equals(Teacher $t1, Teacher $t2) {

		if (get_class($t1) <> get_class($t2)) {
			return false;
		}

		if ($t1->id <> Teacher::UNREGISTERED) {
			return ($t2->id <> Teacher::UNREGISTERED && $t1->id === $t2->id) ? true : false;
		} 
		else {
			return ($t2->id === Teacher::UNREGISTERED && $t1->firstname === $t2->firstname && $t1->lastname === $t2->lastname) ? true : false;
		}

	}
}