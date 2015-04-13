<?php

require '../vendor/autoload.php';

echo '<pre>';
print_r($_SERVER);
echo '</pre>';



$loader = new Twig_Loader_Filesystem('../app/View/');
$twig = new Twig_Environment($loader, array());

echo $twig->render('campus/list.html', array('name' => 'Fabien'));
