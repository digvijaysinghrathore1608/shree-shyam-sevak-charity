'use strict'

listen('click', '.news-category-filter', function (event) {
    $('.news-right-section .categories-section .categories span').css('color','#757e81')
    let CategoryId = $(event.currentTarget).data('id')
    $('.news-category-filter').removeClass('active')
    $('.news-tags-filter').removeClass('active')
    $(event.currentTarget).find('span').css('color','#009e74')
    $(event.currentTarget).addClass('active')
    window.livewire.emit('changeFilter', 'newsCategory', CategoryId)
})

listen('click', '.news-tags-filter', function (event) {
    let TagId = $(event.currentTarget).data('id')
    $('.news-tags-filter').removeClass('active')
    $('.news-category-filter').removeClass('active')
    $(event.currentTarget).addClass('active')
    window.livewire.emit('changeFilter', 'newsTags', TagId)
})






