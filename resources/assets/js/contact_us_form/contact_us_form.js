'use strict'

listen('submit', '#getInTouchForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('landing.contact.store'),
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if(result.success){
                iziToast.success({
                    title: 'Success',
                    message: result.message,
                    position: 'topRight',
                });
            }
            $('#getInTouchForm')[0].reset();
        },
        error: function (result) {
            iziToast.error({
                title: 'Error.',
                message: result.responseJSON.message,
                position: 'topRight',
            });
        },
    })
})
