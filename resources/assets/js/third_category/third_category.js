'use strict'

listen('click', '.third-category-delete-btn', function (event) {
    let deleteSliderId = $(event.currentTarget).data('id')
    let url = route('third-categories.destroy', {third_category: deleteSliderId })
    deleteItem(url, 'Category')
})

listen('submit', '#createFrontSlider3CategoryForm', function (e) {
    e.preventDefault()

    $('#saveSlider3CategoryBtn').prop('disabled', true);

    $('#createFrontSlider3CategoryForm')[0].submit();

    return true;
})

listen('submit', '#editFrontSlider3CategoryForm', function (e) {
    e.preventDefault()

    $('#saveSlider3CategoryBtn').prop('disabled', true);

    $('#editFrontSlider3CategoryForm')[0].submit();

    return true;
})
