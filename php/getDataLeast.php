<?php
$arr = [];
foreach ($rss->find('td') as $element) {
        $arr[] = $element->innertext;
}
echo json_encode($arr, JSON_HEX_TAG);