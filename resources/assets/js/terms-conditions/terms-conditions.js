'use strict'

document.addEventListener('turbo:load', loadTermAndCondition)

let termConditionQuill
let privacyPolicyQuill

function loadTermAndCondition () {

    if (!$('#termConditionId').length && !$('#privacyPolicyId').length) {
        termConditionQuill = null
        privacyPolicyQuill = null

        return false
    }

    termConditionQuill = new Quill('#termConditionId', {
        modules: {
            toolbar: true
        },
        placeholder: 'Type your text here...',
        theme: 'snow'
    });

    termConditionQuill.on('text-change', function (delta, oldDelta, source) {
        if (termConditionQuill.getText().trim().length === 0) {
            termConditionQuill.setContents([{ insert: '' }])
        }
    })

     privacyPolicyQuill = new Quill('#privacyPolicyId', {
        modules: {
            toolbar: true
        },
        placeholder: 'Type your text here...',
        theme: 'snow'
    });

    privacyPolicyQuill.on('text-change', function (delta, oldDelta, source) {
        if (privacyPolicyQuill.getText().trim().length === 0) {
            privacyPolicyQuill.setContents([{ insert: '' }])
        }
    })

    let element = document.createElement('textarea')
    element.innerHTML = $('#termsConditionsData').val();
    termConditionQuill.root.innerHTML = element.value;

    element.innerHTML = $('#privacyPolicyData').val();
    privacyPolicyQuill.root.innerHTML = element.value;
}

listen('submit', '#editTermsConditionsForm', function (e) {
    e.stopImmediatePropagation()

    let element = document.createElement('textarea')
    let editor_content_1 = termConditionQuill.root.innerHTML
    element.innerHTML = editor_content_1
    let editor_content_2 = privacyPolicyQuill.root.innerHTML

    $('#termsConditionsData').val(editor_content_1)
    $('#privacyPolicyData').val(editor_content_2)

    if (termConditionQuill.getText().trim().length === 0) {
        displayErrorMessage('The Terms & Conditions is required.')
        return false
    }

    if (privacyPolicyQuill.getText().trim().length === 0) {
        displayErrorMessage('The Privacy Policy is required.')
        return false
    }
})
