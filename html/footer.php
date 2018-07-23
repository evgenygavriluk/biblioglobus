<footer class="navbar-fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 justify-content-center">
                <p class="text-center">biblioglobus.com</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        errorList = {'invalid_bookid':'Неверное значение id книги',
                     'comment_length_less_five':'Комментарий слишком короткий',
                     'length_toobig':'Длина комментария не может превышать 2000 символов',
                     'invalid_raiting':'Рейтинг должен быть от 1-10',
                     'name_less_two':'Имя не может быть меньше двух букв',
                     'first_char_is_not_char':'Имя не может начинаться с цифры'
        };
        console.log("Отправка формы");
        $("#commentform").submit(function() {
            var form_data = $(this).serialize();
            console.log('Данные пошли: '+form_data);
            $.ajax({
                type: "POST",
                url: "sendcomment.php",
                data: form_data,
                success: function(resp) {
                    console.log('Отправка отработала');
                    console.log(resp);
                    var parsed = JSON.parse(resp);
                    if(parsed['sendcomment'] == 'ok'){
                        alert('Комментарий успешно добавлен');
                        getComments(<?=$_GET['bookid'];?>);
                        document.getElementById("commentform").reset();
                    }
                    else{
                        for(var errorfield in parsed){
                            field = document.getElementById(errorfield+'_error');
                            field.style.display = 'block';
                            field.innerHTML = errorList[parsed[errorfield]];
                            document.getElementById(errorfield).addEventListener('input', function(){
                               this.previousElementSibling.style.display = 'none';
                            });
                        }
                    }

                }
            });
        });
    });


    function getComments(bookId){
        console.log("Чтение комментариев");

             $.ajax({
                type: "POST",
                url: "getcomments.php",
                data: {bookid:bookId},
                success: function(resp) {
                    console.log('Отправлено: ');
                    document.getElementById('comments').innerHTML = resp;
                 }
            });
    };

</script>
</body>
</html>