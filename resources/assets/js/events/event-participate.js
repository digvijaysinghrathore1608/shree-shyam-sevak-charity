'use strict'

listen('click', '.event-participant-delete-btn', function (event) {
    let deleteParticipateId = $(event.currentTarget).data('id')
    let url = route('events.participate.destroy', { eventParticipant : deleteParticipateId })
    deleteItem(url, 'Event Participant')
})
