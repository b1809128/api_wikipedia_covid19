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
                    <div class="card-number"><?= $content->find('.info-box-number.number.text-red', 0)->innertext ?></div>
                    <div class="card-number-today">Hôm nay +<?= $content->find('span.number', 1)->innertext ?></div>
                </div>
                <div class="card-item recovered vietnam">
                    <div class="card-text background_2">Khỏi</div>
                    <div class="card-number"><?= $content->find('.info-box-number.number.text-green', 0)->innertext ?></div>
                    <div class="card-number-today">Hôm nay +<?= $content->find('span.number', 3)->innertext ?></div>
                </div>
                <div class="card-item treatment vietnam">
                    <div class="card-text background_3">Đang điều trị</div>
                    <div class="card-number"><?= $content->find('.info-box-number.number.text-red', 0)->innertext - $content->find('.info-box-number.number.text-green', 0)->innertext ?></div>
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
                    <div class="card-number"><?= $vietnam->find('th', 18)->plaintext ?></div>
                    <div class="card-number-today">Hôm nay <?= $rss->find('strong', 0)->innertext ?></div>
                </div>
                <div class="card-item recovered vietnam">
                    <div class="card-text background_2">Khỏi</div>
                    <div class="card-number"><?= $vietnam->find('th', 21)->plaintext ?></div>
                </div>
                <div class="card-item treatment vietnam">
                    <div class="card-text background_3">Đang điều trị</div>
                    <div class="card-number"><?= $vietnam->find('th', 19)->plaintext ?></div>
                </div>
                <div class="card-item death vietnam">
                    <div class="card-text background_4">Tử vong</div>
                    <div class="card-number"><?= $vietnam->find('th', 22)->plaintext ?></div>
                </div>
            </div>

            <!-- <div class="map">
                <div class="data-chart">
                    <p class="data-chart-text">Biểu đồ Covid-19 trong 7 ngày gần nhất tại Việt Nam </p>
                    <canvas id="chart-square" style="width:100%;max-width:600px"></canvas>
                    <canvas id="chart-circle" style="width:100%;max-width:500px"></canvas>
                </div>
                <div class="image-map">
                </div>
            </div> -->
            <div id="data_infected">
                <?php
                $arr = [];
                foreach ($vietnam->find('.cbs-ibr') as $key => $element) {
                    if ($key % 2 == 0) {
                        $arr[] = $element->innertext;
                    }
                }

                // echo sizeof($arr);
                for ($i = count($arr) - 7; $i < count($arr); $i++) {
                    echo "<infected>" . $arr[$i] . "</infected>";
                }
                ?>
            </div>
            <div id="data_recovered">
                <?php
                $arr_1 = [];
                foreach ($vietnam->find('div.bb-fl') as $key => $element) {

                    $arr_1[] = $element->title;
                }
                for ($i = count($arr_1)-20; $i < count($arr_1); $i+=3) {
                    echo "<recovered>" . $arr_1[$i] . "</recovered>";
                }
                ?>
            </div>
            <div id="data_date">
                <?php
                    $arr_2 = [];
                    foreach ($vietnam->find('td.bb-04em') as $key => $element) {
                    
                        $arr_2[] = $element->plaintext;
                    }
                    $date = [];
                    for ($i = 0 ; $i < count($arr_2); $i+=3) {
                        $date[] = $arr_2[$i];
                    }

                    for($i = count($date)-7 ; $i < count($date); $i++){
                        echo "<date>".$date[$i]."</date>";
                    }
                ?>
            </div>
            <div id="data_circle">
                <?php
                    echo "<circle>".$vietnam->find('th', 18)->plaintext."</circle>";
                    echo "<circle>".$vietnam->find('th', 21)->plaintext."</circle>";
                    echo "<circle>".$vietnam->find('th', 19)->plaintext."</circle>";
                    echo "<circle>".$vietnam->find('th', 22)->plaintext."</circle>";

                ?>
            </div>
        </div>
        <footer>
            <div>Copyright 2021 - All by QuocHuy's Developer </div>
        </footer>
    </div>

    <script type="text/javascript">
        // In ra ngay thang nam
        function getLastUpdate() {
            const d = new Date();
            document.getElementById('time').innerHTML = d;
        }
        getLastUpdate();
    </script>
</body>

</html>