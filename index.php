<?php
include_once 'layout/head.php';
include_once 'layout/header.php';
include_once 'endpoints/getToken.php';
include_once 'endpoints/getCountries.php';

?>
<main role="main" class="flex-shrink-0">
    <div class="container pt-5 mt-5">
        <div class="text-center"><h1>Reloadly Youtube!</h1></div>
        <div class="row">
            <div class="col-6">
                <form id="pn_form">
                    <div class="form-group row">
                        <label for="country" class="w-100">Country</label>
                        <select class="form-control" id="country">
                            <?php foreach ($countriesResponse as $country) { ?>
                                <option value="<?=$country->isoName?>"><?=$country->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="w-100">Phone Number</label>
                        <input type="text" class="form-control col" id="phone_number" placeholder="Enter phone number" required>
                        <button type="submit" class="ml-2 btn btn-primary col-auto"><i class="fa fa-spinner fa-spin d-none"></i> Search</button>
                    </div>
                </form>
            </div>
            <div class="col-6 d-none align-items-center text-center justify-content-center" id="details_box">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 text-center">
                        <img id="operator_image" src="someimage" width="100px">
                    </div>
                    <p>
                        <span class="operator_detail"> Operator id : </span><span id="operator_id">0</span><br>
                        <span class="operator_detail"> Operator Name : </span><span id="operator_name">Some Name</span>
                    </p>
                </div>
            </div>
            <div class="col-12">
                <form id="tu_form" class="d-none" method="post" action="endpoints/sendTopup.php">
                    <input type="hidden" name="phone_number" value="">
                    <input type="hidden" name="country_code" value="">
                    <input type="hidden" name="operator_id" value="-1">
                    <div class="form-group row">
                        <label for="amount" class="w-100">Amount</label>
                        <input type="number" step="0.01" class="form-control col" id="amount" name="amount" placeholder="Enter amount" required>
                        <button type="submit" class="ml-2 btn btn-primary col-auto"><i class="fa fa-spinner fa-spin d-none"></i> Send Top-up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'layout/footer.php';
?>

<script>
    $('#pn_form').submit(function (e) {
        $('button[type="submit"] i').toggleClass('d-none')
        e.preventDefault();
        var phone = $('#phone_number').val();
        var country = $('#country').val();

        $.ajax({
            method: 'GET',
            url: '/endpoints/getOperatorByPhone.php?phone='+phone+'&iso='+country,
            success: function (operator) {
                $('button[type="submit"] i').toggleClass('d-none')
                operator = $.parseJSON(operator);
                $('#details_box').removeClass('d-none');
                $('#details_box').addClass('d-flex');
                if (operator.errorCode != undefined || operator.error != undefined){
                    $('.operator_detail').addClass('d-none');
                    $('#operator_name').html(operator.errorCode!= undefined?operator.errorCode:operator.error);
                    $('#operator_id').html('');
                    $('#operator_image').attr('src','');

                    $('#tu_form').addClass('d-none');
                    $('#tu_form input[name="phone_number"]').val('');
                    $('#tu_form input[name="country_code"]').val('');
                    $('#tu_form input[name="operator_id"]').val(-1);

                    $('#tu_form label[for="amount"]').html('Amount');

                }else {
                    $('.operator_detail').removeClass('d-none');
                    $('#operator_name').html(operator.name);
                    $('#operator_id').html(operator.operatorId);
                    $('#operator_image').attr('src',operator.logoUrls[0]);

                    $('#tu_form').removeClass('d-none');
                    $('#tu_form input[name="phone_number"]').val(phone);
                    $('#tu_form input[name="country_code"]').val(country);
                    $('#tu_form input[name="operator_id"]').val(operator.operatorId);

                    if (operator.denominationType == 'RANGE')
                        $('#tu_form label[for="amount"]').html('Range Supported Min ['+ operator.minAmount + '] Max ['+ operator.maxAmount + ']');
                    else
                        $('#tu_form label[for="amount"]').html('Fixed Amounts Supported ['+ operator.fixedAmounts.toString() + ']');

                }
            }
        })
    });
</script>
