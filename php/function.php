<?php
require_once './simple_html_dom.php';
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false
    )
);
$content = file_get_html('https://covid.cantho.gov.vn/?fbclid=IwAR006ORto0SYOL-Iz5VqgRDZpzAbyPCqM4Dz6TnhLvRCL-XcHKkRlAQtMa0', false, stream_context_create($arrContextOptions));
$vietnam = file_get_html('https://vi.wikipedia.org/wiki/%C4%90%E1%BA%A1i_d%E1%BB%8Bch_COVID-19_t%E1%BA%A1i_Vi%E1%BB%87t_Nam', false, stream_context_create($arrContextOptions));
$rss = file_get_html('https://rsstin.com/topic/covid-19?utm_source=coccoc_context&utm_medium=CPC&utm_campaign=RSSTIN%2ECOM&utm_term=covid&utm_content=36764798&md=_0u7e50vdaa*Cr3GhsODtX4tKHPqZpuei1-JLidqizJd6qqz68t50KG57tcAl84vgeC2uxhJSiP8E.', false, stream_context_create($arrContextOptions));
