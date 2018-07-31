<?php require_once "header.php"; ?>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>
                    <?=$h1;?>
                </h1>
                <?=$books; ?>

<?php if(!isset($_GET['authorid'])):?>
                <table id="table" class="table table-bordered table-hover" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="author" data-sortable="true">Авторы</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?=$authors; ?>
                    </tbody>
                </table>
                <nav aria-label="books">
                    <ul class="pagination justify-content-center">
                        <?php
                        if($_SERVER['SCRIPT_NAME']=='/author.php'){
                            $href = '?page=';
                        }

                        if ($currentPage > $firstPage){
                            echo '<li class="page-item"><a class="page-link" href="'.$href, ($currentPage-1).'">Предыдущая</a></li>';
                        }

                        for($i=$firstPage; $i<=$allPages; $i++){
                            $active='';
                            if($i==$currentPage) $active ='active';
                            echo '<li class="page-item '.$active.'"><a class="page-link" href="'.$href, $i.'">'.$i.'</a></li>';
                        }
                        if(($currentPage)<$allPages) {
                            echo '<li class="page-item"><a class="page-link" href="'.$href, ($currentPage + 1) . '">Следующая</a></li>';
                        }

                        ?>
                    </ul>
                </nav>
<?php endif ?>

            </div>
        </div>

    </div>
</section>

<?php require_once "footer.php"; ?>