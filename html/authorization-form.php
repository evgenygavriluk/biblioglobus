<?php require_once "header.php"; ?>
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 auth-form">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#enter" role="tab" aria-controls="enter" aria-expanded="true">Войти на сайт</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-expanded="false">Зарегистрироваться</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div role="tabpanel" class="tab-pane fade active show" id="enter" aria-labelledby="home-tab" aria-expanded="true">
                        <form id="enterform" name="enterform" method="post" onsubmit="return false">
                            <div class="form-group">
                                <label for="enterEmail">e-mail</label>
                                <span id="enterEmail_error" class="error"></span>
                                <input type="email" class="form-control" id="enterEmail" name="enterEmail">
                            </div>
                            <div class="form-group">
                                <label for="enterPassword">Пароль</label>
                                <input type="password" class="form-control" id="enterPassword" name="enterPassword">
                            </div>
                            <div class="form-group">
                                <div class="main-checkbox">
                                    <input value="None" id="enterCheckbox" name="enterCheckbox" type="checkbox">
                                    <label for="centerCheckbox"><span class="text">Запомнить меня на этом компьютере</span></label>
                                </div>

                            </div>
                            <div class="form-group">
                                <button type="submit" id="enterSubmit" class="btn btn-default">Войти</button>
                            </div>
                            <div class="form-group forgot-pass">
                                <a href="forgotpassword">Восстановить пароль</a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                        <form id="registrationform" name="registerForm" method="post" onsubmit="return false">
                            <div class="form-group">
                                <label for="registerFirstName">Имя</label>
                                <input type="text" class="form-control" id="registerFirstName" name="registerFirstName" required>
                            </div>
                            <div class="form-group">
                                <label for="registerLastName">Фамилия</label>
                                <input type="text" class="form-control" id="registerLastName" name="registerLastName" required>
                            </div>
                            <div class="form-group">
                                <label for="registerEmail">e-mail</label>
                                <span id="registerEmail_error" class="error"></span>
                                <input type="email" class="form-control" id="registerEmail" name="registerEmail" required>
                            </div>
                            <div class="form-group">
                                <label for="registerPassword">Пароль</label>
                                <input type="password" class="form-control" id="registerPassword" name="registerPassword" required minlength="8" maxlength="10">
                            </div>
                            <div class="form-group">
                                <button type="submit" id="registerSubmit"  name="registerSubmit" class="btn btn-default">Зарегистрироваться</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<?php require_once "footer.php"; ?>