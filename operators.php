<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';

$ch = curl_init();

$page = isset($_GET['page'])?$_GET['page']:1;

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/operators?page=$page");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$operatorsResponse = json_decode($response);

?>
<main role="main" class="flex-shrink-0">
    <div class="container pt-5 mt-5">
        <div class="col text-center mb-4">
            <h1>Operators</h1>
        </div>
        <div class="col">
            <div class="row">
                <?php foreach($operatorsResponse->content as $operator) { ?>
                    <a href="operator.php?id=<?=$operator->operatorId?>" class="col-4"><?=$operator->name?> [ <?=$operator->destinationCurrencyCode?> ]</a>
                <? } ?>
            </div>
            <div class="row mt-3 justify-content-center">
                <?php for($x =1; $x <= $operatorsResponse->totalPages; $x++) { ?>
                    <div class="col-auto pr-0">
                        <a href="operators.php?page=<?=$x?>" class="btn btn-sm btn-primary"><?=$x?></a>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'layout/footer.php';
?>