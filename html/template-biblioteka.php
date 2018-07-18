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
                <?=$adress; ?>
                <?=$biblioteks; ?>
                <?=$books; ?>
            </div>
        </div>

    </div>
</section>

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