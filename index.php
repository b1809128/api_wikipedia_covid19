<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19 Report</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
                        <div class="card-number update"><?= "+" . $content->find('span', 11)->plaintext ?></div>
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

            <div class="map">
                <div class="image-map">
                    <?= $vietnam->find('td', 0)->innertext ?>
                </div>
                <div class="data-chart">
                    <p class="data-chart-text">Biểu đồ Covid-19 trong 7 ngày gần nhất tại Việt Nam </p>
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    
                </div>
            </div>

        </div>
        <footer>
            <p>Copyright 2021 - All by QuocHuy's Developer </p>
        </footer>
    </div>
    <script type="text/javascript">
        // In ra ngay thang nam
        const d = new Date();
        document.getElementById('time').innerHTML = d;

        // Lay du lieu tuong tac voi js
        var data = <?php
                    $arr = [];
                    foreach ($vietnam->find('.cbs-ibr') as $key => $element) {
                        if ($key % 2 == 0) {
                            // $number = $element->innertext;
                            $arr[] = $element->innertext;
                        }
                    }
                    echo json_encode($arr, JSON_HEX_TAG);
                    ?>;

        var recover = <?php
                        $arr = [];
                        foreach ($vietnam->find('div.bb-fl') as $key => $element) {

                            $arr[] = $element->title;
                        }
                        echo json_encode($arr, JSON_HEX_TAG);
                        ?>;

        var arr_rec = []
        for (let i = 613; i < recover.length; i += 3) {
            arr_rec.push(Number(recover[i]));
        }
        // console.log(arr_rec);

        const date = new Date();
        var arr_date = [];
        var x = date.getDate();
        var y = (date.getMonth() + 1)

        var s = 0;
        for (let i = 0; i < 7; i++) {
            s = x - i;
            arr_date.push(s);
        }

        var new_db = arr_date.sort();

        // Su ly du lieu dua vao bieu do
        var xValues = [];

        for (let i = 0; i < new_db.length; i++) {
            xValues.push(new_db[i] + "/" + y);
        }

        var yValues = [];
        var num = []
        for (let i = 0; i < data.length; i++) {
            yValues.push(Number(data[i]));
        }

        var getDB = yValues.map((data) => {
            return data
        })

        var db = []
        // console.log(getDB)
        for (let i = 204; i <= 210; i++) {
            db.push(getDB[i] * 1000);
        }

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: db,
                    borderColor: "red",
                    fill: true,
                    label: "Số ca nhiễm"
                }, {
                    data: arr_rec,
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
    </script>
</body>

</html>