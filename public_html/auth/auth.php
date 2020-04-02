<?php
/**
 * Project: afisha
 * Filename: auth.php
 * Date: 12/15/2019
 * Time: 8:06 PM
 */
$title = "Авторизация";
require_once("../public_header.php");
require_once('LoginForm.php');
require_once('Password.php');
require_once('../Session.php');
?>
<?php
$msg = '';
$form = new LoginForm($_POST);

if ($_POST) {
    if ($form->validate()) {
        $email = $form->getEmail();
        $password = new Password($form->getPassword());
        $res = $db->connect()->query("SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' LIMIT 1");
        if (!$res) {
            $msg = 'No such user found';
        }
        if ($res) {
            foreach ($res as $row) {
                $email = $row['email'];
                Session::set('email', $email);
                if ($row['roles'] == 0) {
                    ?>
                    <script>
                        location.href = "/personal_area.php";
                    </script>
                    <?php
                }
                if ($row['roles'] == 1) {
                    ?>
                    <script>
                        location.href = "/auth/admin.php";
                    </script>
                    <?php
                }
                ?>
                <?php
//                header('location: auth.php?msg=Вы авторизированы на сайте');
            }
        }
    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}
?>
<?php $msg .= $_GET['msg']; ?>
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
                            <?php }
                            $db = null;
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
                <div class="content">
                    <div class="row col-md-12 mb-3 mt-3">
                        <div class="col-md-12">
                            <b style="color: red;"><?= $msg; ?></b>
                            <form method="post" enctype="multipart/form-data" id="auth">
                                <?php echo $email; ?>
                                <div class="form-group">
                                    <label for="email" class="float-left">Адрес электронной почты</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Ваш email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="float-left">Пароль</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Пароль" required>

                                </div>
                                <input type="submit" class="btn btn-danger float-right" value="Войти">
                                <button type="reset" class="btn btn-danger float-right mr-2">
                                    Отмена
                                </button>
                            </form>


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