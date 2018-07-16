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
    $bibliotekaList = new TableList('biblioteka');

if(!isset($_GET['bibliotekaid'])){
    echo '<h1>Библиотеки объединения "Библиоглобус"</h1>';
    ?>

    <ul>
    <?php
    $bibliotekaList->showBibliotekaList();
    ?>
    </ul>
<?php
}
else if(isset($_GET['bibliotekaid'])){
    echo '<h1>'.$bibliotekaList->getTableField('bibliotekatitle', 'bibliotekaid', htmlspecialchars($_GET['bibliotekaid'])).'</h1>';
    echo '<p>'.$bibliotekaList->getTableField('bibliotekaadress', 'bibliotekaid', htmlspecialchars($_GET['bibliotekaid'])).'</p>';

    $bibliotekaList->showContainBooks(htmlspecialchars($_GET['bibliotekaid']));

}
?>
    <?php require_once "js.php"; ?>
    </body>
</html>