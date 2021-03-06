<?php require_once "header.php"; ?>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>
                    <?=$h1;?>
                </h1>
<?php if(!$books==''):
    // Формируем SELECT со списком авторов
?>
<form name="author" action="" method="get">
    <select id="author" name="author" onchange='this.form.submit();'>
        <option value="0">Все авторы</option>
<?php
    foreach($author->getAuthors(0) as $list=>$elements){
        $selected='';
        if(isset($_GET['author']) and $elements['authorid']==$_GET['author']) $selected = 'selected';
            echo '<option value="' . $elements['authorid'] . '" '.$selected.'>' . $elements['authorname'] . '</option>';
    }
?>

    </select>
</form>


<?php
    require_once "booktable.php";
endif; ?>

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
                <form id="commentform" name="commentform" method="post" onsubmit = "return false">
                    <label for="bookcommentauthor">Ваше имя:</label>
                    <span id="bookcommentauthor_error" class="error"></span>
                    <input type="text" id="bookcommentauthor" name="bookcommentauthor" class="form-control" required maxlength="255">
                    <label for="bookcomment">Отзыв:</label>
                    <span id="bookcomment_error" class="error"></span>
                    <textarea id="bookcomment" name="bookcomment" class="form-control" required maxlength="2000"></textarea>
                    <label for="commentraiting">Какую оценку поставите книге?</label>
                    <select id="commentraiting" name="commentraiting">
                        <option value="10">10 баллов</option>
                        <option value="9">9 балла</option>
                        <option value="8">8 балла</option>
                        <option value="7">7 балла</option>
                        <option value="6">6 балл</option>
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
            <div id="comments" class="col-lg-6">
               <?=$comments;?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<?php require_once "footer.php"; ?>
<script>
    $("#sort").click(function() {
        if($("#sort_type").val() == 0) $("#sort_type").val(1);
        else $("#sort_type").val(0);
        $("#sort_form").submit();
        console.log($("#sort_type").val());
    });
</script>
