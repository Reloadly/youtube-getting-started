<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';

$ch = curl_init();

$iso = isset($_GET['iso'])?$_GET['iso']:null;

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/countries/".$iso);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$country = json_decode($response);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/operators/countries/".$iso);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$operatorsResponse = json_decode($response);


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/promotions/country-codes/".$iso);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$promotionsResponse = json_decode($response);

?>
<main role="main" class="flex-shrink-0">
    <div class="container pt-5 mt-5">
        <div class="col">
            <div class="mb-2 row justify-content-center">
                <h2>Country Description</h2>
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
                    <td>isoName :</td>
                    <td><?=$country->isoName?></td>
                </tr>
                <tr>
                    <td>name : </td>
                    <td><?=$country->name?></td>
                </tr>
                <tr>
                    <td>currencyCode : </td>
                    <td><?=$country->currencyCode?></td>
                </tr>
                <tr>
                    <td>currencyName : </td>
                    <td><?=$country->currencyName?></td>
                </tr>
                <tr>
                    <td>currencySymbol : </td>
                    <td><?=$country->currencySymbol?></td>
                </tr>
                <tr>
                    <td>flag : </td>
                    <td><img src="<?=$country->flag?>" width="20px"></td>
                </tr>
                <tr>
                    <td>callingCodes : </td>
                    <td>
                        <?php foreach ($country->callingCodes as $code) echo $code.'  '; ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="my-2 row justify-content-center">
                <h2>Operators</h2>
            </div>
            <div class="row">
                <?php foreach($operatorsResponse as $operator) { ?>
                    <a href="operator.php?id=<?=$operator->operatorId?>" class="col-4"><?=$operator->name?> [ <?=$operator->destinationCurrencyCode?> ]</a>
                <? } ?>
            </div>
            <div class="my-2 row justify-content-center">
                <h2>Promotions</h2>
            </div>
            <div class="row">
                <?php foreach($promotionsResponse as $promotion) { ?>
                    <a href="promotion.php?id=<?=$promotion->promotionId?>" class="col-12"><?=$promotion->title?></a>
                <? } ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'layout/footer.php';
?>