'use strict'

listen('click', '#addCampaignUpdates', function () {
    $('#creatCampaignUpdatesModal').appendTo('body').modal('show')
    resetModalForm('#createCampaignUpdatesForm')
})

listen('hidden.bs.modal', '#editCampaignUpdatesModal', function () {
    resetModalForm('#editCampaignUpdatesForm')
})

listen('click', '.campaign-update-edit-btn', function (event) {
    let editCampaignUpdatesId = $(event.currentTarget).data('id')
    renderCampaignUpdatesData(editCampaignUpdatesId)
})

function renderCampaignUpdatesData (id) {
    $.ajax({
        url: route('campaign-updates.edit', id),
        type: 'GET',
        success: function (result) {
            $('#campaignUpdatesID').val(result.data.id)

            $('#editCampaignUpdatesTitle').val(result.data.title)

            $('#editCampaignUpdatesDescription').val(result.data.description)

            $('#editCampaignUpdatesModal').modal('show')
        },
    })
}

listen('submit', '#createCampaignUpdatesForm', function (e) {
    e.preventDefault()
    $('#createCampaignUpdateBtn').prop('disabled', true)
    $.ajax({
        url: route('campaign-updates.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                Livewire.emit('refresh', 'refresh')
                displaySuccessMessage(result.message)
                $('#creatCampaignUpdatesModal').modal('hide')
                $('#createCampaignUpdateBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#createCampaignUpdateBtn').prop('disabled', false)
        },
    })
})

listen('submit', '#editCampaignUpdatesForm', function (e) {
    e.preventDefault()
    $('#editCampaignUpdateBtn').prop('disabled', true)
    let formData = $(this).serialize()
    let id = $('#campaignUpdatesID').val()
    $.ajax({
        url: route('campaign-updates.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            Livewire.emit('refresh', 'refresh')
            $('#editCampaignUpdatesModal').modal('hide')
            displaySuccessMessage(result.message)
            $('#editCampaignUpdateBtn').prop('disabled', false)
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editCampaignUpdateBtn').prop('disabled', false)
        },
        complete: function () {
        },
    })
})

listen('click', '.campaign_update-show-btn', function (event) {
    $('#showCampaignUpdateModal').appendTo('body').modal('show')
    let campaignFaqUpdate = $(event.currentTarget).data('id')
    $.ajax({
        url: route('campaign-updates.index') + '/' + campaignFaqUpdate,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#faqUpdateShowTitle').html(result.data.title)
                $('#faqUpdateShowCreatedAt').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                $('#faqUpdateShowUpdatedAt').
                    text(moment(result.data.updated_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                let element = document.createElement('textarea')
                element.innerHTML = (!isEmpty(result.data.description))
                    ? result.data.description
                    : 'N/A'
                $('#faqUpdateShowDescription').html(element.value)
                Livewire.emit('refresh')
                $('#showCampaignUpdateModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.campaign-update-delete-btn', function (event) {
    let deleteFaqsId = $(event.currentTarget).data('id')
    deleteItem(route('campaign-updates.destroy', deleteFaqsId),
        'Campaign Updates')
})

listen('click', '#addUserCampaignUpdates', function () {
    $('#creatCampaignUpdatesModal').appendTo('body').modal('show')
    resetModalForm('#createUserCampaignUpdatesForm')
})

listen('hidden.bs.modal', '#editUserCampaignUpdatesModal', function () {
    resetModalForm('#editUserCampaignUpdatesForm')
})

listen('click', '.user-campaign-update-edit-btn', function (event) {
    let editCampaignUpdatesId = $(event.currentTarget).data('id')
    renderUserCampaignUpdatesData(editCampaignUpdatesId)
})

function renderUserCampaignUpdatesData (id) {
    $.ajax({
        url: route('user.campaign-updates.edit', id),
        type: 'GET',
        success: function (result) {
            $('#campaignUpdatesID').val(result.data.id)

            $('#editUserCampaignUpdatesTitle').val(result.data.title)

            $('#editUserCampaignUpdatesDescription  ').
                val(result.data.description)

            $('#editUserCampaignUpdatesModal').modal('show')
        },
    })
}

listen('submit', '#createUserCampaignUpdatesForm', function (e) {
    e.preventDefault()
    $('#createCampaignUpdateBtn').prop('disabled', true)
    $.ajax({
        url: route('user.campaign-updates.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                Livewire.emit('refresh', 'refresh')
                displaySuccessMessage(result.message)
                $('#creatCampaignUpdatesModal').modal('hide')
                $('#createCampaignUpdateBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#createCampaignUpdateBtn').prop('disabled', false)
        },
    })
})

listen('submit', '#editUserCampaignUpdatesForm', function (e) {
    e.preventDefault()
    $('#editCampaignUpdateBtn').prop('disabled', true)
    let formData = $(this).serialize()
    let id = $('#campaignUpdatesID').val()
    $.ajax({
        url: route('user.campaign-updates.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            Livewire.emit('refresh', 'refresh')
            $('#editUserCampaignUpdatesModal').modal('hide')
            displaySuccessMessage(result.message)
            $('#editCampaignUpdateBtn').prop('disabled', false)
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editCampaignUpdateBtn').prop('disabled', false)
        },
        complete: function () {
        },
    })
})

listen('click', '.user-campaign-update-show-btn', function (event) {
    $('#showCampaignUpdateModal').appendTo('body').modal('show')
    let campaignFaqUpdate = $(event.currentTarget).data('id')
    $.ajax({
        url: route('user.campaign-updates.index') + '/' + campaignFaqUpdate,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#faqUpdateShowTitle').html(result.data.title)
                $('#faqUpdateShowCreatedAt').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                $('#faqUpdateShowUpdatedAt').
                    text(moment(result.data.updated_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                let element = document.createElement('textarea')
                element.innerHTML = (!isEmpty(result.data.description))
                    ? result.data.description
                    : 'N/A'
                $('#faqUpdateShowDescription').html(element.value)
                Livewire.emit('refresh')
                $('#showCampaignUpdateModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.user-campaign-update-delete-btn', function (event) {
    let deleteFaqsId = $(event.currentTarget).data('id')
    deleteItem(route('user.campaign-updates.destroy', deleteFaqsId),
        'Campaign Updates')
})
