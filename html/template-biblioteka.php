<?php require_once "header.php"; ?>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>
                    <?=$h1;?>
                </h1>
                <?=$adress; ?>
                <?=$biblioteks; ?>

                <?php if(!$books==''): ?>
                    <table id="table" class="table table-bordered table-hover" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                        <thead>
                        <tr>
                            <th data-field="author" data-sortable="true">Обложка</th>
                            <th data-field="author" data-sortable="true">Автор</th>
                            <th data-field="book" data-filter-control="input" data-sortable="true">Книга</th>
                            <th data-field="year" data-filter-control="select" data-sortable="true">Год</th>
                            <th data-field="year" data-filter-control="select" data-sortable="true">Жанр</th>
                            <th data-field="year" data-filter-control="select" data-sortable="true">Рейтинг</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?=$books; ?>

                        </tbody>
                    </table>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>

<?php require_once "footer.php"; ?>