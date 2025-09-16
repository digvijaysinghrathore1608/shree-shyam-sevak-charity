'use strict'
document.addEventListener('DOMContentLoaded', loadFrontCampaignData)

function loadFrontCampaignData () {

    if ($('#campaignDonationForm').length) {
        $("#amount").trigger("keyup");
    }

    $(' .owl_1').owlCarousel({
        loop: false,
        margin: 2,
        responsiveClass: true, autoplayHoverPause: true,
        autoplay: false,
        slideSpeed: 400,
        paginationSpeed: 400,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: false,
            },
            375: {
                items: 2,
                nav: true,
                loop: false,
            },
            600: {
                items: 3,
                nav: true,
                loop: false,
            },
            1000: {
                items: 4,
                nav: true,
                loop: false,
            },
        },
    })

    $(document).ready(function () {
        var li = $('.owl-item li ')
        $('.owl-item li').on('click', function () {
            li.removeClass('active')
        })
    })

    let dueDate = $('#dueDate').val();

    if (dueDate !== undefined) {
        dueDate = new Date(dueDate)
        dueDate.setHours(dueDate.getHours() + 24)

        let dayBox = document.getElementById('day-box')
        let hrBox = document.getElementById('hr-box')
        let minBox = document.getElementById('min-box')
        let secBox = document.getElementById('sec-box')
        let endDate = new Date(moment(dueDate).year(), moment(dueDate).month(), moment(dueDate).date(), moment(dueDate).hours(), moment(dueDate).minutes(), moment(dueDate).seconds())
        let endTime = endDate.getTime()

        function countdown() {
            let todayDate = new Date()
            let todayTime = todayDate.getTime()
            let remainingTime = endTime - todayTime
            let oneMin = 60 * 1000
            let oneHr = 60 * oneMin
            let oneDay = 24 * oneHr
            let addZeroes = (num) => (num < 10 ? `0${num}` : num)
            if (endTime < todayTime) {
                clearInterval(i)
                document.querySelector(
                    '.countdown').innerHTML = `<h1>Countdown Has Expired</h1>`
            } else {
                let daysLeft = Math.floor(remainingTime / oneDay)
                let hrsLeft = Math.floor((remainingTime % oneDay) / oneHr)
                let minsLeft = Math.floor((remainingTime % oneHr) / oneMin)
                let secsLeft = Math.floor((remainingTime % oneMin) / 1000)
                dayBox.textContent = addZeroes(daysLeft)
                hrBox.textContent = addZeroes(hrsLeft)
                minBox.textContent = addZeroes(minsLeft)
                secBox.textContent = addZeroes(secsLeft)
            }
        }

        let i = setInterval(countdown, 1000)
        countdown()
    }
}
$.ajaxSetup({
    headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
})

listen('click', '.campaign_category_id', function (event) {
    let campaignCategoryId = $(event.currentTarget).attr('data-id')
    $('.campaign_category_id').each(function () {
        $(this).removeClass('active');
        if ($(this).attr('data-id') == campaignCategoryId) {
            $(this).addClass('active');
        }
    })
    window.livewire.emit('changeFilter', 'campaignCategoryId',
        campaignCategoryId)
})

listen('click', '.currency', function () {
    $('#amount').val($(this).text())
    $('#yourAmount').text($(this).text())
})

listen('keyup', '#amount', function () {
    let amount = $('#amount').val()

    $('#yourAmount').text(amount)

    $('.prefilled-amount').removeClass('text-danger')

    var prefillAmounts = document.querySelectorAll('.prefilled-amount');
    prefillAmounts.forEach((prefillAmount) => {
        if (prefillAmount.innerHTML === amount) {
            prefillAmount.classList.add('text-danger')
        }
    })

    let finalAmount = calculateTotalAmount(amount);

    $('.showTotalAmount').text(finalAmount ? finalAmount : 0);

    $('.charge_element').removeClass('d-none');

    if ($('#chargeAmtID').text() == 0 || amount == 0) {
        $('.charge_element').addClass('d-none');
    }
})

listen('change', 'input[name=\'payment_method\']', function () {
    let paymentType = $(this).val()

    let stripePayment = 1
    let paypalPayment = 2

    if (paymentType == stripePayment) {
        $('.stripePayment').removeClass('d-none')
        $('.paypalPayment').addClass('d-none')
    }
    if (paymentType == paypalPayment) {
        $('.paypalPayment').removeClass('d-none')
        $('.stripePayment').addClass('d-none')
    }

})

listen('click', '.paymentByStripe', function () {


    let campaignStripePaymentUrl = route('campaign.stripe-payment')
    let campaignId = $('#campaignId').val()
    let currencyCode = $('#currencyCode').val()
    let firstName = $('#firstName').val()
    let LastName = $('#lastName').val()
    let email = $('#email').val()
    let amount = $('#amount').val()
    let giftId = $('#donationAsGiftId').val()
    let donateAnonymously
    if ($('#donateAnonymously').is(':checked')){
        donateAnonymously = 1
    } else{
        donateAnonymously = 0
    }

    let payloadData = {
        amount: parseFloat(amount),
        currency_code: currencyCode,
        campaign_id: campaignId,
        first_name: firstName,
        last_name: LastName,
        email: email,
        donate_anonymously: donateAnonymously,
        gift_id: giftId,
    }

    if (amount.trim().length === 0) {
        iziToast.error({
            title: 'Error',
            message: 'The amount field is required',
            position: 'topRight',
        })

        return false
    } else if (amount === '0') {
        iziToast.error({
            title: 'Error',
            message: 'The amount is required greater than zero',
            position: 'topRight',
        })

        return false
    } else if (amount < 30 && currencyCode === 'inr') {
        iziToast.error({
            title: 'Error',
            message: 'The amount is required greater than or equal to thirty for indian currency.',
            position: 'topRight',
        })

        return false
    } else if (firstName.trim().length === 0) {
        iziToast.error({
            title: 'Error',
            message: 'The first name field is required',
            position: 'topRight',
        })

        return false
    } else if (LastName.trim().length === 0) {
        iziToast.error({
            title: 'Error',
            message: 'The last name field is required',
            position: 'topRight',
        })

        return false
    } else if (email.trim().length > 0) {
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
            iziToast.error({
                title: 'Error',
                message: 'Email field must be a valid email address',
                position: 'topRight',
            })
            return false
        }
    }

    $(this).addClass('disabled')
    $('.donate-btn').text('Please Wait...')
    paymentByStripe(campaignStripePaymentUrl, payloadData)
})

const paymentByStripe = (campaignStripePaymentUrl, payloadData) => {
    let stripeKey = $('#stripeKey').val()
    let stripe = Stripe(stripeKey)
    $.post(campaignStripePaymentUrl, payloadData).done((result) => {
        let sessionId = result.data.sessionId
        stripe.redirectToCheckout({
            sessionId: sessionId,
        }).then(function (result) {
            $(this).addClass('disabled')
            $('.donate-btn').text('Please Wait...')
        })
    }).catch(error => {
        $(this).addClass('disabled')
        $('.donate-btn').text('Please Wait...')
    });
};

listen('click', '.paymentByPaypal', function () {

    let campaignId = $('#campaignId').val()
    let firstName = $('#firstName').val()
    let LastName = $('#lastName').val()
    let email = $('#email').val()
    let currencyCode = $('#currencyCode').val()
    let amount = $('#amount').val()
    let giftId = $('#donationAsGiftId').val()
    let donateAnonymously
    if ($('#donateAnonymously').is(':checked')){
        donateAnonymously = 1
    } else{
        donateAnonymously = 0
    }

    if (amount.trim().length === 0) {
        iziToast.error({
            title: 'Error',
            message: 'The amount field is required',
            position: 'topRight',
        })

        return false
    } else if (amount === '0') {
        iziToast.error({
            title: 'Error',
            message: 'The amount is required greater than zero',
            position: 'topRight',
        })

        return false
    } else if (firstName.trim().length === 0) {
        iziToast.error({
            title: 'Error',
            message: 'The first name field is required',
            position: 'topRight',
        })

        return false
    } else if (LastName.trim().length === 0) {
        iziToast.error({
            title: 'Error',
            message: 'The last name field is required',
            position: 'topRight',
        })

        return false
    }

    $(this).addClass('disabled')
    $('.donate-btn').text('Please Wait...')

    $.ajax({
        type: 'GET',
        url: route('paypal.init'),
        data: {
            amount: parseFloat($('#amount').val()),
            currency_code: $('#currencyCode').val(),
            campaign_id: campaignId,
            first_name: firstName,
            last_name: LastName,
            email: email,
            donate_anonymously: donateAnonymously,
            gift_id: giftId,
        },
        success: function (result) {

            if (result.url) {
                window.location.href = result.url
            }

            if (result.statusCode === 201) {
                let redirectTo = ''

                $.each(result.result.links,
                    function (key, val) {
                        if (val.rel == 'approve') {
                            redirectTo = val.href
                        }
                    })
                location.href = redirectTo
            }
        },
        error: function (error) {
            iziToast.error({
                title: 'Error',
                message: error.responseJSON.message,
                position: 'topRight',
            })
            $('.paymentByPaypal').removeClass('disabled').text('Donate Now')
        },
        complete: function () {
        },
    })

})

listen('click', '.prefilled-amount', function () {
    $('.prefilled-amount').removeClass('amount-selected')
    $('.prefilled-amount').removeClass('text-danger')
    $(this).addClass('amount-selected')
    $(this).addClass('text-danger')
})

$(document).on('click', '.prefilled-amount', function () {
    let amount = $(this).text();
    let finalAmount = calculateTotalAmount(amount);

    $('.showTotalAmount').text(finalAmount ? finalAmount : 0);
})

// $(document).on('click', '.checkPaymentType', function () {
//     let amount2;
//
//     let dynamicAmt = $('#amount').val();
//     if (dynamicAmt < 120) {
//         $('.prefilled-amount').each(function () {
//             if ($(this).hasClass('amount-selected')) {
//                 amount2 = $(this).text();
//             }
//         })
//     }else {
//         amount2 = dynamicAmt;
//     }
//
//     let finalAmount = calculateTotalAmount(amount2);
//
//     $('.showTotalAmount').text(finalAmount ? finalAmount : 0);
// })

// window.calculateTotalAmount = function (amount){
//     let stripeDiscountType = $('#stripeDiscountType').val();
//     let stripeDiscount = $('#stripeDiscount').val();
//     let paypalDiscountType = $('#paypalDiscountType').val();
//     let paypalDiscount = $('#paypalDiscount').val();
//
//     let finalAmount;
//     let paymentType = '';
//     if ($(".checkPaymentType").prop('checked')){
//         paymentType = $('.checkPaymentType').val();
//     }
//     if(paymentType == 1) {
//         if(stripeDiscountType == 1)  {
//             let charge = parseFloat(stripeDiscount);
//             finalAmount = parseFloat(amount) + charge;
//             $('#chargeAmtID').text(charge ? charge : 0);
//         }else {
//             let charge = (parseFloat(amount) * parseFloat(stripeDiscount))/100;
//             finalAmount = parseFloat(amount) + charge;
//             $('#chargeAmtID').text(charge ? charge : 0);
//         }
//     }else {
//         if(paypalDiscountType == 1)  {
//             let charge = parseFloat(paypalDiscount);
//             finalAmount = parseFloat(amount) + charge;
//             $('#chargeAmtID').text(charge ? charge : 0);
//         }else {
//             let charge = (parseFloat(amount) * parseFloat(paypalDiscount))/100;
//             finalAmount = parseFloat(amount) + charge;
//             $('#chargeAmtID').text(charge ? charge : 0);
//         }
//     }
//
//     return finalAmount ? finalAmount : 0;
// }

window.calculateTotalAmount = function (amount) {

    let typeOfCommission = $('#typeOfCommission').val();
    let donationCommission = $('#donationCommission').val();

    let finalAmount = amount;

    if (donationCommission > 0) {
        if (typeOfCommission == 2) {
            let charge = (parseFloat(amount) * parseFloat(donationCommission)) / 100;
            finalAmount = parseFloat(amount) + charge;
            $('#chargeAmtID').text(charge ? charge : 0);
        } else {
            let charge = parseFloat(donationCommission);
            finalAmount = parseFloat(amount) + charge;
            $('#chargeAmtID').text(charge ? charge : 0);
        }
    }

    return finalAmount ? finalAmount : 0;

}
