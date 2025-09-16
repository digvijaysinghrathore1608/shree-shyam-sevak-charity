'use strict'

listen('click', '#addCountryBtn', function () {
    $('#addCountryModal').appendTo('body').modal('show')
    resetModalForm('#addCountryForm')
})

listen('submit', '#addCountryForm', function (e) {
    e.preventDefault()
    processingBtn('#addCountryForm', '#CountryBtn',
        'loading')

    $.ajax({
        url: route('countries.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            displaySuccessMessage(result.message)
            $('#addCountryModal').modal('hide')
            Livewire.emit('refresh')
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
        complete: function () {
            processingBtn('#addCountryForm', '#btnSave')
        },
    })
})

listen('click', '.country-edit-btn', function (event) {
    let editCountryId = $(event.currentTarget).data('id')
    renderCountryData(editCountryId)
})

function renderCountryData (id) {
    $.ajax({
        url: route('countries.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#editCountryId').val(result.data.id)
                $('#editName').val(result.data.country_name)
                $('#editCountryModal').modal('show').appendTo('body')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}

listen('submit', '#editCountryForm', function (event) {
    event.preventDefault()
    processingBtn('#editCountryForm', '#btnEditSave', 'loading')
    let id = $('#editCountryId').val()

    $.ajax({
        url: route('countries.update', id),
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editCountryModal').modal('hide')
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
        complete: function () {
            processingBtn('#editCountryForm', '#btnEditSave')
        },
    })
})

listen('click', '.country-delete-btn', function (event) {
    let deleteCountryId = $(event.currentTarget).data('id')
    deleteItem(route('countries.destroy', deleteCountryId), 'Country')
})
