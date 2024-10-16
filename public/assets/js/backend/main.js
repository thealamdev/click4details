"use strict"

// @todo: Initialize data table plugin
var renderDataTable = (render = '#example', number = 10) => {
    const configuration = {
        menu: [
            [10, 12, 15, 20, 25, 50],
            [10, 12, 15, 20, 25, 50],
        ],
        lang: {
            lengthMenu: 'Display _MENU_ records per page',
            zeroRecords: 'Oops! no match records found',
            info: 'Showing page _PAGE_ of _PAGES_',
            infoEmpty: 'No records available',
            infoFiltered: '(filtered from _MAX_ total records)',
        },
        tree: "<'row'<'col-sm-12 col-lg-6'l><'col-sm-12 col-lg-6'f>>" + "<'row'<'col-sm-12'tr>>"
    }

    return $(render).DataTable({
        scrollY: false,
        scrollX: false,
        autoWidth: false,
        sort: true,
        responsive: false,
        lengthMenu: configuration.menu,
        language: configuration.lang,
        dom: configuration.tree,
        paging: true,
        drawCallback: function () {
            $('#dataTable_length [name="dataTable_length"]').removeClass('form-select-sm')
            $('#dataTable_filter input[type="search"]').removeClass('form-control-sm')
            // $('.dataTables_paginate > .pagination').addClass('pagination-sm')
        }
    });
}

// @todo: Image drag and drop using dropify
var uploadsDragDrop = (selector = '.dropify') => {
    return $(selector).dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop a new file or click the remove button to replace',
            'remove': 'Remove',
            'error': 'Oops! Something went wrong'
        },
        tpl: {
            message: '<div class="dropify-message"><span class="file-icon" /> <p class="fs-20">{{ default }}</p></div>',
        }
    })
}

// @todo: markdown text editor plugin initialized
var mdeMarkdownEditor = (selector = 'markdown') => {
    const easyMDE = new EasyMDE({
        element: document.getElementById(selector),
        toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image", "|", "undo", "horizontal-rule", "redo"]
    });
}

// @todo: Flash session toast notification message
var toastNotification = (status) => {
    const parse = document.getElementById('toastNotification')
    const onCtx = document.getElementById('sessionStatus')
    const toast = new bootstrap.Toast(parse)
    onCtx.innerText = status;
    toast.show();
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
