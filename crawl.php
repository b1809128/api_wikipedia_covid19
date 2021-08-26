<?php 
    require_once './simple_html_dom.php';
    $arrContextOptions = array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false
        )
    );
    
    $content = file_get_html('https://covid-19-hoc-tap.herokuapp.com/index2.php', false, stream_context_create($arrContextOptions));
    
    echo $content;

    // foreach ($content->find('p') as $key=>$element) {       
    //         echo $key ."--";           
    //         print_r($element->innertext);
    //         echo "<br>";                   
    // }

    // $arr = [];
    // foreach ($content->find('span.number') as $key=>$element) {       
    //     // echo $key ."--";           
    //     $arr[] = $element->innertext;  
    //     // echo "<br>";                   
    // }
    // echo json_encode($arr, JSON_HEX_TAG);
    