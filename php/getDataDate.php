<?php
$arr = [];
foreach ($vietnam->find('td.bb-04em') as $key => $element) {

    $arr[] = $element->plaintext;
}
echo json_encode($arr, JSON_HEX_TAG);