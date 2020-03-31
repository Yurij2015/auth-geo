<?php
?>
<?php
echo "Есть контакт";
?>
<hr>
<h1>Геопозиция!</h1>
<?php
$country = geoip_country_name_by_name('www.example.com');
if ($country) {
    echo 'Хост расположен в ' . $country;
}
?>
