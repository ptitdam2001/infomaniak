<?php
require '../vendor/autoload.php';

print_r($_SERVER);



$loader = new Twig_Loader_Filesystem('../app/View/');
$twig = new Twig_Environment($loader, array());

echo $twig->render('campus/list.html', array('name' => 'Fabien'));
