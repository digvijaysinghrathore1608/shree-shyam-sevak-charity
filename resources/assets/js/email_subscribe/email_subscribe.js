'use strict'

listen('submit', '#addEmailForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('email.subscribe.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                iziToast.success({
                    title: 'Success',
                    message: result.message,
                    position: 'topRight',
                });
                $('#addEmailForm')[0].reset();
            }
        },
        error: function (result) {
            iziToast.error({
                title: 'Error',
                message: result.responseJSON.message,
                position: 'topRight',
            });
            $('#addEmailForm')[0].reset();
        },
    })
})
