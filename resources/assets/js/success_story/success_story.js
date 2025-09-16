'use strict'

listen('click', '.success-story-delete-btn', function (event) {
    let deleteSuccessStoryID = $(event.currentTarget).data('id')
    let url = route('success-stories.destroy',
        { success_story: deleteSuccessStoryID })
    deleteItem(url, 'Success Story')
})

listen('submit', '#addSuccessStoryForm', function () {

    $('#saveSuccessStoryBtn').prop('disabled', true)

    return true;
})

listen('submit', '#editSuccessStoryForm', function () {

    $('#saveSuccessStoryBtn').prop('disabled', true);

    return true;
})

