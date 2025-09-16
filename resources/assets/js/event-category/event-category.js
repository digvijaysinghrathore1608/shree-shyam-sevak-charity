'use strict'

listen('click', '#addEventCategoryBtn', function () {
    $('#addEventCategoryModal').appendTo('body').modal('show')
    resetModalForm('#addEventCategoryForm')
    $('#previewImage').css('background-image',
        'url("' + defaultEventCategoryImage + '")')
})

listen('submit', '#addEventCategoryForm', function (e) {
    e.preventDefault()
    processingBtn('#addEventCategoryForm', '#eventCategoryBtn',
        'loading');
    $('#eventCategoryBtn').prop('disabled', true);
    $.ajax({
        url: route('event-categories.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message)
            $('#addEventCategoryModal').modal('hide')
            Livewire.emit('refresh')
            $('#eventCategoryBtn').prop('disabled', false)
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#eventCategoryBtn').prop('disabled', false);
        },
        complete: function () {
            processingBtn('#addEventCategoryForm', '#btnSave');
        },
    });
});

listen('submit', '#editEventCategoryForm', function (event) {
    event.preventDefault();
    processingBtn('#editEventCategoryForm', '#btnEditSave', 'loading');
    $('#btnEditSave').prop('disabled', true);
    let id = $('#editEventCategoryId').val();

    $.ajax({
        url: route('event-categories.update', id),
        type: 'POST',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editEventCategoryModal').modal('hide');
                Livewire.emit('refresh');
                $('#btnEditSave').prop('disabled', false);

            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $('#btnEditSave').prop('disabled', false);
        },
        complete: function () {
            processingBtn('#editEventCategoryForm', '#btnEditSave');
        },
    });
});

listen('click', '.event-category-delete-btn', function (event) {
    let deleteEventCategoryId = $(event.currentTarget).data('id');
    let url = route('event-categories.destroy',
        { event_category: deleteEventCategoryId });
    deleteItem(url, 'Event Category');
});

listen('click', '.event-category-edit-btn', function (event) {
    let editEventCategoryId = $(event.currentTarget).data('id');
    renderEventCategoryData(editEventCategoryId);
});

function renderEventCategoryData (id) {
    $.ajax({
        url: route('event-categories.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#editEventCategoryId').val(result.data.id);
                $('#editName').val(result.data.name);
                if (isEmpty(result.data.image_url)) {
                    $('#editPreviewImage').css('background-image',
                        'url("' + defaultEventCategoryImage + '")')
                } else {
                    $('#editPreviewImage').css('background-image',
                        'url("' + result.data.image_url + '")');
                }
                (result.data.is_active == 1) ? $('#editIsActive').
                    prop('checked', true) : $('#editIsActive').
                    prop('checked', false);
                $('#editIsActive').prop('disabled', false);
                if (result.data.events.length > 0) {
                    $('#editIsActive').append('<input name="is_active_true" value="1">')
                    $('#editIsActive').prop('disabled', true);
                }
                $('#editEventCategoryModal').modal('show').appendTo('body');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}

listen('click', '.isActive', function (event) {
    let eventCategoryId = $(event.currentTarget).data('id');
    $.ajax({
        type: 'post',
        url: route('event-categories.status'),
        data: { id: eventCategoryId },
        success: function (result) {
            Livewire.emit('refresh');
            displaySuccessMessage(result.message);
        },
    });
});

listen('change', '#eventCategoryStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
    hideDropdownManually($('#eventCategoryFilterBtn'),
        $('#eventCategoryFilter'));
});

listen('click', '#eventCategoryResetFilter', function () {
    $('#eventCategoryStatus').val(2).change();
    hideDropdownManually($('#eventCategoryFilterBtn'),
        $('#eventCategoryFilter'));
});

listen('click', '#eventCategoryFilterBtn', function () {
    openDropdownManually($('#eventCategoryFilterBtn'),
        $('#eventCategoryFilter'));
});
