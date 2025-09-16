'use strict'

listen('click', '#addCampaignFaqs', function () {
    $('#creatCampaignFaqsModal').appendTo('body').modal('show')
    resetModalForm('#createCampaignFaqsForm')
})

listen('hidden.bs.modal', '#editCampaignFaqsModal', function () {
    resetModalForm('#editCampaignFaqsForm')
})

listen('click', '.campaign-faq-edit-btn', function (event) {
    let editCampaignFaqsId = $(event.currentTarget).data('id')
    renderCampaignFaqsData(editCampaignFaqsId)
})

function renderCampaignFaqsData (id) {
    $.ajax({
        url: route('campaign-faqs.edit', id),
        type: 'GET',
        success: function (result) {
            $('#campaignFaqsID').val(result.data.id)

            $('#editCampaignFaqsTitle').val(result.data.title)

            $('#editCampaignFaqsDescription').val(result.data.description)

            $('#editCampaignFaqsModal').modal('show')
        },
    })
}

listen('submit', '#createCampaignFaqsForm', function (e) {
    e.preventDefault()
    $('#createCampaignFaqsBtn').prop('disabled', true)
    $.ajax({
        url: route('campaign-faqs.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                Livewire.emit('refresh', 'refresh')
                displaySuccessMessage(result.message)
                $('#creatCampaignFaqsModal').modal('hide')
                $('#createCampaignFaqsBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#createCampaignFaqsBtn').prop('disabled', false)
        },
    })
})

listen('submit', '#editCampaignFaqsForm', function (e) {
    e.preventDefault()
    $('#editCampaignFaqsBtn').prop('disabled', true)
    let formData = $(this).serialize()
    let id = $('#campaignFaqsID').val()
    $.ajax({
        url: route('campaign-faqs.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            $('#editCampaignFaqsModal').modal('hide')
            Livewire.emit('refresh', 'refresh')
            displaySuccessMessage(result.message)
            $('#editCampaignFaqsBtn').prop('disabled', false)

        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editCampaignFaqsBtn').prop('disabled', false)
        },
        complete: function () {
        },
    })
})

listen('click', '.campaign_faq-show-btn', function (event) {
    $('#showCampaignFaqModal').appendTo('body').modal('show')
    let campaignFaqId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('campaign-faqs.index') + '/' + campaignFaqId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showTitle').html(result.data.title)
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
                $('#showCampaignFaqModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.campaign-faq-delete-btn', function (event) {
    let deleteFaqsId = $(event.currentTarget).data('id')
    deleteItem(route('campaign-faqs.destroy', deleteFaqsId), 'Campaign FAQ')
})

listen('submit', '#createUserCampaignFaqsForm', function (e) {
    e.preventDefault()
    $('#createCampaignFaqsBtn').prop('disabled', true)
    $.ajax({
        url: route('user.campaign-faqs.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                Livewire.emit('refresh', 'refresh')
                displaySuccessMessage(result.message)
                $('#creatCampaignFaqsModal').modal('hide')
                $('#createCampaignFaqsBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#createCampaignFaqsBtn').prop('disabled', false)
        },
    })
})

listen('click', '#addUserCampaignFaqs', function () {
    $('#creatCampaignFaqsModal').appendTo('body').modal('show')
    resetModalForm('#createUserCampaignFaqsForm')
})

listen('click', '.user-campaign-faq-edit-btn', function (event) {
    let editCampaignFaqsId = $(event.currentTarget).data('id')
    renderUserCampaignFaqsData(editCampaignFaqsId)
})

function renderUserCampaignFaqsData (id) {
    $.ajax({
        url: route('user.campaign-faqs.edit', id),
        type: 'GET',
        success: function (result) {
            $('#campaignFaqsID').val(result.data.id)

            $('#editCampaignFaqsTitle').val(result.data.title)

            $('#editCampaignFaqsDescription').val(result.data.description)

            $('#editUserCampaignFaqsModal').modal('show')
        },
    })
}

listen('hidden.bs.modal', '#editUserCampaignFaqsModal', function () {
    resetModalForm('#editUserCampaignFaqsForm')
})

listen('submit', '#editUserCampaignFaqsForm', function (e) {
    e.preventDefault()
    $('#editCampaignFaqsBtn').prop('disabled', true)
    let formData = $(this).serialize()
    let id = $('#campaignFaqsID').val()
    $.ajax({
        url: route('user.campaign-faqs.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            $('#editUserCampaignFaqsModal').modal('hide')
            Livewire.emit('refresh', 'refresh')
            displaySuccessMessage(result.message)
            $('#editCampaignFaqsBtn').prop('disabled', false)

        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editCampaignFaqsBtn').prop('disabled', false)
        },
        complete: function () {
        },
    })
})

listen('click', '.user_campaign_faq-show-btn', function (event) {
    $('#showCampaignFaqModal').appendTo('body').modal('show')
    let campaignFaqId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('user.campaign-faqs.index') + '/' + campaignFaqId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showTitle').html(result.data.title)
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
                $('#showCampaignFaqModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.user-campaign-faq-delete-btn', function (event) {
    let deleteFaqsId = $(event.currentTarget).data('id')
    deleteItem(route('user.campaign-faqs.destroy', deleteFaqsId),
        'Campaign FAQ')
})
