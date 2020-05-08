<?php
session_start();
if (isset($_SESSION['email'])) {
    $msg = $_SESSION['email'];
} elseif (!isset($_SESSION['email'])) {
    header("Location: log-in.php");
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css"> -->
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
    <title>Аутентификация по геолокиции</title>
</head>
<body style="padding-top: 70px">
<div class="container">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light"><a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
                aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <ul class="navbar-nav mr-auto">
                <?php require_once("navigation.php"); ?>
            </ul>
        </div>
    </nav>
    <div class="col-md-12">
        <?php
        echo "Вы воши в систему как: " . $msg;
        ?>
    </div>
</div>

</body>
</html>








