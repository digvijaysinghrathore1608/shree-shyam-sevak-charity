'use strict'

document.addEventListener('turbo:load', loadEventCreateEdit)

function loadEventCreateEdit () {

    let minTime = $('#startDate').val()
    let minDate = new Date()

    if ($('#endDate').length) {

        $('#endDate').flatpickr({
            enableTime: true,
            noCalendar: true,
            enableSeconds: true,
            dateFormat: 'H:i:S',
            time_24hr: true,
            minTime: minTime.split(':')[0] + ':' +
                parseInt(minTime.split(':')[1]) + 5,
        })
    }



    if ($('#eventDate').length) {
        $('#eventDate').flatpickr({
            minDate: new Date(),
            dateFormat: 'Y-m-d',
        })
    }

    if ($('#eventIsEdit').length) {
        $('#eventDate').flatpickr({
            minDate: new Date(),
            dateFormat: 'Y-m-d',
        })
    }

    if ($('#startDate').length) {
        $('#startDate').flatpickr({
            enableTime: true,
            noCalendar: true,
            enableSeconds: true,
            dateFormat: 'H:i:S',
            time_24hr: true,
        })
    }
}

listen('change', '#startDate', function () {
    let startTime = $('#startDate').val()
  let  minTime = '"' + startTime + '"'

    $('#endDate').flatpickr({
        enableTime: true,
        noCalendar: true,
        enableSeconds: true,
        dateFormat: 'H:i:S',
        time_24hr: true,
        minTime: minTime.split(':')[0] + ':' +
            parseInt(minTime.split(':')[1]) + 5,
    })

    if (startTime) {
        let endTime = $('#endDate').val()
        if (startTime > endTime) {
            $('#endDate').val('')
        }
    }

})

listen('keyup', '#eventCreateTitle', function () {
    var eventCreateTitle = $('#eventCreateTitle').val()

    $('#eventCreateSlug').
        val(eventCreateTitle.toLowerCase().replace(/\s+/g, '-'))

    var eventCreateSlug = $('#eventCreateSlug').val()

    if (eventCreateSlug.length > 15) {
        $('#eventCreateSlug').val(eventCreateSlug.substr(0, 15))
    }
});

listen('submit', '#eventCreateForm', function () {

    let websiteUrl = $('#event_organizer_website').val();

    let websiteExp = new RegExp(
        /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)+[-a-z]/i)

    let websiteCheck = (websiteUrl == '' ? true : (websiteUrl.match(
        websiteExp) ? true : false))

    if (!websiteCheck) {
        displayErrorMessage('Please enter a valid event organizer website.')
        return false
    }

    processingBtn('#eventCreateForm', '#btnEventSubmit',
        'loading')

    $('#btnEventSubmit').prop('disabled', true)
})

listen('submit', '#eventEditForm', function () {

    let websiteUrl = $('#event_organizer_website').val();

    let endDate = $('#eventDate').val();
    if (endDate < moment().format('Y-MM-DD')) {
        displayErrorMessage('Event date must be greater then or equal to today date.')
        return false
    }

    let websiteExp = new RegExp(
        /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)+[-a-z]/i)

    let websiteCheck = (websiteUrl == '' ? true : (websiteUrl.match(
        websiteExp) ? true : false))

    if (!websiteCheck) {
        displayErrorMessage('Please enter a valid event organizer website.')
        return false
    }

    processingBtn('#eventEditForm', '#btnEventSubmit', 'loading')

    $('#btnEventSubmit').prop('disabled', true)
});
