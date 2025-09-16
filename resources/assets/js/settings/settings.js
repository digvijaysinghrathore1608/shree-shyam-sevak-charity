'use strict'

document.addEventListener('turbo:load', loadSettingUpdate)

function loadSettingUpdate() {

    if ($('#credentialsSettings , #generalSettingFrom').length) {
        let chargeTypeCommission = $('#settingChargesType').val();
        settingChargeSymbol(chargeTypeCommission);
    }

}


listen('click', '.img-radio ', function () {
    $('.img-radio').removeClass('img-border')
    $(this).addClass('img-border')
    $('#homepage').val($(this).attr('data-id'))
})

function isEmailEditProfile(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

listen('submit', '#generalSettingFrom', function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(`Contact number is ` + $('#error-msg').text())
        return false
    }

    if (!isEmailEditProfile($('#email').val())) {
        displayErrorMessage('Please Enter valid Email.');
        return false;
    }
})

listen('click', '.stripe-enable', function () {
    $('.stripe-div').toggleClass('d-none')
})

listen('click', '.paypal-enable', function () {
    $('.paypal-div').toggleClass('d-none')
})

listenChange('#settingChargesType', function () {
    let chargeType = $('#settingChargesType').val();
    settingChargeSymbol(chargeType);
});

function settingChargeSymbol(chargeType){

    $("#commission").trigger("keyup");

    if (chargeType == 1) {
        $('#commissionSymbol').text('Flat');
    } else {
        $('#commissionSymbol').text('%');
    }
}

listen('submit', '#credentialsSettings', function () {

    if ($('#stripeEnable').prop('checked')) {
        if ($('#stripeKey').val().trim().length === 0) {
            displayErrorMessage('Stripe key field is required')
            return false
        } else if ($('#stripeSecret').val().trim().length === 0) {
            displayErrorMessage('Stripe secret field is required')
            return false
        }
    }

    if ($('#paypalEnable').prop('checked')) {
        if ($('#paypalKey').val().trim().length === 0) {
            displayErrorMessage('Paypal key field is required')
            return false
        } else if ($('#paypalSecret').val().trim().length === 0) {
            displayErrorMessage('Paypal secret field is required')
            return false
        }

    }

    // let commissionPercentage = $('#commission').val()
    //
    // if (Number.isInteger(Number(commissionPercentage))) {
    //     if (commissionPercentage < 0 || commissionPercentage > 100) {
    //         displayErrorMessage(
    //             'Donation commission percentage required between 0 to 100.')
    //         return false
    //     }
    // } else {
    //     displayErrorMessage(
    //         'Donation commission percentage required integer number.')
    //     return false
    // }

    processingBtn('#credentialsSettings', '#credentialSettingBtn',
        'loading')
    $('#credentialSettingBtn').prop('disabled', true)
})

listenKeyup("#commission", function () {
    let commissionType = $("#settingChargesType").val();
    let commissionValue = $("#commission").val();
    if (commissionType == "2" && commissionValue > 100) {
        $("#commission").val(0);
    }
})

