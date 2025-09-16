'use strict'

listen('click', '#addNewsCategoryBtn', function () {
    $('#createNewsCategoryModal').appendTo('body').modal('show')
    resetModalForm('#createNewsCategoryForm')
})

$('#editNewsCategoryModal').on('hidden.bs.modal', function () {
    resetModalForm('#editNewsCategoryForm',
        '#editNewsCategoryValidationErrorsBox')
})

listen('click', '.news-category-edit-btn', function (event) {
    let editNewsCategoryId = $(event.currentTarget).data('id')
    renderNewsCategoriesData(editNewsCategoryId)
})

function renderNewsCategoriesData (id) {
    $.ajax({
        url: route('news-categories.edit', id),
        type: 'GET',
        success: function (result) {
            Livewire.emit('refresh', 'refresh')
            $('#NewsCategoryID').val(result.data.id)

            $('#editNewsCategoryName').val(result.data.name)

            $('#editNewsCategoryModal').modal('show')
        },
    })
}

listen('submit', '#createNewsCategoryForm', function (e) {
    e.preventDefault()
    processingBtn('#createNewsCategoryForm', '#createNewsCategoryBtn',
        'loading')
    $('#createNewsCategoryBtn').prop('disabled', true);
    $.ajax({
        url: route('news-categories.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#createNewsCategoryModal').modal('hide')
                $('#createNewsCategoryBtn').prop('disabled', false);
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#createNewsCategoryBtn').prop('disabled', false);
        },
    })
})

listen('submit', '#editNewsCategoryForm', function (e) {
    e.preventDefault()
    $('#editNewsCategoryBtn').prop('disabled', true);
    let formData = $(this).serialize()
    let id = $('#NewsCategoryID').val()

    $.ajax({
        url: route('news-categories.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            $('#editNewsCategoryModal').modal('hide')
            displaySuccessMessage(result.message)
            $('#editNewsCategoryBtn').prop('disabled', false);
            Livewire.emit('refresh')
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editNewsCategoryBtn').prop('disabled', false);
        },
        complete: function () {
        },
    })
})

listen('click', '.news-category-delete-btn', function (event) {
    let deleteNewsCategoryID = $(event.currentTarget).data('id')
    let url = route('news-categories.destroy', { news_category: deleteNewsCategoryID })
    deleteItem(url, 'News Category')
})
