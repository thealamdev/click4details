@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

    <h1 class="page-header mb-3">
        Hi, {{ auth()->user()->name }}<small class="ms-2">here's what's happening with your store today.</small>
    </h1>

    <div class="profile">
        <div class="profile-header">
            <div class="profile-header-cover">
            </div>
            <div class="profile-header-content">
                <div class="profile-header-img">
                    <img src="https://images.pexels.com/photos/1198802/pexels-photo-1198802.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt>
                </div>
                <ul class="profile-header-tab nav nav-tabs nav-tabs-v2">
                    <li class="nav-item">
                        <a href="#jobTab" class="nav-link active" data-bs-toggle="tab">
                            <div class="nav-field">Jobs</div>
                            <div class="nav-value">{{ count($schedule['schedule']) }}</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#clientTab" class="nav-link" data-bs-toggle="tab">
                            <div class="nav-field">Clients</div>
                            <div class="nav-value">{{ count($schedule['requirements']) }}</div>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="profile-container">
            <div class="profile-content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tab-content p-0">
                            @include('content.admin.user.partials.dashboard.tabs.job-tab')
                            @include('content.admin.user.partials.dashboard.tabs.client-tab')
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('assets/js/backend/custom.js') }}"></script>

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
                    console.log(formData)
                    $.ajax({
                        type: "POST",
                        url: formUrl,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            dialog.modal('hide')
                            if (response.status == 400) {
                                tosterNotificaton(response.message)
                            }
                        }
                    });
                });

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#detailModalShow', function(e) {
                e.preventDefault();
                let dialog = '';
                let modalUrl = $(this).attr('href');
                let customerId = $(this).attr('formActionUrl');

                $.ajax({
                    type: "GET",
                    url: modalUrl,
                    success: function(response) {
                        dialog = bootbox.dialog({
                            title: 'Customer Follow up Details',
                            message: "<div class='modalContent'></div>",
                            size: 'large',

                        });
                        $('.modalContent').html(response);
                    }
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

    <!-- Update message function !-->
    <script>
        function updateMessage(event) {
            let targetUrl = $(event).attr('action');
            $.ajax({
                type: "GET",
                url: targetUrl,
                dataType: "json",
                success: function(response) {
                    if (response.status == 400) {
                        tosterNotificaton(response.message)
                    }
                }
            });

        }
    </script>
@endpush
