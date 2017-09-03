<?php

date_default_timezone_set('Asia/Colombo');
ini_set('error_log', 'notification-error.log');
error_reporting(E_ERROR);
ini_set('display_errors', 1);

$array = json_decode(file_get_contents('php://input'), true);

$applicationId = $array['applicationId'];
$frequency = $array['frequency'];
$status = $array['status'];
$address = $array['subscriberId'];
$version = $array['version'];
$timeStamp = $array['timeStamp'];


// Your code here


?>
