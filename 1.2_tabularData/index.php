<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Coding Train: Data/APIs 1</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
</head>
<body>
<canvas id="myChart" width="800" height="400"></canvas>
<script>
    const xlabels = [];
    const ytemps = [];
    chartIt();
    async function chartIt() {
        await getData();
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: xlabels,
                datasets: [{
                    label: 'Combined Land-Surface Air and Sea-Surface Water Temperature in C°',
                    data: ytemps,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false,
                            callback: function(value, index, values) {
                                return value + '°';
                            }
                        }
                    }]
                }
            }
        });
    }

    async function getData() {
        const response = await fetch('ZonAnn.Ts+dSST.csv');
        const data = await response.text();

        const table =  await data.split('\n').slice(1);
        table.forEach( row => {
            const cols = row.split(',');
            const year = cols[0];
            xlabels.push(year);
            const temp = cols[1];
            ytemps.push(parseFloat(temp) + 14);
            console.log(ytemps);
        });

    }
</script>
</body>
</html>