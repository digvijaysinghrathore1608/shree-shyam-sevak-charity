'use strict'

document.addEventListener('turbo:load', loadPageCreateEdit)

let pageQuill
let pageEditQuill

const bindings = {
    // This will overwrite the default binding also named 'tab'
    tab: {
        key: 9,
        handler: function () {
            // Handle tab
        }
    },
}

function loadPageCreateEdit () {
    loadPageCreate()
    loadPageEdit()
}

function loadPageCreate() {
    if (!$('#pageDescription').length) {
        pageQuill = null
        return
    }

    pageQuill = new Quill('#pageDescription', {
        modules: {
            toolbar: true,
            keyboard: {
                bindings: bindings
            },
            
        },
        placeholder: 'Description',
        theme: 'snow'
    });
}

function loadPageEdit() {
    if (!$('#pageEditDescription').length) {
        pageEditQuill = null
        return
    }

    pageEditQuill = new Quill('#pageEditDescription', {
        modules: {
            toolbar: true,
            keyboard: {
                bindings: bindings
            },
        },
        placeholder: 'Description',
        theme: 'snow'
    });

    let element = document.createElement('textarea');
    element.innerHTML = $('#pageDescriptionData').val();
    pageEditQuill.root.innerHTML = element.value;
}

listen('submit', '#pageCreateForm', function () {
    processingBtn('#pageCreateForm', '#btnPageSubmit',
        'loading')
    let editor_content = pageQuill.root.innerHTML;
    let input = JSON.stringify(editor_content);
    if (pageQuill.getText().trim().length === 0) {
        displayErrorMessage('Description field is required.');
        return false;
    }
    $('#description').val(input.replace(/"/g, ''));
})

listen('submit', '#pageEditForm', function () {
    processingBtn('#pageEditForm', '#btnPagedEditSave', 'loading')

    let editor_content = pageEditQuill.root.innerHTML;
    let input = JSON.stringify(editor_content);

    if (pageEditQuill.getText().trim().length === 0) {
        displayErrorMessage('Description field is required.');
        return false;
    }
    $('#description').val(input.replace(/"/g, ''));
})
