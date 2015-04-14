<?php
namespace Service;

use \Model\Student; 

class StudentService {
  
  static public function equals(Student $s1, Student $s2) {
    if ($s1->id <> Student::UNREGISTERED) {
    	return ($s2->id <> Student::UNREGISTERED && $s1->id === $s2->id) ? true : false;
    } 
    else {
    	return ($s2->id === Student::UNREGISTERED && $s1->firstname === $s2->firstname && $s1->lastname === $s2->lastname) ? true : false;
    }
  }

  static private function student_compare(Student $s1, Student $s2) {
    return $s1->id - $s2->id;
  }

  static public function sortById(array $students) {
    usort($students, array('self', 'student_compare'));
    return $students;
  }

}
