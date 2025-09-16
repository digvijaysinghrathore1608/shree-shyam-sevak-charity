'use strict'

listen('click', '.campaign-delete-btn', function (event) {
    let deleteCampaigntId = $(event.currentTarget).data('id')
    deleteItem(route('campaigns.destroy', deleteCampaigntId), 'Campaign')
})

listen('change', '#campaignStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#campaignStatusFilterBtn'), $('#campaignFilter'))
})

listen('click', '#campaignResetFilter', function () {
    $('#campaignStatus').val(5).change()
    hideDropdownManually($('#campaignStatusFilterBtn'), $('#campaignFilter'))
});

listen('click', '#campaignStatusFilterBtn', function () {
    openDropdownManually($('#campaignStatusFilterBtn'), $('#campaignFilter'))
})

listen('click', '.transaction-show-btn', function (event) {
    $('#showTransactionModal').appendTo('body').modal('show')
    let transactionId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('transaction.show') + '/' + transactionId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#userFullName').html(result.data.full_name)
                $('#showPaymentId').
                    html(
                        result.data.campaign_donation_transaction.transaction_id)
                $('#userEmail').html((!isEmpty(result.data.email))
                    ? result.data.email
                    : 'N/A')

                let campaignCurrencySymbol = $('#campaignCurrencySymbol').val()

                let amount = campaignCurrencySymbol + ' ' +
                    addCommas(
                        (result.data.donated_amount.toFixed(2)).toString())

                $('#showDonatedAmount').html(amount)

                $('#showPaymentMethod').
                    html(result.data.campaign_donation_transaction.payment_type)

                $('#showPaymentDate').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                Livewire.emit('refresh')
                $('#showTransactionModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.transaction-show-gift-btn', function (event) {
    $('#showGiftTransactionModal').appendTo('body').modal('show')
    let transactionId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('transaction.show') + '/' + transactionId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#userGiftFullName').html(result.data.full_name)
                $('#showGiftPaymentId').
                    html(
                        result.data.campaign_donation_transaction.transaction_id)
                $('#userGiftEmail').html((!isEmpty(result.data.email))
                    ? result.data.email
                    : 'N/A')

                let campaignCurrencySymbol = $('#campaignGiftCurrencySymbol').val()

                let amount = campaignCurrencySymbol + ' ' +
                    addCommas(
                        (result.data.donated_amount.toFixed(2)).toString())

                $('#showGiftDonatedAmount').html(amount)

                $('#showGiftPaymentMethod').
                    html(result.data.campaign_donation_transaction.payment_type)

                $('#showGiftPaymentDate').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                Livewire.emit('refresh')
                $('#showGiftTransactionModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.user-transaction-show-btn', function (event) {
    $('#showTransactionModal').appendTo('body').modal('show')
    let transactionId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('user.transaction.show') + '/' + transactionId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#userFullName').html(result.data.full_name)
                $('#showPaymentId').
                    html(
                        result.data.campaign_donation_transaction.transaction_id)
                $('#userEmail').html((!isEmpty(result.data.email))
                    ? result.data.email
                    : 'N/A')

                let campaignCurrencySymbol = $('#campaignCurrencySymbol').val()

                let amount = campaignCurrencySymbol + ' ' +
                    addCommas(
                        (result.data.donated_amount.toFixed(2)).toString())

                $('#showDonatedAmount').html(amount)

                $('#showPaymentMethod').
                    html(result.data.campaign_donation_transaction.payment_type)

                $('#showPaymentDate').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                Livewire.emit('refresh')
                $('#showTransactionModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.user-campaign-delete-btn', function (event) {
    let deleteCampaigntId = $(event.currentTarget).data('id')
    deleteItem(route('user.campaigns.destroy', deleteCampaigntId), 'Campaign')
})

listen('click', '.user-transaction-show-gift-btn', function (event) {
    $('#showGiftTransactionModal').appendTo('body').modal('show')
    let transactionId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('user.transaction.show') + '/' + transactionId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#userGiftFullName').html(result.data.full_name)
                $('#showGiftPaymentId').
                    html(
                        result.data.campaign_donation_transaction.transaction_id)
                $('#userGiftEmail').html((!isEmpty(result.data.email))
                    ? result.data.email
                    : 'N/A')

                let campaignCurrencySymbol = $('#campaignGiftCurrencySymbol').val()

                let amount = campaignCurrencySymbol + ' ' +
                    addCommas(
                        (result.data.donated_amount.toFixed(2)).toString())

                $('#showGiftDonatedAmount').html(amount)

                $('#showGiftPaymentMethod').
                    html(result.data.campaign_donation_transaction.payment_type)

                $('#showGiftPaymentDate').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                Livewire.emit('refresh')
                $('#showGiftTransactionModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})
