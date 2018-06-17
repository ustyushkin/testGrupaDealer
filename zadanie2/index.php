<?php
$data_back = json_decode(file_get_contents('php://input'));

$lat = $data_back->{"lat"};
$lng = $data_back->{"lng"};
$units = $data_back->{"parameters"};

$folder = 'cache/';

$cachefile = 'cached-' . $lat . '-' . $lng . '-' . $units . '.json';
$cachetime = 1000;

// get json from cached file
if (file_exists($folder . $cachefile) && time() - $cachetime < filemtime($folder . $cachefile)) {
    header("Content-type: application/json");
    include($folder . $cachefile);
    exit;
}

ob_start();

$options = array('http' =>
    array(
        'method' => 'GET',
        'header' => 'Content-type: application/x-www-form-urlencoded'
    )
);
$context = stream_context_create($options);
$result = file_get_contents('http://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lng . '&appid=38ab4ff890fcc4a5e7c1d84a83a0f953&lang=pl&units=' . $units, false, $context);

header("Content-type: application/json");

echo json_encode($result);

//save in cache file
$cached = fopen($folder . $cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush();