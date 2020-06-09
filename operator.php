<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';

$ch = curl_init();

$id = isset($_GET['id'])?$_GET['id']:null;

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/operators/".$id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$operator = json_decode($response);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/operators/$id/commissions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$discount = json_decode($response);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/promotions/operators/".$id);
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
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>operatorId :</td>
                    <td><?=$operator->operatorId?></td>
                </tr>
                <tr>
                    <td>name :</td>
                    <td><?=$operator->name?></td>
                </tr>
                <tr>
                    <td>bundle :</td>
                    <td><?=$operator->bundle?></td>
                </tr>
                <tr>
                    <td>denominationType :</td>
                    <td><?=$operator->denominationType?></td>
                </tr>
                <tr>
                    <td>senderCurrencyCode :</td>
                    <td><?=$operator->senderCurrencyCode?></td>
                </tr>
                <tr>
                    <td>senderCurrencySymbol :</td>
                    <td><?=$operator->senderCurrencySymbol?></td>
                </tr>
                <tr>
                    <td>destinationCurrencyCode :</td>
                    <td><?=$operator->destinationCurrencyCode?></td>
                </tr>
                <tr>
                    <td>destinationCurrencySymbol :</td>
                    <td><?=$operator->destinationCurrencySymbol?></td>
                </tr>
                <tr>
                    <td>commission :</td>
                    <td><?=$operator->commission?></td>
                </tr>
                <tr>
                    <td>internationalDiscount :</td>
                    <td><?=$operator->internationalDiscount?></td>
                </tr>
                <tr>
                    <td>localDiscount :</td>
                    <td><?=$operator->localDiscount?></td>
                </tr>
                <tr>
                    <td>mostPopularAmount :</td>
                    <td><?=$operator->mostPopularAmount?></td>
                </tr>
                <tr>
                    <td>minAmount :</td>
                    <td><?=$operator->minAmount?></td>
                </tr>
                <tr>
                    <td>maxAmount :</td>
                    <td><?=$operator->maxAmount?></td>
                </tr>
                <tr>
                    <td>country isoName :</td>
                    <td><?=$operator->country->isoName?></td>
                </tr>
                <tr>
                    <td>logo :</td>
                    <td><img src="<?=$operator->logoUrls[0]?>" width="100px"></td>
                </tr>
                <tr>
                    <td>fixedAmounts :</td>
                    <td><?=json_encode($operator->fixedAmounts)?></td>
                </tr>
                <tr>
                    <td>suggestedAmounts :</td>
                    <td><?=json_encode($operator->suggestedAmounts)?></td>
                </tr>
                <tr>
                    <td>suggestedAmountsMap :</td>
                    <td><?=json_encode($operator->suggestedAmountsMap)?></td>
                </tr>
                <tr>
                    <td>Discount Percentage :</td>
                    <td><?=json_encode($discount->percentage)?>%</td>
                </tr>
                <tr>
                    <td>International Discount Percentage :</td>
                    <td><?=json_encode($discount->internationalPercentage)?>%</td>
                </tr>
                <tr>
                    <td>Local Discount Percentage :</td>
                    <td><?=json_encode($discount->localPercentage)?>%</td>
                </tr>
                </tbody>
            </table>
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