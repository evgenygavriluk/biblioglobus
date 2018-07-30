<?php
require_once "Clases.php";

$h1 = 'Главная';

$comments = new Comment();
$books = new Book();
$author = new Author();

$lastFiveComments = $comments->showLastFiveBookComments();

$bestFiveBooks = $books->showBestFiveBooks();

$popularAuthors = $author->showFiveAuthorsHaveMoreBooks();

require_once "template-index.php"; ?>