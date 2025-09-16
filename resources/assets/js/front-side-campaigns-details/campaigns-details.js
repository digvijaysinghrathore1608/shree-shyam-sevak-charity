'use strict'
document.addEventListener('DOMContentLoaded', loadFrontCampaignDetailsData)

function loadFrontCampaignDetailsData () {
    const images = document.querySelectorAll('.img-timg'),
        modal = document.querySelector('.modal'),
        content = document.querySelector('.modal-content'),
        closeBtn = document.querySelector('.close'),
        prevBtn = document.querySelector('.previous'),
        nextBtn = document.querySelector('.next'),
        caption = document.querySelector('.caption')

    let imgIndex
    const openModal = () => {
        modal.style.display = 'flex'
    }
    const closeModal = () => {
        modal.style.display = 'none'
    }
    const displayImg = () => {
        if (imgIndex > images.length - 1) { imgIndex = 0 }

        if (imgIndex < 0) { imgIndex = images.length - 1 }

        content.src = images[imgIndex].src
        content.alt = images[imgIndex].alt
    }
    for (let i = 0; i < images.length; i++) {
        images[i].addEventListener('click', () => {
            imgIndex = i
            openModal()
            displayImg()
        })
    }
    if (closeBtn) {
        closeBtn.addEventListener('click', () => closeModal())
    }
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            imgIndex--
            displayImg()
        })
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            imgIndex++
            displayImg()
        })
    }

    listenKeyup(function (e) {
        if (e.key === 'Escape') {
            closeModal()
        }
    })
    listenKeyup(function (e) {
        if (e.key === 'ArrowRight') {
            imgIndex++
            displayImg()
        }
    })
    listenKeyup(function (e) {
        if (e.key === 'ArrowRight') {
            imgIndex++
            displayImg()
        }
    })
}
listenClick('.copy-link', function () {
    let $temp = $('<input>')
    $('body').append($temp)
    $temp.val($(this).attr('data-link')).select()
    document.execCommand('copy')
    $temp.remove()
    iziToast.success({
        title: 'Success',
        message: 'Link Copied.',
        position: 'topRight',
    });
});
