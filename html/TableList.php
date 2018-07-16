<?php


class TableList
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

    public function getTableCnt($counter, $value){
        try{
            $result = $this->dbh->query("SELECT COUNT(*) FROM $this->tableName WHERE $counter = $value");
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

    // Возвращает название книги с bookid = $bookid
    public function getBookName($bookid){
        return $this->getTableField('bookname', 'bookid', htmlspecialchars($bookid));
    }

    // Показывает автора(ов) книги с bookid = $bookid
    public function showBookAuthor($bookid){
        try{
            $query = "SELECT a.authorid, a.authorname FROM author as a JOIN book_author ba ON a.authorid = ba.authorid JOIN book b ON b.bookid = ba.bookid WHERE b.bookid = $bookid";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            echo '<a href="author.php?authorid='.$elements['authorid'].'">'.$elements['authorname'].'</a>';
        }
    }

    public function getAuthorName($authorid){
        return $this->getTableField('authorname', 'authorid', htmlspecialchars($authorid));
    }

    public function showBibliotekaList(){
        $biblio = new TableList('biblioteka_book');
        foreach($this->getTableList() as $list=>$elements){
            echo '<li><a href="?bibliotekaid='.$elements['bibliotekaid'].'">'.$elements['bibliotekatitle'].'</a> на хранении: '.$biblio->getTableCnt('bibliotekaid', $elements['bibliotekaid']).' книг</li>';
        }
    }


    public function showContainBooks($bId){
        try{
            $query = "SELECT b.bookid, b.bookname, a.authorname FROM book as b JOIN biblioteka_book bb ON bb.bookid = b.bookid JOIN book_author ba ON b.bookid = ba.bookid JOIN author a ON a.authorid = ba.authorid WHERE bb.bibliotekaid = $bId";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            echo '<li><a href="book.php?bookid='.$elements['bookid'].'">'.$elements['authorname'].', '.$elements['bookname'].'</a></li>';
        }
    }


}