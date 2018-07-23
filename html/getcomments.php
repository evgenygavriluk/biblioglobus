<?php
require_once "Clases.php";

if(!isset($_POST['bookid']) ){
    header('Location: http://biblioglobus.com/book.php');
    exit;
}
else {
    $comment = new Comment();
    echo $comment->showBookComments(htmlspecialchars($_POST['bookid']));
}