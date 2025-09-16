'use strict'
document.addEventListener('turbo:load', loadDonationGiftsData)

function loadDonationGiftsData () {
    const donationGiftDeliverytDate = $('#donationGiftDeliverytDate')
    if (donationGiftDeliverytDate.length) {
        donationGiftDeliverytDate.flatpickr({
            altInput: true,
            altFormat: "J F, Y",
            dateFormat: 'Y-m-d ',
            minDate: "today"
        })
    }
    
// $(document).ready(function(){
    var maxField = 100; 
    var addGiftButton = $('.add-gift'); 
    var giftFieldWrapper = $('.donationWrap'); 
    var giftFieldHTML = ` <div class="gift-field-wrap row">
            <div class="col-11 form-group mr-5">
                <label for="name" class="required mb-1">Gift: </label>
                <input type="text" class="form-control" name="gifts[createGift][]" placeholder="Gift" required>
            </div>
            <div class="d-flex action-wrap align-items-center col-1 mt-5">
                <a href="javascript:void(0)" class="add-gift-add me-1">
                    <i class="fa fa-plus-circle fs-1 text-primary"></i>
                </a>
                <a href="javascript:void(0)"  data-bs-toggle="tooltip"
                   title="{{ __('messages.common.delete') }}"
                   class="btn px-1 text-danger fs-3 delete-gift">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </div>` 
    
    var x = 1; 
    
    $(addGiftButton).click(function(){
        if(x < maxField){
            x++;
            $(giftFieldWrapper).append(giftFieldHTML);
        }
    });
    $(giftFieldWrapper).on('click', '.delete-gift', function(e){
        e.preventDefault();
        $(this).offsetParent().remove(); 
        x--;
    });

    listen('click', '.add-gift-add', function (event) {
        if(x < maxField){
            x++;
            $(giftFieldWrapper).append(giftFieldHTML);
        }
    });
}

listen('click', '.donation-gift-delete-btn', function (event) {
    let deleteDonationGiftId = $(event.currentTarget).data('id')
    deleteItem(route('donation-gifts.destroy', deleteDonationGiftId), 'Donation gift')
})

// listen('click', '.gift-delete-btn', function (event) {
//     let deleteGiftId = $(event.currentTarget).data('id')
//     deleteItem(route('donation.gift.destroy', deleteGiftId), 'Gift')
// })
//

listenClick('.gift-delete-btn', function (event) {
    let deleteGiftId = $(event.currentTarget).attr('data-id');
    swal({
        title: 'Delete !',
        text: 'Are you sure want to delete this "' + "Gift" + '" ?',
        icon: sweetAlertIcon,
        buttons: {
            confirm:'Yes, Delete!',
            cancel: 'No, Cancel',
        },
        reverseButtons: true,

    }).then((result) => {
        if (result) {
            $.ajax({
                url: route('donation.gift.destroy', deleteGiftId),
                type: 'DELETE',
                success: function success(result) {
                    if (result.success) {
                        displaySuccessMessage(result.message);
                    }
                    swal({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Gift' + ' has been deleted.',
                        type: 'success',
                        timer: 2000,
                    });
                    setTimeout(function () {
                        Turbo.visit(window.location.href)
                    }, 2000)
                },
                error: function error (data) {
                    swal({
                        title: 'Error',
                        icon: 'error',
                        text: data.responseJSON.message,
                        type: 'error',
                        timer: 4000,
                    });
                },
            });
        }
    });
});
