'use strict'

listen('click', '#addTeamBtn', function () {
    $('#createTeamModal').appendTo('body').modal('show')
    resetModalForm('#createTeamForm')
    $('#staffImage').css('background-image',
        'url("' + defaultTeamImage + '")')
})

$('#editTeamModal').on('hidden.bs.modal', function () {
    resetModalForm('#editTeamForm', '#editTeamValidationErrorsBox')
});

listen('click', '.team-edit-btn', function (event) {
    let editTeamID = $(event.currentTarget).data('id');
    renderTeamData(editTeamID);
});

function renderTeamData (editTeamID) {
    $.ajax({
        url: route('team-members.edit', editTeamID),
        type: 'GET',
        success: function (result) {
            $('#editTeamId').val(result.data.id)
            $('#editName').val(result.data.name)
            $('#editDesignation').val(result.data.designation)
            if (isEmpty(result.data.image_url)) {
                $('#editPreviewImage').css('background-image',
                    'url("' + defaultTeamImage + '")')
            } else {
                $('#editPreviewImage').css('background-image',
                    'url("' + result.data.image_url + '")');
            }
            $('#editTeamModal').modal('show');
        },
    });
}

listen('submit', '#createTeamForm', function (e) {
    e.preventDefault();
    $('#createTeamBtn').prop('disabled', true);
    $.ajax({
        url: route('team-members.store'),
        type: 'POST',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#createTeamModal').modal('hide')
                Livewire.emit('refresh')
                $('#createTeamBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $('#createTeamBtn').prop('disabled', false);
        },
    });
});
listen('submit', '#editTeamForm', function (event) {
    event.preventDefault();
    $('#editTeamBtn').prop('disabled', true);
    processingBtn('#editTeamForm', '#btnEditSave', 'loading');
    let editTeamFormID = $('#editTeamId').val();

    $.ajax({
        url: route('teams.update', editTeamFormID),
        type: 'POST',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editTeamModal').modal('hide')
                Livewire.emit('refresh')
                $('#editTeamBtn').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $('#editTeamBtn').prop('disabled', false);
        },
        complete: function () {
            processingBtn('#editTeamForm', '#btnEditSave');
        },
    });
});

listen('click', '.team-delete-btn', function (event) {
    let deleteTeamId = $(event.currentTarget).data('id')
    let url = route('team-members.destroy', { team_member: deleteTeamId })
    deleteItem(url, 'Team Member')
});
