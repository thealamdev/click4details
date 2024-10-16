@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        @include('content.package.vehicle.requirement.partials.navigation')
    </div>

    <div class="rounded mb-3">
        @include('content.package.vehicle.requirement.partials.form')
    </div>

    <div class="rounded border border-slate-100">
        @include('content.package.vehicle.requirement.partials.table')
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var attributes = [
                '.brands', '.condition',
                '.skeleton',
                '.transmission', '.model', '.color', '.grade', '.available', '.registration', '.fuel',
                '.customerDetailsion', '.feature'
            ];

            attributes.forEach(function(e) {
                $(e).select2({
                    placeholder: 'Enter ' + e.substring(
                        1)
                });
            });
        });
    </script>

    <script>
        var input = document.querySelectorAll('.formInput');
        input.forEach((element, index) => {
            element.addEventListener('keyup', function() {
                if (event.key === "Enter") {
                    input[index + 1].focus()
                }
            })
        });

        // var submit = document.querySelector('.submit')
        // submit.addEventListener('focus', function() {
        //     this.type = "submit"
        // })
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#bootModalShow', function(e) {
                e.preventDefault();
                let dialog = '';
                let modalUrl = $(this).attr('href');
                let formUrl = $(this).attr('formActionUrl');
                let title = $(this).attr('title');

                $.ajax({
                    type: "GET",
                    url: modalUrl,
                    success: function(response) {
                        dialog = bootbox.dialog({
                            title: title,
                            message: "<div class='modalContent'></div>",
                            size: 'large',

                        });
                        $('.modalContent').html(response);
                    }
                });

                $(document).on('submit', '#createOrUpdateModal', function(e) {
                    e.preventDefault();
                    let formData = new FormData($('#createOrUpdateModal')[0]);
                    $.ajax({
                        type: "POST",
                        url: formUrl,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            dialog.modal('hide')
                        }
                    });
                });

            });
        });
    </script>

    <script>
        function deleteItem(element, deleteItemClass) {
            if (confirm('Are you sure to delete this???')) {
                let actionUrl = $(element).attr('deleteAction');

                let removeItemClass = 'removeItem' + deleteItemClass;

                $.ajax({
                    type: "GET",
                    url: actionUrl,
                    success: function(response) {
                        $('.' + removeItemClass).remove();
                    }
                });
            }
        }
    </script>

    <script>
        function visitForm(event) {
            let visitClass = 'visitForm' + event;
            let visitForm = document.querySelector('.' + visitClass);

            if (visitForm) {
                if (visitForm.style.display === 'block') {
                    visitForm.style.display = 'none';
                } else {
                    visitForm.style.display = 'block';
                }
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            // Function to toggle message divs
            $(document).on('click', '.toggleMessageButton', function() {
                var $container = $(this).closest('.message-container');
                var $messageMainDiv = $container.find('.messageMainDiv');
                var $messageIdDiv = $container.find('.messageIdDiv');
                var $button = $(this);

                if ($messageMainDiv.css('display') === 'none') {
                    $messageMainDiv.css('display', 'block');
                    $messageIdDiv.css('display', 'none');
                    $button.removeClass('btn-info').addClass('btn-primary').html(
                        '<i class="fa-solid fa-plus"></i>');
                } else {
                    $messageMainDiv.css('display', 'none');
                    $messageIdDiv.css('display', 'block');
                    $button.removeClass('btn-primary').addClass('btn-info').html(
                        '<i class="fa-solid fa-times"></i>');
                }
            });

            // Function to add new input fields
            $(document).on('click', '.addItem', function() {
                var followupId = $(this).data('requirement-id');
                var formContainer = $('#formItemsContainer' + followupId);

                var newInputField =
                    '<div class="row formItem p-4 m-auto border border-slate-300 rounded mb-3">' +
                    '<div class="col-lg-12 mb-3">' +
                    '<input type="text" name="message[]" placeholder="Enter the message" class="form-control">' +
                    '</div>' +
                    '<div class="col-lg-6">' +
                    '<input type="date" name="send_date[]" placeholder="Enter Message Send Date" class="form-control">' +
                    '</div>' +
                    '<div class="col-lg-6">' +
                    '<input type="time" name="call_time[]" placeholder="Enter the call info" class="form-control">' +
                    '</div>' +
                    '<div class="col-lg-12 mt-3 text-center">' +
                    '<button type="button" class="btn btn-secondary addItem" data-requirement-id="' +
                    followupId + '">+</button>' +
                    '<button type="button" class="btn btn-danger removeItem">-</button>' +
                    '</div>' +
                    '</div>';

                formContainer.append(newInputField);
            });

            // Function to remove input fields
            $(document).on('click', '.removeItem', function() {
                $(this).closest('.formItem').remove();
            });

            // Form submission logic
            $(document).on('submit', '.submitFormItem', function(e) {
                e.preventDefault();
                let formUrl = $(this).attr('action');
                let formData = new FormData(this);
                let reloadBody = $('.reloadBody');
                let formContainer = $(this).closest('.visitForm');

                // Collect data from only visible input elements
                $(this).find('.formItem input:visible').each(function() {
                    formData.append($(this).attr('name'), $(this).val());
                });
                console.log(formData);

                $.ajax({
                    type: "POST",
                    url: formUrl,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (Array.isArray(response)) {
                            response.forEach(function(item) {
                                var submittedDataHtml =
                                    '<div class="row removeItem">' +
                                    '<div class="col-lg-1 text-center">' +
                                    (item.send_date ? new Date(item.send_date)
                                        .toLocaleDateString('en-US', {
                                            day: '2-digit',
                                            month: 'short',
                                            year: 'numeric'
                                        }) : '--') +
                                    '</div>' +
                                    '<div class="col-lg-5">' +
                                    (item.message ? '<p class="text-success">' + item
                                        .message + '</p>' : '') +
                                    (item.note ? '<span> Note:</span>' + '<p class="text-success">' + item
                                        .note + '</p>' : '') +
                                    '<div class="row reloadItem">' +
                                    '<div class="col-lg-12"></div>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-lg-1 d-flex mt-2 align-items-start">' +
                                    (item.message ?
                                        '<a class="inline-block btn btn-sm border border-slate-100" href="https://wa.me/+88?text=' +
                                        encodeURIComponent(item.message) +
                                        '"><i class="text-success fa-brands fa-whatsapp"></i></a>' :
                                        '--') +
                                    '</div>' +
                                    '<div class="col-lg-1 mt-2">' +
                                    '<form action="" method="POST">' +
                                    '@csrf' +
                                    '@method('PUT')' +
                                    (item.send_status ?
                                        '<i class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>' :
                                        '<button type="submit" class="btn btn-sm border border-slate-100"><i class="las la-paper-plane"></i></button>'
                                    ) +
                                    '</form>' +
                                    '</div>' +
                                    '<div class="col-lg-1 mt-2">' +
                                    '<form action="" method="POST">' +
                                    '@csrf' +
                                    '@method('PUT')' +
                                    (item.call_status ?
                                        '<i class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>' :
                                        '<button type="submit" class="btn btn-sm border border-slate-100"><i class="fa-solid fa-phone"></i></button>'
                                    ) +
                                    '</form>' +
                                    '</div>' +
                                    '<div class="col-lg-1 mt-2 text-center">' +
                                    '<a title="" id="bootModalShow" class="p-1 border border-slate-100 rounded text-slate-900" href=""><i class="fs-6 align-middle fa-solid fa-plus"></i></a>' +
                                    '</div>' +
                                    '</div>' +
                                    '<hr>';

                                reloadBody.append(submittedDataHtml);
                            });
                        } else {
                            console.error("Response is not iterable or empty.");
                        }

                        if (formContainer.length) {
                            formContainer.css('display', 'none');
                            let formElement = formContainer.find('.submitFormItem')[0];
                            if (formElement) {
                                formElement.reset();
                            }
                            formContainer.find('.formItem').not(':first').remove();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred during AJAX request:", error);
                    }
                });
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            // Function to toggle message divs
            $(document).on('click', '.toggleMessageButton', function() {
                var $container = $(this).closest('.message-container');
                var $messageMainDiv = $container.find('.messageMainDiv');
                var $messageIdDiv = $container.find('.messageIdDiv');
                var $button = $(this);

                if ($messageMainDiv.css('display') === 'none') {
                    $messageMainDiv.css('display', 'block');
                    $messageIdDiv.css('display', 'none');
                    $button.removeClass('btn-info').addClass('btn-primary').html('<i class="fa-solid fa-plus"></i>');
                } else {
                    $messageMainDiv.css('display', 'none');
                    $messageIdDiv.css('display', 'block');
                    $button.removeClass('btn-primary').addClass('btn-info').html('<i class="fa-solid fa-times"></i>');
                }
            });

            // Function to add new input fields
            let formLength = @json($count);
            $(document).on('click', '.addItem', function() {
                formLength = +Number(formLength) + 1;
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.vehicle.requirement.index') }}",
                    data: {
                        data: formLength
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(@json($formLenCount))
                    }
                });
            });

            // Function to remove input fields
            $(document).on('click', '.removeItem', function() {
                $(this).closest('.formItem').remove();
            });

            // Form submission logic
            $(document).on('submit', '.submitFormItem', function(e) {
                e.preventDefault();
                let formUrl = $(this).attr('action');
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: formUrl,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (Array.isArray(response)) {
                            response.forEach(function(item) {
                                var submittedDataHtml =
                                    '<div class="row removeItem">' +
                                    '<div class="col-lg-1 text-center">' +
                                    (item.send_date ? new Date(item.send_date).toLocaleDateString('en-US', {
                                        day: '2-digit',
                                        month: 'short',
                                        year: 'numeric'
                                    }) : '--') +
                                    '</div>' +
                                    '<div class="col-lg-5">' +
                                    (item.message ? '<p class="text-success">' + item.message + '</p>' : '') +
                                    '<div class="row reloadItem">' +
                                    '<div class="col-lg-12"></div>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-lg-1 d-flex mt-2 align-items-start">' +
                                    (item.message ? '<a class="inline-block btn btn-sm border border-slate-100" href="https://wa.me/+88?text=' + encodeURIComponent(item.message) + '"><i class="text-success fa-brands fa-whatsapp"></i></a>' : '--') +
                                    '</div>' +
                                    '<div class="col-lg-1 mt-2">' +
                                    '<form action="" method="POST">' +
                                    '@csrf' +
                                    '@method('PUT')' +
                                    (item.send_status ? '<i class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>' : '<button type="submit" class="btn btn-sm border border-slate-100"><i class="las la-paper-plane"></i></button>') +
                                    '</form>' +
                                    '</div>' +
                                    '<div class="col-lg-1 mt-2">' +
                                    '<form action="" method="POST">' +
                                    '@csrf' +
                                    '@method('PUT')' +
                                    (item.call_status ? '<i class="fa-solid fa-check fs-5 fw-900 text-success border border-slate-100 p-1 rounded"></i>' : '<button type="submit" class="btn btn-sm border border-slate-100"><i class="fa-solid fa-phone"></i></button>') +
                                    '</form>' +
                                    '</div>' +
                                    '<div class="col-lg-1 mt-2 text-center">' +
                                    '<a title="" id="bootModalShow" class="p-1 border border-slate-100 rounded text-slate-900" href=""><i class="fs-6 align-middle fa-solid fa-plus"></i></a>' +
                                    '</div>' +
                                    '</div>' +
                                    '<hr>';
                                reloadBody.append(submittedDataHtml);
                            });
                        } else {
                            console.error("Response is not iterable or empty.");
                        }
                        if (formContainer.length) {
                            formContainer.css('display', 'none');
                            let formElement = formContainer.find('.submitFormItem')[0];
                            if (formElement) {
                                formElement.reset();
                            }
                            formContainer.find('.formItem').not(':first').remove();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred during AJAX request:", error);
                    }
                });
            });
        });
    </script> --}}


    <script>
        // addCall script
        function addCall(event) {
            let formUrl = $(event).attr('route');

            $.ajax({
                type: "GET",
                url: formUrl,
                success: function(response) {
                    let alert = `<div class="alert alert-primary" role="alert">
                                 This is a primary alert—check it out!
                                </div>`;
                }
            });
        }
    </script>
@endpush
