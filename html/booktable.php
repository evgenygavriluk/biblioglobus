<table id="table" class="table table-bordered table-hover" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    <thead>
    <tr>
        <th data-field="author" data-sortable="true">Обложка</th>
        <th data-field="author" data-sortable="true">Автор</th>
        <th data-field="book" data-filter-control="input" data-sortable="true">Книга</th>
        <th data-field="year" data-filter-control="select" data-sortable="true">Год</th>
        <th data-field="year" data-filter-control="select" data-sortable="true">Жанр</th>
        <th data-field="score" data-filter-control="select" data-sortable="true">
            <form id="sort_form" name="sort_form" action="" method="get">
                <?php if(isset($_GET['page'])): ?>
                    <input type="hidden" name="page" value="<?=(isset($_GET['page']))? $_GET['page']: '';?>">
                <?php endif; ?>
                <?php if(isset($_GET['bibliotekaid'])): ?>
                    <input type="hidden" name="bibliotekaid" value="<?=$_GET['bibliotekaid'];?>">
                <?php endif;?>
                <?php if(isset($_GET['author'])): ?>
                    <input type="hidden" name="author" value="<?=(isset($_GET['author']))? $_GET['author']:'';?>">
                <?php endif;?>


                <label for="sort_type" id="sort"><i class="fa fa-sort"></i>Рейтинг</label>
                <input id="sort_type" name="sort_type" type="hidden" value="<?=(isset($_GET['sort_type']))? $_GET['sort_type']: 0;?>">
            </form>

        </th>
    </tr>
    </thead>
    <tbody>
    <?=$books; ?>
    </tbody>
</table>
<nav aria-label="books">
    <ul class="pagination justify-content-center">
        <?php

            if($_SERVER['SCRIPT_NAME']=='/biblioteka.php'){
                $params = explode('&', $_SERVER['QUERY_STRING']);

                $href = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?'.$params[0].'&page=';
            }
            if($_SERVER['SCRIPT_NAME']=='/book.php'){
                    $href = '?page=';
            }
            if(isset($_GET['sort_type'])) {
                $sort = '&sort_type'.$_GET['sort_type'];
            }
            else $sort='';

            if ($currentPage > $firstPage){
                echo '<li class="page-item"><a class="page-link" href="'.$href, ($currentPage-1), $sort.'">Предыдущая</a></li>';
            }

            for($i=$firstPage; $i<=$allPages; $i++){
                $active='';
                if($i==$currentPage) $active ='active';
                echo '<li class="page-item '.$active.'"><a class="page-link" href="'.$href, $i, $sort.'">'.$i.'</a></li>';
            }
            if(($currentPage)<$allPages) {
                echo '<li class="page-item"><a class="page-link" href="'.$href, ($currentPage + 1), $sort .'">Следующая</a></li>';
            }

         ?>
    </ul>
</nav>