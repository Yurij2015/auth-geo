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
        let watchId, geocoder, startLat, startLong;
        let start = 1;
        window.onload = function () {
            if (navigator.geolocation) {
                watchId = navigator.geolocation.watchPosition(onSuccess, onError,
                    {maximumAge: 60 * 1000, timeout: 5 * 60 * 1000, enableHighAccuracy: true});
            }
        }

        function onSuccess(position) {
            let currentLat = position.coords.latitude;
            let currentLong = position.coords.longitude;
            if (start === 1) {
                startLat = currentLat;
                startLong = currentLong;
                start = 0;
            }
            geocoder = new google.maps.Geocoder();
            let latlong = new google.maps.LatLng(currentLat, currentLong);
            geocoder.geocode({'latLng': latlong}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results) {
                        document.getElementById("location").innerHTML = "Ваше местоположение: " + results[0].formatted_address;
                    }
                } else
                    alert("Could not get the geolocation information");
            });

            let mapOptions = {
                center: new google.maps.LatLng(startLat, startLong),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };

            let map = new google.maps.Map(document.getElementById("view"), mapOptions);
            let marker = new google.maps.Marker({
                position: latlong,
                map: map,
                title: "My position",
                // animation: google.maps.Animation.BOUNCE,
            });

            let info = new google.maps.InfoWindow({
                content: "User position!"
            });

            google.maps.event.addListener(marker, "click", function () {
                info.open(map, marker);
            })
        }

        function onError(error) {
            switch (error.code) {
                case PERMISSION_DENIED:
                    alert("User denied permission");
                    break;
                case TIMEOUT:
                    alert("Geolocation timed out");
                    break;
                case POSITION_UNAVAILABLE:
                    alert("Geolocation information is not available");
                    break;
                default:
                    alert("Unknown error");
                    break;
            }

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
            <div id="location" class="lead"></div>
            <hr>
            <div id="view" style="width: 900px; height: 800px;">
            </div>
        </div>
    </div>
    <hr>
</div>
</body>
</html>
