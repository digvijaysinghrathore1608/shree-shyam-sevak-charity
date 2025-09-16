'use strict'

listen('click', '#addFaqs', function () {
    $('#creatFaqsModal').appendTo('body').modal('show')
    resetModalForm('#createFaqsForm');
})

listen('hidden.bs.modal', '#editFaqsModal', function () {
    resetModalForm('#editFaqsForm')
})

listen('click', '.faqs-edit-btn', function (event) {
    let editFaqsId = $(event.currentTarget).data('id')
    renderFaqsData(editFaqsId)
})

function renderFaqsData (id) {
    $.ajax({
        url: route('faqs.edit', id),
        type: 'GET',
        success: function (result) {

            $('#faqsID').val(result.data.id)

            $('#editFaqsTitle').val(result.data.title)

            $('#editFaqsDescription').val(result.data.description)

            $('#editFaqsModal').modal('show')
        },
    })
}

listen('submit', '#createFaqsForm', function (e) {
    e.preventDefault()
    $('#createFaqsBtn').prop('disabled', true);
    $.ajax({
        url: route('faqs.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#creatFaqsModal').modal('hide')
                Livewire.emit('refresh')
                $('#createFaqsBtn').prop('disabled', false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#createFaqsBtn').prop('disabled', false);
        },
    })
})

listen('submit', '#editFaqsForm', function (e) {
    e.preventDefault()
    $('#editFaqsBtn').prop('disabled', true);
    let formData = $(this).serialize()
    let id = $('#faqsID').val()
    $.ajax({
        url: route('faqs.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            $('#editFaqsModal').modal('hide')
            displaySuccessMessage(result.message)
            Livewire.emit('refresh')
            $('#editFaqsBtn').prop('disabled', false);

        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editFaqsBtn').prop('disabled', false);
        },
        complete: function () {
        },
    })
})

listen('click', '.faq-show-btn', function (event) {
    $('#showFaqModal').appendTo('body').modal('show')
    let faqId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('faqs.index') + '/' + faqId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#faqShowTitle').html(result.data.title)
                $('#faqShowCreatedAt').
                    text(moment(result.data.created_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                $('#faqShowUpdatedAt').
                    text(moment(result.data.updated_at,
                        'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY'))
                let element = document.createElement('textarea')
                element.innerHTML = (!isEmpty(result.data.description))
                    ? result.data.description
                    : 'N/A'
                $('#faqShowDescription').html(element.value)
                Livewire.emit('refresh')
                $('#showFaqModal').appendTo('body').modal('show')

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.faqs-delete-btn', function (event) {
    let deleteFaqsId = $(event.currentTarget).data('id')
    let url = route('faqs.destroy', { faq: deleteFaqsId })
    deleteItem(url, 'FAQ')
})

