/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/call_to_actions/create_call_to_actions.js":
/*!***********************************************************************!*\
  !*** ./resources/assets/js/call_to_actions/create_call_to_actions.js ***!
  \***********************************************************************/
/***/ (() => {

"use strict";


listen('submit', '#callToActionForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('landing.call-to-actions'),
    type: 'post',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        iziToast.success({
          title: 'Success',
          message: result.message,
          position: 'topRight'
        });
        $('#callToActionForm')[0].reset();
      }
    },
    error: function error(result) {
      iziToast.error({
        title: 'Error',
        message: result.responseJSON.message,
        position: 'topRight'
      });
      $('#callToActionForm')[0].reset();
    }
  });
});

/***/ }),

/***/ "./resources/assets/js/contact_us_form/contact_us_form.js":
/*!****************************************************************!*\
  !*** ./resources/assets/js/contact_us_form/contact_us_form.js ***!
  \****************************************************************/
/***/ (() => {

"use strict";


listen('submit', '#getInTouchForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('landing.contact.store'),
    type: 'post',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        iziToast.success({
          title: 'Success',
          message: result.message,
          position: 'topRight'
        });
      }

      $('#getInTouchForm')[0].reset();
    },
    error: function error(result) {
      iziToast.error({
        title: 'Error.',
        message: result.responseJSON.message,
        position: 'topRight'
      });
    }
  });
});

/***/ }),

/***/ "./resources/assets/js/custom/helpers.js":
/*!***********************************************!*\
  !*** ./resources/assets/js/custom/helpers.js ***!
  \***********************************************/
/***/ (() => {

"use strict";


window.listen = function (event, selector, callback) {
  $(document).on(event, selector, callback);
};

window.listenClick = function (selector, callback) {
  $(document).on('click', selector, callback);
};

window.listenSubmit = function (selector, callback) {
  $(document).on('submit', selector, callback);
};

window.listenHiddenBsModal = function (selector, callback) {
  $(document).on('hidden.bs.modal', selector, callback);
};

window.listenChange = function (selector, callback) {
  $(document).on('change', selector, callback);
};

window.listenKeyup = function (selector, callback) {
  $(document).on('keyup', selector, callback);
};

/***/ }),

/***/ "./resources/assets/js/email_subscribe/email_subscribe.js":
/*!****************************************************************!*\
  !*** ./resources/assets/js/email_subscribe/email_subscribe.js ***!
  \****************************************************************/
/***/ (() => {

"use strict";


listen('submit', '#addEmailForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('email.subscribe.store'),
    type: 'POST',
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        iziToast.success({
          title: 'Success',
          message: result.message,
          position: 'topRight'
        });
        $('#addEmailForm')[0].reset();
      }
    },
    error: function error(result) {
      iziToast.error({
        title: 'Error',
        message: result.responseJSON.message,
        position: 'topRight'
      });
      $('#addEmailForm')[0].reset();
    }
  });
});

/***/ }),

/***/ "./resources/assets/js/events/landing-event.js":
/*!*****************************************************!*\
  !*** ./resources/assets/js/events/landing-event.js ***!
  \*****************************************************/
/***/ (() => {

"use strict";


document.addEventListener('DOMContentLoaded', loadFrontEventsData);

function loadFrontEventsData() {
  $(' .owl_1').owlCarousel({
    loop: false,
    margin: 2,
    responsiveClass: true,
    autoplayHoverPause: true,
    autoplay: true,
    slideSpeed: 400,
    paginationSpeed: 400,
    autoplayTimeout: 3000,
    responsive: {
      0: {
        items: 1,
        nav: true,
        loop: false
      },
      375: {
        items: 2,
        nav: true,
        loop: false
      },
      600: {
        items: 3,
        nav: true,
        loop: false
      },
      1000: {
        items: 4,
        nav: true,
        loop: false
      },
      1199: {
        items: 5,
        nav: true,
        loop: false
      }
    }
  });
  $(document).ready(function () {
    var a = $('.owl-item a ');
    $('.owl-item a ').on('click', function () {
      a.removeClass('active');
      $(this).addClass('active');
    });
  });
}

listen('click', '.category_id', function () {
  var categoryId = $(this).attr('data-id');
  $('.category_id').each(function () {
    $(this).removeClass('active');

    if ($(this).attr('data-id') == categoryId) {
      $(this).addClass('active');
    }
  });
  window.livewire.emit('changeFilter', 'eventCategory', categoryId);
});
listen('click', '.bookSeatBtn', function () {
  var id = $(this).attr('data-id');
  $('#eventId').val(id);
  $('#bookSeatForm')[0].reset();
  $('#bookSeatModal').appendTo('body').modal('show');
});
listen('submit', '#bookSeatForm', function (e) {
  e.preventDefault();
  var avalableSeats = $('#availableSeat').text();
  $.ajax({
    url: route('landing.event.book-seat'),
    type: 'post',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        iziToast.success({
          title: 'Success',
          message: result.message,
          position: 'topRight'
        });
        $('#availableSeat').text(avalableSeats - 1);
        $('#bookSeatModalShow').modal('toggle');
        $('#bookSeatForm')[0].reset();
      }
    },
    error: function error(result) {
      iziToast.error({
        title: 'Error',
        message: result.responseJSON.message,
        position: 'topRight'
      });
      $('#bookSeatForm')[0].reset();
    }
  });
});
$(document).ready(function () {
  var campaignEndDate = $('#campaignEndDate').val();
  var userInput = campaignEndDate;
  var seconds;
  var date = new Date(userInput);
  date.setHours(24);
  date.setMinutes(0);
  var now = new Date();
  seconds = parseInt((date.getTime() - now.getTime()) / 1000);
  var days, hours, minutes;
  days = Math.floor(seconds / (3600 * 24));
  seconds -= days * 3600 * 24;
  hours = Math.floor(seconds / 3600);
  seconds -= hours * 3600;
  minutes = Math.floor(seconds / 60);
  seconds -= minutes * 60;

  var validationPrint = function validationPrint(timeUnit) {
    return timeUnit < 10 ? "0".concat(timeUnit) : timeUnit;
  };

  $('#seconds').text(validationPrint(seconds));
  $('#minutes').text(validationPrint(minutes));
  $('#hours').text(validationPrint(hours));
  $('#days').text(validationPrint(days));
  var changeTimeWithLimit = setInterval(function () {
    seconds -= 1;
    $('#seconds').text(validationPrint(seconds));

    if (seconds === 0 && minutes > 0) {
      seconds = 60;
      minutes -= 1;
      $('#minutes').text(validationPrint(minutes));
    }

    if (seconds === 0 && minutes === 0 && hours > 0) {
      seconds = 60;
      minutes = 60;
      hours -= 1;
      $('#hours').text(validationPrint(hours));
    }

    if (seconds === 0 && minutes === 0 && hours === 0 && days > 0) {
      seconds = 60;
      minutes = 60;
      hours = 24;
      days -= 1;
      $('#days').text(validationPrint(days));
    }

    if (seconds === 0 && minutes === 0 && hours === 0 && days === 0) {
      clearInterval(changeTimeWithLimit);
    }
  }, 1000);
});

/***/ }),

/***/ "./resources/assets/js/front-side-about-us/about-us.js":
/*!*************************************************************!*\
  !*** ./resources/assets/js/front-side-about-us/about-us.js ***!
  \*************************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadFrontSideBrand);

function loadFrontSideBrand() {
  $('[data-toggle="tooltip"]').tooltip();
}

/***/ }),

/***/ "./resources/assets/js/front-side-campaigns-details/campaigns-details.js":
/*!*******************************************************************************!*\
  !*** ./resources/assets/js/front-side-campaigns-details/campaigns-details.js ***!
  \*******************************************************************************/
/***/ (() => {

"use strict";


document.addEventListener('DOMContentLoaded', loadFrontCampaignDetailsData);

function loadFrontCampaignDetailsData() {
  var images = document.querySelectorAll('.img-timg'),
      modal = document.querySelector('.modal'),
      content = document.querySelector('.modal-content'),
      closeBtn = document.querySelector('.close'),
      prevBtn = document.querySelector('.previous'),
      nextBtn = document.querySelector('.next'),
      caption = document.querySelector('.caption');
  var imgIndex;

  var openModal = function openModal() {
    modal.style.display = 'flex';
  };

  var closeModal = function closeModal() {
    modal.style.display = 'none';
  };

  var displayImg = function displayImg() {
    if (imgIndex > images.length - 1) {
      imgIndex = 0;
    }

    if (imgIndex < 0) {
      imgIndex = images.length - 1;
    }

    content.src = images[imgIndex].src;
    content.alt = images[imgIndex].alt;
  };

  var _loop = function _loop(i) {
    images[i].addEventListener('click', function () {
      imgIndex = i;
      openModal();
      displayImg();
    });
  };

  for (var i = 0; i < images.length; i++) {
    _loop(i);
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', function () {
      return closeModal();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', function () {
      imgIndex--;
      displayImg();
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', function () {
      imgIndex++;
      displayImg();
    });
  }

  listenKeyup(function (e) {
    if (e.key === 'Escape') {
      closeModal();
    }
  });
  listenKeyup(function (e) {
    if (e.key === 'ArrowRight') {
      imgIndex++;
      displayImg();
    }
  });
  listenKeyup(function (e) {
    if (e.key === 'ArrowRight') {
      imgIndex++;
      displayImg();
    }
  });
}

listenClick('.copy-link', function () {
  var $temp = $('<input>');
  $('body').append($temp);
  $temp.val($(this).attr('data-link')).select();
  document.execCommand('copy');
  $temp.remove();
  iziToast.success({
    title: 'Success',
    message: 'Link Copied.',
    position: 'topRight'
  });
});

/***/ }),

/***/ "./resources/assets/js/front-side-campaigns/campaigns.js":
/*!***************************************************************!*\
  !*** ./resources/assets/js/front-side-campaigns/campaigns.js ***!
  \***************************************************************/
/***/ (function() {

"use strict";


var _this = this;

document.addEventListener('DOMContentLoaded', loadFrontCampaignData);

function loadFrontCampaignData() {
  if ($('#campaignDonationForm').length) {
    $("#amount").trigger("keyup");
  }

  $(' .owl_1').owlCarousel({
    loop: false,
    margin: 2,
    responsiveClass: true,
    autoplayHoverPause: true,
    autoplay: false,
    slideSpeed: 400,
    paginationSpeed: 400,
    autoplayTimeout: 3000,
    responsive: {
      0: {
        items: 1,
        nav: true,
        loop: false
      },
      375: {
        items: 2,
        nav: true,
        loop: false
      },
      600: {
        items: 3,
        nav: true,
        loop: false
      },
      1000: {
        items: 4,
        nav: true,
        loop: false
      }
    }
  });
  $(document).ready(function () {
    var li = $('.owl-item li ');
    $('.owl-item li').on('click', function () {
      li.removeClass('active');
    });
  });
  var dueDate = $('#dueDate').val();

  if (dueDate !== undefined) {
    var countdown = function countdown() {
      var todayDate = new Date();
      var todayTime = todayDate.getTime();
      var remainingTime = endTime - todayTime;
      var oneMin = 60 * 1000;
      var oneHr = 60 * oneMin;
      var oneDay = 24 * oneHr;

      var addZeroes = function addZeroes(num) {
        return num < 10 ? "0".concat(num) : num;
      };

      if (endTime < todayTime) {
        clearInterval(i);
        document.querySelector('.countdown').innerHTML = "<h1>Countdown Has Expired</h1>";
      } else {
        var daysLeft = Math.floor(remainingTime / oneDay);
        var hrsLeft = Math.floor(remainingTime % oneDay / oneHr);
        var minsLeft = Math.floor(remainingTime % oneHr / oneMin);
        var secsLeft = Math.floor(remainingTime % oneMin / 1000);
        dayBox.textContent = addZeroes(daysLeft);
        hrBox.textContent = addZeroes(hrsLeft);
        minBox.textContent = addZeroes(minsLeft);
        secBox.textContent = addZeroes(secsLeft);
      }
    };

    dueDate = new Date(dueDate);
    dueDate.setHours(dueDate.getHours() + 24);
    var dayBox = document.getElementById('day-box');
    var hrBox = document.getElementById('hr-box');
    var minBox = document.getElementById('min-box');
    var secBox = document.getElementById('sec-box');
    var endDate = new Date(moment(dueDate).year(), moment(dueDate).month(), moment(dueDate).date(), moment(dueDate).hours(), moment(dueDate).minutes(), moment(dueDate).seconds());
    var endTime = endDate.getTime();
    var i = setInterval(countdown, 1000);
    countdown();
  }
}

$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  }
});
listen('click', '.campaign_category_id', function (event) {
  var campaignCategoryId = $(event.currentTarget).attr('data-id');
  $('.campaign_category_id').each(function () {
    $(this).removeClass('active');

    if ($(this).attr('data-id') == campaignCategoryId) {
      $(this).addClass('active');
    }
  });
  window.livewire.emit('changeFilter', 'campaignCategoryId', campaignCategoryId);
});
listen('click', '.currency', function () {
  $('#amount').val($(this).text());
  $('#yourAmount').text($(this).text());
});
listen('keyup', '#amount', function () {
  var amount = $('#amount').val();
  $('#yourAmount').text(amount);
  $('.prefilled-amount').removeClass('text-danger');
  var prefillAmounts = document.querySelectorAll('.prefilled-amount');
  prefillAmounts.forEach(function (prefillAmount) {
    if (prefillAmount.innerHTML === amount) {
      prefillAmount.classList.add('text-danger');
    }
  });
  var finalAmount = calculateTotalAmount(amount);
  $('.showTotalAmount').text(finalAmount ? finalAmount : 0);
  $('.charge_element').removeClass('d-none');

  if ($('#chargeAmtID').text() == 0 || amount == 0) {
    $('.charge_element').addClass('d-none');
  }
});
listen('change', 'input[name=\'payment_method\']', function () {
  var paymentType = $(this).val();
  var stripePayment = 1;
  var paypalPayment = 2;

  if (paymentType == stripePayment) {
    $('.stripePayment').removeClass('d-none');
    $('.paypalPayment').addClass('d-none');
  }

  if (paymentType == paypalPayment) {
    $('.paypalPayment').removeClass('d-none');
    $('.stripePayment').addClass('d-none');
  }
});
listen('click', '.paymentByStripe', function () {
  var campaignStripePaymentUrl = route('campaign.stripe-payment');
  var campaignId = $('#campaignId').val();
  var currencyCode = $('#currencyCode').val();
  var firstName = $('#firstName').val();
  var LastName = $('#lastName').val();
  var email = $('#email').val();
  var amount = $('#amount').val();
  var giftId = $('#donationAsGiftId').val();
  var donateAnonymously;

  if ($('#donateAnonymously').is(':checked')) {
    donateAnonymously = 1;
  } else {
    donateAnonymously = 0;
  }

  var payloadData = {
    amount: parseFloat(amount),
    currency_code: currencyCode,
    campaign_id: campaignId,
    first_name: firstName,
    last_name: LastName,
    email: email,
    donate_anonymously: donateAnonymously,
    gift_id: giftId
  };

  if (amount.trim().length === 0) {
    iziToast.error({
      title: 'Error',
      message: 'The amount field is required',
      position: 'topRight'
    });
    return false;
  } else if (amount === '0') {
    iziToast.error({
      title: 'Error',
      message: 'The amount is required greater than zero',
      position: 'topRight'
    });
    return false;
  } else if (amount < 30 && currencyCode === 'inr') {
    iziToast.error({
      title: 'Error',
      message: 'The amount is required greater than or equal to thirty for indian currency.',
      position: 'topRight'
    });
    return false;
  } else if (firstName.trim().length === 0) {
    iziToast.error({
      title: 'Error',
      message: 'The first name field is required',
      position: 'topRight'
    });
    return false;
  } else if (LastName.trim().length === 0) {
    iziToast.error({
      title: 'Error',
      message: 'The last name field is required',
      position: 'topRight'
    });
    return false;
  } else if (email.trim().length > 0) {
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
      iziToast.error({
        title: 'Error',
        message: 'Email field must be a valid email address',
        position: 'topRight'
      });
      return false;
    }
  }

  $(this).addClass('disabled');
  $('.donate-btn').text('Please Wait...');
  paymentByStripe(campaignStripePaymentUrl, payloadData);
});

var paymentByStripe = function paymentByStripe(campaignStripePaymentUrl, payloadData) {
  var stripeKey = $('#stripeKey').val();
  var stripe = Stripe(stripeKey);
  $.post(campaignStripePaymentUrl, payloadData).done(function (result) {
    var sessionId = result.data.sessionId;
    stripe.redirectToCheckout({
      sessionId: sessionId
    }).then(function (result) {
      $(this).addClass('disabled');
      $('.donate-btn').text('Please Wait...');
    });
  })["catch"](function (error) {
    $(_this).addClass('disabled');
    $('.donate-btn').text('Please Wait...');
  });
};

listen('click', '.paymentByPaypal', function () {
  var campaignId = $('#campaignId').val();
  var firstName = $('#firstName').val();
  var LastName = $('#lastName').val();
  var email = $('#email').val();
  var currencyCode = $('#currencyCode').val();
  var amount = $('#amount').val();
  var giftId = $('#donationAsGiftId').val();
  var donateAnonymously;

  if ($('#donateAnonymously').is(':checked')) {
    donateAnonymously = 1;
  } else {
    donateAnonymously = 0;
  }

  if (amount.trim().length === 0) {
    iziToast.error({
      title: 'Error',
      message: 'The amount field is required',
      position: 'topRight'
    });
    return false;
  } else if (amount === '0') {
    iziToast.error({
      title: 'Error',
      message: 'The amount is required greater than zero',
      position: 'topRight'
    });
    return false;
  } else if (firstName.trim().length === 0) {
    iziToast.error({
      title: 'Error',
      message: 'The first name field is required',
      position: 'topRight'
    });
    return false;
  } else if (LastName.trim().length === 0) {
    iziToast.error({
      title: 'Error',
      message: 'The last name field is required',
      position: 'topRight'
    });
    return false;
  }

  $(this).addClass('disabled');
  $('.donate-btn').text('Please Wait...');
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
      gift_id: giftId
    },
    success: function success(result) {
      if (result.url) {
        window.location.href = result.url;
      }

      if (result.statusCode === 201) {
        var redirectTo = '';
        $.each(result.result.links, function (key, val) {
          if (val.rel == 'approve') {
            redirectTo = val.href;
          }
        });
        location.href = redirectTo;
      }
    },
    error: function error(_error) {
      iziToast.error({
        title: 'Error',
        message: _error.responseJSON.message,
        position: 'topRight'
      });
      $('.paymentByPaypal').removeClass('disabled').text('Donate Now');
    },
    complete: function complete() {}
  });
});
listen('click', '.prefilled-amount', function () {
  $('.prefilled-amount').removeClass('amount-selected');
  $('.prefilled-amount').removeClass('text-danger');
  $(this).addClass('amount-selected');
  $(this).addClass('text-danger');
});
$(document).on('click', '.prefilled-amount', function () {
  var amount = $(this).text();
  var finalAmount = calculateTotalAmount(amount);
  $('.showTotalAmount').text(finalAmount ? finalAmount : 0);
}); // $(document).on('click', '.checkPaymentType', function () {
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
  var typeOfCommission = $('#typeOfCommission').val();
  var donationCommission = $('#donationCommission').val();
  var finalAmount = amount;

  if (donationCommission > 0) {
    if (typeOfCommission == 2) {
      var charge = parseFloat(amount) * parseFloat(donationCommission) / 100;
      finalAmount = parseFloat(amount) + charge;
      $('#chargeAmtID').text(charge ? charge : 0);
    } else {
      var _charge = parseFloat(donationCommission);

      finalAmount = parseFloat(amount) + _charge;
      $('#chargeAmtID').text(_charge ? _charge : 0);
    }
  }

  return finalAmount ? finalAmount : 0;
};

/***/ }),

/***/ "./resources/assets/js/front-side-index-page/index-page.js":
/*!*****************************************************************!*\
  !*** ./resources/assets/js/front-side-index-page/index-page.js ***!
  \*****************************************************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', loadFrontData);

function loadFrontData() {
  $('.counter').each(function () {
    var $this = $(this),
        countTo = $this.attr('data-countto');
    countDuration = parseInt($this.attr('data-duration'));
    $({
      counter: $this.text()
    }).animate({
      counter: countTo
    }, {
      duration: countDuration,
      easing: 'linear',
      step: function step() {
        $this.text(Math.floor(this.counter));
      },
      complete: function complete() {
        $this.text(this.counter);
      }
    });
  });
  $('.slick-slider').slick({
    dots: false,
    arrows: false,
    autoplay: true,
    autoplayspeed: 1600,
    centerPadding: '0',
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 1199,
      settings: {
        slidesToShow: 4
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 2
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 1
      }
    }]
  });
  $('.set > a').on('click', function () {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $(this).siblings('.content').slideUp(200);
      $('.set > a i').removeClass('fa-minus').addClass('fa-plus');
    } else {
      $('.set > a i').removeClass('fa-minus').addClass('fa-plus');
      $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
      $('.set > a').removeClass('active');
      $(this).addClass('active');
      $('.content').slideUp(200);
      $(this).siblings('.content').slideDown(200);
    }
  });
}

listen('click', '.slider-popup-video', function () {
  var videoUrl = $(this).attr('data-src');
  $('.home-page-video').attr('src', videoUrl);
  $('#homePageVideoModal').modal('show');
});
listen('hidden.bs.modal', '#homePageVideoModal', function () {
  $('.home-page-video').attr('src', '');
});
listen('hidden.bs.modal', '#exampleModal4', function () {
  $("#exampleModal4 iframe").attr("src", $("#exampleModal4 iframe").attr("src"));
});

/***/ }),

/***/ "./resources/assets/js/news/news-category-filter.js":
/*!**********************************************************!*\
  !*** ./resources/assets/js/news/news-category-filter.js ***!
  \**********************************************************/
/***/ (() => {

"use strict";


listen('click', '.news-category-filter', function (event) {
  $('.news-right-section .categories-section .categories span').css('color', '#757e81');
  var CategoryId = $(event.currentTarget).data('id');
  $('.news-category-filter').removeClass('active');
  $('.news-tags-filter').removeClass('active');
  $(event.currentTarget).find('span').css('color', '#009e74');
  $(event.currentTarget).addClass('active');
  window.livewire.emit('changeFilter', 'newsCategory', CategoryId);
});
listen('click', '.news-tags-filter', function (event) {
  var TagId = $(event.currentTarget).data('id');
  $('.news-tags-filter').removeClass('active');
  $('.news-category-filter').removeClass('active');
  $(event.currentTarget).addClass('active');
  window.livewire.emit('changeFilter', 'newsTags', TagId);
});

/***/ }),

/***/ "./resources/assets/js/news_comments/create_news_comments.js":
/*!*******************************************************************!*\
  !*** ./resources/assets/js/news_comments/create_news_comments.js ***!
  \*******************************************************************/
/***/ (() => {

"use strict";


document.addEventListener('DOMContentLoaded', loadCommentsData);

function loadCommentsData() {
  if ($('.post-comment').length == 0) {
    $('.comment-section').addClass('d-none');
  } else {
    $('.comment-section').removeClass('d-none');
  }
}

listen('submit', '#newsCommentsForm', function (e) {
  e.preventDefault();
  var websiteUrl = $('#websiteName').val();
  var websiteExp = new RegExp(/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)+[-a-z]/i);
  var websiteCheck = websiteUrl == '' ? true : websiteUrl.match(websiteExp) ? true : false;

  if (!websiteCheck) {
    iziToast.error({
      title: 'Error',
      message: 'Please enter a valid website name.',
      position: 'topRight'
    });
    return false;
  }

  $.ajax({
    url: route('landing.news-comments'),
    type: 'post',
    dataType: 'json',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        iziToast.success({
          title: 'Success',
          message: result.message,
          position: 'topRight'
        });
        var commentCount = result.data.commentCount;
        var newsComment = result.data.newsComment;
        $('#newsCommentsForm')[0].reset();
        $('#commentCount').html(commentCount + ' Comments');
        $('#commentCounts').html(commentCount + ' Comments');
        $('.comment-box').prepend("     \n                              <div class=\"media d-flex mt-40 mb-40\">\n                                        <div class=\"media-img me-sm-4 me-3 rounded-10\">\n                                            <img src=\"".concat(newsComment.user_id == null ? userDefaultImage : newsComment.users.profile_image, "\" class=\"w-100 h-100 rounded-10\" alt=\"comment-image\">                          \n                                        </div>\n                                        <div class=\"media-body w-100\">\n                                            <div class=\"media-title d-flex flex-wrap justify-content-between \">\n                                                <div class=\"d-flex align-items-center flex-wrap  mb-2\">\n                                                    <h5 class=\"mt-sm-0 mt-2 mb-0  text-black fs-18 fw-5 me-3 pe-sm-1\">").concat(newsComment.name, "</h5>\n                                                    <span class=\"text-gray fs-14 me-4 mt-sm-0 mt-2\">\n                                                        <span class=\"text-gray me-3 pe-sm-1\">|</span> ").concat(moment(newsComment.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'), "</span>\n                                                </div>\n<!--                                                <button class=\"reply-btn fs-18 fw-5 text-primary bg-white border-0  mb-2\">-->\n<!--                                                    <i class=\"fa-solid fa-reply me-2\"></i>Reply-->\n<!--                                                </button>-->\n                                            </div>\n                                            <p class=\"fs-16 fw-5 text-gray mb-0\">\n                                                ").concat(newsComment.comments, "\n                                            </p>\n                                        </div>\n                                    </div>"));

        if (commentCount == 0) {
          $('.comment-section').addClass('d-none');
        } else {
          $('.comment-section').removeClass('d-none');
        }
      }
    },
    error: function error(result) {
      iziToast.error({
        title: 'Error',
        message: result.responseJSON.message,
        position: 'topRight'
      });
    }
  });
});
listen('keyup', '#searchNews', function () {
  var value = $(this).val();
  window.livewire.emit('changeFilter', 'searchByNewsNameDesc', value);
});
listenClick('#resetNewsFilter', function () {
  var searchValue = $(document).find('#searchNews').val();

  if (searchValue) {
    var value = $(this).val();
    $('#searchNews').val('').trigger('change');
    window.livewire.emit('changeFilter', 'searchByNewsNameDesc', value);
  }
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	__webpack_modules__["./resources/assets/js/custom/helpers.js"]();
/******/ 	__webpack_modules__["./resources/assets/js/news/news-category-filter.js"]();
/******/ 	__webpack_modules__["./resources/assets/js/front-side-index-page/index-page.js"]();
/******/ 	__webpack_modules__["./resources/assets/js/email_subscribe/email_subscribe.js"]();
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	__webpack_modules__["./resources/assets/js/front-side-campaigns/campaigns.js"]();
/******/ 	__webpack_modules__["./resources/assets/js/front-side-campaigns-details/campaigns-details.js"]();
/******/ 	__webpack_modules__["./resources/assets/js/front-side-about-us/about-us.js"]();
/******/ 	__webpack_modules__["./resources/assets/js/events/landing-event.js"]();
/******/ 	__webpack_modules__["./resources/assets/js/contact_us_form/contact_us_form.js"]();
/******/ 	__webpack_modules__["./resources/assets/js/call_to_actions/create_call_to_actions.js"]();
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/js/news_comments/create_news_comments.js"]();
/******/ 	
/******/ })()
;