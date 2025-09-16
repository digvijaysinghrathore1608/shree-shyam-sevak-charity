'use strict'

listen('click', '.user-withdraw-request-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id')
    let campaignId = $(event.currentTarget).attr('data-campaign-id')
    let divAttr = document.createElement("div");
    let paymentType = paypalPaymentType;
    getCommission(campaignId,paymentType,id);
    divAttr.innerHTML =
        '<select type="text" id="paymentType" class="swal2-select swal2-input select2 form-select" name="selected_payment_gatway" required>' +
        '<option value="1" selected class="swal2-input">Paypal</option>' +
        '<option value="2"  class="swal2-input">Bank</option>' +
        '</select>' +
        '<input type="hidden" name="withdrawCampingId" id="withdrawCampingId" value="'+campaignId+'">'+
        '<input type="hidden" name="withdrawId" id="withdrawId" value="'+id+'">'+
        '<div class="form-check form-check-custom form-check-solid defautEmail mt-3 mb-3">\n' +
        '    <input class="form-check-input"  type="checkbox" id="defaultEmail"  checked/>\n' +
        '    <label class="form-check-label" for="defaultEmail">\n' +
        '        Default PayPal email\n' +
        '    </label>\n' +
        '</div>\n'+
        '<input type="text" id="email" class="swal2-input withdrawEmail d-none swal-content__input mb-2" placeholder="Enter paypal account email">' +
        '<input type="text" id="confirmEmail" class="swal2-input payPalWithdrawRequest swal-content__input" placeholder="Confirm paypal account email">' +
        '<div class="form-check form-check-custom form-check-solid defaultBank d-none mt-3 mb-3">\n' +
        '    <input class="form-check-input"  type="checkbox" id="defaultBank" checked/>\n' +
        '    <label class="form-check-label" for="defaultBank">\n' +
        '        Default bank detail\n' +
        '    </label>\n' +
        '</div>\n'+
        '<input type="text" id="accountNumber" class="swal2-input bankWithdrawRequest d-none swal-content__input mt-2" placeholder="Enter bank account number">' +
        '<input type="text" id="isbnNumber" class="swal2-input bankWithdrawRequest d-none swal-content__input mt-2" placeholder="Enter bank ISBN number">' +
        '<input type="text" id="branchName" class="swal2-input bankWithdrawRequest d-none swal-content__input mt-2" placeholder="Enter bank branch name">' +
        '<input type="text" id="accountHolderName" class="swal2-input bankWithdrawRequest d-none swal-content__input mt-2" placeholder="Enter account holder name">' +
        '<textarea class="swal2-textarea swal-content__input mt-3" id="notes" placeholder="Type your message here" style="display: flex;"></textarea>';

    swal({

        title: 'Withdraw Request',
        content:divAttr ,
        text: 'Are you sure want to  this withdraw amount ?',
        buttons: {
            confirm:'Yes, Request Send',
            cancel: 'No, Cancel',
        },
        reverseButtons: true,
        icon: sweetWithdrawAlertIcon,

    }).then(function (result) {
        if ($('#paymentType').val() == 1) {
            if($('#defaultEmail').prop('checked') == true) {
                $('#email').val($('#defaultPayPal').val());
            }
        } else{
            if ($('#defaultBank').prop('checked') == true) {
                $('#accountNumber').val($('#defaultAccountNumber').val());
                $('#isbnNumber').val($('#defaultIsbnNumber').val());
                $('#branchName').val($('#defaultBranchName').val());
                $('#accountHolderName').val($('#defaultHolderName').val());
            }
        }
        let email = $('#email').val();
        let confirmEmail = $('#confirmEmail').val();
        let notes = $('#notes').val();
        let accountNumber = $('#accountNumber').val();
        let isbnNumber = $('#isbnNumber').val();
        let branchName = $('#branchName').val();
        let accountHolderName = $('#accountHolderName').val();
        let paymentType = $('#paymentType').val();
        if(result){
            $.ajax({
                url: route('user.withdraw.store'),
                type: 'POST',
                data: {
                    payment_type: paymentType,
                    email: email,
                    confirm_email: confirmEmail,
                    user_notes: notes,
                    campaign_id: campaignId,
                    account_number: accountNumber,
                    isbn_number: isbnNumber,
                    branch_name: branchName,
                    account_holder_name: accountHolderName,
                    id: id
                },
                success: function (obj) {

                    if (obj.success) {
                        window.livewire.emit('refresh')
                    }
                    swal({
                        title: 'Sent',
                        text: 'Withdraw request has been sent.',
                        icon: 'success',
                        timer: 2000,
                        confirmButtonColor: '#009ef7',
                    })
                },


                error: function (data) {
                    swal({
                        title: 'Error',
                        icon: 'error',
                        text: data.responseJSON.message,
                        type: 'error',
                        timer: 5000,
                        confirmButtonColor: '#009ef7',
                    })
                },
            })
        }
    });
})

listenChange('#paymentType', function () {

    var paymentType = $(this).val()
    var payPalWithdrawRequest = 1
    var bankWithdrawRequest = 2

    if (paymentType == payPalWithdrawRequest) {
        $('.bankWithdrawRequest').addClass('d-none')
        $('.defaultBank').addClass('d-none')
        $('.payPalWithdrawRequest').removeClass('d-none')
        $('.defautEmail').removeClass('d-none')
        if ($('#defaultEmail').prop('checked') == false) {
            $('.withdrawEmail').removeClass('d-none');
        }
    }

    if (paymentType == bankWithdrawRequest) {
        $('.payPalWithdrawRequest').addClass('d-none')
        $('.withdrawEmail').addClass('d-none')
        $('.defautEmail').addClass('d-none')
        $('.bankWithdrawRequest').removeClass('d-none')
        $('.defaultBank').removeClass('d-none')

        if($('#defaultBank').prop('checked') == true){
            $('.bankWithdrawRequest').addClass('d-none');
        }
    }
})

listen('click','#defaultEmail',function () {
    if ($(this).prop('checked') == false) {
        $('.withdrawEmail').removeClass('d-none');
    }
    if($(this).prop('checked') == true){
        $('.withdrawEmail').addClass('d-none');
    }
})

listen('click','#defaultBank',function () {
    if ($(this).prop('checked') == false) {
        $('.bankWithdrawRequest').removeClass('d-none');
    }
    if($(this).prop('checked') == true){
        $('.bankWithdrawRequest').addClass('d-none');
    }
})

listen('click', '.withdraw-show-btn', function (event) {
    $('#showWithdrawModal').appendTo('body').modal('show')
    let requestId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('user.withdraw.index') + '/' + requestId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showUserNotes').html((!isEmpty(result.data.user_notes))
                    ? result.data.user_notes
                    : 'N/A')
                $('#showAdminNotes').html((!isEmpty(result.data.admin_notes))
                    ? result.data.admin_notes
                    : 'N/A')
                Livewire.emit('refresh')
                $('#showWithdrawModal').appendTo('body').modal('show')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('change', '#userWithdrawStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#userWithdrawStatusFilterBtn'),
        $('#userWithdrawFilter'))
})

listen('click', '#userWithdrawResetFilter', function () {
    $('#userWithdrawStatus').val(5).change()
    hideDropdownManually($('#userWithdrawStatusFilterBtn'),
        $('#userWithdrawFilter'))
})

listen('click', '#userWithdrawStatusFilterBtn', function () {
    openDropdownManually($('#userWithdrawStatusFilterBtn'),
        $('#userWithdrawFilter'))
})

listenChange('#paymentType', function (event){
    let campaignId = $('#withdrawCampingId').val();
    let paymentType = $('#paymentType').val();
    let id = $('#withdrawId').val();
    getCommission(campaignId,paymentType,id);
})

function getCommission(campaignId,paymentType,withdrawId){
    $.ajax({
        url: route('user.get-commission',campaignId),
        type: 'GET',
        data: {campaignId:campaignId,paymentType:paymentType,withdrawId:withdrawId},
        success: function (result) {
            if (result.success) {
                $('#chargesCalculationTable').remove();
                $('.swal-content').append(`
                <table id="chargesCalculationTable" class="table mt-3 mb-0">
                    <tr>
                        <td class="text-start">Donation Amount</td>
                        <td class="text-end charges">${result.data.campaignAmount.toFixed(2)}</td>
                    </tr>
                    <tr class="border-bottom border-secondary">
                        <td class="text-start">Charge Amount</td>
                        <td class="text-end">- ${(result.data.chargeAmount.toFixed(2))}</td>
                    </tr>
                    <tr>
                        <td class="text-start">Total Withdrawal Amount</td>
                        <td class="text-end">${result.data.totalWithdrawalAmount.toFixed(2)}</td>
                    </tr>
                </table>
                `);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}
