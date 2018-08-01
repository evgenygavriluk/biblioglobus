#biblioglobus.com

Учебный проект сайта гипотетической библиотечной сети

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
        
author - 
biblioteka -
book -
comment -
thema -

biblioteka_book
book_author
book_thema
        
        

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
