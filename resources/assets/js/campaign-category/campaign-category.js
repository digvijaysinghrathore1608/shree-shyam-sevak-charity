'use strict'

listen('click', '#addCampaignCategoryBtn', function () {
    $('#addCampaignCategoryModal').appendTo('body').modal('show')
    resetModalForm('#addCampaignCategoryForm')
})

listen('hidden.bs.modal', '#addCampaignCategoryBtn', function () {
    resetModalForm('#addCampaignCategoryForm')
})

listen('submit', '#addCampaignCategoryForm', function (e) {
    e.preventDefault()
    processingBtn('#addCampaignCategoryForm', '#campaignCategoryBtn', 'loading');
    $('#campaignCategoryBtn').prop('disabled', true)
    $.ajax({
        url: route('campaign-categories.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            Livewire.emit('refresh', 'refresh')
            displaySuccessMessage(result.message)
            $('#addCampaignCategoryModal').modal('hide')
            $('#campaignCategoryBtn').prop('disabled', false)
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#campaignCategoryBtn').prop('disabled', false)
        },
        complete: function () {
            processingBtn('#addCampaignCategoryForm', '#btnSave')
        },
    })
})

listen('submit', '#editCampaignCategoryForm', function (event) {
    event.preventDefault()
    processingBtn('#editCampaignCategoryForm', '#btnEditSave', 'loading')
    $('#btnEditSave').prop('disabled', true)
    let id = $('#editCampaignCategoryId').val()

    $.ajax({
        url: route('campaign-categories.update', id),
        type: 'POST',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                Livewire.emit('refresh', 'refresh')
                $('#btnEditSave').prop('disabled', false)
                displaySuccessMessage(result.message)
                $('#editCampaignCategoryModal').modal('hide')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#btnEditSave').prop('disabled', false)
        },
        complete: function () {
            processingBtn('#editCampaignCategoryForm', '#btnEditSave')
        },
    })
});

listen('click', '.campaign-category-delete-btn', function (event) {
    let deleteCampaignCategoryId = $(event.currentTarget).data('id')
    deleteItem(route('campaign-categories.destroy', deleteCampaignCategoryId),
        'Campaign Category')
});

listen('click', '#addCampaignCategoryBtn', function () {
    $('#addCampaignCategoryModal').appendTo('body').modal('show')
    resetModalForm('#addCampaignCategoryForm')
});

listen('click', '.campaign-category-edit-btn', function (event) {
    let editCampaignCategoryId = $(event.currentTarget).data('id')
    renderCampaignCategoryData(editCampaignCategoryId)
});

function renderCampaignCategoryData (id) {
    $.ajax({
        url: route('campaign-categories.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#editCampaignCategoryId').val(result.data.id)
                $('#editName').val(result.data.name);
                (result.data.is_active == 1) ? $('#editIsActive').
                    prop('checked', true) : $('#editIsActive').
                    prop('checked', false)
                $('#editIsActive').prop('disabled', false)
                if (result.data.campaigns.length > 0) {
                    $('#editIsActive').prop('disabled', true)
                }
                if (isEmpty(result.data.image)) {
                    $('#editCampaignCategoryPreviewImage').css('background-image',
                        'url("' + brandDefaultImage + '")')
                } else {
                    $('#editCampaignCategoryPreviewImage').css('background-image',
                        'url("' + result.data.image + '")')
                }
                $('#editCampaignCategoryModal').
                    modal('show').
                    appendTo('body')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}

listen('click', '.campaign-category-active', function (event) {
    let campaignCategoryId = $(event.currentTarget).data('id')
    $.ajax({
        type: 'post',
        url: route('campaign-categories.status'),
        data: { id: campaignCategoryId },
        success: function (result) {
            Livewire.emit('refresh', 'refresh')
            displaySuccessMessage(result.message)
        },
    });
});

listen('change', '#campaignCategoryStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#campaignCategoryFilterBtn'), $('#campaignCategoryFilter'));
});

listen('click', '#campaignCategoryResetFilter', function () {
    $('#campaignCategoryStatus').val(2).change();
    hideDropdownManually($('#campaignCategoryFilterBtn'), $('#campaignCategoryFilter'));
});

listen('click', '#campaignCategoryFilterBtn', function () {
    openDropdownManually($('#campaignCategoryFilterBtn'), $('#campaignCategoryFilter'))
});
