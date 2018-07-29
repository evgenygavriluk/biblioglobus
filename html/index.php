<?php
require_once "Clases.php";

$h1 = 'Главная';

$comments = new Comment();
$books = new Book();

$lastFiveComments = $comments->showLastFiveBookComments();

$bestFiveBooks = $books->showBestFiveBooks();


require_once "template-index.php"; ?>