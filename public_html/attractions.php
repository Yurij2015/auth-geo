<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
    <!-- Get API key for Google Maps JavaScript API and use it in the place of YOUR-KEY -->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAOj7WmwEcxrMnABjmJj5gecfI-wGwSiTo"></script>
    <script type="text/javascript">
        var myLocation, distance, interest, map;
        var markers = new Array();
        window.onload = function () {
            drawMap();
        }
        function drawMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(onSuccess, onError,
                    {maximumAge: 60 * 1000, timeout: 5 * 60 * 1000, enableHighAccuracy: true});
            } else
                alert("Your browser does not support HTML5 Geolocation!!!");
        }
        function onSuccess(position) {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            myLocation = new google.maps.LatLng(lat, long);
            var mapOptions = {
                center: myLocation,
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("mapArea"), mapOptions);
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
        function getLocations() {
            interest = document.getElementById("interest").value;
            distance = document.getElementById("distance").value;
            if (interest == "default") {
                alert("You have to select a point of interest");
            } else
                findPlaces();
        }
        function findPlaces() {
            var request = {
                location: myLocation,
                radius: distance,
                type: interest
            };
            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, createMarkers);
        }
        function createMarkers(response, status) {
            var latlngbounds = new google.maps.LatLngBounds();
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                clearMarkers();
                for (var i = 0; i < response.length; i++) {
                    drawMarker(response[i]);
                    latlngbounds.extend(response[i].geometry.location);
                }
                map.fitBounds(latlngbounds);
            } else if (status == google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                alert("Sorry, there is no matching result!!");
            } else {
                alert("Sorry, there is some error!!!");
            }
        }
        function drawMarker(obj) {
            var marker = new google.maps.Marker({
                position: obj.geometry.location,
                map: map
            });
            markers.push(marker);
            var infoWindow = new google.maps.InfoWindow({
                content: '<img src="' + obj.icon + '"/><span style="color:gray">' +
                    obj.name + '<br />Rating: ' + obj.rating +
                    '<br />Vicinity: ' + obj.vicinity + '</span>'
            });
            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.open(map, marker);
            });
        }

        function clearMarkers() {
            if (markers) {
                for (i in markers) {
                    markers[i].setMap(null);
                }
                markers = [];
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
            <h3>Найти поблизости</h3>
            <label  for="interest"></label><select class="form-control" onchange="getLocations();" id="interest">
                <option value="default">Выберите тип объекта</option>
                <option value="atm">ATM</option>
                <option value="beauty_salon">Beauty Parlor</option>
                <option value="church">Church</option>
                <option value="doctor">Doctor</option>
                <option value="parking">Parking</option>
                <option value="library">Library</option>
                <option value="restaurant">Restaurant</option>
            </select> в радиусе
            <label for="distance"></label><select class="form-control" onchange="getLocations();" id="distance">
                <option value="500" selected>500</option>
                <option value="1000">1000</option>
                <option value="1500">1500</option>
                <option value="2000">2000</option>
            </select> метров <br/>
            <hr>
            <div id="mapArea" style="width:900px;height:900px"></div>
        </div>
    </div>
    <hr>
</div>
</body>
</html>