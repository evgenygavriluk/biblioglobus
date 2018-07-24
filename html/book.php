<?php
require_once "Clases.php";
$authors = '';
$description ='';
$books = '';

$book = new Book();
$comment = new Comment();

if(!isset($_GET['bookid'])){
    $h1 = 'Все книги объединения "Библиоглобус"';
    $allBiblioteka = new Biblioteka();

    $elementsPerPage = 2;

    if(!isset($_GET['page'])){
        $firstPage = 1;
        $currentPage = 1;
    } else {
        $firstPage = 1;
        $currentPage = $_GET['page'];
    }

    $books = $allBiblioteka->showContainBooks(0, $currentPage, $elementsPerPage);

    $allPages = (int)($allBiblioteka->getBibliotekaBookCnt(0)/$elementsPerPage)+1;
}
else if(isset($_GET['bookid'])){
    $bId = $_GET['bookid'];
    $thisBook = $book->getAllAboutBook($bId);
    $h1 = $thisBook['bookname'];
    $bookImage = $thisBook['bookimage'];
    $description = $thisBook['bookdescription'];
    $authors = $book->showBookAuthors($bId);
    $bibliotecs = $book->getBookBiblioteks($bId);
    $comments = $comment->showBookComments($bId);
}

require_once "template-book.php";
?>
