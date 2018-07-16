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
$bookList = new TableList('author');

if(!isset($_GET['authorid'])){
    echo '<h1>Все авторы</h1>';
}
else if(isset($_GET['authorid'])){
    echo '<h1>'.$bookList->getAuthorName(htmlspecialchars($_GET['authorid'])).'</h1>';
    $bookList->showBookAuthor(htmlspecialchars($_GET['bookid']));
}
?>
<?php require_once "js.php"; ?>
</body>
</html>