<?php
require_once "Clases.php";

if(!isset($_POST['bookid']) ){
    header('Location: http://biblioglobus.com/book.php');
    exit;
}
else {
    $file = fopen("sendcomment.log","a+");

    $comment = new Comment();
    $validError = array();
    $bookid = (integer) htmlspecialchars($_POST['bookid']);
    $bookcomment = htmlspecialchars($_POST['bookcomment']);
    $commentraiting = (integer)($_POST['commentraiting']);
    $bookcommentauthor = htmlspecialchars($_POST['bookcommentauthor']);

    if($bookid<1){
        $validError+= ["bookid" => 'invalid_bookid'];
    }

    if(strlen($bookcomment)<5){
        $validError+= ['bookcomment' =>'comment_length_less_five'];
    }


    if(strlen($bookcomment)>2000){
        $validError+= ['bookcommen' =>'length_toobig'];

    }

    if($commentraiting<1 || $commentraiting>10){
        $validError+=['commentraiting'=>'invalid_raiting'];
    }

    if(strlen($bookcommentauthor)<2){
        $validError+=['bookcommentauthor'=>'name_less_two'];
    }

    if(ctype_digit($bookcommentauthor{0})){
        $validError+=['bookcommentauthor'=>'first_char_is_not_char'];
    }


    fwrite($file, implode($_POST));
    fwrite($file, implode($validError));

    if(empty($validError)) {
        $comment->setBookComment($bookid, $bookcomment, $commentraiting, $bookcommentauthor);
        $validOk = ['sendcomment'=>'ok'];
        echo json_encode($validOk);
    }
    else{
        echo json_encode($validError);
    }
    fclose($file);
}