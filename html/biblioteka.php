<?php
require_once "Clases.php";
$adress='';
$books='';
$biblioteks = '';

$biblioteka = new Biblioteka();

if(!isset($_GET['bibliotekaid'])){
    $h1 = 'Библиотеки объединения "Библиоглобус"';
    $biblioteks = $biblioteka->showBibliotekaList();
}
else if(isset($_GET['bibliotekaid'])){
    $h1 = $biblioteka->getBibliotekaName($_GET['bibliotekaid']);
    $adress = $biblioteka->getBibliotekaAdress($_GET['bibliotekaid']);
    $books = $biblioteka->showContainBooks(htmlspecialchars($_GET['bibliotekaid']));
}

require_once "template-biblioteka.php"; ?>
