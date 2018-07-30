<?php require_once "header.php"; ?>

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h1>
                        <?=$h1;?>
                    </h1>
                </div>
            </div>

        </div>
    </section>
    <section id="best_books">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2>
                        Лучшие книги
                    </h2>
                    <div class="card-deck">
                        <?=$bestFiveBooks;?>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section id="popular_authors">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2>
                        Авторы многокнижцы
                    </h2>

                    <div class="card-deck">
                        <?=$popularAuthors ;?>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section id="last_comments">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2>
                        Последние отзывы
                    </h2>
                    <div class="card-deck">
                        <?=$lastFiveComments;?>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php require_once "footer.php"; ?>