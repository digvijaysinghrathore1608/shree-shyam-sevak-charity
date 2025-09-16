'use strict'

listen('click', '.delete-btn', function (event) {
    let deletePageId = $(event.currentTarget).data('id')
    let url = route('pages.destroy', {page: deletePageId })
    deleteItem(url, 'Page')
})

listen('click', '.page-active', function (event) {
    let pagStatusId = $(event.currentTarget).data('id')
    $.ajax({
        type: 'post',
        url: route('pages.status'),
        data: { id: pagStatusId },
        success: function (result) {
            Livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listen('change', '#pageStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
    hideDropdownManually($('#pageFilterBtn'), $('#pageFilter'))
})

listen('click', '#pagesResetFilter', function () {
    $('#pageStatus').val(2).change()
    hideDropdownManually($('#pageFilterBtn'), $('#pageFilter'))
})

listen('click', '.page-show-btn', function (event) {
    $('#showPagesModal').appendTo('body').modal('show')
    let pageId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('pages.index') + '/' + pageId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                console.log(result.data);
                $('#showName').html(result.data.name)
                $('#showTitle').html(result.data.title)
                $('#showStatus').html((result.data.is_active == 1) ? 'yes':'No')
                $('#showCreatedAt').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                $('#showUpdatedAt').
                    text(moment(result.data.updated_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                let element = document.createElement('textarea')
                element.innerHTML = (!isEmpty(result.data.description))
                    ? result.data.description
                    : 'N/A'
                $('#showDescription').html(element.value)
                Livewire.emit('refresh')
                $('#showPagesModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '#pageFilterBtn', function () {
    openDropdownManually($('#pageFilterBtn'), $('#pageFilter'))
})
