<?php

include_once 'getToken.php';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/topups");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode([
    'recipientPhone' => [
        'countryCode' => $_POST['country_code'],
        'number' => $_POST['phone_number']
    ],
    'operatorId' => $_POST['operator_id'],
    'amount' => $_POST['amount']
]));

$response = curl_exec($ch);
curl_close($ch);

print_r($response);

?>