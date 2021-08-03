<?php
$arr = [];
foreach ($vietnam->find('.cbs-ibr') as $key => $element) {
    if ($key % 2 == 0) {
        $arr[] = $element->innertext;
    }
}
echo json_encode($arr, JSON_HEX_TAG);