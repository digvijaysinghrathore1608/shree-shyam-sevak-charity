/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/assets/js/posts/posts.js ***!
  \********************************************/


var tableName = '#postsTable';
var tbl = $(tableName).DataTable({
  processing: true,
  serverSide: true,
  'language': {
    'lengthMenu': 'Show _MENU_'
  },
  'order': [[0, 'asc']],
  ajax: {
    url: route('posts.index')
  },
  columnDefs: [{
    'targets': [2],
    'orderable': false,
    'className': 'text-center',
    'width': '8%'
  }, {
    targets: '_all',
    defaultContent: 'N/A',
    'className': 'text-start align-middle text-nowrap'
  }],
  columns: [{
    data: 'name',
    name: 'name'
  }, {
    data: 'title',
    name: 'title'
  }, {
    data: function data(row) {
      var data = [{
        'id': row.id,
        'editUrl': route('posts.edit', row.id)
      }];
      return prepareTemplateRender('#actionsButtonTemplates', data);
    },
    name: 'id'
  }]
});
handleSearchDatatable(tbl);
listen('click', '#addPostBtn', function () {
  $('#createPostModal').appendTo('body').modal('show');
  resetModalForm('#createPostForm');
});
$('#editPostModal').on('hidden.bs.modal', function () {
  resetModalForm('#editPostForm', '#editPostValidationErrorsBox');
});
listen('click', '.edit-btn', function (event) {
  var id = $(event.currentTarget).data('id');
  renderData(id);
});

function renderData(id) {
  $.ajax({
    url: route('posts.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#PostID').val(result.data.id);
      $('#editName').val(result.data.name);
      $('#editTitle').val(result.data.title);
      $('#editPostModal').modal('show');
    }
  });
}

listen('submit', '#createPostForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('posts.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#createPostModal').modal('hide');
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('submit', '#editPostForm', function (e) {
  e.preventDefault(); // let loadingButton = jQuery(this).find('#skillSaveBtn');
  // loadingButton.button('loading');

  var formData = $(this).serialize();
  var id = $('#PostID').val();
  $.ajax({
    url: route('posts.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editPostModal').modal('hide');
      displaySuccessMessage(result.message);
      $(tableName).DataTable().ajax.reload(null, false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {// loadingButton.button('reset');
    }
  });
});
listen('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('posts.destroy', recordId), tableName, 'Post');
});
/******/ })()
;