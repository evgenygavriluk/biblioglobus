<table id="table" class="table table-bordered table-hover" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    <thead>
    <tr>
        <th data-field="author" data-sortable="true">Обложка</th>
        <th data-field="author" data-sortable="true">Автор</th>
        <th data-field="book" data-filter-control="input" data-sortable="true">Книга</th>
        <th data-field="year" data-filter-control="select" data-sortable="true">Год</th>
        <th data-field="year" data-filter-control="select" data-sortable="true">Жанр</th>
        <th data-field="score" data-filter-control="select" data-sortable="true">Рейтинг</th>
    </tr>
    </thead>
    <tbody>
    <?=$books; ?>
    </tbody>
</table>
<nav aria-label="books">
    <ul class="pagination justify-content-center">
        <?php

            if ($currentPage > $firstPage){
                echo '<li class="page-item"><a class="page-link" href="?page='.($currentPage-1).'">Предыдущая</a></li>';
            }

            for($i=$firstPage; $i<=$allPages; $i++){
                $active='';
                if($i==$currentPage) $active ='active';
                echo '<li class="page-item '.$active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
            }
            if(($currentPage)<$allPages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Следующая</a></li>';
            }
         ?>
    </ul>
</nav>