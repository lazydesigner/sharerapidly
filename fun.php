<?php



function base_url(){

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

    $domain = $_SERVER['HTTP_HOST'];

    $subdirectory = dirname($_SERVER['PHP_SELF']);

    $baseUrl = $protocol . $domain . $subdirectory;
    // $baseUrl = $protocol . $domain . $subdirectory;
    return $baseUrl;

}

?>