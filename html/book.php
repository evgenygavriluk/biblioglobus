<?php
require_once "Clases.php"; ?>

<html>
<head>
    <?php require_once "header.php"; ?>
</head>
<body>
<?php
$book = new Book();

if(!isset($_GET['bookid'])){
    echo '<h1>Все книги объединения "Библиоглобус"</h1>';
    ?>

<?php
}
else if(isset($_GET['bookid'])){
    echo '<h1>'.$book->getBookName($_GET['bookid']).'</h1>';
    $book->showBookAuthors(htmlspecialchars($_GET['bookid']));
}
?>
<?php require_once "js.php"; ?>
</body>
</html>