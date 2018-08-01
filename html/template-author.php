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
                        <th data-field="author" data-sortable="true">
                            <form id="sort_form" name="sort_form" action="" method="get">
                                <?php if(isset($_GET['page'])): ?>
                                    <input type="hidden" name="page" value="<?=(isset($_GET['page']))? $_GET['page']: '';?>">
                                <?php endif; ?>
                                <label for="sort_type" id="sort"><i class="fa fa-sort"></i>Авторы</label>
                                <input id="sort_type" name="sort_type" type="hidden" value="<?=(isset($_GET['sort_type']))? $_GET['sort_type']: 0;?>">
                            </form>
                        </th>
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
                        if(isset($_GET['sort_type'])) $st='&sort_type='.$_GET['sort_type'];
                        else $st="";

                        if ($currentPage > $firstPage){
                            echo '<li class="page-item"><a class="page-link" href="'.$href, ($currentPage-1),$st.'">Предыдущая</a></li>';
                        }

                        for($i=$firstPage; $i<=$allPages; $i++){
                            $active='';
                            if($i==$currentPage) $active ='active';
                            echo '<li class="page-item '.$active.'"><a class="page-link" href="'.$href, $i, $st.'">'.$i.'</a></li>';
                        }
                        if(($currentPage)<$allPages) {
                            echo '<li class="page-item"><a class="page-link" href="'.$href, ($currentPage + 1), $st.'">Следующая</a></li>';
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
<script>
    $("#sort").click(function() {
        if($("#sort_type").val() == 0) $("#sort_type").val(1);
        else $("#sort_type").val(0);
        $("#sort_form").submit();
        console.log($("#sort_type").val());
    });
</script>
