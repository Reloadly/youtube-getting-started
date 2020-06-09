<?php
include_once 'getToken.php';

$ch = curl_init();

$phone = $_GET['phone'];
$iso = $_GET['iso'];

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/operators/auto-detect/phone/$phone/country-code/$iso?&includeBundles=true");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

print_r($response);

?>