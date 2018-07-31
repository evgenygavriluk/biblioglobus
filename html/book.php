<?php
require_once "Clases.php";
$authors = '';
$description ='';
$books = '';

$book = new Book();
$comment = new Comment();
$author = new Author();

if(!isset($_GET['bookid'])){
    $h1 = 'Все книги объединения "Библиоглобус"';
    $allBiblioteka = new Biblioteka();

    $elementsPerPage = 2;

    if(!isset($_GET['page'])){
        $firstPage = 1;
        $currentPage = 1;
    } else {
        $firstPage = 1;
        $currentPage = (int)$_GET['page'];
    }
    if(!isset($_GET['author'])){
        $authorid = 0;
    } else {
        $authorid = (int)$_GET['author'];
    }
    if ((int)($allBiblioteka->getBibliotekaBookCnt(0, $authorid)%$elementsPerPage) ==0) $allPages = (int)($allBiblioteka->getBibliotekaBookCnt(0,$authorid)/$elementsPerPage);
    else $allPages = (int)($allBiblioteka->getBibliotekaBookCnt(0,$authorid)/$elementsPerPage)+1;
    if ($currentPage<1 || $currentPage>$allPages) $currentPage = 1;
    $books = $allBiblioteka->showContainBooks(0, $currentPage, $elementsPerPage, $authorid);
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
