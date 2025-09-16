'use strict'
listen('click', '#changePassword', function () {
    $('#changePasswordModal').modal('show').appendTo('body')
    resetModalForm('#changePasswordForm')
    $('.active-class>div.active').removeClass('active')
})

listen('click', '#passwordChangeBtn', function () {
    $.ajax({
        url: route('user.changePassword'),
        type: 'PUT',
        data: $('#changePasswordForm').serialize(),
        success: function (result) {
            $('#changePasswordModal').modal('hide')
            $('#changePasswordForm')[0].reset();
            displaySuccessMessage(result.message)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    });
});

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html('');
    $(selector).text(errorResult.responseJSON.message);
};
