<?php
require_once "Clases.php";

$author = new Author();

if(!isset($_GET['authorid'])){
    $h1 = 'Все авторы';
    $authors = $author->showAuthorList();
    $books = '';
}
else if(isset($_GET['authorid'])){
    $h1=$author->getAuthorName(htmlspecialchars($_GET['authorid']));
    $books = $author->showAuthorBooks($_GET['authorid']);
    $authors = '';
}

require_once "template-author.php"; ?>
