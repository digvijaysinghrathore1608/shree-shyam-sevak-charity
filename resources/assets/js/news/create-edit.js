'use strict'

document.addEventListener('turbo:load', loadNewsCreateEdit)

let newsDetailsQuill

function loadNewsCreateEdit () {
    if (!$('#newsEditDetails').length) {
        newsDetailsQuill = null
        return false
    }

    if ($('#newsTagId').length) {
        $('#newsTagId').select2({
            placeholder: 'Tags',
            allowClear: true,
        })
    }

    let bindings = {
        // This will overwrite the default binding also named 'tab'
        tab: {
            key: 9,
            handler: function () {
                // Handle tab
            }
        },
    }

    newsDetailsQuill = new Quill('#newsEditDetails', {
        modules: {
            toolbar: true,
            keyboard: {
                bindings: bindings
            }
        },
        placeholder: 'Type your text here...',
        theme: 'snow',
    })

    newsDetailsQuill.on('text-change', function (delta, oldDelta, source) {
        if (newsDetailsQuill.getText().trim().length === 0) {
            newsDetailsQuill.setContents([{ insert: '' }])
        }
    })

    if ($('#newsIsEdit').length) {
        if (!$('#newsIsEdit').val()) {
            return false;
        }
        let editNewsDescriptionData = $('#editNewsDescriptionData').val();
        let element = document.createElement('textarea');
        element.innerHTML = editNewsDescriptionData;
        newsDetailsQuill.root.innerHTML = element.value;
    }
}

listen('keyup', '#newsCreateTitle', function () {
    var newsCreateTitle = $('#newsCreateTitle').val()

    $('#newsCreateSlug').val(newsCreateTitle.toLowerCase().replace(/\s+/g, '-'))

    var newsCreateSlug = $('#newsCreateSlug').val()

    if (newsCreateSlug.length > 15) {
        $('#newsCreateSlug').val(newsCreateSlug.substr(0, 15))
    }
});

listen('submit', '#addNewsForm', function (e) {
    e.preventDefault()
    if (newsDetailsQuill.getText().trim().length === 0) {
        displayErrorMessage('The description field is required.')
        return false
    }
    processingBtn('#addNewsForm', '#btnNewsSave',
        'loading')
    $('#btnNewsSave').prop('disabled', true)
    let editor_content = newsDetailsQuill.root.innerHTML
    let input = JSON.stringify(editor_content)
    $('#description').val(input.replace(/"/g, ''))
    $('#addNewsForm')[0].submit()
    return true
})

listen('submit', '#editNewsForm', function (event) {
    event.preventDefault()
    if (newsDetailsQuill.getText().trim().length === 0) {
        displayErrorMessage('The description field is required.')
        return false
    }
    processingBtn('#editNewsForm', '#btnNewsSave', 'loading')
    $('#btnNewsSave').prop('disabled', true)
    let editor_content = newsDetailsQuill.root.innerHTML
    let input = JSON.stringify(editor_content)
    $('#description').val(input.replace(/"/g, ''))
    $('#editNewsForm')[0].submit()

    return true
})
