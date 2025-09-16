'use strict'

listen('click', '.second-slider-delete-btn', function (event) {
    let deleteSecondSliderID = $(event.currentTarget).data('id')
    let url = route('second-slider.destroy',
        { second_slider: deleteSecondSliderID })
    deleteItem(url, 'Slider')
})
listen('submit', '#createFrontSlider2Form', function (e) {
    e.preventDefault()

    $('#saveSlider2Btn').prop('disabled', true)

    $('#createFrontSlider2Form')[0].submit();

    return true;
})

listen('submit', '#editFrontSlider2Form', function (e) {
    e.preventDefault()

    $('#saveSlider2Btn').prop('disabled', true);

    $('#editFrontSlider2Form')[0].submit();

    return true;
})
