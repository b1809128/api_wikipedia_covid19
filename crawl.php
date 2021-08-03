<?php 
    require_once './simple_html_dom.php';
    $arrContextOptions = array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false
        )
    );
    
    $content = file_get_html('https://covid.cantho.gov.vn/?fbclid=IwAR006ORto0SYOL-Iz5VqgRDZpzAbyPCqM4Dz6TnhLvRCL-XcHKkRlAQtMa0', false, stream_context_create($arrContextOptions));
    
    // echo $content;
    
    // echo $content->find('div#divcovid3',0);

    foreach ($content->find('.number') as $key=>$element) {       
            echo $key ."--";           
            print_r($element->innertext);
            echo "<br>";       
    }
    