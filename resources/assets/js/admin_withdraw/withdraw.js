'use strict'

listen('click', '.admin-withdraw-request-btn', function (event) {
    let id = $(event.currentTarget).data('id')
    $('.swal-content__textarea').attr('placeholder','Type your notes here')
    let divAttr = document.createElement("div");
    divAttr.innerHTML ='<textarea class="swal2-textarea swal-content__input mt-3" id="notes" placeholder="Type your message here" style="display: flex;"></textarea>';
        swal({
        title: 'Withdraw Request',
        content:divAttr,
        inputPlaceholder: 'Type your notes here',
        text: 'Are you sure ?',
        type: 'info',
        icon: sweetWithdrawAlertIcon,
        buttons: {
            confirm:'Approve!',
            denyButtonText:'Reject',
            cancel: 'Cancel'    
        },
    }).then(function (result) {
            if (!result) return null;
            let notes = $('.swal-content__input').val();
           
        if (result == true) {
            $.ajax({
                url: route('withdraw.update', id),
                type: 'PUT',
                data: {
                    admin_notes: notes,
                    is_approved: 1,
                },
                success: function (obj) {

                    let email = obj.data.email
                    let reference_id = obj.data.id
                    let amount = obj.data.deducate_amount
                    let currency = obj.data.campaign.currency

                    $.ajax({
                        type: 'GET',
                        url: route('paypal.payout'),
                        data: {
                            reference_id: reference_id,
                            email: email,
                            amount: amount,
                            currency: currency,
                        },
                        success: function (result) {

                            if (result.url) {
                                window.location.href = result.url
                            }

                            if (result.statusCode === 201) {
                                let redirectTo = ''

                                $.each(result.result.links,
                                    function (key, val) {
                                        if (val.rel == 'approve') {
                                            redirectTo = val.href
                                        }
                                    })
                                location.href = redirectTo
                            }
                        },
                        error: function (error) {
                           
                        },
                        complete: function () {
                        },
                    })

                    if (obj.success) {
                        window.livewire.emit('refresh')
                    }
                    swal({
                        title: 'Approved',
                        text: 'Withdraw request has Approved.',
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
        } else {
            let notes = $('.swal-content__input').val()
            $.ajax({
                url: route('withdraw.update', id),
                type: 'PUT',
                data: {
                    admin_notes: notes,
                    status: 3,
                },
                success: function (result) {
                    if (result.success) {
                        swal({
                            title: 'Rejected',
                            text: result.message,
                            icon: 'success',
                            timer: 2000,
                            confirmButtonColor: '#009ef7',
                        })
                        window.livewire.emit('refresh')
                    }
                }, error: function (data) {
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
    })
})
listen('change', '#withdrawStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#withdrawStatusFilterBtn'), $('#withdrawFilter'))
})

listen('click', '#withdrawResetFilter', function () {
    $('#withdrawStatus').val(5).change()
    hideDropdownManually($('#withdrawStatusFilterBtn'), $('#withdrawFilter'))
})

listen('click', '#withdrawStatusFilterBtn', function () {
    openDropdownManually($('#withdrawStatusFilterBtn'), $('#withdrawFilter'))
})

listen('click', '.withdraw-request-show-btn', function (event) {
    let withdrawId = $(event.currentTarget).data('id')

    $.ajax({
        url: route('withdraw.showPaymentDetails', withdrawId),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let data = result.data
                if (data.payment_type == 1) {
                    $('#showPaypalAccountEmail').html(data.email)
                    $('#showPaypalAccountMessage').
                        html(!isEmpty(data.user_notes)
                            ? data.user_notes
                            : 'N/A')
                    $('#showPaypalCreatedRequestDate').
                        text(moment(data.created_at,
                            'YYYY-MM-DD hh:mm:ss').
                            format('Do MMM, YYYY'))
                    $('#approvedPayPalType').html(data.approved_type)
                    $('#paypalPaymentDetailsShowModel').
                        appendTo('body').
                        modal('show')

                } else {
                    $('#showBankAccountNumber').
                        html(data.bank_details.account_number)
                    $('#showIsbnNo').html(data.bank_details.isbn_number)
                    $('#showBranchName').html(data.bank_details.branch_name)
                    $('#showAccountHolderName').
                        html(data.bank_details.account_holder_name)
                    $('#showBankMessage').
                        html(!isEmpty(data.user_notes)
                            ? data.user_notes
                            : 'N/A')
                    $('#showBankCreatedRequestDate').
                        text(moment(data.created_at,
                            'YYYY-MM-DD hh:mm:ss').
                            format('Do MMM, YYYY'))
                    $('#approvedType').html(data.approved_type)
                    $('#bankPaymentDetailsShowModel').
                        appendTo('body').
                        modal('show')
                }

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})
