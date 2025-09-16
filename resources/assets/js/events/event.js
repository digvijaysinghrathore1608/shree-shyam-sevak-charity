'use strict'

listen('click', '.event-delete-btn', function (event) {
    let deleteEventId = $(event.currentTarget).data('id')
    let url = route('events.destroy', { event: deleteEventId })
    deleteItem(url, 'Event')
})

listen('change', '#eventStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#eventFilterBtn'), $('#eventFilter'))
})

listen('click', '#eventResetFilter', function () {
    $('#eventStatus').val(3).change()
    hideDropdownManually($('#eventFilterBtn'), $('#eventFilter'))
})

listen('click', '#eventFilterBtn', function () {
    openDropdownManually($('#eventFilterBtn'), $('#eventFilter'))
})
