<?php

require '../vendor/autoload.php';

echo '<pre>';
print_r($_SERVER);
echo '</pre>';

use \Model\Student;
use \Model\InternalTeacher;
use \Model\ExternalTeacher;
use \Model\Campus;

$campus = new Campus("Montpellier", "Herault");

$student = new Student("toto","titi",1);
$campus->addStudent($student);

$t = new InternalTeacher("moi", "doris");
$t2 = new ExternalTeacher("toi", "John", 1500);
$campus->addTeacher($t);
$campus->addTeacher($t2);

echo '<pre>';
echo json_encode($campus, JSON_PRETTY_PRINT);
echo '</pre>';

$loader = new Twig_Loader_Filesystem('../app/View/');
$twig = new Twig_Environment($loader, array());

echo $twig->render('campus/list.html', array('name' => 'Fabien'));
