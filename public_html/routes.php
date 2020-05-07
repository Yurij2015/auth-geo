<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
    <!-- Get API key for Google Maps JavaScript API and use it in the place of YOUR-KEY -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOj7WmwEcxrMnABjmJj5gecfI-wGwSiTo"></script>
    <script>
        let points = [{}, {}];
        let map;
        function findPath()
        {
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(onSuccess, onError,
                    {maximumAge:60*1000, timeout:5*60*1000, enableHighAccuracy:true});
            }
            else
                document.getElementById("mapArea").innerHTML = "Your browser does not support HTML5 Geolocation!!!";
        }
        function onSuccess(position)
        {
            points[0].lat = position.coords.latitude;
            points[0].long = position.coords.longitude;
            let localAddress = document.getElementById("destination").value.replace(" ", "+");
            let xmlhttpAddr = new XMLHttpRequest();
//Get API key for Google Maps Geocoding API and use it in the place of YOUR-KEY
            let url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + localAddress + "&key=AIzaSyAOj7WmwEcxrMnABjmJj5gecfI-wGwSiTo";
            xmlhttpAddr.open("GET", url, false);
            xmlhttpAddr.send();
            if (xmlhttpAddr.readyState == 4 && xmlhttpAddr.status == 200)
            {
                let result = xmlhttpAddr.responseText;
                let jsResult = eval("(" + result + ")");
                points[1].lat = jsResult.results[0].geometry.location.lat;
                points[1].long = jsResult.results[0].geometry.location.lng;
            }
            let mapOptions = {
                center: new google.maps.LatLng(points[0].lat, points[0].long),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("mapArea"), mapOptions);
            let latlngbounds = new google.maps.LatLngBounds();
            for(let i=0;i<points.length;i++)
            {
                let marker = new google.maps.Marker({
                    position: new google.maps.LatLng(points[i].lat, points[i].long),
                    map:map
                });
                latlngbounds.extend(marker.position);
            }
            map.fitBounds(latlngbounds);
            drawPath();
        }
        function drawPath()
        {
            let directionsService = new google.maps.DirectionsService();
            let poly = new google.maps.Polyline({strokeColor:"#FF0000", strokeWeight:4});
            let request = {
                origin: new google.maps.LatLng(points[0].lat, points[0].long),
                destination: new google.maps.LatLng(points[1].lat, points[1].long),
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
            directionsService.route(request, function(response, status){
                if (status == google.maps.DirectionsStatus.OK)
                {
                    new google.maps.DirectionsRenderer({
                        map:map,
                        polylineOptions: poly,
                        directions:response
                    });
                }
            });
        }

        function onError(error)
        {
            switch(error.code)
            {
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
    <title>Построение маршрута</title>
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
            <div class="form-group">
            <label>
                <input class="form-control" type="text" id="destination">
            </label>
            </div>
            <div class="form-group">
            <button class="btn btn-info" id="btnPath" onclick="findPath()">Построить маршрут</button>
            </div>
            <div id="mapArea" style="width: 900px; height: 800px;"></div>
        </div>
    </div>
    <hr>
</div>
</body>
</html>
