<?php
//if (isset($_GET['id'])) {
//  $id = $_GET['id'];
//}
if ($_POST) {
  $name = trim(htmlspecialchars($_POST['name']));
  $address = trim(htmlspecialchars($_POST['address']));
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $type = $_POST['type'];
  $id = $_POST['id'];
  if (!empty($name)) {
    require_once("../RedBeanPHP5_4_2/rb.php");
    R::setup('mysql:host=mysql_geoauth;port=3306;dbname=geoauth', 'geoauth', '3004917779');
    $markers = R::load('markers', $id);
    $markers->name = $name;
    $markers->address = $address;
    $markers->lat = $lat;
    $markers->lng = $lng;
    $markers->type = $type;
    R::store($markers);
    header('location: /admin/attracion-admin.php?msg=Запись успешно обновлена!');
  }
}
