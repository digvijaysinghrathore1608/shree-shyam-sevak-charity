/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/assets/js/comments/comments.js ***!
  \**************************************************/


var tableName = '#commentsTable';
var tbl = $(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[0, 'asc']],
  'language': {
    'lengthMenu': 'Show _MENU_'
  },
  ajax: {
    url: route('comments.index')
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
    data: 'title',
    name: 'title'
  }, {
    data: 'name',
    name: 'name'
  }, {
    data: function data(row) {
      var data = [{
        'id': row.id,
        'editUrl': route('comments.edit', row.id)
      }];
      return prepareTemplateRender('#actionsButtonTemplates', data);
    },
    name: 'id'
  }]
});
handleSearchDatatable(tbl);
listen('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('comments.destroy', recordId), tableName, 'Comment');
});
/******/ })()
;