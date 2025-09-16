'use strict'

listen('submit', '#callToActionForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('landing.call-to-actions'),
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            
            if (result.success) {
                iziToast.success({
                    title: 'Success',
                    message: result.message,
                    position: 'topRight',
                });
                $('#callToActionForm')[0].reset();
            }
        },
        error: function (result) {
            
            iziToast.error({
                title: 'Error',
                message: result.responseJSON.message,
                position: 'topRight',
            });
            $('#callToActionForm')[0].reset();
        },
    })
})
