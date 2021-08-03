<?php 
    require_once './simple_html_dom.php';
    $arrContextOptions = array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false
        )
    );
    
    $content = file_get_html('https://rsstin.com/topic/covid-19', false, stream_context_create($arrContextOptions));
    
    // echo $content;
    
    // echo $content->find('div#divcovid3',0);

    foreach ($content->find('td') as $key=>$element) {       
            echo $key ."--";           
            print_r($element->plaintext);
            echo "<br>";       
    }
    