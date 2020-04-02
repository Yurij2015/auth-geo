<?php
/**
 * Project: afisha
 * Filename: auth.php
 * Date: 12/15/2019
 * Time: 8:06 PM
 */
$title = "Регистрация";
require_once("../public_header.php");
require_once('RegistrationForm.php');
require_once('Password.php');
require_once('../Session.php');
?>
<?php
$msg = '';
$form = new RegistrationForm($_POST);

if ($_POST) {
    if ($form->validate()) {
        $email = $form->getEmail();
        $username = $form->getUserName();
        $usersecondname = $form->getUserSecondName();
        $password = new Password($form->getPassword());
        $res = $db->connect()->query("SELECT * FROM users WHERE email = '{$email}'");
        if ($res->rowCount() > 0) {
            $msg = 'Пользователь с таким эл. адресом уже существует!';
        }
        if ($res->rowCount() == 0) {
            $db->connect()->query("INSERT INTO `users` (email, username, usersecondname, password) VALUES ('{$email}','{$username}', '{$usersecondname}','{$password}')");
//            header('location: auth.php?msg=Регистрация прошла успешно!');
            ?>
            <script>
                location.href = "/auth/auth.php";
            </script>
            <?php
        }
    } else {
        $msg = $form->passwordsMatch() ? 'Пожалуйста, заполните все поля' : 'Пароли не совпадают';
    }
}
?>

<div class="container">
    <div class="row afisha">
        <div class="starthead bg-dark">
            <h1 class="starthead-center">Афиша</h1>
        </div>
        <div class="row contentafisha">
            <div class="calendar contentafisha-center">
                <form method="post" action="/search_date.php#search_date">
                    <label>
                        <select class="form-control form-control-sm font-weight-bold" name="search"
                                style="background: transparent; color: white; border: none;">
                            <option selected value="" disabled class="font-weight-bold">Календарь</option>
                            <?php
                            $timetable = $db->connect()->query("SELECT DISTINCT date FROM timetable");
                            foreach ($timetable as $timetabledate) {
                                ?>
                                <option value="<?php echo $timetabledate['date'] ?>"><?php echo $timetabledate['date'] ?></option>
                            <?php } ?>
                            ?>
                        </select>
                    </label>
                    <button type="submit" class="fa fa-search"
                            style="background: transparent; color: white; border: none">
                    </button>
                </form>
            </div>
            <div class="emptyplace"></div>
            <div class="search">
                <form method="post" id="searchrequest" action="../search.php">
                    <label for="search"></label>
                    <input placeholder="Поиск по спектаклям, артистам" id="search" name="search">
                    <button type="submit" class="fa fa-search"
                            style="background: transparent; color: white; border: none"></button>
                </form>
            </div>
            <div class="container">
                <div class="content" id="reg">
                    <div class="row col-md-12 mb-3 mt-3">
                        <div class="col-12">
                            <h4 class="text-center" style="margin-top: 30px;">Регистрация в системе</h4>
                            <b style="color: red;"><?= $msg; ?></b>
                            <form method="post">
                                <div class="form-group">
                                    <label for="email" class="float-left">Адрес электронной почты</label>
                                    <input type="email" class="form-control" id="email" placeholder="Ваш email"
                                           name="email"
                                           value="<?= $form->getEmail(); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="float-left">Имя пользователя</label>
                                    <input type="text" class="form-control" id="username"
                                           placeholder="Ваше Имя" name="username" value="<?= $form->getUsername() ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="usersecondname" class="float-left">Фамилия пользователя</label>
                                    <input type="text" class="form-control" id="usersecondname"
                                           placeholder="Ваша Фамилия"
                                           name="usersecondname" value="<?= $form->getUserSecondName() ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="float-left">Пароль</label>
                                    <input type="password" class="form-control" id="password" placeholder="Пароль"
                                           name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="passwordConfirm" class="float-left">Проверка пароля</label>
                                    <input type="password" class="form-control" id="passwordConfirm"
                                           placeholder="Проверка пароля"
                                           name="passwordConfirm" required>
                                </div>
                                <input type="submit" class="btn btn-danger float-right" value="Регистрация">
                                <button type="reset" class="btn btn-danger float-right mr-2">
                                    Отмена
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>

            </div>
        </div>
    </div>

</div>
<footer class="row">
    <div class="col-md-12">
        <?= "Все права защищены " . "&copy; " . date("Y") ?>
    </div>
</footer>
</div>
</div>
</body>
</html>