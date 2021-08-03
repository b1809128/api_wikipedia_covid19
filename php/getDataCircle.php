<?php
$arr = [];
foreach ($vietnam->find('th') as $key => $element) {

    $arr[] = $element->plaintext;
}
echo json_encode($arr, JSON_HEX_TAG);