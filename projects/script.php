<?php
 
$locale = 'fr_FR.utf-8';
setlocale(LC_ALL, $locale);
putenv('LC_ALL='.$locale);
 
header("X-Robots-Tag: noindex, nofollow", true);
 
$token = (string)$_GET['token'];
 
$data = array();
if (!$token || $token != 'azerty') {
    $data = array(
        'error' => "Not authorised",
        'error_code' => 403,
        'error_description' => "Not authorised",
        'resource' => null
    );
    echo json_encode($data);
    header('HTTP/1.0 403 Forbidden');
    exit;
}
 
$message = urldecode((string)$_GET['message']);
$number = (string)$_GET['number'];
$number_array = explode('-', $number);
 
if (!$message || !$number_array) {
    $data = array(
        'error' => "Missing data",
        'error_code' => 403,
        'error_description' => "Missing data",
        'resource' => null
    );
    echo json_encode($data);
    header('HTTP/1.0 403 Forbidden');
    exit;
}
$o = null;
$r = null; 
foreach ($number_array as $number) {
    exec('echo "'.$message.'" | gammu-smsd-inject TEXT '.$number.' 2>&1 &', $o, $r );
}
