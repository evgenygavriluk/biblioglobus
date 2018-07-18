<?php
require_once "Clases.php";

$book = new Book();
$comment = new Comment();

if(isset($_POST['sendcomment'])){
    echo $_POST['bookid'], $_POST['bookcomment'], $_POST['commentraiting'], $_POST['bookcommentauthor'];
    $comment->setBookComment($_POST['bookid'], $_POST['bookcomment'], $_POST['commentraiting'], $_POST['bookcommentauthor']);
}

if(!isset($_GET['bookid'])){
    $h1 = 'Все книги объединения "Библиоглобус"';
    $authors = '';
    $description ='';
    $allBiblioteka = new Biblioteka();
    $books = $allBiblioteka->showContainBooks();
    ?>

<?php
}
else if(isset($_GET['bookid'])){

    $bId = $_GET['bookid'];

    $thisBook = $book->getAllAboutBook($bId);
    $h1 = $thisBook['bookname'];
    $bookImage = $thisBook['bookimage'];
    $description = $thisBook['description'];
    $authors = $book->showBookAuthors($bId);
    $books = '';
    $bibliotecs = $book->getBookBiblioteks($bId);
    $comments = $comment->showBookComments($bId);
}

require_once "template-book.php"; ?>
