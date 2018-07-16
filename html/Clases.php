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

    // Возвращает имя автора по его id
    public function getAuthorName($authorId){
        return $this->getTableField('authorname', 'authorid', htmlspecialchars($authorId));
    }

    // Показывает все книги автора с authorId = $authorId
    public function showAuthorBooks($authorId){
        try{
            $query = "SELECT b.bookid, b.bookname FROM book as b JOIN book_author ba ON b.bookid = ba.bookid JOIN author a ON a.authorid = ba.authorid WHERE a.authorid = $authorId";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            echo '<a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a>';
        }
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
        foreach($this->getBookAuthors($bookid) as $list=>$elements){
            echo '<a href="author.php?authorid='.$elements['authorid'].'">'.$elements['authorname'].'</a>';
        }
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
        //var_dump($this->getTableList());
        foreach($this->getTableList() as $list=>$elements){
            echo '<li><a href="?bibliotekaid='.$elements['bibliotekaid'].'">'.$elements['bibliotekatitle'].'</a> На хранении '.$this->getBibliotekaBookCnt($elements['bibliotekaid']).' книг</li>';
        }
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
    public function showContainBooks($bId){
        $book = new Book();
        try{
        //  $query = "SELECT b.bookid, b.bookname, a.authorname FROM book as b JOIN biblioteka_book bb ON bb.bookid = b.bookid JOIN book_author ba ON b.bookid = ba.bookid JOIN author a ON a.authorid = ba.authorid WHERE bb.bibliotekaid = $bId";
            $query = "SELECT b.bookid, b.bookname FROM book as b JOIN biblioteka_book bb ON bb.bookid = b.bookid WHERE bb.bibliotekaid = $bId";

            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        echo '<ul>';
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            echo '<li>'.$book->showBookAuthors($elements['bookid']).'<a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></li>';
        }
        echo '</ul>';
    }
}