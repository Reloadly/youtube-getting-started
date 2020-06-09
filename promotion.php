<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';

$ch = curl_init();

$id = isset($_GET['id'])?$_GET['id']:null;

curl_setopt($ch, CURLOPT_URL, "https://topups.reloadly.com/promotions/".$id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:application/json",
    "Authorization: Bearer ".$tokenResponse->access_token
));

$response = curl_exec($ch);
curl_close($ch);

$promotion = json_decode($response);

?>
<main role="main" class="flex-shrink-0">
    <div class="container pt-5 mt-5">
        <div class="col">
            <div class="mb-2 row justify-content-center">
                <h2>Promotion Description</h2>
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
                    <td>promotionId :</td>
                    <td><?=$promotion->promotionId?></td>
                </tr>
                <tr>
                    <td>operatorId :</td>
                    <td><?=$promotion->operatorId?></td>
                </tr>
                <tr>
                    <td>title :</td>
                    <td><?=$promotion->title?></td>
                </tr>
                <tr>
                    <td>title2 :</td>
                    <td><?=$promotion->title2?></td>
                </tr>
                <tr>
                    <td>description :</td>
                    <td><?=$promotion->description?></td>
                </tr>
                <tr>
                    <td>startDate :</td>
                    <td><?=$promotion->startDate?></td>
                </tr>
                <tr>
                    <td>endDate :</td>
                    <td><?=$promotion->endDate?></td>
                </tr>
                <tr>
                    <td>denominations :</td>
                    <td><?=$promotion->denominations?></td>
                </tr>
                <tr>
                    <td>localDenominations :</td>
                    <td><?=$promotion->localDenominations?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
include_once 'layout/footer.php';
?>