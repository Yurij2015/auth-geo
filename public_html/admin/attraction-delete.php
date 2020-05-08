<?php
require_once("../RedBeanPHP5_4_2/rb.php");
R::setup('mysql:host=mysql_geoauth;port=3306;dbname=geoauth', 'geoauth', '3004917779');
try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $markers= R::load('markers', $id);
        R::trash($markers);
        header('location: /admin/attracion-admin.php?msg=Запись успешно удалена!');
    }
} catch (exception $e) {
    echo "Запись нельзя удалить. Есть связанные данные!";
    echo "<br><a href = '/admin/attracion-admin.php'>Назад</a>";
}