document.addEventListener('DOMContentLoaded', loadFrontData)

function loadFrontData () {
    $('.counter').each(function () {
        var $this = $(this),
            countTo = $this.attr('data-countto')
        countDuration = parseInt($this.attr('data-duration'))
        $({ counter: $this.text() }).animate(
            {
                counter: countTo,
            },
            {
                duration: countDuration,
                easing: 'linear',
                step: function () {
                    $this.text(Math.floor(this.counter))
                },
                complete: function () {
                    $this.text(this.counter)
                },
            },
        )
    })

    $('.slick-slider').slick({
        dots: false,
        arrows: false,
        autoplay: true,
        autoplayspeed: 1600,
        centerPadding: '0',
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    })

    $('.set > a').on('click', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
            $(this).siblings('.content').slideUp(200)
            $('.set > a i').removeClass('fa-minus').addClass('fa-plus')
        } else {
            $('.set > a i').removeClass('fa-minus').addClass('fa-plus')
            $(this).find('i').removeClass('fa-plus').addClass('fa-minus')
            $('.set > a').removeClass('active')
            $(this).addClass('active')
            $('.content').slideUp(200)
            $(this).siblings('.content').slideDown(200)
        }
    })
}

listen('click', '.slider-popup-video', function () {
    let videoUrl = $(this).attr('data-src');
    $('.home-page-video').attr('src',videoUrl);
    $('#homePageVideoModal').modal('show')
})

listen('hidden.bs.modal','#homePageVideoModal',function(){
    $('.home-page-video').attr('src','');
})

listen('hidden.bs.modal','#exampleModal4',function(){
        $("#exampleModal4 iframe").attr("src", $("#exampleModal4 iframe").attr("src"));
})
