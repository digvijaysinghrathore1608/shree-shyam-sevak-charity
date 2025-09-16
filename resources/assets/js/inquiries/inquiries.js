'use strict'

listen('click', '.inquiry-delete-btn', function (event) {
    let deleteInquiryID = $(event.currentTarget).data('id')
    let url = route('inquiries.destroy', { inquiry: deleteInquiryID })
    deleteItem(url, 'Inquiry')
})

listen('click', '.inquiry-show-btn', function (event) {
    $('#showInquiriesModal').appendTo('body').modal('show')
    let inquiryId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('inquiries.index') + '/' + inquiryId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showName').html(result.data.name)
                $('#showEmail').html(result.data.email)
                $('#showPhoneNo').html(result.data.phone)
                $('#showSubject').html(result.data.subject)
                $('#showCreatedAt').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                $('#showUpdatedAt').
                    text(moment(result.data.updated_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                let element = document.createElement('textarea')
                element.innerHTML = (!isEmpty(result.data.message))
                    ? result.data.message
                    : 'N/A'
                $('#showMessage').html(element.value)
                Livewire.emit('refresh')
                $('#showInquiriesModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('change', '#enquiriesStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
    hideDropdownManually($('#inquiriesFilterBtn'), $('#inquiriesFilter'))
})

listen('click', '#enquiryResetFilter', function () {
    $('#enquiriesStatus').val(2).change()
    hideDropdownManually($('#inquiriesFilterBtn'), $('#inquiriesFilter'))
})

listen('click', '#inquiriesFilterBtn', function () {
    openDropdownManually($('#inquiriesFilterBtn'), $('#inquiriesFilter'))
})
