'use strict'

listen('click', '.user-delete-btn', function (event) {
    let deleteUserId = $(event.currentTarget).data('id')
    deleteItem(route('users.destroy', deleteUserId), 'User')
})

listen('change', '.is-verified', function (event) {
    let userVerifyId = $(event.currentTarget).data('id')
    $.ajax({
        url: route('user.email.verify', userVerifyId),
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                window.livewire.emit('refresh')
            }
        },
    })
})

listen('change', '.userIsActive', function (event) {
    let userStatusId = $(event.currentTarget).data('id')
    updateUserStatus(userStatusId)
})

function updateUserStatus (id) {
    $.ajax({
        url: route('user.status.active.deactive', id),
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
            }
        },
    })
}

let userFilterBtn = $('#userFilterBtn');
let userFilter = $('#userFilter');

listen('change', '#userStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#userFilterBtn'), $('#userFilter'))
})

listen('click', '#userResetFilter', function () {
    $('#userStatus').val(2).change()
    hideDropdownManually($('#userFilterBtn'), $('#userFilter'))
})

listen('click', '#userFilterBtn', function () {
    openDropdownManually($('#userFilterBtn'), $('#userFilter'))
})

function isEmailEditProfile(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

listenSubmit('#userCreateForm,#userEditForm',function () {
    if (!isEmailEditProfile($('#email').val())) {
        displayErrorMessage('Please Enter valid Email.');
        return false;
    }
    if ($('#password').val() != ''){
        if ($('#password').val() !== $('#cPassword').val()) {
            displayErrorMessage('The password and password confirmation must match.')
            return false;
        }
}
    $('#btnSubmit').attr('disabled',true)
});
