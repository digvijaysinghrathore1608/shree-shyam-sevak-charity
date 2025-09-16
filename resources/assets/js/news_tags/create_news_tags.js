'use strict'

listen('click', '.TagsBtn', function () {
    $('#createNewsTagsModal').appendTo('body').modal('show')
    resetModalForm('#createNewsTagsForm')
})

listen('submit', '#createNewsTagsForm', function (e) {
    e.preventDefault()
    processingBtn('#createNewsTagsForm', '#createNewsTagsBtn',
        'loading')
    $('#createNewsTagsBtn').prop('disabled', true);
    $.ajax({
        url: route('news-tags.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message)
            $('#createNewsTagsModal').modal('hide')
            $('#newsTagsTable').DataTable().ajax.reload(null, false)
            $('#createNewsTagsBtn').prop('disabled', false);
            Livewire.emit('refresh')
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#createNewsTagsBtn').prop('disabled', false);
        },
        complete: function () {
            processingBtn('#createNewsTagsForm', '#createNewsTagsBtn')
        },
    })
})

listen('click', '.news-tags-edit-btn', function (event) {
    let eventId = $(event.currentTarget).data('id')
    renderNewsTagsData(eventId)
})

function renderNewsTagsData (id) {
    $.ajax({
        url: route('news-tags.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                Livewire.emit('refresh', 'refresh')
                $('#NewsTagsID').val(result.data.id)
                $('#editName').val(result.data.name)
                $('#editNewsTagsModal').modal('show').appendTo('body')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}

listen('submit', '#editNewsTagsForm', function (e) {
    e.preventDefault()
    $('#editNewsTagsBtn').prop('disabled', true);
    let id = $('#NewsTagsID').val()
    $.ajax({
        url: route('news-tags.update',id),
        type: 'POST',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message)
            $('#editNewsTagsModal').modal('hide')
            $('#newsTagsTable').DataTable().ajax.reload(null, false)
            $('#editNewsTagsBtn').prop('disabled', false);
            Livewire.emit('refresh')
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editNewsTagsBtn').prop('disabled', false);
        },
        complete: function () {
            processingBtn('#editNewsTagsForm', '#editNewsTagsBtn')
        },
    })
})

