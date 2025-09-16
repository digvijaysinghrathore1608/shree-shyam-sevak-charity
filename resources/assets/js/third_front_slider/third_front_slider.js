'use strict'

listen('click', '.third-slider-delete-btn', function (event) {
    let deleteSliderId = $(event.currentTarget).data('id')
    let url = route('third-slider.destroy', {third_slider: deleteSliderId })
    deleteItem(url, 'Front Slider')
})

listen('submit', '#createFrontSlider3Form', function (e) {
    e.preventDefault()

    $('#saveSlider3Btn').prop('disabled', true);

    $('#createFrontSlider3Form')[0].submit();

    return true;
})

listen('submit', '#editFrontSlider3Form', function (e) {
    e.preventDefault()

    $('#saveSlider3Btn').prop('disabled', true);

    $('#editFrontSlider3Form')[0].submit();

    return true;
})
