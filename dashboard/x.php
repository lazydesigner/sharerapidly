<?php



function base_url(){

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

    $domain = $_SERVER['HTTP_HOST'];

    $subdirectory = dirname($_SERVER['PHP_SELF']);

    $baseUrl = $protocol . $domain . $subdirectory;
    // $baseUrl = $protocol . $domain . $subdirectory;
    return $baseUrl.'/';

}

function get_home_url() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];

    // Remove subdirectories from the base path
    $basePath = '/';
    $requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $basePathPosition = strpos($requestUri, $basePath);
    if ($basePathPosition !== false) {
        $basePath = substr($requestUri, 0, $basePathPosition + strlen($basePath));
    }

    $url = $protocol . $host . $basePath;

    return $url;
}


$home_url = get_home_url();
echo $home_url.'<br>';

$g = base_url();
echo $g;

?>