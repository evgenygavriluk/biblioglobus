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

            $statement = "SELECT COUNT(*) FROM $tableName WHERE $counter = $value";
            if($value==0) {
                   $statement = "SELECT COUNT(*) FROM $tableName";
            }
            $result = $this->dbh->query($statement);
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
        $authorList = '<ul class="list-group">';
        foreach($this->getTableList() as $list=>$elements){
            $authorList.='<li class="list-group-item"><a href="?authorid='.$elements['authorid'].'">'.$elements['authorname'].'</a></li>';
        }
        $authorList.='</ul>';
        return $authorList;
    }

    // Возвращает список авторов
    public function getAuthors($where)
    {
        $tableList = array();
        echo 'where = '.$where;

        if ($where == 0) $query = "SELECT * FROM author";
        else $query = "SELECT * FROM author AS a JOIN book_author AS ba ON a.authorid=ba.authorid JOIN biblioteka_book AS bb ON bb.bookid = ba.bookid WHERE bb.bibliotekaid=$where";
        echo 'query = '.$query;
        try {
            $result = $this->dbh->query($query);
        } catch (PDOException$e) {
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
       while($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            $tableList += $row;
        }
        return $tableList;
    }

    // Возвращает имя автора по его id
    public function getAuthorName($authorId){
        return $this->getTableField('authorname', 'authorid', htmlspecialchars($authorId));
    }

    // Возвращает 5 авторов, написавших больше всего книг
    public function getFiveAuthorsHaveMoreBooks(){
        $authorBooksCnt=array();
        try{
            $query = "SELECT a.authorid, a.authorname, a.authorimage, b.bookid FROM book as b JOIN book_author ba ON b.bookid = ba.bookid JOIN author a ON a.authorid = ba.authorid";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }

        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            if(!array_key_exists($elements['authorid'], $authorBooksCnt)) {
                $cnt = 1;

                $authorBooksCnt[$elements['authorid']] = [
                    'authorid' => $elements['authorid'],
                    'authorname' => $elements['authorname'],
                    'authorimage' => $elements['authorimage'],
                    'books' => $cnt];
            } else {
                $cnt = $authorBooksCnt[$elements['authorid']]['books'];
                $cnt++;
                $authorBooksCnt[$elements['authorid']]['books'] = $cnt;
            }
        }

        usort($authorBooksCnt, function ($item1, $item2) {
            if ($item1['books'] == $item2['books']) return 0;
            return $item1['books'] > $item2['books'] ? -1 : 1;
        });
        return array_slice($authorBooksCnt, 0, 5);
    }

    public function showFiveAuthorsHaveMoreBooks(){
        $fiveAuthorsList = '';
        foreach($this->getFiveAuthorsHaveMoreBooks() as $list=>$elements){
            $fiveAuthorsList .= '<div class="card border-secondary mb-3" style="width: 18rem;"><img class="card-img-top" src="pic/authors/'.$elements['authorimage'].'" alt="'.$elements['authorname'].'"><div class="card-body"><h5>'.$elements['authorname'].'</h5><a href="author.php?authorid='.$elements['authorid'].'" class="btn btn-primary">Об авторе</a></div></div>';
        }
        return $fiveAuthorsList;
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
        $authorBooks.='<ul class="list-group">';
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $authorBooks.='<li class="list-group-item"><a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></li>';
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

    // Возвращает всю информацию о книге
    public function getAllAboutBook($bookId){
        $bookInfo = array();
        try{
            $result = $this->dbh->query("SELECT * FROM book WHERE bookid=$bookId");
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach ($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements)
        {
            $bookInfo += $elements;
        }
        return $bookInfo;
    }

    // Возвращает название книги с bookid = $bookid
    public function getBookName($bookid){
        return $this->getTableField('bookname', 'bookid', htmlspecialchars($bookid));
    }

    // Возвращает рейтинг книги с bookid = $bookid
    public function getBookScore($bookid){
        $commentscnt = $this->getTableField('commentscnt', 'bookid', htmlspecialchars($bookid));
        $allballs = $this->getTableField('allballs', 'bookid', htmlspecialchars($bookid));
        return $allballs/$commentscnt;
    }

    // Возвращает список 5 самых рейтинговых книг
    public function getBestFiveBooks(){
        $bookScore = array();
        try{
            $result = $this->dbh->query("SELECT * FROM book");
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach ($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements)
        {
            if($elements['commentscnt']>0) {
                $score = $elements['allballs'] / $elements['commentscnt'];
            } else $score = 0;
            array_push($bookScore, ['bookid'=>$elements['bookid'], 'bookname'=>$elements['bookname'], 'bookimage'=>$elements['bookimage'],'score'=>$score]);
        }

        // Сортируем рейтинг по убыванию
        usort($bookScore, function($a, $b){
            if($a['score'] === $b['score'])
                return 0;

            return $a['score'] < $b['score'] ? 1 : -1;
        });


        return array_slice($bookScore, 0, 5);
        //return $bookScore;
    }

    // Показывает список 5 самых рейтинговых книг
    public function showBestFiveBooks(){
        $bestBooksList = '';
        foreach($this->getBestFiveBooks() as $list=>$elements){
            $bestBooksList .= '<div class="card border-secondary mb-3" style="width: 18rem;"><img class="card-img-top" src="pic/books/'.$elements['bookimage'].'" alt="'.$elements['bookname'].'"><div class="card-body"><a href="book.php?bookid='.$elements['bookid'].'" class="btn btn-primary">Перейти к книге</a></div></div>';
        }
        return $bestBooksList;
    }

    // Записывает новые параметры для рейтинга (кол-во комментариев и общий балл
    public function setBookScore($bookid, $newBall){
        $currentBookComments = $this->getTableField('commentscnt', 'bookid', htmlspecialchars($bookid));
        $newBookComments = $currentBookComments+1;

        $currentAllBalls = $this->getTableField('allballs', 'bookid', htmlspecialchars($bookid));
        $newAllBalls = $currentAllBalls+$newBall;
        try{
            $query = "UPDATE book SET commentscnt=$newBookComments, allballs=$newAllBalls WHERE bookid=$bookid";
            $result = $this->dbh->query($query);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }

    }


    // Возвращает описание книги с bookid = $bookid
    public function getBookDescription($bookid){
        return $this->getTableField('bookdescription', 'bookid', htmlspecialchars($bookid));
    }

    // Возвращает  имя файла изображения книги
    public function getBookImage($bookid){
        return $this->getTableField('bookimage', 'bookid', htmlspecialchars($bookid));
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

    // Возвращает количество книг в библиотеке по ее id - первая версия метода, без выборки по автору
    /*public function getBibliotekaBookCnt($bId){
        if($bId==0) {
            return $this->getTableCnt('book',0 , 0);
        }
        else return $this->getTableCnt('biblioteka_book', 'bibliotekaid', $bId);
    }*/

    // Возвращает количество книг в библиотеке по ее id и id автора
    public function getBibliotekaBookCnt($bId, $authorId){
        try{
            if($bId==0 and $authorId==0) $statement = "SELECT COUNT(*) FROM book";
            if($bId==0 and $authorId>0)  $statement = "SELECT COUNT(*) FROM book AS b JOIN book_author ba ON ba.bookid = b.bookid WHERE ba.authorid = $authorId";
            if($bId>0  and $authorId==0) $statement = "SELECT COUNT(*) FROM biblioteka_book WHERE bibliotekaid = $bId";
            if($bId>0  and $authorId>0)  $statement = "SELECT COUNT(*) FROM biblioteka_book AS bb JOIN author a ON a.bookid = bb.bookid WHERE bibliotekaid = $bId AND authorid=$authorId";
            echo $statement;

            $result = $this->dbh->query($statement);
        } catch (PDOException$e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }

        return $result->fetchColumn();

    }

    // Показывает все находящиеся в библиотеке книги
    public function showContainBooks($bId=0, $curPage=1, $elementsPerPage=5, $authorId=0){
        $book = new Book();
        $rangeStart = $curPage*$elementsPerPage-$elementsPerPage;
        $bookList='';
        try{
            if($bId>0 and $authorId==0)  $query = "SELECT b.bookid, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM book as b JOIN biblioteka_book bb ON bb.bookid = b.bookid JOIN thema t ON t.themaid = b.bookthema WHERE bb.bibliotekaid = $bId LIMIT $elementsPerPage OFFSET $rangeStart";
            if($bId==0 and $authorId==0) $query = "SELECT b.bookid, b.bookname, b.bookpublicyear, b.bookimage, b.commentscnt, b.allballs, t.themaname FROM book as b JOIN thema t ON t.themaid = b.bookthema LIMIT $elementsPerPage OFFSET $rangeStart";


            $result = $this->dbh->query($query);
        } catch (PDOException $e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }

        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $score = ($elements['allballs']>0 && $elements['commentscnt']>0)? (float)$elements['allballs']/$elements['commentscnt'] : 'Отзывов пока нет';
            $bookList.= '<tr><td><img src="pic/books/'.$elements['bookimage'].'" width="50px"></td><td>'.$book->showBookAuthors($elements['bookid']).'</td><td><a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></td><td>'.$elements['bookpublicyear'].'</td><td>'.$elements['themaname'].'</td><td>'.$score.'</td></tr>';
        }
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
            $commentList .= '<div class="commentary alert alert-info""><p><strong>'.$elements['commentatorname'].'</strong> поставил книге '.$elements['commentraiting'].' баллов</p><em>'.$elements['commenttext'].'</em></div>';
        }
        return $commentList;
    }

    public function setBookComment($bId, $commentText, $commentRaiting=10, $comentatorName){
        try{
            $query = "INSERT INTO comment (bookid, commenttext, commentraiting, commentatorname) VALUES ($bId, \"$commentText\", $commentRaiting, \"$comentatorName\")";
            $result = $this->dbh->query($query);
            $book = new Book();
            $book->setBookScore($bId, $commentRaiting);
        } catch (PDOException $e){
            die('Не удалось записать комментарий: ' . $e->getMessage());
        }
    }

    public function getLastFiveBookComments(){
        $bookComments = array();
        try{
            $query = "SELECT c.commenttext, c.commentraiting, c.commentatorname, b.bookid, b.bookname FROM comment as c JOIN book b ON c.bookid=b.bookid ORDER BY commentid DESC";
            $result = $this->dbh->query($query);
        } catch (PDOException $e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $bookComments += $row;
        }
        return $bookComments;
    }

    public function showLastFiveBookComments(){
        $commentList ='';
        foreach($this->getLastFiveBookComments() as $list=>$elements){
            $commentList .= '<div class="card border-secondary mb-3" style="max-width: 18rem;"><div class="card-header">'.$elements['commentatorname'].' прокомментировал книгу <a href="book.php?bookid='.$elements['bookid'].'">'.$elements['bookname'].'</a></div><div class="card-body"><p class="card-text">'.$elements['commenttext'].'</p><small>Поставил баллов: '.$elements['commentraiting'].'</small></div></div>';

        }
        return $commentList;
    }

}