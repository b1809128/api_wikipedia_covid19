<?php
$arr = [];
foreach ($vietnam->find('div.bb-fl') as $key => $element) {

    $arr[] = $element->title;
}
echo json_encode($arr, JSON_HEX_TAG);