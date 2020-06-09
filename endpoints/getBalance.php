<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/accounts/balance");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$balanceResponse = json_decode($response);

?>