<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <title>Аутентификация по геолокиции</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Аутентификация по геолокации</h2>

            <button id = "find-me">Show my location</button><br/>
            <p id = "status"></p>
            <a id = "map-link" target="_blank"></a>

            <?php echo "Geolocation"; ?>
            <script>
                function geoFindMe() {
                    const status = document.querySelector('#status');
                    const mapLink = document.querySelector('#map-link');
                    mapLink.href = '';
                    mapLink.textContent = '';
                    function success(position) {
                        const latitude  = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        status.textContent = '';
                        mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
                        mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
                    }
                    function error() {
                        status.textContent = 'Unable to retrieve your location';
                    }
                    if(!navigator.geolocation) {
                        status.textContent = 'Geolocation is not supported by your browser';
                    } else {
                        status.textContent = 'Locating…';
                        navigator.geolocation.getCurrentPosition(success, error);
                    }
                }
                document.querySelector('#find-me').addEventListener('click', geoFindMe);
            </script>

        </div>
    </div>

</div>
<hr>
<div>
    <script>
        if (navigator.geolocation) {
            alert("geolocation is available");
        }
        else {
            alert("geolocation is not supported");
        }
    </script>
</div>
</body>
</html>
<?php
