#biblioglobus.com

##Описание проекта

Сайт гипотетической библиотечной сети, позволяющий просматривать информацию о книгах, хранящихся в фондах и авторах.

1. index.php - "главная страница". Отображает рейтинг 5 самых комментируемых книг, 5 авторов, написавших больше всего книг и 5 последних комментариев.
Состоит из index.php и шаблона template-index.php

2. biblioteka.php - страница "Библиотеки". Работает в двух режимах, с параметром bibliotekaid и без параметров. В последнем случае отображается список всех библиотек сети с возможностью перехода на страницу конкретной библиотеки (Например: biblioteka.php/?bibliotekaid=2).
В режиме с параметром (Например: bibliotekaid=3) отображается таблица со списком книг, хранящихся в фондах данного филиала. Для упращения работы со списком доступна паджинация (разбиение списка на страницы) и фильтр по автору.
Состоит из biblioteka.php и шаблона template-biblioteka.php
В шаблоне подключается модуль формирования таблицы книг booktable.php

3. book.php - страница "Книги". Работает в двух режимах, с параметром bookid и без параметров. В последнем случае отображается список всех книг, хранящихся в фондах всех библиотек сети с возможностью перехода на страницу конкретной книги (Например: book.php/?bookid=7).
В режиме с параметром (Например: bookid=2) отображается информация о книге, с возможностью перехода на страницу автора(ов) и список библиотек, в фондах которых эта книга доступна.
Состоит из book.php и шаблона template-book.php
В шаблоне подключается модуль формирования таблицы книг booktable.php


##Структура папок и файлов

/ - 
    /js  - 
    /css - 
    /pic - изображения, используемые в проекте
        /authors - изображения авторов
        /books   - изображения обложек книг

##База данных

Для работы проекта используется база данных biblioglobus.sql, дамп находится в корне
        host = 'localhost';
        db   = 'biblioglobus';
        user = 'egavrilyuk';
        pass = 'Etik53vT#*1980';
        charset = 'utf8';

Содержит следующие таблицы и поля
        
###author - таблица авторов

Column	    | Type
------------------------------------
authorid	| int(10) Auto Increment	 
authorname	| varchar(70)	 
authorimage	| varchar(35)	  


###biblioteka - таблица библиотек

Column	         | Type	
-------------------------------------
bibliotekaid	 | int(2) Auto Increment	 
bibliotekatitle	 | varchar(30)	 
bibliotekaadress | varchar(100)	  

###book - таблица книг

Column	        | Type
---------------------------------------
bookid	        | int(10) Auto Increment	 
bookname	    | varchar(100)	 
bookpublicyear  | year(4)	 
bookpages	    | int(4)	 
bookthema	    | int(3)	 
bookdescription	| varchar(1000) NULL	 
bookimage	    | varchar(20)	 
commentscnt	    | int(10) unsigned NULL	 
allballs	    | int(10) unsigned NULL	  

###comment - таблица комментариев

Column	        | Type
---------------------------------------
commentid	    | int(10) Auto Increment	 
bookid	        | int(10)	 
commenttext	    | varchar(2000)	 
commentraiting	| int(10) unsigned NULL	 
commentatorname	| varchar(50) NULL	  

###thema - таблица жанров

Column	  | Type
---------------------------------
themaid	  | int(2) Auto Increment	 
themaname | varchar(30)	  


###biblioteka_book
###book_author
###book_thema
        
        

##Классы и методы 

class Biblioglobus

    getTableList()

    getTableCnt($tableName, $counter, $value)

    getTableField($fieldName, $fieldParam, $value)



class Author - класс для работы с объектом Автор

    getAuthorsCnt() - 

    showAuthorList($curPage, $elementsPerPage, $sortRule=0) - Показывает список авторов с разбиением на страницы по $elementsPerPage количеству элементов на странице с сортировкой по имени (А->Я $sortRule=0, Я->А $sortRule=0).

    getAuthors($where) - Возвращает список авторов. $where=0 - во всех библиотеках, $where>0 - в библиотеке с id=номер библиотеки.

    getAuthorName($authorId) - Возвращает имя автора по его id.

    getFiveAuthorsHaveMoreBooks() - Возвращает 5 авторов, написавших больше всего книг.

    showFiveAuthorsHaveMoreBooks() - Показывает 5 авторов, написавших больше всего книг.

    showAuthorBooks($authorId) -  Показывает все книги автора $authorId.


class Book - класс для работы с объектом Книга

    getAllAboutBook($bookId) - Возвращает всю информацию о книге.
   
    getBookName($bookid) - Возвращает название книги по ее bookid.

    getBookScore($bookid) - Возвращает рейтинг книги по ее bookid.

    getBestFiveBooks() - Возвращает список 5 самых рейтинговых книг.

    showBestFiveBooks() - Показывает список 5 самых рейтинговых книг.

    setBookScore($bookid, $newBall) - Записывает в базу новые параметры для рейтинга (кол-во комментариев и общий балл).
    
    getBookDescription($bookid) - Возвращает описание книги по ее bookid.

    getBookImage($bookid) - Возвращает  имя файла изображения книги по ее bookid.

    getBookAuthors($bookid) - Возвращает автора(ов) книги по ее bookid.

    showBookAuthors($bookid) - Показывает автора(ов) книги по ее bookid.

    getBookBiblioteks($bookid) - Возвращает список библиотек, в которых есть книга.


class Biblioteka - класс для работы с объектом Библиотека

    showBibliotekaList() - Показывает список всех библиотек.

    getBibliotekaName($bId) - Возвращает название библиотеки по ее id.

    getBibliotekaAdress($bId) - Возвращает адрес библиотеки по ее id.

    getBibliotekaBookCnt($bId=0, $authorId=0) - Возвращает количество книг в библиотеке по ее id и id автора.

    showContainBooks($bId=0, $curPage=1, $elementsPerPage=5, $authorId=0, $reitingSort=0) - Показывает все находящиеся в библиотеке книги с разбиением на страницы по $elementsPerPage количеству элементов на странице с фильтром по автору и сортировкой по рейтингу.



class Comment - класс для работы с объектом Комментарий

    getBookComments($bId) - Возвращает все комментарии к книге

    showBookComments($bookid) - Показывает комментарии к книге

    setBookComment($bId, $commentText, $commentRaiting=10, $comentatorName)

    getLastFiveBookComments() - Возвращает список 5 последних комментариев.

    showLastFiveBookComments() - Показывает список 5 последних комментариев.
