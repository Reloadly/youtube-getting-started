<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';

$ch = curl_init();

$page = isset($_GET['page'])?$_GET['page']:1;

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/promotions?page=$page&size=200");
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
        <div class="col text-center mb-4">
            <h1>Promotions</h1>
        </div>
        <div class="col">
            <div class="row">
                <?php foreach($promotionsResponse->content as $promotion) { ?>
                    <a href="promotion.php?id=<?=$promotion->promotionId?>" class="col-12"><?=$promotion->title?></a>
                <? } ?>
            </div>
            <div class="row mt-3 justify-content-center">
                <?php for($x =1; $x <= $discountsResponse->totalPages; $x++) { ?>
                    <div class="col-auto pr-0">
                        <a href="promotions.php?page=<?=$x?>" class="btn btn-sm btn-primary"><?=$x?></a>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'layout/footer.php';
?>