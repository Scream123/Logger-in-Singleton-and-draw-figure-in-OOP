<?php

//check to errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

define('ROOT', dirname(__FILE__));
//include class
require_once(ROOT . '/components/Autoloader.php');
$autoloader = new Autoloader();

$rectangle = new Rectangle('fgfg', 12);
$circle = new Circle(10);
$triangle = new Triangle('ff', 4, 8);

echo 'Площадь прямоугольника: '  . $rectangle->square()    . '<br/>';
echo 'Периметр прямоугольника: ' . $rectangle->perimeter() . '<br/>';
echo 'Площадь круга: '           . $circle->square()       . '<br/>';
echo 'Периметр круга: '          . $circle->perimeter()    . '<br/>';
echo 'Площадь треугольника: '    . $triangle->square()     . '<br/>';
echo 'Периметр треугольника: '   . $triangle->perimeter()  . '<br/>';


//singleton object call
$config = Logger::getInstance();

