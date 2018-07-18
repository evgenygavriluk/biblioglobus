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
    $h1 = $book->getBookName($_GET['bookid']);
    $authors = $book->showBookAuthors(htmlspecialchars($bId));
    $description = $book->getBookDescription(htmlspecialchars($bId));
    $books = '';
    $bibliotecs = $book->getBookBiblioteks($bId);
    $comments = $comment->showBookComments($bId);

}

require_once "template-book.php"; ?>
