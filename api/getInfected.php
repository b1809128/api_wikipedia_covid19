<?php
require_once '../simple_html_dom.php';
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false
    )
);
$content = file_get_html('https://covid-19-hoc-tap.herokuapp.com/index2.php', false, stream_context_create($arrContextOptions));


// echo $content;

$arr = [];
foreach ($content->find('.card-number') as $key => $element) {
    $arr[] =  $element->innertext;
}

$arr_1 = [];
foreach ($content->find('infected') as $key => $element) {
    $arr_1[] =  $element->innertext;
}

$arr_2 = [];
foreach ($content->find('recovered') as $key => $element) {
    $arr_2[] =  $element->innertext;
}

$arr_3 = [];
foreach ($content->find('date') as $key => $element) {
    $arr_3[] =  $element->innertext;
}

$arr_4 = [];
foreach ($content->find('circle') as $key => $element) {
    $arr_4[] =  $element->innertext;
}

$arr_5 = [];
foreach ($content->find('.card-number-today') as $key => $element) {
    $arr_5[] =  $element->innertext;
}

$test = array("api"=>["infected" => $arr, "sevenday" => $arr_1, "recovered" => $arr_2, "date" => $arr_3, "circle" => $arr_4, "today" => $arr_5]);


echo json_encode($test, JSON_HEX_TAG);
