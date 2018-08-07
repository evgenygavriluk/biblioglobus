<?php
session_start();
require_once "Clases.php";

//echo 'userid = '.$_SESSION['userid'];
$h1 = 'Главная';

if(!isset($_SESSION['userid']))
{
    require_once "authorization-form.php";
}
else {

    $comments = new Comment();
    $books = new Book();
    $author = new Author();

    $lastFiveComments = $comments->showLastFiveBookComments();

    $bestFiveBooks = $books->showBestFiveBooks();

    $popularAuthors = $author->showFiveAuthorsHaveMoreBooks();

    require_once "template-index.php";
}
?>