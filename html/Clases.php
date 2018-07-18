<?php

class Biblioglobus
{
    protected $host;
    protected $db;
    protected $user;
    protected $pass;
    protected $charset;
    protected $dsn;

    protected $tableName;
    public $tableList = array();
    public $dbh;

    function __construct($tableName){
        $this->host = 'localhost';
        $this->db   = 'biblioglobus';
        $this->user = 'egavrilyuk';
        $this->pass = 'Etik53vT#*1980';
        $this->charset = 'utf8';
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $this->tableName = $tableName;

        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }

    }

    public function getTableList(){
        try{
            $result = $this->dbh->query("SELECT * FROM $this->tableName");
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC))
        {
            $this->tableList += $row;
        }
        return $this->tableList;
    }

    public function getTableCnt($tableName, $counter, $value){
        try{
            $result = $this->dbh->query("SELECT COUNT(*) FROM $tableName WHERE $counter = $value");
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }

        return $result->fetchColumn();
    }

    public function getTableField($fieldName, $fieldParam, $value){
        try{
            $result = $this->dbh->query("SELECT $fieldName FROM $this->tableName WHERE $fieldParam = $value");
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }

        return $result->fetchColumn();
    }
}

class Author extends Biblioglobus
{
    function __construct(){
        parent::__construct('author');
        // echo "Class is ready ($this->tableName)";
    }

    // Показывает список всех авторов
    public function showAuthorList(){
        $authorList = '<ul>';
        foreach($this->getTableList() as $list=>$elements){
            $authorList.='<li><a href="?authorid='.$elements['authorid'].'">'.$elements['authorname'].'</a></li>';
        }
        $authorList.='</ul>';
        return $authorList;
    }

    // Возвращает имя автора по его id
    public function getAuthorName($authorId){
        return $this->getTableField('authorname', 'authorid', htmlspecialchars($authorId));
    }

    // Показывает все книги автора с authorId = $authorId
    public function showAuthorBooks($authorId){
        $authorBooks='';
        try{
            $query = "SELECT b.bookid, b.bookname FROM book as b JOIN book_author ba ON b.bookid = ba.bookid JOIN author a ON a.authorid = ba.authorid WHERE a.authorid = $authorId";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        $authorBooks.='<ul>';
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $authorBooks.='<li><a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></li>';
        }
        $authorBooks.='</ul>';
        return $authorBooks;
    }
}

class Book extends Biblioglobus
{
    function __construct(){
        parent::__construct('book');
        //echo "Class is ready ($this->tableName)";
    }


    // Возвращает название книги с bookid = $bookid
    public function getBookName($bookid){
        return $this->getTableField('bookname', 'bookid', htmlspecialchars($bookid));
    }

    // Возвращает описание книги с bookid = $bookid
    public function getBookDescription($bookid){
        return $this->getTableField('bookdescription', 'bookid', htmlspecialchars($bookid));
    }

    // Возвращает автора(ов) книги с bookid = $bookid
    public function getBookAuthors($bookid){
        $bookAuthors = array();
        try{
            $query = "SELECT a.authorid, a.authorname FROM author as a JOIN book_author ba ON a.authorid = ba.authorid JOIN book b ON b.bookid = ba.bookid WHERE b.bookid = $bookid";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $bookAuthors += $row;
        }
        return $bookAuthors;
    }

    // Показывает автора(ов) книги с bookid = $bookid
    public function showBookAuthors($bookid){
        $authorsList = '';
        foreach($this->getBookAuthors($bookid) as $list=>$elements){
            $authorsList .= '<a href="author.php?authorid='.$elements['authorid'].'">'.$elements['authorname'].'</a>&nbsp';
        }
        return $authorsList;
    }

    // Возвращает список библиотек, в которых есть книга
    public function getBookBiblioteks($bookid){
        $bookBibliotecs = '<ul>';
        try{
            $query = "SELECT bibl.bibliotekaid, bibl.bibliotekatitle, bibl.bibliotekaadress FROM biblioteka as bibl JOIN biblioteka_book bb ON bibl.bibliotekaid = bb.bibliotekaid WHERE bb.bookid = $bookid";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $bookBibliotecs .= '<li><a href="biblioteka.php?bibliotekaid='.$elements['bibliotekaid'].'">'.$elements['bibliotekatitle'].' '.$elements['bibliotekaadress'].'</a></li>';
        }
        $bookBibliotecs .= '</ul>';
        return $bookBibliotecs;
    }

}

class Biblioteka extends Biblioglobus
{
    function __construct(){
        parent::__construct('biblioteka');
        //echo "Class is ready ($this->tableName)";
    }

    // Показывает список всех библиотек
    public function showBibliotekaList(){
        $bibliotekaList = '<ul>';
        foreach($this->getTableList() as $list=>$elements){
            $bibliotekaList.='<li><a href="?bibliotekaid='.$elements['bibliotekaid'].'">'.$elements['bibliotekatitle'].'</a> На хранении '.$this->getBibliotekaBookCnt($elements['bibliotekaid']).' книг</li>';
        }
        $bibliotekaList.= '</ul>';
        return $bibliotekaList;
    }

    // Возвращает название библиотеки по ее id
    public function getBibliotekaName($bId){
        return $this->getTableField('bibliotekatitle', 'bibliotekaid', htmlspecialchars($bId));
    }

    // Возвращает адрес библиотеки по ее id
    public function getBibliotekaAdress($bId){
        return $this->getTableField('bibliotekaadress', 'bibliotekaid', htmlspecialchars($bId));
    }

    // Возвращает количество книг в библиотеке по ее id
    public function getBibliotekaBookCnt($bId){
        return $this->getTableCnt('biblioteka_book', 'bibliotekaid', $bId);
    }

    // Показывает все находящиеся в библиотеке книги
    public function showContainBooks($bId=0){
        $book = new Book();
        $bookList='';
        try{
            $query = "SELECT b.bookid, b.bookname FROM book as b JOIN biblioteka_book bb ON bb.bookid = b.bookid WHERE bb.bibliotekaid = $bId";
            if($bId==0) {
                $query = "SELECT bookid, bookname FROM book";
            }
            $result = $this->dbh->query($query);
        } catch (PDOException $e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        $bookList.='<ul>';
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $bookList.= '<li>'.$book->showBookAuthors($elements['bookid']).'<a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></li>';
        }
        $bookList.='</ul>';
        return $bookList;
    }
}

class Comment extends Biblioglobus
{
    function __construct(){
        parent::__construct('comment');
        //echo "Class is ready ($this->tableName)";
    }

    // Возвращает все комментарии к книге
    public function getBookComments($bId){
        $bookComments = array();
        try{
            $query = "SELECT commenttext, commentraiting, commentatorname FROM comment WHERE bookid = $bId ORDER BY commentid DESC";
            $result = $this->dbh->query($query);
        } catch (PDOException $e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $bookComments += $row;
        }
        return $bookComments;
    }

    // Показывает комментарии к книге
    public function showBookComments($bookid){
        $commentList = '';
        foreach($this->getBookComments($bookid) as $list=>$elements){
            $commentList .= '<div class="commentary"><p><strong>'.$elements['commentatorname'].'</strong> поставил книге '.$elements['commentraiting'].' баллов</p><p>'.$elements['commenttext'].'</p></div>';
        }
        return $commentList;
    }

    public function setBookComment($bId, $commentText, $commentRaiting=5, $comentatorName){
        echo $bId, $commentText, $commentRaiting, $comentatorName;
        try{
            $query = "INSERT INTO comment (bookid, commenttext, commentraiting, commentatorname) VALUES ($bId, \"$commentText\", $commentRaiting, \"$comentatorName\")";
            echo $query;
            $result = $this->dbh->query($query);
        } catch (PDOException $e){
            die('Не удалось записать комментарий: ' . $e->getMessage());
        }
    }

}