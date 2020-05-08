<?php
session_start();
if ($_POST) {
    $email = trim(htmlspecialchars($_POST['email']));
    $lat = $_POST['lat'];
    $lng= $_POST['lng'];
    $datetime = date("Y-m-d H:i");
    if (!empty($email)) {
        require_once("RedBeanPHP5_4_2/rb.php");
        R::setup('mysql:host=mysql_geoauth;port=3306;dbname=geoauth', 'geoauth', '3004917779');
        $users= R::dispense('users');
        $users->email = $email;
        $users->lat = $lat;
        $users->long = $lng;
        $users->datetime = $datetime;
        R::store($users);
        $_SESSION['email'] = $email;
        header("Location: index.php");
    }
}
