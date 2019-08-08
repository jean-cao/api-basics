<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Coding Train: Data/APIs 1</title>
</head>
<body>
    <img src="" id="rainbow" />
    <script>
        console.log('about to fetch a rainbow');

        catchRainbow();

        async function catchRainbow() {
            const response = await fetch('rainbow.jpg');
            const blob = await response.blob();
            console.log(blob);
            document.getElementById('rainbow').src = URL.createObjectURL(blob);
        }
    </script>
</body>
</html>