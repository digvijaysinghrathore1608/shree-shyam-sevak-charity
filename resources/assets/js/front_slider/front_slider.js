'use strict'

listen('click', '.first-slider-delete-btn', function (event) {
    let deleteSliderId = $(event.currentTarget).data('id')
    deleteItem(route('sliders.destroy', deleteSliderId), 'Front Slider')
})

listen('submit', '#createSliderForm', function (e) {

    e.preventDefault()

    $('#saveSliderBtn').prop('disabled', true);

    $('#createSliderForm')[0].submit();

    return true;
})

listen('submit', '#editSliderForm', function (e) {
    e.preventDefault()

    $('#saveSliderBtn').prop('disabled', true);

    $('#editSliderForm')[0].submit();

    return true;
})
