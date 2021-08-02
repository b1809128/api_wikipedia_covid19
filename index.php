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

                <div class="card-item infected vietnam">
                    <div class="card-text background_1">Số ca nhiễm</div>
                    <div class="card-number"><?= $content->find('span', 8)->plaintext ?></div>
                    <div class="card-number-today">+<?= $content->find('span', 11)->plaintext ?></div>
                </div>
                <div class="card-item recovered vietnam">
                    <div class="card-text background_2">Khỏi</div>
                    <div class="card-number"><?= $content->find('span', 24)->plaintext ?></div>
                </div>
                <div class="card-item treatment vietnam">
                    <div class="card-text background_3">Đang điều trị</div>
                    <div class="card-number"><?= $content->find('span', 8)->plaintext - $content->find('span', 24)->plaintext ?></div>
                </div>
                <div class="card-item death vietnam">
                    <div class="card-text background_4">Tử vong</div>
                    <div class="card-number"><?= $content->find('span', 21)->plaintext ?></div>
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
    $rss = file_get_html('https://rsstin.com/topic/covid-19?utm_source=coccoc_context&utm_medium=CPC&utm_campaign=RSSTIN%2ECOM&utm_term=covid&utm_content=36764798&md=_0u7e50vdaa*Cr3GhsODtX4tKHPqZpuei1-JLidqizJd6qqz68t50KG57tcAl84vgeC2uxhJSiP8E.', false, stream_context_create($arrContextOptions));

                ?>
                <div class="card-item infected vietnam">
                    <div class="card-text background_1">Số ca nhiễm</div>
                    <div class="card-number"><?= $vietnam->find('th', 20)->plaintext ?></div>
                    <div>+<?= $rss->find('strong',1)->innertext ?></div>
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
        const d = new Date();
        document.getElementById('time').innerHTML = d;

        // Lay du lieu ca nhiem
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
        //Lay du lieu hoi phuc
        var recover = <?php
                        $arr = [];
                        foreach ($vietnam->find('div.bb-fl') as $key => $element) {

                            $arr[] = $element->title;
                        }
                        echo json_encode($arr, JSON_HEX_TAG);
                        ?>;
        // Lay du lieu ngay thang nam
        var date_db = <?php
                        $arr = [];
                        foreach ($vietnam->find('td.bb-04em') as $key => $element) {

                            $arr[] = $element->plaintext;
                        }
                        echo json_encode($arr, JSON_HEX_TAG);
                        ?>;

        var arr_date_db = [];
        for (let i = 0; i < date_db.length; i += 3) {
            arr_date_db.push(date_db[i]);
        }

        // console.log(arr_date_db)


        var arr_rec = []
        for (let i = 616; i < recover.length; i += 3) {
            arr_rec.push(Number(recover[i]));
        }


        // Su ly du lieu dua vao bieu do
        var xValues = [];
        for (let i = arr_date_db.length-7; i <= arr_date_db.length-1; i++) {
            xValues.push(arr_date_db[i]);
        }

        // console.log(xValues)

        var yValues = [];
        var num = []
        for (let i = 0; i < data.length; i++) {
            yValues.push(Number(data[i]));
        }


        var getDB = yValues.map((data) => {
            return data
        })


        var db = []

        for (let i = (data.length- 7); i <= getDB.length; i++) {
            db.push(parseFloat(getDB[i]) * 1000);
        }
        //    console.log(getDB)

        // Bieu do 1
        new Chart("chart-square", {
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


        //Circle data

        var cir_data = <?php
                        $arr = [];
                        foreach ($vietnam->find('th') as $key => $element) {

                            $arr[] = $element->plaintext;
                        }
                        echo json_encode($arr, JSON_HEX_TAG);
                        ?>;
        // console.log(cir_data)
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