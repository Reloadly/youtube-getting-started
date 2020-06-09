<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';

$ch = curl_init();

$page = isset($_GET['page'])?$_GET['page']:1;

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/operators/commissions?page=$page&size=200");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);
$discountsResponse = json_decode($response);

?>
<main role="main" class="flex-shrink-0">
    <div class="container pt-5 mt-5">
        <div class="col text-center mb-4">
            <h1>Discounts</h1>
        </div>
        <div class="col">
            <div class="row">
                <?php foreach($discountsResponse->content as $discount) { ?>
                    <div class="col-3"><?=$discount->operator->name?></div>
                    <div class="col-3"><?=$discount->percentage?>%</div>
                <? } ?>
            </div>
            <div class="row mt-3 justify-content-center">
                <?php for($x =1; $x <= $discountsResponse->totalPages; $x++) { ?>
                    <div class="col-auto pr-0">
                        <a href="discounts.php?page=<?=$x?>" class="btn btn-sm btn-primary"><?=$x?></a>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'layout/footer.php';
?>