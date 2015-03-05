<?php

//Se requiere el fichero con las clases Gato y Vaca para las pruebas
require 'clases.php';
//Se requiere el fichero con el método que se usa para ordenar objetos
require '../utils.php';



$gato1 = new Gato(13);
$gato2 = new Gato(13.21);
$gato3 = new Gato(12.5);
$gato4 = new Gato(10);
$vaca1 = new Vaca(6);
$vaca2 = new Vaca(4.7);

$gato1->setNombre('Albondiga');
$gato1->setColor('Amarillo');
$gato2->setNombre('Levenshtein');
$gato2->setPeso(5);
$gato3->setNombre('Algore');
$gato3->setColor('Gris');
$gato3->setPeso(7);
$gato4->setPeso(5.2);


echo '<pre>';
$prueba_1 = $array = array($gato1, $gato2, $gato3, $gato4);
$prueba_2 = $array;
$prueba_3 = $array;
$prueba_4 = array($gato1, $gato2, $vaca1, $vaca2);

//Ordena objetos de tipo Gato
$ordenar_por = 'edad';
$resultado = Utils::ordena_objetos($prueba_1, $ordenar_por);
echo "<h2>Ordenar por: <i>{$ordenar_por}</i> ascendente.</h2>";
var_dump($resultado); echo '<hr>';

//Ordena objetos de tipo Gato
$ordenar_por = 'peso';
$resultado = Utils::ordena_objetos($prueba_2, $ordenar_por, FALSE);
echo "<h2>Ordenar por: <i>{$ordenar_por}</i> descendente.</h2>";
var_dump($resultado); echo '<hr>';

//Ordena objetos de tipo Gato
$ordenar_por = 'color';
$resultado = Utils::ordena_objetos($prueba_3, $ordenar_por, FALSE);
echo "<h2>Ordenar por: <i>{$ordenar_por}</i> descendente.</h2>";
var_dump($resultado); echo '<hr>';

//Ordena dos tipos de objetos: objetos Gato y objetos Vaca
$ordenar_por = 'edad';
$resultado = Utils::ordena_objetos($prueba_4, $ordenar_por);
echo "<h2>Ordenar por: <i>{$ordenar_por}</i> ascendente.</h2>";
var_dump($resultado); echo '<hr>';