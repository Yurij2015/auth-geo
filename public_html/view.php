<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
    <!-- Get API key for Google Maps JavaScript API and use it in the place of YOUR-KEY -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOj7WmwEcxrMnABjmJj5gecfI-wGwSiTo"></script>
    <script>
        window.onload = function () {
            navigator.geolocation.getCurrentPosition(function (position) {
                let lat = position.coords.latitude;
                let long = position.coords.longitude;
                let mapOptions = {
                    center: new google.maps.LatLng(lat, long),
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                };
                let map = new google.maps.Map(document.getElementById("view"), mapOptions);
            });

        }
    </script>
    <title>Озбор местности</title>
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
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div id="view" style="width: 900px; height: 800px;">
            </div>
        </div>
    </div>
    <hr>
</div>
</body>
</html>
