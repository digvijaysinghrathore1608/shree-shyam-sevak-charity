'use strict'

listen('click', '.role-delete-btn', function (event) {
    let deleteRoleId = $(event.currentTarget).data('id')
    let url = route('roles.destroy', { role: deleteRoleId })
    deleteItem(url, 'Role')
})

listen('click', '#checkAllPermission', function () {
    if ($('#checkAllPermission').is(':checked')) {
        $('.permission').each(function () {
            $(this).prop('checked', true)
        })
    } else {
        $('.permission').each(function () {
            $(this).prop('checked', false)
        })
    }
})

listen('click', '.permission', function () {
    if($('.permission:checked').length === $('.permission').length){
        $('#checkAllPermission').prop('checked',true);
    }else{
        $('#checkAllPermission').prop('checked',false);
    }
})
