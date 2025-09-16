'use strict'

document.addEventListener('turbo:load', loadAdminWithdrawSetting)

function loadAdminWithdrawSetting() {

    if ($('#editWithdrawSetting').length) {
        let chargeTypeCommission = $('#editDiscountType').val();
        settingWithdrawChargeSymbol(chargeTypeCommission);
    }

}

listenChange('#editDiscountType', function () {
    let chargeType = $('#editDiscountType').val();
    settingWithdrawChargeSymbol(chargeType);
});

function settingWithdrawChargeSymbol(chargeType) {

    $("#editDiscount").trigger("keyup");

    if (chargeType == 1) {
        $('#withdrwalCommissionSymbol').text('Flat');
    } else {
        $('#withdrwalCommissionSymbol').text('%');
    }
}

listenKeyup("#editDiscount", function () {
    let commissionType = $("#editDiscountType").val();
    let commissionValue = $("#editDiscount").val();
    if (commissionType == "2" && commissionValue > 100) {
            $("#editDiscount").val(0);
    }
})
