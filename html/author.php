<?php
require_once "Clases.php";
$books = '';
$authors = '';

$author = new Author();

if(!isset($_GET['authorid'])){
    $h1 = 'Все авторы';
    $authors = $author->showAuthorList();
}
else if(isset($_GET['authorid'])){
    $h1=$author->getAuthorName(htmlspecialchars($_GET['authorid']));
    $books = $author->showAuthorBooks($_GET['authorid']);
}

require_once "template-author.php";
?>
