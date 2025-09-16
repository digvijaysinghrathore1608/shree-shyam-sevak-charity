'use strict'
document.addEventListener('DOMContentLoaded', loadFrontEventsData)

function loadFrontEventsData () {
    $(' .owl_1').owlCarousel({
        loop: false,
        margin: 2,
        responsiveClass: true, autoplayHoverPause: true,
        autoplay: true,
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
            1199: {
                items: 5,
                nav: true,
                loop: false,
            },
        }
    })
    
    $(document).ready(function () {
        var a = $('.owl-item a ')
        $('.owl-item a ').on('click',function () {
            a.removeClass('active')
            $(this).addClass('active')
        })
    })
}

listen('click', '.category_id', function () {
    let categoryId = $(this).attr('data-id')
    $('.category_id').each(function () {
        $(this).removeClass('active');
        if ($(this).attr('data-id') == categoryId) {
            $(this).addClass('active');
        }
    })
    window.livewire.emit('changeFilter', 'eventCategory', categoryId)
})
listen('click', '.bookSeatBtn', function () {
    let id = $(this).attr('data-id')
    $('#eventId').val(id)
    $('#bookSeatForm')[0].reset()
    $('#bookSeatModal').appendTo('body').modal('show')
})

listen('submit', '#bookSeatForm', function (e) {
    e.preventDefault();
    let avalableSeats = $('#availableSeat').text();
    $.ajax({
        url: route('landing.event.book-seat'),
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                iziToast.success({
                    title: 'Success',
                    message: result.message,
                    position: 'topRight',
                });
                $('#availableSeat').text(avalableSeats - 1)
                $('#bookSeatModalShow').modal('toggle')
                $('#bookSeatForm')[0].reset()
            }
        },
        error: function (result) {
            iziToast.error({
                title: 'Error',
                message: result.responseJSON.message,
                position: 'topRight',
            });
            $('#bookSeatForm')[0].reset();
        },
    });
});
$(document).ready(function () {
    let campaignEndDate = $('#campaignEndDate').val()
    const userInput = campaignEndDate;
    let seconds;

    const date = new Date(userInput);
    date.setHours(24);
    date.setMinutes(0);
    const now = new Date();
    seconds = parseInt((date.getTime() - now.getTime()) / 1000);

    let days, hours, minutes;

    days = Math.floor(seconds / (3600 * 24));
    seconds -= days * 3600 * 24;
    hours = Math.floor(seconds / 3600);
    seconds -= hours * 3600;
    minutes = Math.floor(seconds / 60);
    seconds -= minutes * 60;

    const validationPrint = (timeUnit) => {
        return timeUnit < 10 ? `0${timeUnit}` : timeUnit;
    };

    $('#seconds').text(validationPrint(seconds));
    $('#minutes').text(validationPrint(minutes));
    $('#hours').text(validationPrint(hours));
    $('#days').text(validationPrint(days));

    const changeTimeWithLimit = setInterval(() => {
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

