<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
    <title>Текущее местоположение</title>
</head>
<body style="padding-top: 70px">
<div class="container">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Geo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
                aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <ul class="navbar-nav mr-auto">
                <?php require_once("navigation.php"); ?>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <script>
                function getPosition() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(successPosition);
                    } else {
                        document.getElementById("result").innerHTML = "Ваш браузер не поддерживает определение геолокации! Вы не можете войти на сайт."
                    }
                }

                function successPosition(position) {
                    let lat = position.coords.latitude;
                    let long = position.coords.longitude;
                    let longlat = lat + "," + long;
                    document.getElementById("result").innerHTML = "Latitude: " + lat + ", Longitude: " + long +
                        "<hr>" +
                        "<form method='post' action='handlerlogin.php'>" +
                        "<div class='form-group'> " +
                        "<label for='email'>Введите адрес эл. почты</label>" +
                        "<input class='form-control' id='email' name='email'>" +
                        "</div>" +
                        "<input hidden name='lat' value='" + lat + "'>" +
                        "<input hidden name='lng' value='" + long + "'>" +
                        "<div class='form-group'> " +
                        "<input class='btn btn-primary' type='submit' value='Войти' '>" +
                        "</div>" +
                        "</form>";
                    let mapUrl = "https://maps.googleapis.com/maps/api/staticmap?center=" + longlat + "&zoom=17&size=500x500&maptype=hybrid&markers=color:red%7Clabel:I%7C" + longlat + "&key=AIzaSyAOj7WmwEcxrMnABjmJj5gecfI-wGwSiTo";
                    document.getElementById("mycurrentposition").innerHTML = "<img src='" + mapUrl + "'>";
                }
            </script>
            <div id="result"></div>
            <hr>
            <button class="btn btn-primary" id="btnPosition" onclick="getPosition();">Определить мое местоположение
            </button>

        </div>
    </div>
    <hr>
    <div id="mycurrentposition" style="width: 500px; height: 500px;">
    </div>
    <hr>
</div>
</body>
</html>
