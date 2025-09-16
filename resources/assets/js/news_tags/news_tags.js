'use strict'

listen('click', '.news-tags-delete-btn', function (event) {
    let deleteNewsTagsId = $(event.currentTarget).data('id')
    let url = route('news-tags.destroy', { news_tag: deleteNewsTagsId })
    deleteItem(url, 'News Tag')
})

