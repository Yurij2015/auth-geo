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
    <?php
    echo "Есть контакт";
    ?>

    <h1>My First Google Map</h1>

    <div id="googleMap" style="width:100%;height:400px;"></div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.4.1.js"></script>
    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(51.508742, -0.120850),
                zoom: 5,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOj7WmwEcxrMnABjmJj5gecfI-wGwSiTo&callback=myMap"></script>

    <button id="find-me">Show my location</button>
    <br/>
    <p id="status"></p>
    <a id="map-link" target="_blank"></a>


    <script>
        function geoFindMe() {

            const status = document.querySelector('#status');
            const mapLink = document.querySelector('#map-link');

            mapLink.href = '';
            mapLink.textContent = '';

            function success(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                status.textContent = '';
                mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
                mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
            }

            function error() {
                status.textContent = 'Unable to retrieve your location';
            }

            if (!navigator.geolocation) {
                status.textContent = 'Geolocation is not supported by your browser';
            } else {
                status.textContent = 'Locating…';
                navigator.geolocation.getCurrentPosition(success, error);
            }

        }

        document.querySelector('#find-me').addEventListener('click', geoFindMe);
    </script>
</div>

</body>
</html>








