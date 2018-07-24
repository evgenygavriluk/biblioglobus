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
    //$books = $biblioteka->showContainBooks(htmlspecialchars($_GET['bibliotekaid']));


    $elementsPerPage = 2;

    if(!isset($_GET['page'])){
        $firstPage = 1;
        $currentPage = 1;
    } else {
        $firstPage = 1;
        $currentPage = $_GET['page'];
    }

    $books = $biblioteka->showContainBooks($_GET['bibliotekaid'], $currentPage, $elementsPerPage);
    $allPages = (int)($biblioteka->getBibliotekaBookCnt($_GET['bibliotekaid'])/$elementsPerPage)+1;
}

require_once "template-biblioteka.php"; ?>
