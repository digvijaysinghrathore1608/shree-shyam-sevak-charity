'use strict'

listen('click', '.news-delete-btn', function (event) {
    let deleteNewsID = $(event.currentTarget).data('id')
    let url = route('news.destroy', { news: deleteNewsID })
    deleteItem(url, 'News')
})


