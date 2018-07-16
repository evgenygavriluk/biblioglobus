<?php
require_once "Clases.php"; ?>

<html>
    <head>
        <?php require_once "header.php"; ?>
    </head>
    <body>
<?php
    $biblioteka = new Biblioteka();

if(!isset($_GET['bibliotekaid'])){
    echo '<h1>Библиотеки объединения "Библиоглобус"</h1>';
    ?>

    <ul>
    <?php
    $biblioteka->showBibliotekaList();
    ?>
    </ul>
<?php
}
else if(isset($_GET['bibliotekaid'])){
    echo '<h1>'.$biblioteka->getBibliotekaName($_GET['bibliotekaid']).'</h1>';
    echo '<p>'. $biblioteka->getBibliotekaAdress($_GET['bibliotekaid']).'</p>';

    $biblioteka->showContainBooks(htmlspecialchars($_GET['bibliotekaid']));

}
?>
    <?php require_once "js.php"; ?>
    </body>
</html>