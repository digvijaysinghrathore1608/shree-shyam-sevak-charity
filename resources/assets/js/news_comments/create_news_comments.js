'use strict'
document.addEventListener('DOMContentLoaded', loadCommentsData)

function loadCommentsData () {
    if ($('.post-comment').length == 0) {
        $('.comment-section').addClass('d-none')
    } else {
        $('.comment-section').removeClass('d-none')
    }
}

listen('submit', '#newsCommentsForm', function (e) {
    e.preventDefault()

    let websiteUrl = $('#websiteName').val()

    let websiteExp = new RegExp(
        /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)+[-a-z]/i)

    let websiteCheck = (websiteUrl == '' ? true : (websiteUrl.match(
        websiteExp) ? true : false))

    if (!websiteCheck) {
        iziToast.error({
            title: 'Error',
            message: 'Please enter a valid website name.',
            position: 'topRight',
        })
        return false
    }

    $.ajax({
        url: route('landing.news-comments'),
        type: 'post',
        dataType: 'json',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {

            if (result.success) {
                iziToast.success({
                    title: 'Success',
                    message: result.message,
                    position: 'topRight',
                })
                let commentCount = result.data.commentCount
                let newsComment = result.data.newsComment
                $('#newsCommentsForm')[0].reset()
                $('#commentCount').html(commentCount + ' Comments')
                $('#commentCounts').html(commentCount + ' Comments')
                
                $('.comment-box').prepend(
                    `     
                              <div class="media d-flex mt-40 mb-40">
                                        <div class="media-img me-sm-4 me-3 rounded-10">
                                            <img src="${(newsComment.user_id ==
                        null)
                        ? userDefaultImage
                        : newsComment.users.profile_image}" class="w-100 h-100 rounded-10" alt="comment-image">                          
                                        </div>
                                        <div class="media-body w-100">
                                            <div class="media-title d-flex flex-wrap justify-content-between ">
                                                <div class="d-flex align-items-center flex-wrap  mb-2">
                                                    <h5 class="mt-sm-0 mt-2 mb-0  text-black fs-18 fw-5 me-3 pe-sm-1">${newsComment.name}</h5>
                                                    <span class="text-gray fs-14 me-4 mt-sm-0 mt-2">
                                                        <span class="text-gray me-3 pe-sm-1">|</span> ${moment(
                        newsComment.created_at, 'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY')}</span>
                                                </div>
<!--                                                <button class="reply-btn fs-18 fw-5 text-primary bg-white border-0  mb-2">-->
<!--                                                    <i class="fa-solid fa-reply me-2"></i>Reply-->
<!--                                                </button>-->
                                            </div>
                                            <p class="fs-16 fw-5 text-gray mb-0">
                                                ${newsComment.comments}
                                            </p>
                                        </div>
                                    </div>`
                    ,
                )
                if (commentCount == 0) {
                    $('.comment-section').addClass('d-none')
                } else {
                    $('.comment-section').removeClass('d-none')
                }
            }
        },
        error: function (result) {
            iziToast.error({
                title: 'Error',
                message: result.responseJSON.message,
                position: 'topRight',
            })
        },
    })
})

listen('keyup', '#searchNews', function () {
    let value = $(this).val()

    window.livewire.emit('changeFilter', 'searchByNewsNameDesc', value)
})

listenClick('#resetNewsFilter', function () {
    let searchValue = $(document).find('#searchNews').val()

    if (searchValue) {
        let value = $(this).val()
        $('#searchNews').val('').trigger('change')
        window.livewire.emit('changeFilter', 'searchByNewsNameDesc', value)
    }

})
