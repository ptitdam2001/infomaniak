<?php

require '../vendor/autoload.php';

use \Model\Student;
use \Model\InternalTeacher;
use \Model\ExternalTeacher;
use \Model\Campus;
use \Service\DataService;

session_start();

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createCampus($nbStudent = 1, $nbInternalTeacher = 1, $nbExternalTeacher = 1) {
	$campus = new Campus(generateRandomString(10), generateRandomString(10));

	for ($i = 0; $i < $nbStudent; $i++) {
		$student = new Student(generateRandomString(7), generateRandomString(7), $i);
		$campus->addStudent($student);
	}

	for ($i = 0; $i < $nbInternalTeacher; $i++) {
		$teacher = new InternalTeacher(generateRandomString(7), generateRandomString(7), $i);
		$campus->addTeacher($teacher);
	}

	for ($i = 0; $i < $nbExternalTeacher; $i++) {
		$teacher = new ExternalTeacher(generateRandomString(7), generateRandomString(7), rand(1, 5000), $i);
		$campus->addTeacher($teacher);
	}

	DataService::getInstance()->save($campus);

	return $campus;
}

if (isset($_POST['create_campus'])) {
	$new = createCampus($_POST['nbStudent'], $_POST['nbInternalTeacher'], $_POST['nbExternalTeacher']);
	$_SESSION["last_created"] = serialize($new);
}

if (isset($_POST['create_student'])) {
	$student = new Student(generateRandomString(7), generateRandomString(7));
	DataService::getInstance()->save($student);
}

if (isset($_POST['create_teacher'])) {
	$teacher = rand(0, 10) % 2 == 1 ? new InternalTeacher(generateRandomString(7), generateRandomString(7)) : new ExternalTeacher(generateRandomString(7), generateRandomString(7), rand(1, 5000));
	DataService::getInstance()->save($teacher);
}

if (isset($_POST['remove_campus'])) {
	DataService::getInstance()->remove(unserialize($_SESSION["last_created"]));
}

$all = DataService::getInstance()->getAll('campus');
$allStudent = DataService::getInstance()->getAll('student');
$allTeacher = DataService::getInstance()->getAll('teacher');
?>
<html>
	<head>
		<title>Tests fonctionnelles</title>
	</head>
	<body>
		<p><strong>Campus :</strong></p>
		<form method="post" action="/">
			<input type="hidden" name="create_campus" value="1" />
			<p>nb etudiant : <input type="numeric" name="nbStudent" value="1" /></p>
			<p>nb enseignant interne : <input type="numeric" name="nbInternalTeacher" value="1" /></p>
			<p>nb enseignant externe : <input type="numeric" name="nbExternalTeacher" value="1" /></p>
			<p><input type="submit" value="Generer" /></p>
		</form>
		<form method="post" action="/">
			<input type="hidden" name="remove_campus" value="1" />
			<p><input type="submit" value="Supprimer le dernier campus" /></p>
		</form>
		<hr />
		<pre><?php echo $all;?></pre>
		<hr />
		<p><strong>Etudiants : </strong>
			<form method="post" action="/">
				<input type="hidden" name="create_student" value="1" />
				<p><input type="submit" value="Generer" /></p>
			</form>
		</p>
		<hr />
		<pre><?php echo $allStudent;?></pre>
		<hr />
		<p><strong>Professeur : </strong>
			<form method="post" action="/">
				<input type="hidden" name="create_teacher" value="1" />
				<p><input type="submit" value="Generer" /></p>
			</form>
		</p>
		<hr />
		<pre><?php echo $allTeacher;?></pre>
	</body>
</html>
