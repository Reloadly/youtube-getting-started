<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';
include_once 'endpoints/getCountries.php';
?>
<main role="main" class="flex-shrink-0">
    <div class="container pt-5 mt-5">
        <div class="col text-center mb-4">
            <h1>Countries</h1>
        </div>
        <div class="col">
            <div class="row">
                <?php foreach($countriesResponse as $country) { ?>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><img src="<?=$country->flag?>" width="100%"></div>
                            <div class="col-2"><?=$country->isoName?></div>
                            <a href="/country.php?iso=<?=$country->isoName?>" class="col-auto"><?=$country->currencyName?></a>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'layout/footer.php';
?>