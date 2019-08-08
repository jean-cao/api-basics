<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Coding Train: Data/APIs 1</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
            integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
            crossorigin=""></script>
</head>
<style>
    #issMap { height: 480px; }
</style>
<body>
<h1>Where is the ISS?</h1>
<p>latitude: <span id="lat"></span><br />
    longitude: <span id="long"></span>
</p>
<div id="issMap"></div>
<script>
    var mymap = L.map('issMap').setView([0, 0], 2);

    var myIcon = L.icon({
        iconUrl: 'doge.png',
        iconSize: [100, 100],
        iconAnchor: [50, 50]
    });

    const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
    const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    const tiles = L.tileLayer(tileUrl, { attribution });
    tiles.addTo(mymap);
    const marker = L.marker([0, 0], {icon: myIcon}).addTo(mymap);
    const api_url = 'https://api.wheretheiss.at/v1/satellites/25544';

    let firstTime = true;

    async function getISS() {
        const response = await fetch(api_url);
        const data = await response.json();
        const { latitude, longitude} = data;

        marker.setLatLng([latitude, longitude]);
        if(firstTime) {
            mymap.setView([latitude,longitude], 5);
            firstTime = false;
        }

        document.getElementById('lat').textContent = latitude.toFixed(2);
        document.getElementById('long').textContent = longitude.toFixed(2);
        console.log(data);
    }

    getISS();

    setInterval(getISS, 1000);
</script>
</body>
</html>