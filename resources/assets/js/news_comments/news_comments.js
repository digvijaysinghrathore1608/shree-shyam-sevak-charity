'use strict'

listen('hidden.bs.modal', '#editNewsCommentsModal', function () {
    resetModalForm('#editNewsCommentsForm')
})

listen('click', '.news-comment-edit-btn', function (event) {
    let editNewsCommentsId = $(event.currentTarget).data('id')
    renderNewsCommentsData(editNewsCommentsId)
})

function renderNewsCommentsData (id) {
    $.ajax({
        url: route('news-comments.edit', id),
        type: 'GET',
        success: function (result) {
            Livewire.emit('refresh', 'refresh')
            $('#newsCommentsID').val(result.data.id)

            $('#editNewsComments').val(result.data.comments)

            $('#editNewsCommentsName').val(result.data.name)

            $('#editNewsCommentsEmail').val(result.data.email)

            $('#editNewsCommentsWebsiteName').val(result.data.website_name)

            $('#editNewsCommentsModal').modal('show')
        },
    })
}

listen('submit', '#editNewsCommentsForm', function (e) {
    e.preventDefault()
    let websiteUrl = $('#editNewsCommentsWebsiteName').val()

    let websiteExp = new RegExp(
        /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)+[-a-z]/i)

    let websiteCheck = (websiteUrl == '' ? true : (websiteUrl.match(
        websiteExp) ? true : false))

    if (!websiteCheck) {
        displayErrorMessage('Please enter a valid website name.')
        return false
    }

    let formData = $(this).serialize()
    let id = $('#newsCommentsID').val()
    $.ajax({
        url: route('news-comments.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            $('#editNewsCommentsModal').modal('hide')
            displaySuccessMessage(result.message)
            Livewire.emit('refresh')
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
        complete: function () {
        },
    })
})
listen('click', '.news-comment-delete-btn', function (event) {
    let deleteNewsCommentID = $(event.currentTarget).data('id')
    let url = route('news-comments.destroy', { news_comment : deleteNewsCommentID })
    deleteItem(url, 'Comment')
})

