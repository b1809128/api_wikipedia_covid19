<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19 Report</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="app">
        <div class="container">
            <h1 class="title">Covid-19 tại Việt Nam</h1>
            <h5 id="time"></h5>
            <button class="btn">Cần Thơ</button>
            <div class="card">
                <?php
                require_once './simple_html_dom.php';
                $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false
                    )
                );

                $content = file_get_html('https://covid.cantho.gov.vn/?fbclid=IwAR006ORto0SYOL-Iz5VqgRDZpzAbyPCqM4Dz6TnhLvRCL-XcHKkRlAQtMa0', false, stream_context_create($arrContextOptions));



                ?>

                <div class="card-item infected cantho">
                    <div class="card-title infected-title">F0</div>
                    <div class="card-content">
                        <div class="card-text">Tổng F0</div>
                        <div class="card-number"><?= $content->find('span', 8)->plaintext ?></div>
                    </div>
                </div>
                <div class="card-item today cantho">
                    <div class="card-title today-title">Today</div>
                    <div class="card-content">
                        <div class="card-text">F0 Hôm nay</div>
                        <div class="card-number"><?= "+" . $content->find('span', 11)->plaintext ?></div>
                    </div>
                </div>
                <div class="card-item recovered cantho">
                    <div class="card-title recovered-title">F1</div>
                    <div class="card-content">
                        <div class="card-text">Tổng F1</div>
                        <div class="card-number"><?= $content->find('span', 15)->plaintext ?></div>
                    </div>
                </div>
                <div class="card-item treatment cantho">
                    <div class="card-title treatment-title">F2</div>
                    <div class="card-content">
                        <div class="card-text">Tổng F2</div>
                        <div class="card-number"><?= $content->find('span', 18)->plaintext ?></div>
                    </div>
                </div>
                <div class="card-item death cantho">
                    <div class="card-title death-title">i</div>
                    <div class="card-content">
                        <div class="card-text">Tử vong</div>
                        <div class="card-number"><?= $content->find('span', 21)->plaintext ?></div>
                    </div>
                </div>
            </div>
            <button class="btn">Việt Nam</button>
            <div class="card">
                <?php
                require_once './simple_html_dom.php';
                $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false
                    )
                );

                $vietnam = file_get_html('https://vi.wikipedia.org/wiki/%C4%90%E1%BA%A1i_d%E1%BB%8Bch_COVID-19_t%E1%BA%A1i_Vi%E1%BB%87t_Nam', false, stream_context_create($arrContextOptions));

                ?>
                <div class="card-item infected vietnam">
                    <div class="card-text background_1">Số ca nhiễm</div>
                    <div class="card-number"><?= $vietnam->find('th', 20)->plaintext ?></div>
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

            <div class="image-map">
                <h4><?= $vietnam->find('b', 0)->innertext ?></h4>
                <!--<?= $vietnam->find('a', 5)->innertext ?>-->
                <canvas id="myChart" style="width:100%;max-width:400px" class="chart"></canvas>
            </div>

        </div>
        <footer>
            <p>Copyright 2021 - All by QuocHuy's Developer </p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript">
        // var string_date = getDate() + "/" + (getMonth() + 1) + "/" + getFullYear();

        // var string_time = getHours() + ":" + getMinutes() + ":" + getSeconds();
        const d = new Date();
        document.getElementById('time').innerHTML = d;
        console.log(string_date);

        const inf = parseFloat(document.querySelectorAll('.card-number')[5].innerText);
        const rec = parseFloat(document.querySelectorAll('.card-number')[6].innerText);
        const dea = parseFloat(document.querySelectorAll('.card-number')[7].innerText);
        const tre = parseFloat(document.querySelectorAll('.card-number')[8].innerText);

        var xValues = ["Infected", "Recovered", "Death", "Treatment"];
        var yValues = [10000, 20000, 4000, 5000];
        var barColors = ["rgba( 255, 57, 43, 0.6)", "#28a745", "#1877f2", "rgba( 225, 132, 37, 1)"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Quoc Huy Developer 2021"
                }
            }
        });
    </script>
</body>

</html>