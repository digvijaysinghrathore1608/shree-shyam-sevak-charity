'use strict'

listen('click', '.email-subscribe-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id')
    deleteItem(route('email.subscribe.destroy', recordId), 'Subscriber')
})
