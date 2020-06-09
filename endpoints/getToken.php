<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://auth.reloadly.com/oauth/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));

curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode([
    'client_id' => 'CLIENT_ID_GOES_HERE',
    'client_secret' => 'CLIENT_SECRET_GOES_HERE',
    'grant_type' => 'client_credentials',
    'audience' => 'https://topups.reloadly.com'
]));

$response = curl_exec($ch);
curl_close($ch);

$tokenResponse = json_decode($response);

?>