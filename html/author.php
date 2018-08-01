<?php
require_once "Clases.php";
$books = '';
$authors = '';

$author = new Author();

if(!isset($_GET['authorid'])){
    $h1 = 'Все авторы';

    $elementsPerPage = 2;

    if(!isset($_GET['page'])){
        $firstPage = 1;
        $currentPage = 1;
    } else {
        $firstPage = 1;
        $currentPage = (int)$_GET['page'];
    }

    if ((int)($author->getAuthorsCnt()%$elementsPerPage) ==0) $allPages = (int)($author->getAuthorsCnt()/$elementsPerPage);
    else $allPages = (int)($author->getAuthorsCnt()/$elementsPerPage)+1;
    if ($currentPage<1 || $currentPage>$allPages) $currentPage = 1;
    if(isset($_GET['sort_type'])) $sortRule = $_GET['sort_type'];
    else $sortRule = 0;
    $authors = $author->showAuthorList($currentPage, $elementsPerPage, $sortRule);
}
else if(isset($_GET['authorid'])){
    $h1=$author->getAuthorName(htmlspecialchars($_GET['authorid']));
    $books = $author->showAuthorBooks($_GET['authorid']);
}

require_once "template-author.php";
?>
