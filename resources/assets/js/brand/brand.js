'use strict'

listen('submit', '#addBrandForm', function (e) {
    e.preventDefault()
    processingBtn('#addBrandForm', '#brandBtn',
        'loading')
    $('#brandBtn').prop('disabled', true)
    $.ajax({
        url: route('brands.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message)
            $('#addBrandModal').modal('hide')
            $('#brandBtn').prop('disabled', false)
            Livewire.emit('refresh')
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#brandBtn').prop('disabled', false)
        },
        complete: function () {
            processingBtn('#addBrandForm', '#btnSave')
        },
    })
})

listen('submit', '#editBrandForm', function (event) {
    event.preventDefault();
    processingBtn('#editBrandForm', '#btnEditSave', 'loading');
    $('#btnEditSave').prop('disabled', true);

    let editBrandFormID = $('#editBrandId').val();

    $.ajax({
        url: route('brands.update', editBrandFormID),
        type: 'POST',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editBrandModal').modal('hide')
                $('#btnEditSave').prop('disabled', false)
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#btnEditSave').prop('disabled', false)
        },
        complete: function () {
            processingBtn('#editBrandForm', '#btnEditSave')
        },
    })
})

listen('click', '.brand-delete-btn', function (event) {
    let deleteBrandID = $(event.currentTarget).data('id')
    let url = route('brands.destroy', {brand: deleteBrandID})
    deleteItem(url, 'Brand')
})

listen('click', '#addBrandBtn', function () {
    $('#addBrandModal').appendTo('body').modal('show')
    resetModalForm('#addBrandForm')
    $('#previewImage').css('background-image',
        'url("' + brandDefaultImage + '")')
})

listen('click', '.brand-edit-btn', function (event) {
    let editBrandID = $(event.currentTarget).data('id')
    renderBrandsData(editBrandID)
})

function renderBrandsData(id) {
    $.ajax({
        url: route('brands.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                Livewire.emit('refresh', 'refresh')
                $('#editBrandId').val(result.data.id)
                $('#editName').val(result.data.name)
                if (isEmpty(result.data.image_url)) {
                    $('#editPreviewImage').css('background-image',
                        'url("' + brandDefaultImage + '")')
                } else {
                    $('#editPreviewImage').css('background-image',
                        'url("' + result.data.image_url + '")')
                }
                $('#editBrandModal').modal('show').appendTo('body')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}
