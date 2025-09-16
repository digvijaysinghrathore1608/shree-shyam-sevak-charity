'use strict'

listen('click', '.call-to-action-delete-btn', function (event) {
    let deleteCallToActionID = $(event.currentTarget).data('id')
    let url = route('call-to-action.destroy',
        { callToAction: deleteCallToActionID })
    deleteItem(url, 'Call To Action')
})

listen('click', '.call-to-action-show-btn', function (event) {
    $('#showCallToActionModal').appendTo('body').modal('show')
    let callToActionId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('call-to-actions.index') + '/' + callToActionId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showName').html(result.data.name)
                $('#showPhoneNo').html(result.data.phone)
                $('#showAddress').html(result.data.address)
                $('#showZip').html(result.data.zip)
                $('#showCreatedAt').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                $('#showUpdatedAt').
                    text(moment(result.data.updated_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                $('#callToActionTable').DataTable().ajax.reload(null, true)
                $('#showCallToActionModal').appendTo('body').modal('show')
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('change', '#callToActionStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
    hideDropdownManually($('#callToActionFilterBtn'), $('#callToActionFilter'))
})

listen('click', '#callToActionResetFilter', function () {
    $('#callToActionStatus').val(2).change()
    hideDropdownManually($('#callToActionFilterBtn'), $('#callToActionFilter'))
})

listen('click', '#callToActionFilterBtn', function () {
    openDropdownManually($('#callToActionFilterBtn'), $('#callToActionFilter'))
})
