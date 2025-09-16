'use strict'

document.addEventListener('turbo:load', loadCampaignCreateEdit)

let campaignDescriptionCreateQuill
let editCampaignDescriptionQuill

function loadCampaignCreateEdit () {
    if ($('#giftStatus').is(':checked')){
        $('.gift-div').removeClass('d-none')
    }
    else{
        $('.gift-div').addClass('d-none')
    }
    if ($('#selectGiftId').length) {
        $('#selectGiftId').select2({
            placeholder: 'Select Gifts',
            allowClear: true,
        })
    }
    const campaignStartDateEle = $('#campaignStartDate')
    const campaignDeadlineDateEle = $('#campaignDeadlineDate')
    if (campaignStartDateEle.length) {
        campaignStartDateEle.flatpickr({
            altInput: true,
            altFormat: "J F, Y",
            dateFormat: 'Y-m-d ',
            minDate: "today"
        })
    }
    if (campaignDeadlineDateEle.length) {
        campaignDeadlineDateEle.flatpickr({
            altInput: true,
            altFormat: 'J F, Y',
            dateFormat: 'Y-m-d ',
            minDate: 'today',
        })
    }

    if ($('#campaignIsEdit').length || $('#editCampaignFieldForm').length) {
        let campaignDeadlineDate = undefined

        if ($('campaignId').length) {
            $('#campaignStartDate').flatpickr({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true,
                minDate: moment(new Date()).format('YYYY-MM-DD'),
                onChange: function (selectedDates, dateStr, instance) {
                    let campaignStartMinDate = moment(
                        $('#campaignStartDate').val()).format()
                    if (typeof followUpDate != 'undefined') {
                        followUpDate.set('minDate', campaignStartMinDate)
                    }
                },
            })
        } else {
            $('#campaignStartDate').flatpickr({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true,
                minDate: moment(new Date()).format('YYYY-MM-DD'),
                onChange: function (selectedDates, dateStr, instance) {
                    let campaignStartMinDate = moment(
                        $('#campaignStartDate').val()).format()
                    if (typeof campaignDeadlineDate != 'undefined') {
                        campaignDeadlineDate.set('minDate',
                            campaignStartMinDate)
                    }
                },
            })
        }

        campaignDeadlineDate = $('#campaignDeadlineDate').flatpickr({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true,
        })

        let campaignStartMinDate = moment($('#campaignStartDate').val()).
            format()

        campaignDeadlineDate.set('minDate', campaignStartMinDate)
    }

    if ($('#currencyType').length) {
        $('#currencyType').select2()
    }

    if ($('#campaignCreateTitle').length && $('#campaignCreateSlug').length) {
        $('#campaignCreateTitle').keyup(function () {
            let campaignCreateTitle = $('#campaignCreateTitle').val()

            $('#campaignCreateSlug').
                val(campaignCreateTitle.toLowerCase().replace(/\s+/g, '-'))

            var campaignCreateSlug = $('#campaignCreateSlug').val()

            if (campaignCreateSlug.length > 15) {
                $('#campaignCreateSlug').val(campaignCreateSlug.substr(0, 15))
            }
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

    if ($('#campaignDescriptionCreateId').length){
        campaignDescriptionCreateQuill = new Quill('#campaignDescriptionCreateId', {
            modules: {
                toolbar: [
                    [
                        {
                            header: [1, 2, false],
                        }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                ],
                keyboard: {
                    bindings: bindings
                }
            },
            placeholder: 'Description',
            theme: 'snow',
        });

        campaignDescriptionCreateQuill.on('text-change', function (delta, oldDelta, source) {
            if (campaignDescriptionCreateQuill.getText().trim().length === 0) {
                campaignDescriptionCreateQuill.setContents([{ insert: '' }]);
            }
            $('#campaignCreateDescription').val(campaignDescriptionCreateQuill.root.innerHTML);
        });
    }

    if ($('#editCampaignDescriptionId').length) {
        editCampaignDescriptionQuill = new Quill('#editCampaignDescriptionId', {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false], }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                ],
                keyboard: {
                    bindings: bindings
                }
            },
            placeholder: 'Description',
            theme: 'snow',
        });

        editCampaignDescriptionQuill.on('text-change', function (delta, oldDelta, source) {
            if (editCampaignDescriptionQuill.getText().trim().length === 0) {
                editCampaignDescriptionQuill.setContents([{ insert: '' }]);
            }
            $('#editCampaignDescription').val(editCampaignDescriptionQuill.root.innerHTML)
        });

        const editCampaignDescriptionData = $('#editCampaignDescriptionData').val()
        let element = document.createElement('textarea')
        element.innerHTML = editCampaignDescriptionData
        editCampaignDescriptionQuill.root.innerHTML = element.value
    }

    if ($('#campaignImageDropZone').length) {
        let campaignDropZoneId = $('#campaignId').val()

        new Dropzone('#campaignImageDropZone', {
            url: route('campaign.file.store', campaignDropZoneId),
            paramName: 'file',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            maxFiles: 10,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFilesize: 10,
            addRemoveLinks: true,
            success: function () {
                $('.dz-message').addClass('d-none')
                displaySuccessMessage('File uploaded successfully.')
            },
            removedfile: function (file) {
                let campaignDropZoneId = $('#campaignId').val()
                let name = file.name;
                $.ajax({
                    type: 'POST',
                    url: route('remove.campaign.file'),
                    data: { 'file': name , 'id': campaignDropZoneId},
                    success: function (result) {
                        if (result.success){
                            if(result.data.length == 0)
                            {
                                $('.dz-message').removeClass('d-none')   
                            }
                            displaySuccessMessage(result.message)
                        }
                    },
                });
                let _ref;
                return (_ref = file.previewElement) != null
                    ? _ref.parentNode.removeChild(file.previewElement)
                    : void 0;
            },
            init: function () {
                let dpzMultipleFiles = this;
                $.ajax({
                    url: route('get.campaign.file', campaignDropZoneId),
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        $.each(response.data, function (key, value) {
                            if (value.name.length){
                                $('.dz-message').addClass('d-none')
                            }
                            if (value.name.length==''){
                                $('.dz-message').removeClass('d-none')
                            }
                            let mockFile = {
                                name: value.name,
                                size: value.size,
                            };
                            dpzMultipleFiles.emit('addedfile', mockFile)
                            dpzMultipleFiles.emit('complete', mockFile)
                            dpzMultipleFiles.emit('thumbnail', mockFile,
                                value.url)
                        });
                    },
                });
            }
        })
    }

    if ($('#userCampaignImageDropZone').length) {
        let campaignDropZoneId = $('#userCampaignId').val()

        new Dropzone('#userCampaignImageDropZone', {
            url: route('user.campaign.file.store', campaignDropZoneId),
            paramName: 'file',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            maxFiles: 10,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFilesize: 10,
            addRemoveLinks: true,
            success: function () {
                $('.dz-message').addClass('d-none')
                displaySuccessMessage('File uploaded successfully.')
            },
            removedfile: function (file) {
                let name = file.name
                $.ajax({
                    type: 'POST',
                    url: route('user.remove.campaign.file'),
                    data: { 'file': name, 'id': campaignDropZoneId },
                    success: function (result) {
                        if (result.data.length==0) {
                            $('.dz-message').removeClass('d-none')
                        }
                        displaySuccessMessage(result.message)
                    },
                })
                let _ref
                return (_ref = file.previewElement) != null
                    ? _ref.parentNode.removeChild(file.previewElement)
                    : void 0
            },
            init: function () {
                let dpzMultipleFiles = this
                $.ajax({
                    url: route('user.get.campaign.file', campaignDropZoneId),
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        $.each(response.data, function (key, value) {
                            if (value.name.length){
                                $('.dz-message').addClass('d-none')
                            }
                            if (value.name.length==''){
                                $('.dz-message').removeClass('d-none')
                            }
                            let mockFile = {
                                name: value.name,
                                size: value.size,
                            }
                            dpzMultipleFiles.emit('addedfile', mockFile)
                            dpzMultipleFiles.emit('complete', mockFile)
                            dpzMultipleFiles.emit('thumbnail', mockFile,
                                value.url)
                        })
                    },
                })
            },
        })
    }

}

listen('submit', '#editCampaignFieldForm', function (e) {
    e.preventDefault()
    $('#editCampaignFieldBtnSave').prop('disabled', true);
    let regexp = /(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi;
    let validUrl =  regexp.test($('#video_link').val());

    if(!isEmpty($('#video_link').val()) && !validUrl){
        $('#editCampaignFieldBtnSave').prop('disabled', false)
        displayErrorMessage('Video URL is invalid.')
        return false;
    }
    let campaignId = $('#campaignId').val()
    $.ajax({
        url: route('update.field', campaignId),
        method: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addDefineGoal').removeClass('active show')
                $('#addGallery').addClass('active show')
                $('#add-gallery-tab').addClass('active')
                $('#add-define-goal').removeClass('active')
                $('#editCampaignFieldBtnSave').prop('disabled', false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editCampaignFieldBtnSave').prop('disabled', false);
        },
        complete: function () {
            processingBtn('#editCampaignFieldForm', '#editCampaignFieldBtnSave')
        },
    });
});

listen('submit', '#campaignCreateForm', function () {
    if (campaignDescriptionCreateQuill.getText().trim().length === 0) {
        displayErrorMessage('The description field is required.')
        return false
    }
    if (campaignDescriptionCreateQuill.getText().trim().length > 10000) {
        displayErrorMessage('The description is too long.')
        return false
    }

    $('#btnSubmit').prop('disabled', true)
})

listen('submit', '#userCampaignCreateForm', function () {
    if (campaignDescriptionCreateQuill.getText().trim().length === 0) {
        displayErrorMessage('The description field is required.')
        return false
    }
    if (campaignDescriptionCreateQuill.getText().trim().length > 10000) {
        displayErrorMessage('The description is too long.')
        return false
    }

    $('#btnSubmit').prop('disabled', true)
})

listen('submit', '#campaignEditForm', function () {
    if (editCampaignDescriptionQuill.getText().trim().length === 0) {
        displayErrorMessage('The description field is required.')
        return false
    }
    if (editCampaignDescriptionQuill.getText().trim().length > 10000) {
        displayErrorMessage('The description is too long.')
        return false
    }
    if ($('#giftStatus').prop('checked')) {
        if ($('#selectGiftId').val().length === 0) {
            displayErrorMessage('Gifts field is required.')
            return false
        }
    }
    
    let editor_content = editCampaignDescriptionQuill.root.innerHTML
    let input = JSON.stringify(editor_content)
    $('#editCampaignDescription').val(input.replace(/"/g, ''))

    $('#editCampaignBtn').prop('disabled', true)
})

listen('submit', '#userEditCampaignFieldForm', function (e) {
    e.preventDefault()
    let regexp = /(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi;
    let validUrl =  regexp.test($('#video_link').val());
    
    if(!isEmpty($('#video_link').val()) && !validUrl){
        displayErrorMessage('Video URL is invalid.')
        return false;
    }

    let userCampaignId = $('#userCampaignId').val()
    $.ajax({
        url: route('user.update.field', userCampaignId),
        method: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addDefineGoal').removeClass('active show')
                $('#addGallery').addClass('active show')
                $('#addGalleryBtn').addClass('active')
                $('#addDefineGoalBtn').removeClass('active')
                $('#userEditCampaignFieldBtnSave').prop('disabled', false)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#userEditCampaignFieldBtnSave').prop('disabled', false)
        },
        complete: function () {
            processingBtn('#userEditCampaignFieldForm',
                '#userEditCampaignFieldBtnSave')
        },
    })
})

listen('click', '#giftStatus', function () {
    if ($('#giftStatus').is(':checked')){
        $('.gift-div').removeClass('d-none')
    }
    else{
        $('.gift-div').addClass('d-none')
    }
})
