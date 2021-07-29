<?php 
    require_once './simple_html_dom.php';
    $arrContextOptions = array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false
        )
    );
    
    $content = file_get_html('https://vi.wikipedia.org/wiki/%C4%90%E1%BA%A1i_d%E1%BB%8Bch_COVID-19_t%E1%BA%A1i_Vi%E1%BB%87t_Nam', false, stream_context_create($arrContextOptions));
    
    // echo $content;
    

    foreach ($content->find('div.bb-fl') as $key=>$element) {       
            echo $key ."--";           
            print_r($element->title);
            echo "<br>";       
    }
    