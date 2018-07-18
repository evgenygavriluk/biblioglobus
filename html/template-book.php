<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title><?='biblioglobus.com '.$h1;?></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
        h1{text-align: center;}
    </style>
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                Городское библиотечное объединение "Библиоглобус"
                <form action="search.php" method="get">
                    <input type="text" name="booksearch" />
                    <button>Поиск</button>
                </form>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>
                    <?=$h1;?>
                </h1>
                <?=$books; ?>
            </div>
        </div>
<?php if(!$authors==''):?>
        <div class="row justify-content-center">
            <div class="col-lg-6 justify-content-center">
                <img src="pic/books/<?=$bookImage;?>" class="bg-book-image">
            </div>
            <div class="col-lg-6">
                <?='Автор: '.$authors; ?>
                <?='<p class="description">'.$description.'</p>'; ?>
                <?='Вы можете взять эту книгу в наших филиалах:'.$bibliotecs; ?>
            </div>
        </div>
<?php endif; ?>
    </div>
</section>

<?php if(!$authors==''):?>
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2>Читали? Оставьте отзыв о книге</h2>
                <form name="commentform" action="" method="post">
                    <label for="bookcommentauthor">Ваше имя:</label>
                    <input type="text" id="bookcommentauthor" name="bookcommentauthor" class="form-control">
                    <label for="bookcomment">Отзыв:</label>
                    <textarea id="bookcomment" name="bookcomment" class="form-control"></textarea>
                    <label for="commentraiting">Какую оценку поставите книге?</label>
                    <select id="commentraiting" name="commentraiting">
                        <option value="5">5 баллов</option>
                        <option value="4">4 балла</option>
                        <option value="3">3 балла</option>
                        <option value="2">2 балла</option>
                        <option value="1">1 балл</option>
                    </select>
                    <input type="hidden" name="bookid" value="<?=$_GET['bookid'];?>" />
                    <input type="submit" name="sendcomment" class="btn btn-primary form-control" value="Отправить отзыв" />
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
               <?=$comments;?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<footer class="navbar-fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 justify-content-center">
                <p class="text-center">biblioglobus.com</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>