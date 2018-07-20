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
                        document.getElementById("commentform").reset();
                    }
                    else{
                        for(errorfield in parsed){
                            field = document.getElementById(errofield);
                            field.setCustomValidity(parsed[errorfield]);
                        }
                    }

                }
            });
        });
    });

</script>
</body>
</html>