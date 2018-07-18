<?php
require_once "Clases.php";

$biblioteka = new Biblioteka();

if(!isset($_GET['bibliotekaid'])){
    $h1 = 'Библиотеки объединения "Библиоглобус"';
    $adress='';
    $biblioteks = $biblioteka->showBibliotekaList();
    $books='';
}
else if(isset($_GET['bibliotekaid'])){
    $h1 = $biblioteka->getBibliotekaName($_GET['bibliotekaid']);
    $adress = $biblioteka->getBibliotekaAdress($_GET['bibliotekaid']);
    $biblioteks = '';

    $books = $biblioteka->showContainBooks(htmlspecialchars($_GET['bibliotekaid']));

}

require_once "template-biblioteka.php"; ?>
