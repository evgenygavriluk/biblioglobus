<?php

ini_set('display_errors','On');
error_reporting('E_ALL');
//phpinfo();
require_once "TableList.php"; ?>

<html>
<head>
    <?php require_once "header.php"; ?>
</head>
<body>
<?php
$bookList = new TableList('book');

if(!isset($_GET['bookid'])){
    echo '<h1>Все книги объединения "Библиоглобус"</h1>';
    ?>

<?php
}
else if(isset($_GET['bookid'])){
    echo '<h1>'.$bookList->getBookName(htmlspecialchars($_GET['bookid'])).'</h1>';
    $bookList->showBookAuthor(htmlspecialchars($_GET['bookid']));
}
?>
<?php require_once "js.php"; ?>
</body>
</html>