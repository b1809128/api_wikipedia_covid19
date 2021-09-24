<?php 
    require_once './simple_html_dom.php';
    $arrContextOptions = array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false
        )
    );
    
    $content = file_get_html('https://vi.wikipedia.org/wiki/%C4%90%E1%BA%A1i_d%E1%BB%8Bch_COVID-19_t%E1%BA%A1i_Vi%E1%BB%87t_Nam', false, stream_context_create($arrContextOptions));
    //https://vi.wikipedia.org/wiki/%C4%90%E1%BA%A1i_d%E1%BB%8Bch_COVID-19_t%E1%BA%A1i_Vi%E1%BB%87t_Nam
    // echo $content->find('th',1)->plaintext;

    foreach ($content->find('th') as $key=>$element) {       
            echo $key ."--";           
            print_r($element->plaintext);
            echo "<br>";                   
    }

    // $arr = [];
    // foreach ($content->find('span.number') as $key=>$element) {       
    //     // echo $key ."--";           
    //     $arr[] = $element->innertext;  
    //     // echo "<br>";                   
    // }
    // echo json_encode($arr, JSON_HEX_TAG);
    