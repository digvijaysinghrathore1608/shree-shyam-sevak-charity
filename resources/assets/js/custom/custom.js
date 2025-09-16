'use strict';
let source = null;
let jsrender = require('jsrender');
let csrfToken = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken,
    },
});

document.addEventListener('turbo:load', initAllComponents);

let firstTime = true;

function initAllComponents () {
    select2initialize();
    refreshCsrfToken();
    IOInitImageComponent();
    alertInitialize();
    modalInputFocus();
    inputFocus();
    togglePassword();
    tooltip();
    IOInitSidebar();
    initComponent();
}

function initComponent() {
    if (firstTime) {
        firstTime = false
        return;
    }

    IOInitSideBarCollapse();
}

function tooltip() {
    var tooltipTriggerList =
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
}
const inputFocus = () => {
    $('input:text:not([readonly="readonly"]):not([name="search"]):not(.front-input)').first().focus();
}

const modalInputFocus = () => {
    $(function () {
        $('.modal').on('shown.bs.modal', function () {
            if ($(this).find('input:text')[0]) {
                $(this).find('input:text')[0].focus()
            }
        })
    })
}

function alertInitialize() {
    $('.alert').delay(5000).slideUp(300)
}

function refreshCsrfToken() {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    });
}

function select2initialize() {
    $('[data-control="select2"]').each(function () {
        $(this).select2()
    })
}

document.addEventListener('click', function (e) {
    let filterBtnEle = $(e.target).closest('.show[data-ic-dropdown-btn="true"]')
    let filterDropDownEle = $(e.target).closest('.show[data-ic-dropdown="true"]')

    if (!(filterBtnEle.length > 0 || filterDropDownEle.length > 0)) {
        $('[data-ic-dropdown-btn="true"]').removeClass('show')
        $('[data-ic-dropdown="true"]').removeClass('show')
    }
})

window.openDropdownManually = function (dropdownBtnEle, dropdownEle) {
    if (!dropdownBtnEle.hasClass('show')) {
        dropdownBtnEle.addClass('show')
        dropdownEle.addClass('show')
    } else {
        dropdownBtnEle.removeClass('show')
        dropdownEle.removeClass('show')
    }
}

window.hideDropdownManually = function (dropdownBtnEle, dropdownEle) {
    dropdownBtnEle.removeClass('show')
    dropdownEle.removeClass('show')
}

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        $('[data-control="select2"]').each(function () {
            $(this).select2()
        })
    })
})

$(document).ajaxComplete(function () {
    // Required for Bootstrap tooltips in DataTables
    $('[data-toggle="tooltip"]').tooltip({
        'html': true,
        'offset': 10,
    });
});


toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.resetModalForm = function (formId, validationBox) {
    $(formId)[0].reset();
    $('select.select2Selector').each(function (index, element) {
        let drpSelector = '#' + $(this).attr('id');
        $(drpSelector).val('');
        $(drpSelector).trigger('change');
    });
    $(validationBox).hide();
};

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html('');
    $(selector).text(errorResult.responseJSON.message);
};

window.manageAjaxErrors = function (data) {
    var errorDivId = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'editValidationErrorsBox';
    if (data.status == 404) {
        toastr.error(data.responseJSON.message);
    } else {
        printErrorMessage('#' + errorDivId, data);
    }
};

window.displaySuccessMessage = function (message) {
    toastr.success(message)
}

window.displayErrorMessage = function (message) {
    toastr.error(message)
}
window.deleteItem = function (url, header) {
    var callFunction = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    swal({
        title: 'Delete !',
        text: 'Are you sure want to delete this "' + header + '" ?',
        buttons: {
            confirm:'Yes, Delete!',
            cancel: 'No, Cancel',
        },
        reverseButtons: true,
        icon: sweetAlertIcon,
    }).then(function (willDelete) {
        if(willDelete){
            deleteItemAjax(url, header, callFunction);
        }
    });
};

function deleteItemAjax (url, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                window.Livewire.emit('resetPageTable');
                livewire.emit('refresh')
                window.livewire.emit('refreshDatatable')
                window.livewire.emit('resetPage')
            }
            swal({
                icon: 'success',
                title: 'Deleted!',
                text: header + ' has been deleted.',
                timer: 2000,
            })
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            swal({
                title: 'Error',
                icon: 'error',
                text: data.responseJSON.message,
                type: 'error',
                timer: 4000,
            });
        },
    });
}

window.format = function (dateTime) {
    var format = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'DD-MMM-YYYY';
    return moment(dateTime).format(format);
};

window.processingBtn = function (selecter, btnId, state = null) {
    var loadingButton = $(selecter).find(btnId);
    if (state === 'loading') {
        loadingButton.button('loading');
    } else {
        loadingButton.button('reset');
    }
};

window.prepareTemplateRender = function (templateSelector, data) {
    let template = jsrender.templates(templateSelector);
    return template.render(data);
};

window.isValidFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: jpeg, jpg, png.').
            show();
        $(validationMessageSelector).delay(5000).slideUp(300);

        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};
window.removeCommas = function (str) {
    return str.replace(/,/g, '');
};

window.DatetimepickerDefaults = function (opts) {
    return $.extend({}, {
        sideBySide: true,
        ignoreReadonly: true,
        icons: {
            close: 'fa fa-times',
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-arrow-up',
            down: 'fa fa-arrow-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-clock-o',
            clear: 'fa fa-trash-o',
        },
    }, opts);
};

window.isEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

window.screenLock = function () {
    $('#overlay-screen-lock').show();
    $('body').css({ 'pointer-events': 'none', 'opacity': '0.6' });
};

window.screenUnLock = function () {
    $('body').css({ 'pointer-events': 'auto', 'opacity': '1' });
    $('#overlay-screen-lock').hide();
};

window.onload = function () {
    window.startLoader = function () {
        $('.infy-loader').show();
    };

    window.stopLoader = function () {
        $('.infy-loader').hide();
    };

    stopLoader();
};

$(document).ready(function () {
    // script to active parent menu if sub menu has currently active
    let hasActiveMenu = $(document).
        find('.nav-item.dropdown ul li').
        hasClass('active');
    if (hasActiveMenu) {
        $(document).
            find('.nav-item.dropdown ul li.active').
            parent('ul').
            css('display', 'block');
        $(document).
            find('.nav-item.dropdown ul li.active').
            parent('ul').
            parent('li').
            addClass('active');
    }
});

window.urlValidation = function (value, regex) {
    let urlCheck = (value == '' ? true : (value.match(regex)
        ? true
        : false));
    if (!urlCheck) {
        return false;
    }

    return true;
};

$('.languageSelection').on('click', function () {
    let languageName = $(this).data('prefix-value');

    $.ajax({
        type: 'POST',
        url: '/change-language',
        data: { languageName: languageName },
        success: function () {
            location.reload();
        },
    });
});



if ($(window).width() > 992) {
    $('.no-hover').on('click', function () {
        $(this).toggleClass('open');
    });
}

$(document).on('click', '#readNotification', function (e) {
    e.preventDefault();
    let notificationId = $(this).data('id');
    let notification = $(this);
    $.ajax({
        type: 'POST',
        url: readNotification +'/'+ notificationId + '/read',
        data: { notificationId: notificationId },
        success: function () {
            notification.remove();
            let notificationCounter = document.getElementsByClassName(
                'readNotification').length;
            if (notificationCounter == 0) {
                $('#readAllNotification').addClass('d-none');
                $('.empty-state').removeClass('d-none');
                $('.notification-toggle').removeClass('beep');
            }
        },
        error: function (error) {
            manageAjaxErrors(error);
        },
    });
});

$(document).on('click', '#readAllNotification', function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: readAllNotifications,
        success: function () {
            $('.readNotification').remove();
            $('#readAllNotification').addClass('d-none');
            $('.empty-state').removeClass('d-none');
            $('.notification-toggle').removeClass('beep');
        },
        error: function (error) {
            manageAjaxErrors(error);
        },
    });
});

$('#register').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownLanguage').trigger('click');
    $('.open #dropdownLogin').trigger('click');
});
$('#language').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownRegister').trigger('click');
    $('.open #dropdownLogin').trigger('click');
});
$('#login').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownRegister').trigger('click');
    $('.open #dropdownLanguage').trigger('click');
});

window.checkSummerNoteEmpty = function (
    selectorElement, errorMessage, isRequired = 0) {
    if ($(selectorElement).summernote('isEmpty') && isRequired === 1) {
        displayErrorMessage(errorMessage);
        $(document).find('.note-editable').html('<p><br></p>');
        return false;
    } else if (!$(selectorElement).summernote('isEmpty')) {
        $(document).find('.note-editable').contents().each(function () {
            if (this.nodeType === 3) { // text node
                this.textContent = this.textContent.replace(/\u00A0/g, '');
            }
        });
        if ($(document).find('.note-editable').text().trim().length == 0) {
            $(document).find('.note-editable').html('<p><br></p>');
            $(selectorElement).val(null);
            if (isRequired === 1) {
                displayErrorMessage(errorMessage);

                return false;
            }
        }
    }

    return true;
};

window.preparedTemplate = function () {
    let source = $('#actionTemplate').html();
    window.preparedTemplate = Handlebars.compile(source);
};

window.ajaxCallInProgress = function () {
    ajaxCallIsRunning = true;
};

window.ajaxCallCompleted = function () {
    ajaxCallIsRunning = false;
};

window.avoidSpace = function (event) {
    let k = event ? event.which : window.event.keyCode;
    if (k == 32) {
        return false;
    }
};

listen('click', '#profileDropdownBtn', function () {
    openDropdownManually($('#profileDropdownBtn'), $('#profileDropdown'))
})

listen('click', '#languageDropdownBtn', function () {
    openDropdownManually($('#languageDropdownBtn'), $('#languageDropdown'))
})

window.addCommas = function (number) {
    number += ''
    var x = number.split('.')
    var x1 = x[0]
    var x2 = x.length > 1 ? '.' + x[1] : ''
    var rgx = /(\d+)(\d{3})/

    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2')
    }

    return x1 + x2
}

listenClick('.backendLanguage', function () {
    let languageName = $(this).attr('data-prefix-value')

    $.ajax({
        type: 'POST',
        url: route('change.language'),
        data: { languageName: languageName },
        success: function (result) {
            displaySuccessMessage(result.message)
            setTimeout(function () {
                Turbo.visit(window.location.href)
            }, 1000)
        },
    })
})
jQuery(document).ready(function ($) {
    $('.aside-item-collapse > ul').hide()
    $('.aside-item-collapse').on('click', function () {
        $(this).
            toggleClass('collapse-menu').
            siblings().
            removeClass('collapse-menu')
        var $menuItem = $(this).children('.aside-submenu')
        $menuItem.stop(true, true).slideToggle('slow')
        $('.aside-submenu').not($menuItem).slideUp()
    })
})
listen('focus', '.select2.select2-container', function (e) {
    let isOriginalEvent = e.originalEvent // don't re-open on closing focus event
    let isSingleSelect = $(this).find('.select2-selection--single').length > 0 // multi-select will pass focus to input

    if (isOriginalEvent && isSingleSelect) {
        $(this).siblings('select:enabled').select2('open')
    }
})
listen('select2:open', () => {
    let allFound = document.querySelectorAll(
        '.select2-container--open .select2-search__field')
    allFound[allFound.length - 1].focus()
})

function togglePassword () {
    $('[data-toggle="password"]').each(function () {
        var input = $(this)
        var eye_btn = $(this).parent().find('.input-icon')
        eye_btn.css('cursor', 'pointer').addClass('input-password-hide')
        eye_btn.on('click', function () {
            if (eye_btn.hasClass('input-password-hide')) {
                eye_btn.removeClass('input-password-hide').
                    addClass('input-password-show')
                eye_btn.find('.bi').
                    removeClass('bi-eye-slash-fill').
                    addClass('bi-eye-fill')
                input.attr('type', 'text')
            } else {
                eye_btn.removeClass('input-password-show').
                    addClass('input-password-hide')
                eye_btn.find('.bi').
                    removeClass('bi-eye-fill').
                    addClass('bi-eye-slash-fill')
                input.attr('type', 'password')
            }
        })
    })
}
