<?php
require './php/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19 Report</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./image/node2.svg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <div class="app">
        <div class="container">
            <h1 class="title">Covid-19 tại Việt Nam</h1>
            <h5 id="time"></h5>
            <button class="btn">Cần Thơ</button>
            <div class="card">

                <div class="card-item infected vietnam">
                    <div class="card-text background_1">Số ca nhiễm</div>
                    <div class="card-number"><?= $content->find('span', 8)->innertext ?></div>
                    <div class="card-number-today">+<?= $content->find('span', 11)->innertext ?></div>
                </div>
                <div class="card-item recovered vietnam">
                    <div class="card-text background_2">Khỏi</div>
                    <div class="card-number"><?= $content->find('span', 21)->innertext ?></div>
                </div>
                <div class="card-item treatment vietnam">
                    <div class="card-text background_3">Đang điều trị</div>
                    <div class="card-number"><?= $content->find('span', 8)->innertext - $content->find('span', 21)->innertext ?></div>
                </div>
                <div class="card-item death vietnam">
                    <div class="card-text background_4">Tử vong</div>
                    <div class="card-number">-</div>
                    <div class="card-number-today">Đang cập nhật</div>
                </div>
            </div>
            <button class="btn">Việt Nam</button>
            <div class="card">
                <div class="card-item infected vietnam">
                    <div class="card-text background_1">Số ca nhiễm</div>
                    <div class="card-number"><?= $vietnam->find('th', 20)->plaintext ?></div>
                    <div><?= $rss->find('strong', 0)->innertext ?></div>
                </div>
                <div class="card-item recovered vietnam">
                    <div class="card-text background_2">Khỏi</div>
                    <div class="card-number"><?= $vietnam->find('th', 23)->plaintext ?></div>
                </div>
                <div class="card-item treatment vietnam">
                    <div class="card-text background_3">Đang điều trị</div>
                    <div class="card-number"><?= $vietnam->find('th', 21)->plaintext ?></div>
                </div>
                <div class="card-item death vietnam">
                    <div class="card-text background_4">Tử vong</div>
                    <div class="card-number"><?= $vietnam->find('th', 24)->plaintext ?></div>
                </div>
            </div>

            <div class="map">
                <div class="data-chart">
                    <p class="data-chart-text">Biểu đồ Covid-19 trong 7 ngày gần nhất tại Việt Nam </p>
                    <canvas id="chart-square" style="width:100%;max-width:600px"></canvas>
                    <canvas id="chart-circle" style="width:100%;max-width:500px"></canvas>
                </div>
                <div class="image-map">
                    <?= $vietnam->find('td', 0)->innertext ?>
                </div>
            </div>

        </div>
        <footer>
            <p>Copyright 2021 - All by QuocHuy's Developer </p>
        </footer>
    </div>

    <script type="text/javascript">
        // In ra ngay thang nam
        function getLastUpdate() {
            const d = new Date();
            document.getElementById('time').innerHTML = d;
        }
        getLastUpdate();

        // Lay du lieu ca nhiem
        var data = <?php require './php/getDataInfected.php' ?>;
        //Lay du lieu hoi phuc
        var recover = <?php require './php/getDataRecovered.php' ?>;
        // Lay du lieu ngay thang nam
        var date_db = <?php require './php/getDataDate.php' ?>;
        //Circle data
        var cir_data = <?php require './php/getDataCircle.php' ?>;
        
        // Su ly du lieu dua vao bieu do
        function getSevenDay(data) {
            var arr_date_db = [];
            for (let i = 0; i < data.length; i += 3) {
                arr_date_db.push(data[i]);
            }
            var xValues = [];
            for (let i = arr_date_db.length - 7; i < arr_date_db.length; i++) {
                xValues.push(arr_date_db[i]);
            }
            return xValues;
        }

        function getInfected(data) {
            var yValues = [];
            for (let i = data.length - 7; i < data.length; i++) {
                yValues.push(parseFloat(Number(data[i])) * 1000);
            }
            return yValues;
        }

        function getRecovered(data) {
            var arr_rec = []
            for (let i = data.length-2;i >= 0; i-=3) {
                arr_rec.push(Number(data[i]));
            }
            var arr_new_rec = [];
            for(i = 0; i < 7; i++){
                arr_new_rec.push(arr_rec[i]);
            }
            return arr_new_rec;
        }


        console.log(getRecovered(recover));

        function getLeastDay(data) {
            var arr = [];
            for (let i = 0; i < 5; i++) {
                arr.push(parseFloat(Number(data[i])) * 1000);
            }
            return arr;
        }
        
        

        // Bieu do 1
        new Chart("chart-square", {
            type: "line",
            data: {
                labels: getSevenDay(date_db),
                datasets: [{
                    data: getInfected(data),
                    borderColor: "red",
                    fill: true,
                    label: "Số ca nhiễm"
                }, {
                    data: getRecovered(recover).sort(),
                    borderColor: "green",
                    fill: true,
                    label: "Hồi phục"
                }]
            },
            options: {

                legend: {
                    display: true,

                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // min: 500,
                            // max: 200000
                        }
                    }],
                }
            }
        });


        var infected = parseFloat(Number(cir_data[20])) * 1000;
        var recov = parseFloat(Number(cir_data[23])) * 1000;
        var treating = parseFloat(Number(cir_data[21])) * 1000;
        var die = parseFloat(Number(cir_data[24])) * 1000;
        // Bieu do 2
        var xValues_1 = ["Số ca nhiễm", "Hồi phục", "Đang điều trị", "Tử vong"];
        var yValues_1 = [infected, recov, treating, die];
        var barColors = [
            "#b91d47",
            "#1e7145",
            "#2b5797",
            "rgba(0,0,0,0.8)",

        ];

        new Chart("chart-circle", {
            type: "doughnut",
            data: {
                labels: xValues_1,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues_1
                }]
            },
            options: {
                title: {
                    display: true,
                    // text: "World Wide Wine Production 2018"
                }
            }
        });
    </script>
</body>

</html>