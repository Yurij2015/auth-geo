<?php
if ($_POST) {
  $name = trim(htmlspecialchars($_POST['name']));
  $address = trim(htmlspecialchars($_POST['address']));
  $lat = $_POST['lat'];
  $lng= $_POST['lng'];
  $type = $_POST['type'];
  if (!empty($name)) {
    require_once("../RedBeanPHP5_4_2/rb.php");
    R::setup('mysql:host=mysql_geoauth;port=3306;dbname=geoauth', 'geoauth', '3004917779');
    $markers = R::dispense('markers');
    $markers->name = $name;
    $markers->address = $address;
    $markers->lat = $lat;
    $markers->lng = $lng;
    $markers->type = $type;
    R::store($markers);
    header('location: /admin/attracion-admin.php?msg=Запись успешно добавлена!');
  }
}
