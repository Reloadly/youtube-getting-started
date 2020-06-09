<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';

$ch = curl_init();

$id = isset($_GET['id'])?$_GET['id']:null;

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/topups/reports/transactions/".$id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$transaction = json_decode($response);

?>
<main role="main" class="flex-shrink-0">
    <div class="container pt-5 mt-5">
        <div class="col">
            <div class="mb-2 row justify-content-center">
                <h2>Transaction Description</h2>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>transactionId :</td>
                    <td><?=$transaction->transactionId?></td>
                </tr>
                <tr>
                    <td>operatorTransactionId :</td>
                    <td><?=$transaction->operatorTransactionId?></td>
                </tr>
                <tr>
                    <td>customIdentifier :</td>
                    <td><?=$transaction->customIdentifier?></td>
                </tr>
                <tr>
                    <td>recipientPhone :</td>
                    <td><?=$transaction->recipientPhone?></td>
                </tr>
                <tr>
                    <td>senderPhone :</td>
                    <td><?=$transaction->senderPhone?></td>
                </tr>
                <tr>
                    <td>countryCode :</td>
                    <td><?=$transaction->countryCode?></td>
                </tr>
                <tr>
                    <td>operatorId :</td>
                    <td><?=$transaction->operatorId?></td>
                </tr>
                <tr>
                    <td>operatorName :</td>
                    <td><?=$transaction->operatorName?></td>
                </tr>
                <tr>
                    <td>discount :</td>
                    <td><?=$transaction->discount?></td>
                </tr>
                <tr>
                    <td>discountCurrencyCode :</td>
                    <td><?=$transaction->discountCurrencyCode?></td>
                </tr>
                <tr>
                    <td>requestedAmount :</td>
                    <td><?=$transaction->requestedAmount?></td>
                </tr>
                <tr>
                    <td>requestedAmountCurrencyCode :</td>
                    <td><?=$transaction->requestedAmountCurrencyCode?></td>
                </tr>
                <tr>
                    <td>deliveredAmount :</td>
                    <td><?=$transaction->deliveredAmount?></td>
                </tr>
                <tr>
                    <td>deliveredAmountCurrencyCode :</td>
                    <td><?=$transaction->deliveredAmountCurrencyCode?></td>
                </tr>
                <tr>
                    <td>transactionDate :</td>
                    <td><?=$transaction->transactionDate?></td>
                </tr>
                <tr>
                    <td>pinDetail :</td>
                    <td><?=json_encode($transaction->pinDetail)?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
include_once 'layout/footer.php';
?>