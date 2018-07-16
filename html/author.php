<?php
require_once "Clases.php"; ?>

<html>
<head>
    <?php require_once "header.php"; ?>
</head>
<body>
<?php
$author = new Author();

if(!isset($_GET['authorid'])){
    echo '<h1>Все авторы</h1>';
}
else if(isset($_GET['authorid'])){
    echo '<h1>'.$author->getAuthorName(htmlspecialchars($_GET['authorid'])).'</h1>';
    $author->showAuthorBooks($_GET['authorid']);
}
?>
<?php require_once "js.php"; ?>
</body>
</html>