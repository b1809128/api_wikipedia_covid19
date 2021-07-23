<?php 
    require_once './simple_html_dom.php';
    $arrContextOptions = array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false
        )
    );
    // https://news.google.com/covid19/map?hl=vi&mid=%2Fm%2F01crd5&gl=VN&ceid=VN%3Avi
    $content = file_get_html('https://vi.wikipedia.org/wiki/%C4%90%E1%BA%A1i_d%E1%BB%8Bch_COVID-19_t%E1%BA%A1i_Vi%E1%BB%87t_Nam', false, stream_context_create($arrContextOptions));
    // echo $content;
    // $find = $content->find('th',20);
    // echo $find->plaintext;

    foreach ($content->find('th') as $key=>$element) {
        echo $key ."--";
        print_r($element->plaintext);
        echo "<br>";
    }



    // for($i = 4; $i <66;$i++) {
    //     $find = $content->find('.text-danger-new',$i)->plaintext;        
    //     if($find != 0){
    //         echo substr($find,1)."<br>";
    //     }
    //     else{
    //         echo $find."<br>";
    //     }
    // }