<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
    <title>Сохраненные достопримечательности</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            /*height: 80%;*/
            width: 900px;
            height: 900px;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Достопримечательности</title>
</head>
<body style="padding-top: 70px">
<div class="container">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light"><a class="navbar-brand" href="#">GeoAuth</a>
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
            <div id="map"></div>
            <script>
                let customLabel = {
                    restaurant: {
                        label: 'R'
                    },
                    bar: {
                        label: 'B'
                    },
                    tourist_attraction: {
                        label: "T"
                    },
                };

                function initMap() {
                    let map = new google.maps.Map(document.getElementById('map'), {
                        center: new google.maps.LatLng(55.75167,37.61778),
                        zoom: 12
                    });
                    let infoWindow = new google.maps.InfoWindow;

                    // download data from
                    downloadUrl('http://localhost/markers.php', function (data) {
                        let xml = data.responseXML;
                        let markers = xml.documentElement.getElementsByTagName('marker');
                        Array.prototype.forEach.call(markers, function (markerElem) {
                            let id = markerElem.getAttribute('id');
                            let name = markerElem.getAttribute('name');
                            let address = markerElem.getAttribute('address');
                            let type = markerElem.getAttribute('type');
                            let point = new google.maps.LatLng(
                                parseFloat(markerElem.getAttribute('lat')),
                                parseFloat(markerElem.getAttribute('lng')));

                            let infowincontent = document.createElement('div');
                            let strong = document.createElement('strong');
                            strong.textContent = name
                            infowincontent.appendChild(strong);
                            infowincontent.appendChild(document.createElement('br'));

                            let text = document.createElement('text');
                            text.textContent = address
                            infowincontent.appendChild(text);
                            let icon = customLabel[type] || {};
                            let marker = new google.maps.Marker({
                                map: map,
                                position: point,
                                label: icon.label
                            });
                            marker.addListener('click', function () {
                                infoWindow.setContent(infowincontent);
                                infoWindow.open(map, marker);
                            });
                        });
                    });
                }

                function downloadUrl(url, callback) {
                    let request = window.ActiveXObject ?
                        new ActiveXObject('Microsoft.XMLHTTP') :
                        new XMLHttpRequest;

                    request.onreadystatechange = function () {
                        if (request.readyState === 4) {
                            request.onreadystatechange = doNothing;
                            callback(request, request.status);
                        }
                    };
                    request.open('GET', url, true);
                    request.send(null);
                }

                function doNothing() {
                }
            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOj7WmwEcxrMnABjmJj5gecfI-wGwSiTo&callback=initMap">
            </script>
        </div>
    </div>
    <hr>
</div>
</body>
</html>